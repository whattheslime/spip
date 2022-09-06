<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;
use Rector\CodingStyle\Rector\Encapsed\EncapsedStringsToSprintfRector;
use Utils\Rector\Rector\Set\ValueObject\SpipTestSetList;

return static function (RectorConfig $rectorConfig): void {
	$rectorConfig->disableParallel();

    $rectorConfig->paths([
        __DIR__ . '/src',
        __DIR__ . '/tests'
    ]);

    // register a single rule
    // $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);

    // define sets of rules
	$rectorConfig->sets([
		SpipTestSetList::ESSAIS_MIGRATION
	]);
	/*
    $rectorConfig->sets([
		SetList::CODE_QUALITY,
		SetList::CODING_STYLE,
        LevelSetList::UP_TO_PHP_74
    ]);

	$rectorConfig->skip([
		EncapsedStringsToSprintfRector::class
	]);*/
};
