<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use PhpParser\Builder\Class_ as ClassBuilder;
use PhpParser\BuilderFactory;
use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\Node\Stmt\ClassLike;
use PhpParser\Node\Stmt\Else_;
use PhpParser\Node\Stmt\Expression;
use PhpParser\Node\Stmt\Function_;
use PhpParser\Node\Stmt\If_;
use PhpParser\Node\Stmt\Return_;
use Rector\Core\Rector\AbstractRector;
use Rector\TypeDeclaration\ValueObject\AssignToVariable;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
use RectorPrefix202209\Symfony\Component\String\UnicodeString;

final class RefactorSpipTestsEssais extends AbstractRector
{
	private string $namespaceFrom = 'Spip\\Core\\Tests';
	private string $namespaceTo = 'Spip\\Core\\Tests';
	private array $moves = [
		'ConnectSql' => 'Sql\\Objets',
		'Filtres' => 'Filtre',
		'FiltresMime' => 'Filtre\\Mime',
		'FiltresMini' => 'Filtre\\Mini',
		'Json' => 'Format\\Json',
		'Xml' => 'Format\\Xml',
	];
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
		$this->generateMethodSetUp($node, $classBuilder);
		$this->generateMethodTearDown($node, $classBuilder);
		$this->generateMethodTest($node, $classBuilder);
		$this->generateMethodProvider($node, $classBuilder);

		$class = $classBuilder->getNode();
		$class->namespacedName = new FullyQualified($this->getName($node) . '\\' . $fqdn->getLast());

		// s’il en reste… c’est un problème
		if ($node->stmts) {
			throw new \Exception('Zut, on n’a pas mangé tous les stmts…');
		}

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

		$newDir = $this->moves[$dir] ?? $dir;

		return new FullyQualified($this->namespaceTo . "\\$newDir\\$file");
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

	private function generateMethodSetUp(Node $node, ClassBuilder $classBuilder): void
	{
		$stmts = [];
		foreach ($node->stmts as $key => $stmt) {
			if (!$stmt instanceof Function_) {
				continue;
			}
			$name = $stmt->name->toString();
			if (!str_starts_with($name, 'pretest_')) {
				continue;
			}
			$stmts = [...$stmts, ...$stmt->stmts];
			unset($node->stmts[$key]);
		}
		if (!$stmts) {
			return;
		}

		$method = $this->builderFactory->method('setUp');
		$method
			->makePublic()
			->setReturnType(new Identifier('void'))
			->addStmts($stmts);

		$classBuilder->addStmt($method->getNode());
	}


	private function generateMethodTearDown(Node $node, ClassBuilder $classBuilder): void
	{
		$stmts = [];
		foreach ($node->stmts as $key => $stmt) {
			if (!$stmt instanceof Function_) {
				continue;
			}
			$name = $stmt->name->toString();
			if (!str_starts_with($name, 'posttest_')) {
				continue;
			}
			$stmts = [...$stmts, ...$stmt->stmts];
			unset($node->stmts[$key]);
		}
		if (!$stmts) {
			return;
		}

		$method = $this->builderFactory->method('tearDown');
		$method
			->makePublic()
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
				$expected = new Variable('expected');
				$actual = new Variable('actual');
				$assignActual = new Assign($actual, $node->expr);
				$callAssertSame = new MethodCall(new Variable('this'), 'assertSame', [
					new Arg($expected),
					new Arg($actual),
				]);
				$callAssertEquals = new MethodCall(new Variable('this'), 'assertEquals', [
					new Arg($expected),
					new Arg($actual),
				]);

				array_splice($nodes, $key, 1, [$assignActual, $callAssertSame, $callAssertEquals]);

				// if (is_array($expected)) ...
				/*
				if (false) {
					$cond = new FuncCall(new Name('is_array'), [
						new Arg($expected),
					]);

					$if = new If_($cond);

					$callAssertContains = new MethodCall(new Variable('this'), 'assertContains', [
						new Arg($actual),
						new Arg($expected),
					]);

					$if->stmts = [new Expression($callAssertContains)];
					$if->else = new Else_([
						new Expression($assignActual),
						new Expression($callAssertSame),
						new Expression($callAssertEquals),
					]);
					$nodes[$key] = $if;
				}*/
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
