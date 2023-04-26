<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use PhpParser\Node;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Stmt\ClassLike;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
use Rector\Core\Application\FileSystem\RemovedAndAddedFilesCollector;

final class MoveSpipTestsEssais extends AbstractRector
{
    private RemovedAndAddedFilesCollector $removedAndAddedFilesCollector;

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

	/** @see https://github.com/rectorphp/rector/blob/main/rules/Restoration/Rector/ClassLike/UpdateFileNameByClassNameFileSystemRector.php */
	public function refactor(Node $node): ?Node
	{
		$className = $this->getName($node);
        if ($className === null) {
            return null;
        }

        $classShortName = $this->nodeNameResolver->getShortName($className);
        $filePath = $this->file->getFilePath();
        $basename = \pathinfo($filePath, \PATHINFO_FILENAME);
        if ($classShortName === $basename) {
            return null;
        }

		$ns = new FullyQualified($className);
		$newPath = str_replace('\\', '/', $ns->slice(3)->toString());

        // no match → rename file
        $newFileLocation = \dirname($filePath, 3) . \DIRECTORY_SEPARATOR . $newPath . '.php';

        $this->removedAndAddedFilesCollector->addMovedFile($this->file, $newFileLocation);
        return null;
	}
}
