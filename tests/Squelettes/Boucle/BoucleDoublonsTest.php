<?php

namespace Spip\Core\Tests\Squelettes\Boucle;

use Spip\Core\Testing\SquelettesTestCase;
use Spip\Core\Testing\Templating;
use Spip\Core\Testing\Template\StringLoader;
use Spip\Core\Testing\Template\FileLoader;

class BoucleDoublonsTest extends SquelettesTestCase {
	public function testBoucleDoublons(): void {
		$this->assertOkSquelette(__DIR__ . '/data/doublons.html');
	}
}
