<?php

declare(strict_types=1);

namespace Spip\Core\Tests\Squelettes\Balise;

use Spip\Core\Testing\SquelettesTestCase;

class ConstTest extends SquelettesTestCase
{
	public function testBaliseConstVide(): void
	{
		$this->assertEmptyCode('#CONST');
		$this->assertEmptyCode("#CONST{''}");
	}

	public function testBaliseConstInconnue(): void
	{
		$this->assertEmptyCode("#CONST{'une_constante_inconnue'}");
	}

	public function testBaliseConstExistante(): void
	{
		$this->assertEqualsCode(_DIR_CACHE, "#CONST{'_DIR_CACHE'}");
		$this->assertEqualsCode(_DIR_CACHE, '#CONST{_DIR_CACHE}');
		$this->assertEqualsCode(_DIR_CACHE, '#SET{c,_DIR_CACHE}#CONST{#GET{c}}');
	}
}
