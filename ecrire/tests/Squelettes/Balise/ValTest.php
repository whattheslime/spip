<?php

declare(strict_types=1);

namespace Spip\Test\Squelettes\Balise;

use Spip\Test\SquelettesTestCase;

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
