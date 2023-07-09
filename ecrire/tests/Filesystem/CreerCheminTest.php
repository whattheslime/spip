<?php

declare(strict_types=1);

namespace Spip\Test\Filesystem;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class CreerCheminTest extends TestCase
{
	private int $nb_dossiers_squelettes;

	public static function setUpBeforeClass(): void {
		include_spip('inc/utils');
	}

	public function setUp(): void {
	}

	public function testAddCheminSansDossierSquelettes() {
		$GLOBALS['dossier_squelettes'] = '';
		$chemins = creer_chemin();
		$this->assertIsArray($chemins);

		_chemin('toto');
		$_chemins = creer_chemin();

		$this->assertIsArray($_chemins);
		$this->assertEquals(count($chemins), count($_chemins) - 1, 'Erreur ajout chemin par la fonction _chemin() : mauvais compte');
		if (is_dir(_DIR_RACINE . 'squelettes')) {
			$this->assertEquals('toto/', $_chemins[1], 'Erreur ajout chemin par la fonction _chemin() : avec squelettes');
		} else {
			$this->assertEquals('toto/', $_chemins[0], 'Erreur ajout chemin par la fonction _chemin() : sans squelettes');
		}
	}

	public function testAddCheminAvecDossierSquelettes() {
		$GLOBALS['dossier_squelettes'] = 'titi:tutu';
		$chemins = creer_chemin();
		$this->assertIsArray($chemins);

		$squelettes = (int) is_dir(_DIR_RACINE . 'squelettes');
		$dossier_squelettes = count(explode(':', $GLOBALS['dossier_squelettes']));

		_chemin('toto');
		$_chemins = creer_chemin();

		$this->assertIsArray($_chemins);
		$this->assertEquals('toto/', $_chemins[$squelettes + $dossier_squelettes], 'Erreur ajout chemin par la fonction _chemin() : avec dossier_squelettes');
	}
}
