<?php

declare(strict_types=1);

namespace Spip\Test\Squelettes\Balise;

use Spip\Test\SquelettesTestCase;

class BaliseDynamiquePhraserTest extends SquelettesTestCase
{
	public static function setUpBeforeClass(): void {
		$GLOBALS['dossier_squelettes'] = self::relativePath(__DIR__ . '/data/squelettes');
	}

	public function testBaliseDynamiquePhraser(): void {
		$skel = <<<SPIP
			<BOUCLE_rub(RUBRIQUES){0,1}>
			[<div>(#FORMULAIRE_TEST_PHRASEUR{#SELF})</div>]
			</BOUCLE_rub>
			#FILTRE{textebrut}
		SPIP;
		$this->assertOkCode($skel);
	}
}
