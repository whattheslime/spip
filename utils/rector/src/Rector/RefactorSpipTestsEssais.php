<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use Nette\Utils\Strings;
use PhpParser\Builder\Method as MethodBuilder;
use PhpParser\Builder\Use_ as UseBuilder;
use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Expression;
use PhpParser\Node\Stmt\Function_;
use Rector\Core\NodeManipulator\ClassInsertManipulator;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
use RectorPrefix202209\Symfony\Component\String\UnicodeString;
use PhpParser\Node\Stmt\Use_;
use Rector\Core\Application\FileSystem\RemovedAndAddedFilesCollector;
use Rector\Core\PhpParser\Node\NodeFactory;

final class RefactorSpipTestsEssais extends AbstractRector
{
	private string $namespace = 'Spip\\Core\\Tests';

	/**
	 * @readonly
	 * @var \Rector\Core\NodeManipulator\ClassInsertManipulator
	 */
	private $classInsertManipulator;

	/**
     * @readonly
     * @var \Rector\Core\Application\FileSystem\RemovedAndAddedFilesCollector
     */
    private $removedAndAddedFilesCollector;

	public function __construct(ClassInsertManipulator $classInsertManipulator, RemovedAndAddedFilesCollector $removedAndAddedFilesCollector)
	{
		$this->classInsertManipulator = $classInsertManipulator;
		$this->removedAndAddedFilesCollector = $removedAndAddedFilesCollector;
	}

	/**
	 * @return array<class-string<Node>>
	 */
	public function getNodeTypes(): array
	{
		return [Namespace_::class];
	}

	/**
	 * @param MethodCall $node - we can add "MethodCall" type here, because
	 *                         only this node is in "getNodeTypes()"
	 */
	public function refactor(Node $node): ?Node
	{

		$fqdn = $this->getFqdn();
		$newNamespace = $fqdn->slice(0, -1)->toString();
		$this->isChangedInNamespaces[$newNamespace] = \true;
		$node->name = new Name($newNamespace);

		$uses = [
			(new UseBuilder('PHPUnit\\Framework\\TestCase', Use_::TYPE_NORMAL))->getNode()
		];

		$class = $this->createTestClass($fqdn->getLast());
		$class->namespacedName = $node->name;

		$setUpMethod = $this->createPublicStaticMethod('setUpBeforeClass');
		$this->classInsertManipulator->addAsFirstMethod($class, $setUpMethod);

		foreach ($node->stmts as $key => $stmt) {
			if ($stmt instanceof Expression) {
				$setUpMethod->stmts[] = $stmt;
			} elseif ($stmt instanceof Function_) {
				$method = $this->createPublicMethod($stmt->name->toString());
				$method->stmts = $stmt->stmts;
				$class->stmts[] = $method;
			}
		}

		$node->stmts = [
			...$uses,
			$class,
		];

		$this->renameFile($fqdn);
		return $node;

	}

	/**
	 * This method helps other to understand the rule and to generate documentation.
	 */
	public function getRuleDefinition(): RuleDefinition
	{
		return new RuleDefinition(
			'Move essais/*.php to PHPUnit.',
			[
				new CodeSample(
					<<<CODESAMPLE
					function test_connect_sql_id_table_objet(...\$args) {
						return id_table_objet(...\$args);
					}
					// ...
					CODESAMPLE,
					<<<CODESAMPLE
					class IdTableObjetTest extends TestCase {
						function testIdTableObjet(\$expected, ...\$args) {
							\$this->expectEquals(\$expected, id_table_objet(...\$args));
						}
						// ...
					}
					CODESAMPLE,
				),
			]
		);
	}

	private function getFqdn(): FullyQualified
	{
		$filePath = $this->file->getFilePath();
		$dirname = basename(\pathinfo($filePath, \PATHINFO_DIRNAME));
		$basename = \pathinfo($filePath, \PATHINFO_FILENAME);

		$dir = new UnicodeString($dirname);
		$dir = ucfirst($dir->camel()->toString());

		$file = new UnicodeString($basename);
		$file = ucfirst($file->camel()->toString()) . 'Test';

		return new FullyQualified($this->namespace . "\\Essais\\$dir\\$file");
	}

	/** @see https://github.com/rectorphp/rector/blob/main/rules/Restoration/Rector/ClassLike/UpdateFileNameByClassNameFileSystemRector.php */
	private function renameFile(FullyQualified $namespace): void {
		$filePath = $this->file->getFilePath();

		$newPath = $namespace->slice(3)->toString();

		$filePath = $this->file->getFilePath();
		$newFileLocation = \dirname($filePath) . \DIRECTORY_SEPARATOR . $newPath . '.php';

		$this->removedAndAddedFilesCollector->addMovedFile($this->file, $newFileLocation);
	}


	private function createTestClass(string $name): Class_
	{
		$class = new Class_($name);

		$class->extends = new FullyQualified('TestCase');

		return $class;
	}

	private function createPublicStaticMethod($name)
	{
		$method = new MethodBuilder($name);
		$method->makePublic();
		$method->makeStatic();
		$method->setReturnType(new Identifier('void'));
		return $method->getNode();
	}

	private function createPublicMethod($name)
	{
		$method = new MethodBuilder($name);
		$method->makePublic();
		$method->setReturnType(new Identifier('void'));
		return $method->getNode();
	}
}
