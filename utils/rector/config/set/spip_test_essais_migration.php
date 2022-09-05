<?php

declare (strict_types=1);
namespace RectorPrefix202209;

use Rector\Config\RectorConfig;
use Utils\Rector\Rector\RefactorSpipTestsEssais;

return static function (RectorConfig $rectorConfig) : void {
	// nothing
	$rectorConfig->rule(RefactorSpipTestsEssais::class);
};
