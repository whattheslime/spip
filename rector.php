<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\LogicalAnd\LogicalToBooleanRector;
use Rector\Config\RectorConfig;
use Rector\Php71\Rector\FuncCall\CountOnNullRector;
use Rector\Php80\Rector\FunctionLike\MixedTypeRector;
use Rector\Php81\Rector\ClassConst\FinalizePublicClassConstantRector;
use Rector\Php81\Rector\FuncCall\NullToStrictStringFuncCallArgRector;


return RectorConfig::configure()
	->withPaths([
		__DIR__ . '/ecrire',
	])
	->withRootFiles()
	->withPhpSets(php82: true)
	#->withPreparedSets(deadCode: true, codeQuality: true)
	->withRules([LogicalToBooleanRector::class])
	->withSkip(
		__DIR__ . '/ecrire/lang',
		FinalizePublicClassConstantRector::class,
		NullToStrictStringFuncCallArgRector::class,
		CountOnNullRector::class,
		MixedTypeRector::class,
	)
;
