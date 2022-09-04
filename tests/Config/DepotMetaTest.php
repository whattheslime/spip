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

class DepotMetaTest extends TestCase {

	protected static $savedMeta;

	// les bases de test
	protected static $assoc;

	protected static $serassoc;

	public static function setUpBeforeClass(): void {
		self::$savedMeta = $GLOBALS['meta'];
		self::$assoc = ['one' => 'element 1', 'two' => 'element 2'];
		self::$serassoc = serialize(self::$assoc);
		include_spip('inc/config');
	}

	public static function tearDownAfterClass():void {
		$GLOBALS['meta'] = self::$savedMeta;
	}

	/**
	 * expliquer_config
	 */
	public function testExpliquerConfig() {
		$essais = [];
		$essais[] = [['meta',null,[]], ''];
		$essais[] = [['meta','0',[]], '0'];
		$essais[] = [['meta','casier',[]], 'casier'];
		$essais[] = [['meta','casier',['sous']], 'casier/sous'];
		$essais[] = [['meta','casier',['sous','plus','bas','encore']], 'casier/sous/plus/bas/encore'];

		$essais[] = [['meta',null,[]], '/meta'];
		$essais[] = [['meta','casier',[]], '/meta/casier'];
		$essais[] = [['meta','casier',['sous']], '/meta/casier/sous'];
		$essais[] = [['meta','casier',['sous','plus','bas','encore']], '/meta/casier/sous/plus/bas/encore'];

		$essais[] = [['toto',null,[]], '/toto'];
		$essais[] = [['toto','casier',[]], '/toto/casier'];
		$essais[] = [['toto','casier',['sous']], '/toto/casier/sous'];
		$essais[] = [['toto','casier',['sous','plus','bas','encore']], '/toto/casier/sous/plus/bas/encore'];

		foreach ($essais as $k => $essai) {
			$expected = array_shift($essai);
			$this->assertEquals($expected, expliquer_config(...$essai), "Echec {$k} : lecture " . end($essai));
		}
	}

	/**
	 * lire_config meta
	 * @depends testExpliquerConfig
	 */
	public function testLireConfig1() {
		$meta = $GLOBALS['meta'];

		// on flingue meta a juste nos donnees
		$GLOBALS['meta'] = [
			'zero' => 0,
			'zeroc' => '0',
			'chaine' => 'une chaine',
			'assoc' => self::$assoc,
			'serie' => self::$serassoc
		];

		$essais = [];
		$essais[] = [$GLOBALS['meta'], ''];
		$essais[] = [0, 'zero'];
		$essais[] = ['0', 'zeroc'];
		$essais[] = ['une chaine', 'chaine'];
		$essais[] = [self::$assoc, 'assoc'];
		$essais[] = [self::$assoc, 'serie'];
		$essais[] = [self::$serassoc, 'serie','',0];
		$essais[] = [null, 'rien'];
		$essais[] = ['defaut', 'rien','defaut'];

		foreach ($essais as $k => $essai) {
			$expected = array_shift($essai);
			$this->assertEquals($expected, lire_config(...$essai), "Echec {$k} : lecture " . reset($essai));
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
		$essais[] = [true, 'test_cfg_zero', 0];
		$essais[] = [true, 'test_cfg_zeroc', '0'];
		$essais[] = [true, 'test_cfg_chaine', 'une chaine'];
		$essais[] = [true, 'test_cfg_assoc', self::$assoc];
		$essais[] = [true, 'test_cfg_serie', self::$serassoc];

		foreach ($essais as $k => $essai) {
			$expected = array_shift($essai);
			$this->assertEquals($expected, ecrire_config(...$essai),"Echec {$k} : ecriture ".reset($essai));
		}
	}

	/**
	 * re lire_config meta
	 * @depends testEcrireConfig
	 */
	public function testLireConfig2() {
		$essais = [];
		$essais[] = [0, 'test_cfg_zero'];
		$essais[] = ['0', 'test_cfg_zeroc'];
		$essais[] = ['une chaine', 'test_cfg_chaine'];
		$essais[] = [self::$assoc, 'test_cfg_assoc'];
		$essais[] = [self::$serassoc, 'test_cfg_serie','',0];

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
		$essais[] = [true, 'test_cfg_zero'];
		$essais[] = [true, 'test_cfg_zeroc'];
		$essais[] = [true, 'test_cfg_chaine'];
		$essais[] = [true, 'test_cfg_assoc'];
		$essais[] = [true, 'test_cfg_serie'];
		$essais[] = [true, 'test_cfg_dummy'];

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
		$essais[] = [null, 'test_cfg_zero'];
		$essais[] = [null, 'test_cfg_zeroc'];
		$essais[] = [null, 'test_cfg_chaine'];
		$essais[] = [null, 'test_cfg_assoc'];
		$essais[] = [null, 'test_cfg_serie'];
		$essais[] = [null, 'test_cfg_dummy'];

		foreach ($essais as $k => $essai) {
			$expected = array_shift($essai);
			$this->assertEquals($expected, lire_config(...$essai), "Echec {$k} : lecture " . reset($essai));
		}
	}
}
