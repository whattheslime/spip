<?php

declare(strict_types=1);

namespace Spip\Test\Squelettes\Balise;

use Spip\Test\SquelettesTestCase;

class AutoriserTest extends SquelettesTestCase
{
	public function testAutoriserSqueletteOkNiet(): void
	{
		$this->assertOkCode('[(#AUTORISER{ok})ok]');
		$this->assertOkCode('[(#AUTORISER{niet}|sinon{ok})]');
		$this->assertOkCode('
			[(#AUTORISER{niet}|?{Ah ben non !! il faut pas...,
				[(#AUTORISER{ok}|?{OK,Allez quoi dis-moi oui!})]
			})]
		');
	}
}
