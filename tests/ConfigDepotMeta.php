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

namespace Spip\Core\Tests;

use PHPUnit\Framework\TestCase;


/**
 * LegacyUnitHtmlTest test - runs all the unit/ php tests and check the ouput is 'OK'
 *
 */
class ConfigDepotMeta extends TestCase {

	protected static $savedMeta;
	// les bases de test
	protected static $assoc;
	protected static $serassoc;

	public static function setUpBeforeClass(): void {
		self::$savedMeta = $GLOBALS['meta'];
		self::$assoc = array('one' => 'element 1', 'two' => 'element 2');
		self::$serassoc = serialize(self::$assoc);
	}

	public static function tearDownAfterClass():void {
		$GLOBALS['meta'] = self::$savedMeta;
	}

	/**
	 * lire_config meta
	 */
	public function testLireConfig1() {
		include_spip('inc/config');
		$meta = $GLOBALS['meta'];

		// on flingue meta a juste nos donnees
		$GLOBALS['meta'] = array(
			'zero' => 0,
			'zeroc' => '0',
			'chaine' => 'une chaine',
			'assoc' => self::$assoc,
			'serie' => self::$serassoc
		);

		$essais = [];
		$essais[] = array($GLOBALS['meta'], '');
		$essais[] = array(0, 'zero');
		$essais[] = array('0', 'zeroc');
		$essais[] = array('une chaine', 'chaine');
		$essais[] = array(self::$assoc, 'assoc');
		$essais[] = array(self::$assoc, 'serie');
		$essais[] = array(self::$serassoc, 'serie','',0);
		$essais[] = array(null, 'rien');
		$essais[] = array('defaut', 'rien','defaut');

		foreach ($essais as $essai) {
			$expected = array_shift($essai);
			$this->assertEquals($expected, lire_config(...$essai));
		}

		$GLOBALS['meta'] = $meta;
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
		$essais[] = array(true, 'test_cfg_zero', 0);
		$essais[] = array(true, 'test_cfg_zeroc', '0');
		$essais[] = array(true, 'test_cfg_chaine', 'une chaine');
		$essais[] = array(true, 'test_cfg_assoc', self::$assoc);
		$essais[] = array(true, 'test_cfg_serie', self::$serassoc);

		foreach ($essais as $essai) {
			$expected = array_shift($essai);
			$this->assertEquals($expected, ecrire_config(...$essai));
		}
	}

	/**
	 * re lire_config meta
	 * @depends testEcrireConfig
	 */
	public function testLireConfig2() {
		$essais = [];
		$essais[] = array(0, 'test_cfg_zero');
		$essais[] = array('0', 'test_cfg_zeroc');
		$essais[] = array('une chaine', 'test_cfg_chaine');
		$essais[] = array(self::$assoc, 'test_cfg_assoc');
		$essais[] = array(self::$serassoc, 'test_cfg_serie','',0);

		foreach ($essais as $essai) {
			$expected = array_shift($essai);
			$this->assertEquals($expected, lire_config(...$essai));
		}

	}

	/**
	 * effacer_config meta
	 * @depends testLireConfig2
	 */
	public function testEffacerConfig() {
		$essais = [];
		$essais[] = array(true, 'test_cfg_zero');
		$essais[] = array(true, 'test_cfg_zeroc');
		$essais[] = array(true, 'test_cfg_chaine');
		$essais[] = array(true, 'test_cfg_assoc');
		$essais[] = array(true, 'test_cfg_serie');
		$essais[] = array(true, 'test_cfg_dummy');

		foreach ($essais as $essai) {
			$expected = array_shift($essai);
			$this->assertEquals($expected, effacer_config(...$essai));
		}
	}

	/**
	 * re lire_config meta
	 * @depends testEffacerConfig
	 */
	public function testLireConfig3(){
		$essais = [];
		$essais[] = array(null, 'test_cfg_zero');
		$essais[] = array(null, 'test_cfg_zeroc');
		$essais[] = array(null, 'test_cfg_chaine');
		$essais[] = array(null, 'test_cfg_assoc');
		$essais[] = array(null, 'test_cfg_serie');
		$essais[] = array(null, 'test_cfg_dummy');

		foreach ($essais as $essai) {
			$expected = array_shift($essai);
			$this->assertEquals($expected, lire_config(...$essai));
		}
	}
}