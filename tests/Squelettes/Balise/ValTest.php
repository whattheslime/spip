<?php
namespace Spip\Core\Tests\Squelettes\Balise;

use Spip\Core\Testing\SquelettesTestCase;
use Spip\Core\Testing\Templating;
use Spip\Core\Testing\Template\StringLoader;
use Spip\Core\Testing\Template\FileLoader;

class ValTest extends SquelettesTestCase
{
	public function testBaliseVal(): void {
		$this->assertEmptyCode('#VAL');
		$this->assertEmptyCode('#VAL{}');
		$this->assertEmptyCode("#VAL{''}");
		$this->assertOkCode('#VAL{ok}');
		$this->assertEqualsCode('1', '#VAL{1}');
	}
}
