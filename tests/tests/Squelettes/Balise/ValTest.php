<?php

declare(strict_types=1);

namespace Spip\Core\Tests\Squelettes\Balise;

use Spip\Core\Testing\SquelettesTestCase;

class ValTest extends SquelettesTestCase
{
	public function testBaliseVal(): void
	{
		$this->assertEmptyCode('#VAL');
		$this->assertEmptyCode('#VAL{}');
		$this->assertEmptyCode("#VAL{''}");
		$this->assertOkCode('#VAL{ok}');
		$this->assertEqualsCode('1', '#VAL{1}');
	}
}
