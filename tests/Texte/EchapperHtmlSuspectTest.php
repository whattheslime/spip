<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction propre du fichier inc/texte.php
 */

namespace Spip\Core\Tests\Texte;

use PHPUnit\Framework\TestCase;

class EchapperHtmlSuspectTest extends TestCase {

	static $filtrer_javascript;
	static $lang;


	public static function setUpBeforeClass(): void {
		find_in_path('inc/texte.php', '', true);
		static::$filtrer_javascript = $GLOBALS['filtrer_javascript'] ?? null;
		$GLOBALS['filtrer_javascript'] = -1;
		// ce test est en en
		static::$lang = $GLOBALS['spip_lang'];
		changer_langue('en');
	}

	public static function tearDownAfterClass(): void {
		$GLOBALS['filtrer_javascript'] = static::$filtrer_javascript;
		$GLOBALS['spip_lang'] = static::$lang;
	}

	/**
	 * @dataProvider providerIsHtmlSafe
	 */
	public function testIsHtmlSafe($expected, ...$args): void {
		$actual = is_html_safe(...$args);
		$this->assertSame($expected, $actual);
		$this->assertEquals($expected, $actual);
	}

	public function providerIsHtmlSafe(): array {
		return [
			'relOK' => [
				true,
				'Voir aussi la page du taxon ️<a class="nom_scientifique" href="http://www.itis.gov/servlet/SingleRpt/SingleRpt?search_topic=TSN&amp;search_value=183813" rel="noreferrer">Acinonyx jubatus</a>. Wikipedia (descriptif rapide).'
			],
			'relInconnu' => [
				false,
				'Voir aussi la page du taxon ️<a class="nom_scientifique" href="http://www.itis.gov/servlet/SingleRpt/SingleRpt?search_topic=TSN&amp;search_value=183813" rel="relinconnu">Acinonyx jubatus</a>. Wikipedia (descriptif rapide).'
			],
			'span_lang_fr' => [
				true,
				'<span lang="fr">Créer des sélections d’objets ayant un prix</span>',
			],
			'span_lang_fr_simples_quotes' => [
				true,
				'<span lang=\'fr\'>Créer des sélections d’objets ayant un prix</span>',
			],
			'entite_unicode' => [
				true,
				'<span lang=\'fr\'>Créer des sélections d&#8217;objets ayant un prix</span>',
			],
		];
	}

}
