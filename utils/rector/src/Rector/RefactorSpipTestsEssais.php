<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use PhpParser\Builder\Class_ as ClassBuilder;
use PhpParser\BuilderFactory;
use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\Node\Stmt\ClassLike;
use PhpParser\Node\Stmt\Expression;
use PhpParser\Node\Stmt\Function_;
use PhpParser\Node\Stmt\Return_;
use Rector\Core\NodeManipulator\ClassInsertManipulator;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
use RectorPrefix202209\Symfony\Component\String\UnicodeString;

final class RefactorSpipTestsEssais extends AbstractRector
{
	private string $namespace = 'Spip\\Core\\Tests';
	private BuilderFactory $builderFactory;

	public function __construct(
		BuilderFactory $builderFactory,
	) {
		$this->builderFactory = $builderFactory;
	}

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

	/**
	 * @return array<class-string<Node>>
	 */
	public function getNodeTypes(): array
	{
		return [Namespace_::class];
	}

	public function refactor(Node $node): ?Node
	{
		if ($this->shouldSkip($node)) {
            return null;
        }

		$fqdn = $this->generateFqdn();
		$this->changeNodeNamespace($node, $fqdn->slice(0, -1)->toString());

		$uses = $this->nodeFactory->createUsesFromNames(['PHPUnit\\Framework\\TestCase']);

		$classBuilder = $this->builderFactory->class($fqdn->getLast());
		$classBuilder->extend('TestCase');

		$this->generateMethodSetUpBeforeClass($node, $classBuilder);
		$this->generateMethodTest($node, $classBuilder);
		$this->generateMethodProvider($node, $classBuilder);

		$class = $classBuilder->getNode();
		$class->namespacedName = $node->name;

		$node->stmts = [
			...$uses,
			$class,
		];

		return $node;

	}

	private function shouldSkip(Node $node): bool {
		// Skip if a class is already there.
		foreach ($node->stmts as $stmt) {
			if ($stmt instanceof ClassLike) {
				return true;
			}
		}
		return false;
	}

	private function toCamelCase(string $str): string {
		$str = new UnicodeString($str);
		return $str->camel()->toString();
	}

	private function generateFqdn(): FullyQualified
	{
		$filePath = $this->file->getFilePath();
		$dirname = basename(\pathinfo($filePath, \PATHINFO_DIRNAME));
		$basename = \pathinfo($filePath, \PATHINFO_FILENAME);

		$dir = ucfirst($this->toCamelCase($dirname));
		$file = ucfirst($this->toCamelCase($basename)) . 'Test';

		return new FullyQualified($this->namespace . "\\RectorEssais\\$dir\\$file");
	}

	private function changeNodeNamespace(Node $node, string $namespace): void {
		$this->isChangedInNamespaces[$namespace] = \true;
		$node->name = new Name($namespace);
	}

	private function generateMethodSetUpBeforeClass(Node $node, ClassBuilder $classBuilder): void
	{
		$stmts = [];
		foreach ($node->stmts as $key => $stmt) {
			if ($stmt instanceof Expression) {
				$stmts[] = $stmt;
				unset($node->stmts[$key]);
			}
		}
		if (!$stmts) {
			return;
		}

		$method = $this->builderFactory->method('setUpBeforeClass');
		$method
			->makePublic()
			->makeStatic()
			->setReturnType(new Identifier('void'))
			->addStmts($stmts);

		$classBuilder->addStmt($method->getNode());
	}

	private function generateMethodTest(Node $node, ClassBuilder $classBuilder): void
	{
		foreach ($node->stmts as $key => $stmt) {
			if (!$stmt instanceof Function_) {
				continue;
			}
			$name = $stmt->name->toString();
			if (!str_starts_with($name, 'test_')) {
				continue;
			}

			$newName = $this->toCamelCase($name);
			$method = $this->builderFactory->method($newName);
			$method
				->makePublic()
				->setReturnType(new Identifier('void'))
				->addStmts($this->transformTestMethodContent($stmt->stmts));

			$param = $this->builderFactory->param('expected');
			$method->addParam($param->getNode());

			$param = $this->builderFactory->param('args');
			$param->makeVariadic();
			$method->addParam($param->getNode());

			$method->setDocComment("/** @dataProvider provider" . ucfirst(substr($newName, 4)) . ' */');

			$classBuilder->addStmt($method->getNode());
			unset($node->stmts[$key]);
		}
	}

	/**
	 * @param Node[] $nodes
	 * @return Node[]
	 */
	private function transformTestMethodContent(array $nodes): array {
		foreach ($nodes as $key => $node) {
			if ($node instanceof Return_) {
				// ...$args
				# new Arg(new Variable('args'), false, true);

				$call = new MethodCall(new Variable('this'), 'assertEquals', [
					new Arg(new Variable('expected')),
					new Arg($node->expr),
				]);
				$nodes[$key] = $call;
			}
		}
		return $nodes;
	}

	private function generateMethodProvider(Node $node, ClassBuilder $classBuilder): void
	{
		foreach ($node->stmts as $key => $stmt) {
			if (!$stmt instanceof Function_) {
				continue;
			}
			$name = $stmt->name->toString();
			if (!str_starts_with($name, 'essais_')) {
				continue;
			}
			$newName = $this->toCamelCase(str_replace('essais_', 'provider_', $name));
			$method = $this->builderFactory->method($newName);
			$method
				->makePublic()
				->setReturnType(new Identifier('array'))
				->addStmts($stmt->stmts);

			$classBuilder->addStmt($method->getNode());
			unset($node->stmts[$key]);
		}
	}
}
