<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Php81\Rector\ClassConst\FinalizePublicClassConstantRector;
use Rector\Php81\Rector\FuncCall\NullToStrictStringFuncCallArgRector;
use Rector\Php71\Rector\FuncCall\CountOnNullRector;
use Rector\Php80\Rector\FunctionLike\MixedTypeRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/ecrire',
        __DIR__ . '/prive',
        __DIR__ . '/spip.php',
        __DIR__ . '/index.php',
    ]);

	$rectorConfig->sets([
		LevelSetList::UP_TO_PHP_81,
		LevelSetList::UP_TO_PHP_82,
	]);

    $rectorConfig->skip([
        __DIR__ . '/ecrire/lang',
		FinalizePublicClassConstantRector::class,
		NullToStrictStringFuncCallArgRector::class,
		CountOnNullRector::class,
		MixedTypeRector::class,
    ]);

};
