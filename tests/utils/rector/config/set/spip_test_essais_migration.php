<?php
declare (strict_types=1);
namespace RectorPrefix202209;

use Rector\Config\RectorConfig;
use Utils\Rector\Rector\RefactorSpipTestsEssais;
use Utils\Rector\Rector\MoveSpipTestsEssais;

return static function (RectorConfig $rectorConfig) : void {
	$rectorConfig->rule(RefactorSpipTestsEssais::class);
	$rectorConfig->rule(MoveSpipTestsEssais::class);
};
