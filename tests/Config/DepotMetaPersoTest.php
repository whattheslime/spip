<?php

/***************************************************************************\
 *  SPIP, Système de publication pour l'internet                           *
 *                                                                         *
 *  Copyright © avec tendresse depuis 2001                                 *
 *  Arnaud Martin, Antoine Pitrou, Philippe Rivière, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribué sous licence GNU/GPL.     *
 *  Pour plus de détails voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

namespace Spip\Core\Tests\Config;

use PHPUnit\Framework\TestCase;

class DepotMetaPersoTest extends TestCase {

	protected static $savedMeta;

	// les bases de test
	protected static $assoc;

	protected static $serassoc;

	public static function setUpBeforeClass(): void {
		self::$savedMeta = $GLOBALS['meta'];
		self::$assoc = ['one' => 'element 1', 'two' => 'element 2'];
		self::$serassoc = serialize(self::$assoc);
	}

	public static function tearDownAfterClass():void {
		$GLOBALS['meta'] = self::$savedMeta;
		unset($GLOBALS['toto']);
	}

	/**
	 * lire_config meta
	 */
	public function testLireConfig1() {
		include_spip('inc/config');
		$meta = $GLOBALS['meta'];

		$trouver_table = charger_fonction('trouver_table','base');
		$this->assertArrayNotHasKey('toto', $GLOBALS, 'Une table spip_toto existe deja !');
		$this->assertEmpty($trouver_table('spip_toto'), 'Une table spip_toto existe deja !');

		// on flingue meta a juste nos donnees
		$GLOBALS['meta'] = ['dummy'=>''];
		$GLOBALS['toto'] = [
			'zero' => 0,
			'zeroc' => '0',
			'chaine' => 'une chaine',
			'assoc' => self::$assoc,
			'serie' => self::$serassoc
		];

		$essais = [];
		$essais[] = [0, '/toto/zero'];
		$essais[] = ['0', '/toto/zeroc'];
		$essais[] = ['une chaine', '/toto/chaine'];
		$essais[] = [self::$assoc, '/toto/assoc'];
		$essais[] = [self::$assoc, '/toto/serie'];
		$essais[] = [self::$serassoc, '/toto/serie','',0];
		$essais[] = [null, '/toto/rien'];
		$essais[] = ['defaut', '/toto/rien','defaut'];
		$essais[] = [null, '/meta/chaine'];
		$essais[] = [null, 'chaine'];

		foreach ($essais as $k => $essai) {
			$expected = array_shift($essai);
			$this->assertEquals($expected, lire_config(...$essai), "Echec {$k} : lecture " . reset($essai));
		}

		$GLOBALS['meta'] = $meta;
		unset($GLOBALS['toto']);
	}

	/**
	 * ecrire_config meta
	 * @depends testLireConfig1
	 */
	public function testEcrireConfig() {
		/*
		 * Notes sur l'ecriture :
		 * - dans le tableau $GLOBALS['meta'], les valeurs transmises
		 * conservent effectivement leur type
		 * - si l'on applique un lire_metas() (reecriture du tableau $GLOBALS['meta']
		 * depuis les informations de la table spip_meta, les types de valeurs
		 * sont tous des types string (puisque la colonne 'valeur' de spip_meta est
		 * varchar (ou text).
		 * 	- 0 devient alors '0'
		 *  - array(xxx) devient 'Array'
		 *
		 * Cela ne se produit pas avec le depot 'metapack' qui serialize systematiquement
		 * tout ce qu'on lui donne (et peut donc restituer le type de donnee correctement).
		 *
		 */
		$essais = [];
		$essais[] = [true, '/toto/test_cfg_zero', 0];
		$essais[] = [true, '/toto/test_cfg_zeroc', '0'];
		$essais[] = [true, '/toto/test_cfg_chaine', 'une chaine'];
		$essais[] = [true, '/toto/test_cfg_assoc', self::$assoc];
		$essais[] = [true, '/toto/test_cfg_serie', self::$serassoc];

		foreach ($essais as $k => $essai) {
			$expected = array_shift($essai);
			$this->assertEquals($expected, ecrire_config(...$essai),"Echec {$k} : ecriture ".reset($essai));
		}

		$trouver_table = charger_fonction('trouver_table','base');
		$this->assertNotEmpty($GLOBALS['toto'], "La table spip_toto n'a pas ete cree !");
		$this->assertNotEmpty($trouver_table('spip_toto'), "La table spip_toto n'a pas ete cree !");

	}

	/**
	 * re lire_config meta
	 * @depends testEcrireConfig
	 */
	public function testLireConfig2() {
		$essais = [];
		$essais[] = [0, '/toto/test_cfg_zero'];
		$essais[] = ['0', '/toto/test_cfg_zeroc'];
		$essais[] = ['une chaine', '/toto/test_cfg_chaine'];
		$essais[] = [self::$assoc, '/toto/test_cfg_assoc'];
		$essais[] = [self::$serassoc, '/toto/test_cfg_serie','',0];

		foreach ($essais as $k => $essai) {
			$expected = array_shift($essai);
			$this->assertEquals($expected, lire_config(...$essai), "Echec {$k} : lecture " . reset($essai));
		}

	}

	/**
	 * effacer_config meta
	 * @depends testLireConfig2
	 */
	public function testEffacerConfig() {
		$essais = [];
		$essais[] = [true, '/toto/test_cfg_zero'];
		$essais[] = [true, '/toto/test_cfg_zeroc'];
		$essais[] = [true, '/toto/test_cfg_chaine'];
		$essais[] = [true, '/toto/test_cfg_assoc'];
		$essais[] = [true, '/toto/test_cfg_serie'];

		foreach ($essais as $k => $essai) {
			$expected = array_shift($essai);
			$this->assertEquals($expected, effacer_config(...$essai), "Echec {$k} : effacer " . reset($essai));
		}

	}

	/**
	 * re lire_config meta
	 * @depends testEffacerConfig
	 */
	public function testLireConfig3(){
		$essais = [];
		$essais[] = [null, '/toto/test_cfg_zero'];
		$essais[] = [null, '/toto/test_cfg_zeroc'];
		$essais[] = [null, '/toto/test_cfg_chaine'];
		$essais[] = [null, '/toto/test_cfg_assoc'];
		$essais[] = [null, '/toto/test_cfg_serie'];

		foreach ($essais as $k => $essai) {
			$expected = array_shift($essai);
			$this->assertEquals($expected, lire_config(...$essai), "Echec {$k} : lecture " . reset($essai));
		}

		$trouver_table = charger_fonction('trouver_table','base');
		$this->assertArrayNotHasKey('toto', $GLOBALS, "La table spip_toto n'a pas ete supprimee par le dernier effacement de config !");
		$this->assertEmpty($trouver_table('spip_toto'), "La table spip_toto n'a pas ete supprimee par le dernier effacement de config !");

	}
}
