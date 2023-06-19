<?php

declare(strict_types=1);

namespace Spip\Test\Squelettes\Balise;

use Spip\Test\SquelettesTestCase;

class EvalTest extends SquelettesTestCase
{
	public function testBaliseEval(): void {
		$this->assertEmptyCode("#EVAL{''}");
		$this->assertOkCode('#EVAL{"\'ok\'"}');
		$this->assertEqualsCode('1', '#EVAL{1}');
		$this->assertEqualsCode(_DIR_CACHE, '#EVAL{_DIR_CACHE}');
		$this->assertEqualsCode('20', '#EVAL{3*5+5}');
	}
}
