<?php

declare(strict_types=1);

namespace Spip\Test\Squelettes\Balise;

use Spip\Test\SquelettesTestCase;

class SelfTest extends SquelettesTestCase
{
	public function testBaliseSelf(): never
	{
		$this->assertEqualsCode('./', '#SELF');
		$this->markTestIncomplete('More tests needed, but requires SPIP evolution with RequestInterface or so');
	}
}
