<?php

namespace Spip\Core\Tests\Squelettes\Boucle;

use Spip\Core\Testing\SquelettesTestCase;
use Spip\Core\Testing\Templating;
use Spip\Core\Testing\Template\StringLoader;
use Spip\Core\Testing\Template\FileLoader;

class BoucleRecursiveTest extends SquelettesTestCase {

	/**
	 * @link http://trac.rezo.net/trac/spip/ticket/764
	 */
	public function testBoucleRecursiveSet(): void {
		$this->assertOkSquelette(__DIR__ . '/data/bug764.html');
	}
}
