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
class ConfigDepotMetaPack extends TestCase {

	protected static $savedMeta;
	// les bases de test
	protected static $assoc;
	protected static $serassoc;

	public static function setUpBeforeClass(): void {
		self::$savedMeta = $GLOBALS['meta'];
		self::$assoc = [
			'one' => 'element 1',
			'two' => 'element 2',
			'three' => [
				'un'=>1,
				'deux'=>2,
				'troisc'=>"3"
			]
		];
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
			'zero' => serialize(0),
			'zeroc' => serialize('0'),
			'chaine' => serialize('une chaine'),
			'assoc' => serialize(self::$assoc),
			'serie' => serialize(self::$serassoc)
		);


		$essais = [];
		$essais[] = array($GLOBALS['meta'], 'metapack::');
		$essais[] = array(serialize($GLOBALS['meta']), 'metapack::','',false);
		// racine
		$essais[] = array(0, 'metapack::zero');
		$essais[] = array('0', 'metapack::zeroc');
		$essais[] = array('une chaine', 'metapack::chaine');
		$essais[] = array(self::$assoc, 'metapack::assoc');
		$essais[] = array(self::$serassoc, 'metapack::serie');
		$essais[] = array(null, 'metapack::rien');
		$essais[] = array('defaut', 'metapack::rien','defaut');
		// chemins
		$essais[] = array(self::$assoc, 'metapack::assoc/');
		$essais[] = array('element 1', 'metapack::assoc/one');
		$essais[] = array(array('un'=>1, 'deux'=>2, 'troisc'=>"3"), 'metapack::assoc/three');
		$essais[] = array(1, 'metapack::assoc/three/un');
		$essais[] = array('3', 'metapack::assoc/three/troisc');
		// racourcis
		$essais[] = array(self::$assoc, 'assoc/');
		$essais[] = array('element 1', 'assoc/one');

		foreach ($essais as $k => $essai) {
			$expected = array_shift($essai);
			$this->assertEquals($expected, lire_config(...$essai), "Echec $k : lecture " . reset($essai));
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
		$essais[] = array(true, 'metapack::test_cfg_zero', 0);
		$essais[] = array(true, 'metapack::test_cfg_zeroc', '0');
		$essais[] = array(true, 'metapack::test_cfg_chaine', 'une chaine');
		$essais[] = array(true, 'metapack::test_cfg_assoc', self::$assoc);
		$essais[] = array(true, 'metapack::test_cfg_serie', self::$serassoc);
		// chemins
		$essais[] = array(true, 'metapack::test_cfg_chemin/casier', self::$assoc);
		$essais[] = array(true, 'metapack::test_cfg_chemin/casier/truc', 'trac');

		foreach ($essais as $k => $essai) {
			$expected = array_shift($essai);
			$this->assertEquals($expected, ecrire_config(...$essai),"Echec $k : ecriture ".reset($essai));
		}
	}

	/**
	 * re lire_config meta
	 * @depends testEcrireConfig
	 */
	public function testLireConfig2() {
		$essais = [];
		$essais[] = array(0, 'metapack::test_cfg_zero');
		$essais[] = array('0', 'metapack::test_cfg_zeroc');
		$essais[] = array('une chaine', 'metapack::test_cfg_chaine');
		$essais[] = array(self::$assoc, 'metapack::test_cfg_assoc');
		$essais[] = array(self::$serassoc, 'metapack::test_cfg_serie');
		// chemins
		$essais[] = array(self::$assoc + array('truc'=>'trac'), 'metapack::test_cfg_chemin/casier');
		$essais[] = array('trac', 'metapack::test_cfg_chemin/casier/truc');
		$essais[] = array(1, 'metapack::test_cfg_chemin/casier/three/un');
		// chemin pas la
		$essais[] = array(null, 'metapack::test_cfg_chemin/casier/three/huit');

		foreach ($essais as $k => $essai) {
			$expected = array_shift($essai);
			$this->assertEquals($expected, lire_config(...$essai), "Echec $k : lecture " . reset($essai));
		}

	}

	/**
	 * effacer_config meta
	 * @depends testLireConfig2
	 */
	public function testEffacerConfig() {
		$essais = [];
		$essais[] = array(true, 'metapack::test_cfg_zero');
		$essais[] = array(true, 'metapack::test_cfg_zeroc');
		$essais[] = array(true, 'metapack::test_cfg_chaine');
		$essais[] = array(true, 'metapack::test_cfg_assoc');
		$essais[] = array(true, 'metapack::test_cfg_serie');
		// chemins
		// on enleve finement tout test_cfg_chemin : il ne doit rien rester
		$essais[] = array(true, 'metapack::test_cfg_chemin/casier/three/huit'); // n'existe pas
		$essais[] = array(true, 'metapack::test_cfg_chemin/casier/three/troisc');
		$essais[] = array(true, 'metapack::test_cfg_chemin/casier/three/deux');
		$essais[] = array(true, 'metapack::test_cfg_chemin/casier/three/un'); // supprime three
		$essais[] = array(true, 'metapack::test_cfg_chemin/casier/one');
		$essais[] = array(true, 'metapack::test_cfg_chemin/casier/two');
		$essais[] = array(true, 'metapack::test_cfg_chemin/casier/truc'); // supprimer chemin/casier

		// on essaye d'effacer une meta qui n'existe pas
		$essais[] = array(true, 'metapack::test_cfg_dummy/casier/truc');

		foreach ($essais as $k => $essai) {
			$expected = array_shift($essai);
			$this->assertEquals($expected, effacer_config(...$essai), "Echec $k : effacer " . reset($essai));
		}
	}

	/**
	 * re lire_config meta
	 * @depends testEffacerConfig
	 */
	public function testLireConfig3(){
		$essais = [];
		$essais[] = array(null, 'metapack::test_cfg_zero');
		$essais[] = array(null, 'metapack::test_cfg_zeroc');
		$essais[] = array(null, 'metapack::test_cfg_chaine');
		$essais[] = array(null, 'metapack::test_cfg_assoc');
		$essais[] = array(null, 'metapack::test_cfg_serie');
		$essais[] = array(null, 'metapack::test_cfg_chemin');
		$essais[] = array(null, 'metapack::test_cfg_dummy');

		foreach ($essais as $k => $essai) {
			$expected = array_shift($essai);
			$this->assertEquals($expected, lire_config(...$essai), "Echec $k : lecture " . reset($essai));
		}
	}
}