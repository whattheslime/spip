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

class DepotMetaPackTest extends TestCase {

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
		$GLOBALS['meta'] = [
			'zero' => serialize(0),
			'zeroc' => serialize('0'),
			'chaine' => serialize('une chaine'),
			'assoc' => serialize(self::$assoc),
			'serie' => serialize(self::$serassoc)
		];


		$essais = [];
		$essais[] = [$GLOBALS['meta'], 'metapack::'];
		$essais[] = [serialize($GLOBALS['meta']), 'metapack::','',false];
		// racine
		$essais[] = [0, 'metapack::zero'];
		$essais[] = ['0', 'metapack::zeroc'];
		$essais[] = ['une chaine', 'metapack::chaine'];
		$essais[] = [self::$assoc, 'metapack::assoc'];
		$essais[] = [self::$serassoc, 'metapack::serie'];
		$essais[] = [null, 'metapack::rien'];
		$essais[] = ['defaut', 'metapack::rien','defaut'];
		// chemins
		$essais[] = [self::$assoc, 'metapack::assoc/'];
		$essais[] = ['element 1', 'metapack::assoc/one'];
		$essais[] = [['un'=>1, 'deux'=>2, 'troisc'=>"3"], 'metapack::assoc/three'];
		$essais[] = [1, 'metapack::assoc/three/un'];
		$essais[] = ['3', 'metapack::assoc/three/troisc'];
		// racourcis
		$essais[] = [self::$assoc, 'assoc/'];
		$essais[] = ['element 1', 'assoc/one'];

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
		$essais[] = [true, 'metapack::test_cfg_zero', 0];
		$essais[] = [true, 'metapack::test_cfg_zeroc', '0'];
		$essais[] = [true, 'metapack::test_cfg_chaine', 'une chaine'];
		$essais[] = [true, 'metapack::test_cfg_assoc', self::$assoc];
		$essais[] = [true, 'metapack::test_cfg_serie', self::$serassoc];
		// chemins
		$essais[] = [true, 'metapack::test_cfg_chemin/casier', self::$assoc];
		$essais[] = [true, 'metapack::test_cfg_chemin/casier/truc', 'trac'];

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
		$essais[] = [0, 'metapack::test_cfg_zero'];
		$essais[] = ['0', 'metapack::test_cfg_zeroc'];
		$essais[] = ['une chaine', 'metapack::test_cfg_chaine'];
		$essais[] = [self::$assoc, 'metapack::test_cfg_assoc'];
		$essais[] = [self::$serassoc, 'metapack::test_cfg_serie'];
		// chemins
		$essais[] = [self::$assoc + ['truc'=>'trac'], 'metapack::test_cfg_chemin/casier'];
		$essais[] = ['trac', 'metapack::test_cfg_chemin/casier/truc'];
		$essais[] = [1, 'metapack::test_cfg_chemin/casier/three/un'];
		// chemin pas la
		$essais[] = [null, 'metapack::test_cfg_chemin/casier/three/huit'];

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
		$essais[] = [true, 'metapack::test_cfg_zero'];
		$essais[] = [true, 'metapack::test_cfg_zeroc'];
		$essais[] = [true, 'metapack::test_cfg_chaine'];
		$essais[] = [true, 'metapack::test_cfg_assoc'];
		$essais[] = [true, 'metapack::test_cfg_serie'];
		// chemins
		// on enleve finement tout test_cfg_chemin : il ne doit rien rester
		$essais[] = [true, 'metapack::test_cfg_chemin/casier/three/huit']; // n'existe pas
		$essais[] = [true, 'metapack::test_cfg_chemin/casier/three/troisc'];
		$essais[] = [true, 'metapack::test_cfg_chemin/casier/three/deux'];
		$essais[] = [true, 'metapack::test_cfg_chemin/casier/three/un']; // supprime three
		$essais[] = [true, 'metapack::test_cfg_chemin/casier/one'];
		$essais[] = [true, 'metapack::test_cfg_chemin/casier/two'];
		$essais[] = [true, 'metapack::test_cfg_chemin/casier/truc']; // supprimer chemin/casier

		// on essaye d'effacer une meta qui n'existe pas
		$essais[] = [true, 'metapack::test_cfg_dummy/casier/truc'];

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
		$essais[] = [null, 'metapack::test_cfg_zero'];
		$essais[] = [null, 'metapack::test_cfg_zeroc'];
		$essais[] = [null, 'metapack::test_cfg_chaine'];
		$essais[] = [null, 'metapack::test_cfg_assoc'];
		$essais[] = [null, 'metapack::test_cfg_serie'];
		$essais[] = [null, 'metapack::test_cfg_chemin'];
		$essais[] = [null, 'metapack::test_cfg_dummy'];

		foreach ($essais as $k => $essai) {
			$expected = array_shift($essai);
			$this->assertEquals($expected, lire_config(...$essai), "Echec $k : lecture " . reset($essai));
		}
	}
}
