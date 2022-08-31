<?php

namespace Spip\Core\Tests\Squelettes\Boucle;

use Spip\Core\Testing\SquelettesTestCase;
use Spip\Core\Testing\Templating;
use Spip\Core\Testing\Template\StringLoader;
use Spip\Core\Testing\Template\FileLoader;

class HierarchieTest extends SquelettesTestCase {
	public function testHierarchiesMultiples(): void {
		$this->assertOkSquelette(__DIR__ . '/data/hierarchies_multiples.html');
	}
}
