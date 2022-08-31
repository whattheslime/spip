<?php
namespace Spip\Core\Tests\Squelettes\Balise;

use Spip\Core\Testing\SquelettesTestCase;
use Spip\Core\Testing\Templating;
use Spip\Core\Testing\Template\StringLoader;
use Spip\Core\Testing\Template\FileLoader;

class SelfTest extends SquelettesTestCase
{
	public function testBaliseSelf(): void {
		$this->assertEqualsCode('./', '#SELF');
		$this->markTestIncomplete('More tests needed, but requires SPIP evolution with RequestInterface or so');
	}
}

