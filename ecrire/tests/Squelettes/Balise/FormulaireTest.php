<?php

declare(strict_types=1);

namespace Spip\Test\Squelettes\Balise;

use Spip\Test\SquelettesTestCase;
use Spip\Test\Templating;

class FormulaireTest extends SquelettesTestCase
{
	/**
	 * Test pour `#FORMULAIRE_`
	 */
	public function testBaliseFormulaire(): void {
		$templating = Templating::fromString([
			'fonctions' => <<<PHP
				function formulaire_inscription_present(\$page) {
					if (trim(\$page) === '') {
						return '#FORMULAIRE_{inscription} ne renvoie rien';
					}
					return 'OK';
				}
			PHP
			,
		]);

		$skel = <<<SPIP
			#FORMULAIRE_{inscription,6forum,''}
			#FILTRE{formulaire_inscription_present}
		SPIP;
		$this->assertOkTemplate($templating, $skel);
	}
}
