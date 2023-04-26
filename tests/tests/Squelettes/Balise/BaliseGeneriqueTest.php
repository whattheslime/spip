<?php

declare(strict_types=1);

namespace Spip\Core\Tests\Squelettes\Balise;

use Spip\Core\Testing\SquelettesTestCase;
use Spip\Core\Testing\Templating;

class BaliseGeneriqueTest extends SquelettesTestCase
{
	public function testBaliseInexistante(): void
	{
		$this->assertEmptyCode('#JENEXISTEPAS');
		$this->assertEmptyCode('[(#JENEXISTEPAS)]');
		$this->assertEmptyCode('[avant(#JENEXISTEPAS)apres]');

		// ceux-ci sont plus etonnant mais c'est ce qui se passe effectivement
		$this->assertEqualsCode('{rien}', '#JENEXISTEPAS{rien}');
		$this->assertEqualsCode('{rien}', '[(#JENEXISTEPAS{rien})]');
		$this->assertEqualsCode('avant{rien}apres', '[avant(#JENEXISTEPAS{rien})apres]');
	}

	public function testBaliseDeclaree(): void
	{
		$templating = Templating::fromString([
			'fonctions' => '
				function balise_JEXISTE_dist($p){
					$p->code = "\'ok\'";
					return $p;
				}
			',
		]);
		$this->assertOkTemplate($templating, '#JEXISTE');
		$this->assertOkTemplate($templating, '[(#JEXISTE)]');
	}

	public function testBaliseDeclareeAvantApres(): void
	{
		$templating = Templating::fromString([
			'fonctions' => '
				function balise_JEXISTE_dist($p){
					$p->code = "\'ok\'";
					return $p;
				}
			',
		]);

		$this->assertEqualsTemplate('avantokapres', $templating, '[avant(#JEXISTE)apres]');
		$this->assertEqualsTemplate('avant apres', $templating, '[avant(#JEXISTE|oui)apres]');
		$this->assertEqualsTemplate('', $templating, '[avant(#JEXISTE|non)apres]');
	}

	public function testBaliseDeclareeEtParams(): void
	{
		$templating = Templating::fromString([
			'fonctions' => '
				function balise_JEXISTE_dist($p){
					$p->code = "\'ok\'";
					return $p;
				}
			',
		]);

		$this->assertOkTemplate($templating, '#JEXISTE{param}');
		$this->assertOkTemplate($templating, '#JEXISTE{param,param}');
		$this->assertOkTemplate($templating, '#JEXISTE{#SELF,#SQUELETTE}');
		$this->assertOkTemplate($templating, '#JEXISTE{#VAL{#SELF}}');
		$this->assertOkTemplate($templating, '[(#JEXISTE{[(#VAL{[(#SELF)]})]})]');
	}

	public function testBaliseDeclareeEtParamsUtiles(): void
	{
		$templating = Templating::fromString([
			'fonctions' => '
				function balise_ZEXISTE_dist($p){
					if (!$p1 = interprete_argument_balise(1,$p))
						$p1 = "\'\'";
					$p->code = "affiche_zexiste($p1)";
					return $p;
				}
				function affiche_zexiste($p1){
					return $p1;
				}
			',
		]);
		$this->assertEmptyTemplate($templating, '#ZEXISTE');
		$this->assertOkTemplate($templating, '#ZEXISTE{ok}');
		$this->assertEqualsTemplate('avantokapres', $templating, '[avant(#ZEXISTE{ok})apres]');
		$this->assertEqualsTemplate('avant apres', $templating, '[avant(#ZEXISTE{ok}|oui)apres]');
		$this->assertEmptyTemplate($templating, '[avant(#ZEXISTE{ok}|non)apres]');
	}

	public function testBaliseSurchargee(): void
	{
		$templating = Templating::fromString([
			'fonctions' => '
				function balise_REXISTE_dist($p){
					$p->code = "\'oups\'";
					return $p;
				}
				function balise_REXISTE($p){
					if (!$p1 = interprete_argument_balise(1,$p)) {
						$p1 = "\'\'";
					}
					$p->code = "affiche_rexiste($p1)";
					return $p;
				}
				function affiche_rexiste($p1){
					return $p1;
				}
			',
		]);

		$this->assertEmptyTemplate($templating, '#REXISTE');
		$this->assertOkTemplate($templating, '#REXISTE{ok}');
	}
}
