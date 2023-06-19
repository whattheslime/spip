<?php

declare(strict_types=1);

namespace Spip\Test\Squelettes\Boucle;

use Spip\Test\SquelettesTestCase;

class BoucleRecursiveTest extends SquelettesTestCase
{
	/**
	 * @link http://trac.rezo.net/trac/spip/ticket/764
	 */
	public function testBoucleRecursiveSet(): void {
		$this->assertOkSquelette(__DIR__ . '/data/bug764.html');
	}
}
