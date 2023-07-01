<?php

declare(strict_types=1);

namespace Spip\Test\Squelettes\Balise;

use Spip\Test\SquelettesTestCase;
use Spip\Test\Templating;

class BaliseDynamiqueLangTest extends SquelettesTestCase
{
	public static function setUpBeforeClass(): void {
		$GLOBALS['dossier_squelettes'] = self::relativePath(__DIR__ . '/data/squelettes');
	}

	/**
	 * Vérifie que la langue est transmise dans une balise dynamique
	 *
	 * - On part d’une `#LANG` (spip_lang) fixée dans le fichier _fonctions
	 * - On trouve un article d’une autre langue
	 * - On appelle une balise dynamique, qui vérifiera que spip_lang a été mis à jour dedans
	 */
	public function testBaliseDynamiqueLang(): void {
		$templating = Templating::fromString([
			'fonctions' => <<<PHP
				// placer une langue globale arbitraire
				\$GLOBALS['spip_lang'] = 'ar';
			PHP,
		]);

		$skel = <<<SPIP
			<BOUCLE_art(ARTICLES){lang!=#LANG}{0,1}>
			#FORMULAIRE_TEST_DYN_LANG{#LANG}
			</BOUCLE_art>
			NA : Impossible de trouver un article dans une autre langue que #LANG
			<//B_art>
		SPIP;

		$this->assertOkTemplate($templating, $skel);
	}


	/**
	 * Vérifie que la langue est transmise dans une balise dynamique depuis un modèle
	 *
	 * - On part d’une `#LANG` (spip_lang) fixée dans le fichier _fonctions
	 * - On trouve un article d’une autre langue
	 * - On appelle une balise dynamique via un modèle, qui vérifiera que spip_lang a été mis à jour dedans
	 */
	public function testBaliseDynamiqueLangModele(): void {
		$templating = Templating::fromString([
			'fonctions' => <<<PHP
				// placer une langue globale arbitraire
				\$GLOBALS['spip_lang'] = 'ar';
			PHP,
		]);

		$skel = <<<SPIP
		<BOUCLE_art(ARTICLES){lang!=#LANG}{0,1}>
		[(#VAL{'<formulaire|test_dyn_lang|t='}|concat{#LANG,'>'}|propre|interdire_scripts)]
		</BOUCLE_art>
		NA : Impossible de trouver un article dans une autre langue que #LANG
		<//B_art>
		#FILTRE{textebrut}
		SPIP;

		$this->assertOkTemplate($templating, $skel);
	}
}
