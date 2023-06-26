<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction couper du fichier inc/texte_mini.php
 */

namespace Spip\Test\Texte;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class CouperTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('inc/texte_mini.php', '', true);
		find_in_path('inc/filtres.php', '', true);
	}

	#[DataProvider('providerCouper')]
	public function testCouper($length_expected, $exact, ...$args): void {
		$actual = couper(...$args);
		$length_actual = spip_strlen(filtrer_entites($actual));
		if ($exact) {
			$this->assertEquals($length_expected, $length_actual);
		} else {
			$this->assertLessThanOrEqual($length_expected, $length_actual);
		}
	}

	public static function providerCouper(): array {
		find_in_path('inc/charsets.php', '', true);
		find_in_path('inc/filtres.php', '', true);

		// Phrases de test et éventuel texte de suite.
		$data = [
			'txt1' => ['Une phrase pour tester le filtre |couper bla bli blu'],
			'txt1suite' => ['Une phrase pour tester le filtre |couper bla bli blu', '&nbsp;(etc.)'],
			'txt2' => ['Tést àvéc plêïn d’àççènts bla bli blu'],
			'txt2suite' => ['Tést àvéc plêïn d’àççènts bla bli blu', '&nbsp;(etc.)'],
			'txt3' => ['Supercalifragilisticexpialidocious'],
			'txt3suite' => ['Supercalifragilisticexpialidocious', '&nbsp;(etc.)'],
			'txt4' => ["Un test du filtre |couper\n\navec deux paragraphes"],
			'txt4suite' => ["Un test du filtre |couper\n\navec deux paragraphes", '&nbsp;(etc.)'],
			'txt5' => ['<p>Un test du filtre |couper</p><p>avec deux paragraphes</p>'],
			'txt5suite' => ['<p>Un test du filtre |couper</p><p>avec deux paragraphes</p>', '&nbsp;(etc.)'],
			'txt6' => [
				'Articlé "illustré" : imagés ’céntrées’ avèc un titre long voir très long mais vraiment très long avec dés àçènts',
			],
			'txt6suite' => [
				'Articlé "illustré" : imagés ’céntrées’ avèc un titre long voir très long mais vraiment très long avec dés àçènts',
				'&nbsp;(etc.)',
			],
			'txt7' => ['Article : avec des espaces insecable ; challenge ?'],
			'txt7suite' => ['Article : avec des espaces insecable ; challenge ?', '&nbsp;(etc.)'],
		];
		// Pour chaque phrase de test, itérer sur toutes les longueurs de coupe
		// possibles.
		$tests = [];
		foreach ($data as $i => &$args) {
			$texte = $args[0];
			$suite = $args[1] ?? null;
			$taille_texte = spip_strlen($texte);
			// si la phrase contient du html on aura jamais la longueur exacte d'origine après une coupe
			$exact_si_pluslong = (strlen($texte) === strlen(strip_tags($texte)));
			for ($taille = 1; $taille <= $taille_texte + 10; $taille++) {
				if ($taille < $taille_texte) {
					$tests["{$i}_L$taille"] = [$taille, false, $texte, $taille, $suite];
				} else {
					$tests["{$i}_L{$taille}"] = [$taille_texte, $exact_si_pluslong, $texte, $taille, $suite];
				}
			}
		}

		$tests['utf_4byteschars'] = [
			900,
			true,
			'😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 😀 ',
			901,
			'&nbsp;(etc.)',
		];

		return $tests;
	}
}
