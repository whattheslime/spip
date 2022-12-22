<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction couper du fichier inc/texte_mini.php
 */

namespace Spip\Core\Tests\Texte;

use PHPUnit\Framework\TestCase;

class CouperTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		find_in_path('inc/texte_mini.php', '', true);
		find_in_path('inc/filtres.php', '', true);
	}

	/**
	 * @dataProvider providerCouper
	 */
	public function testCouper($expected, $exact, ...$args): void
	{
		$actual = spip_strlen(filtrer_entites(couper(...$args)));
		if ($exact)
			$this->assertEquals($expected, $actual);
		else
			$this->assertLessThanOrEqual($expected, $actual);
	}

	public function providerCouper(): array
	{
		find_in_path('inc/charsets.php', '', true);
		// Phrases de test et éventuel texte de suite.
		$data = [
			[
				'Une phrase pour tester le filtre |couper bla bli blu',
			],
			[
				'Une phrase pour tester le filtre |couper bla bli blu',
				'&nbsp;(etc.)',
			],
			[
				'Tést àvéc plêïn d’àççènts bla bli blu',
			],
			[
				'Supercalifragilisticexpialidocious',
			],
			[
				"Un test du filtre |couper\n\navec deux paragraphes",
			],
		];
		// Pour chaque phrase de test, itérer sur toutes les longueurs de coupe
		// possibles.
		$tests = [];
		foreach ($data as $i => &$args) {
			$texte = $args[0];
			$suite = $args[1] ?? null;
			$taille_texte = spip_strlen($texte);
			for ($taille = 1; $taille <= $taille_texte + 10; $taille++) {
				if ($taille < $taille_texte) {
					$tests[] = [
						$taille, false, $texte, $taille, $suite
					];
				} else {
					$tests[] = [
						$taille_texte, true, $texte, $taille, $suite
					];
				}
			}
		}
		return $tests;
	}
}
