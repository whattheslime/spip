<?php
namespace Spip\Core\Tests\Squelettes\Balise;

use Spip\Core\Testing\SquelettesTestCase;

class SelfTest extends SquelettesTestCase
{
	public function testBaliseSelf(): void {
		$this->assertEqualsCode('./', '#SELF');
		$this->markTestIncomplete('More tests needed, but requires SPIP evolution with RequestInterface or so');
	}
}

