<?php

declare(strict_types=1);

namespace Spip\Test\Filtre\Form;

use Spip\Test\SquelettesTestCase;

class FormHiddenTest extends SquelettesTestCase
{
	public function testParametreUrl() {
		$this->assertSame('x?y=1', parametre_url('x', 'y', '1'));
		$this->assertSame('x?y=2', parametre_url(parametre_url('x', 'y', '1'), 'y', '2'));

		$this->assertEqualsCode('x?y=1', '[(#VAL{x}|parametre_url{y,1})]');
		$this->assertEqualsCode('x?y=2', '[(#VAL{x}|parametre_url{y,1}|parametre_url{y,2})]');
	}

	public function testParametreUrlArray() {
		$this->assertSame('x?t[]=1&amp;t[]=2', parametre_url('x', 't[]', [1, 2]));

		$this->assertEqualsCode('x?t[]=1&amp;t[]=2', '[(#VAL{x}|parametre_url{t\[\],#LISTE{1,2}})]');
	}

	public function testFormHiddenUnused() {
		$url = parametre_url(parametre_url('x', 'toto', '1'), 'toto', '%!');
		$url .= '&amp;toto=3=2';
		$hiddens = form_hidden($url);
		$this->assertCount(1, extraire_balises($hiddens, 'input'), 'bug compte d’input');

		$url = parametre_url('x', 'toto', '3=2');
		$url .= '&amp;toto=p';
		$hiddens = form_hidden($url);
		$this->assertSame('3=2', extraire_attribut(extraire_balise($hiddens, 'input'), 'value'), 'bug value input');
	}

	public function testFormHiddenArray() {
		$url = parametre_url('x', 't[]', ['1', '%!']);
		$url .= '&amp;t[]=3=2';
		$hiddens = form_hidden($url);
		$this->assertCount(3, extraire_balises($hiddens, 'input'), 'bug compte d’input');
	}
}
