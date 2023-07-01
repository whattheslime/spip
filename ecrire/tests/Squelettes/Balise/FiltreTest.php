<?php

declare(strict_types=1);

namespace Spip\Test\Squelettes\Balise;

use PHPUnit\Framework\Attributes\Depends;
use Spip\Test\SquelettesTestCase;
use Spip\Test\Template\Loader\StringLoader;
use Spip\Test\Templating;

class FiltreTest extends SquelettesTestCase
{

	public function testFiltre(): void {
		$loader = new StringLoader([
			'fonctions' => <<<PHP
				function strip_non(string \$texte): string {
					return str_replace('NON', '', \$texte);
				}

				function strip_on(string \$texte): string {
					return str_replace('ON', '', \$texte);
				}
			PHP,
			'apres_code' => <<<SPIP
				[(#FILTRE{strip_non})]
				[(#FILTRE{strip_on})]
			SPIP,
		]);
		$templating = new Templating($loader);
		$this->assertOk($templating->render('NONONOK'));
	}

	public function testFiltreNommageExplicite(): void {
		$loader = new StringLoader([
			'fonctions' => <<<PHP
				function filtre_remove_non_dist(string \$texte): string {
					return str_replace('NON', '', \$texte);
				}

				function filtre_remove_on_dist(string \$texte): string {
					return str_replace('ON', '', \$texte);
				}
			PHP,
			'apres_code' => <<<SPIP
				[(#FILTRE{remove_non})]
				[(#FILTRE{remove_on})]
			SPIP,
		]);
		$templating = new Templating($loader);
		$this->assertOk($templating->render('NONONOK'));
	}
}
