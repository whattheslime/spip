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
use PhpParser\Node\Stmt\ClassLike;
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

final class MoveSpipTestsEssais extends AbstractRector
{
	private string $namespace = 'Spip\\Core\\Tests';


	/**
     * @readonly
     * @var \Rector\Core\Application\FileSystem\RemovedAndAddedFilesCollector
     */
    private $removedAndAddedFilesCollector;

	public function __construct(RemovedAndAddedFilesCollector $removedAndAddedFilesCollector)
	{
		$this->removedAndAddedFilesCollector = $removedAndAddedFilesCollector;
	}

	/**
	 * This method helps other to understand the rule and to generate documentation.
	 */
	public function getRuleDefinition(): RuleDefinition
	{
		return new RuleDefinition(
			'Move PHPUnit essais/*.php to another directory.',
			[
				new CodeSample(
					<<<CODESAMPLE
					// essais/some_dir/some_file.php
					namespace Spip\Core\Tests\Something;
					class SomeWhatTest {
					}
					CODESAMPLE,
					<<<CODESAMPLE
					// Something/SomeWhatTest.php
					namespace Spip\Core\Tests\Something;
					class SomeWhatTest {
					}
					CODESAMPLE,
				),
			]
		);
	}

	/**
	 * @return array<class-string<Node>>
	 */
	public function getNodeTypes(): array
	{
		return [ClassLike::class];
	}

	public function refactor(Node $node): ?Node
	{
		$className = $this->getName($node);
        if ($className === null) {
            return null;
        }
	
        $classShortName = $this->nodeNameResolver->getShortName($className);
        $filePath = $this->file->getFilePath();
        $basename = \pathinfo($filePath, \PATHINFO_BASENAME);
        if ($classShortName === $basename) {
            return null;
        }

        // no match → rename file
        $newFileLocation = \dirname($filePath) . \DIRECTORY_SEPARATOR . $classShortName . '.php';
        $this->removedAndAddedFilesCollector->addMovedFile($this->file, $newFileLocation);
        return null;

		$fqdn = $this->getFqdn();
		$this->renameFile($fqdn);
		return $node;

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

		return new FullyQualified($this->namespace . "\\RectorEssais\\$dir\\$file");
	}

	/** @see https://github.com/rectorphp/rector/blob/main/rules/Restoration/Rector/ClassLike/UpdateFileNameByClassNameFileSystemRector.php */
	private function renameFile(FullyQualified $namespace): void {
		$filePath = $this->file->getFilePath();

		$newPath = str_replace('\\', '/', $namespace->slice(3)->toString());

		$filePath = $this->file->getFilePath();
		$newFileLocation = \dirname($filePath, 3) . \DIRECTORY_SEPARATOR . $newPath . '.php';
dump($newFileLocation);
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
