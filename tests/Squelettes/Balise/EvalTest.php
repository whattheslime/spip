<?php
namespace Spip\Core\Tests\Squelettes\Balise;

use Spip\Core\Testing\SquelettesTestCase;
use Spip\Core\Testing\Templating;
use Spip\Core\Testing\Template\StringLoader;
use Spip\Core\Testing\Template\FileLoader;

class EvalTest extends SquelettesTestCase
{
	public function testBaliseEval(): void {
		$this->assertEmptyCode('#EVAL{\'\'}');
		$this->assertOkCode('#EVAL{"\'ok\'"}');
	 	$this->assertEqualsCode('1', '#EVAL{1}');
		$this->assertEqualsCode(_DIR_CACHE, '#EVAL{_DIR_CACHE}');
		$this->assertEqualsCode('20', '#EVAL{3*5+5}');
	}
}
