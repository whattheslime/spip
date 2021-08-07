<?php

/***************************************************************************\
 *  SPIP, Système de publication pour l'internet                           *
 *                                                                         *
 *  Copyright © avec tendresse depuis 2001                                 *
 *  Arnaud Martin, Antoine Pitrou, Philippe Rivière, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribué sous licence GNU/GPL.     *
 *  Pour plus de détails voir le fichier COPYING.txt ou l'aide en ligne.   *
 * \***************************************************************************/

namespace Spip\Core\Tests;

use PHPUnit\Framework\TestCase;


/**
 * ConfigDepotMetaPackTest test
 *
 */
class ActionEditerLiensTest extends TestCase {

	public static function setUpBeforeClass(): void{
		include_spip('action/editer_liens');
	}

	public static function tearDownAfterClass(): void{
		include_spip('base/abstract_sql');
		sql_delete('spip_auteurs_liens', "objet='spirou'");
		sql_delete('spip_auteurs_liens', "objet='zorglub'");
	}

	public function testObjetAssociable(){
		$essais = array(
			array(
				0 => false,
				1 => 'article',
			),
			array(
				0 => array('id_auteur', 'spip_auteurs_liens'),
				1 => 'auteur',
			),
			array(
				0 => array('id_mot', 'spip_mots_liens'),
				1 => 'mot',
			),
			array(
				0 => array('id_document', 'spip_documents_liens'),
				1 => 'document',
			),
			array(
				0 => false,
				1 => 'mot\' OR 1=1\'',
			),
		);

		foreach ($essais as $k => $essai){
			$expected = array_shift($essai);
			$this->assertEquals($expected, objet_associable(...$essai), "Echec $k : objet_associable " . end($essai));
		}
	}


	/**
	 * @depends testObjetAssociable
	 */
	public function testObjetAssocier(){
		$essais = array(
			array(
				0 => false,
				1 => array('article' => 1),
				2 => array('spirou' => 1),
			),
			array(
				0 => 1,
				1 => array('auteur' => 1),
				2 => array('spirou' => 1),
			),
			array(
				0 => 0,
				1 => array('auteur' => 1),
				2 => array('spirou' => 1),
			),
			array(
				0 => 2,
				1 => array('auteur' => 1),
				2 => array('spirou' => array(2, 3)),
			),
			array(
				0 => 1,
				1 => array('auteur' => 1),
				2 => array('spirou' => array(2, 3, 4)),
			),
			array(
				10,
				array('auteur' => 1),
				array('zorglub' => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10))
			),
			array(
				6,
				array('auteur' => 1),
				array('spirou' => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10))
			)
		);

		foreach ($essais as $k => $essai){
			$expected = array_shift($essai);
			$this->assertEquals($expected, objet_associer(...$essai), "Echec $k : objet_associer " . json_encode($essai));
		}

	}

	/**
	 * @depends testObjetAssocier
	 */
	public function testObjetQualifierLiens(){
		$essais = array(
			array(
				0 => false,
				1 => array('article' => 1),
				2 => array('zorglub' => 1),
				3 => array('vu' => 'oui'),
			),
			array(
				0 => 1,
				1 => array('auteur' => 1),
				2 => array('zorglub' => 1),
				3 => array('vu' => 'oui'),
			),
			array(
				0 => 1,
				1 => array('auteur' => 1),
				2 => array('zorglub' => 1),
				3 => array('vu' => 'oui'),
			),
			array(
				0 => false,
				1 => array('auteur' => 1),
				2 => array('zorglub' => 1),
				3 => array('veraer' => 'oui'),
			),
			array(
				0 => 2,
				1 => array('auteur' => 1),
				2 => array('zorglub' => array(2, 3)),
				3 => array('vu' => 'oui'),
			),
		);

		foreach ($essais as $k => $essai){
			$expected = array_shift($essai);
			$this->assertEquals($expected, objet_qualifier_liens(...$essai), "Echec $k : objet_qualifier_liens " . json_encode($essai));
		}
	}

	/**
	 * @depends testObjetQualifierLiens
	 */
	public function testObjetDissocier(){
		$essais = array(
			array(
				0 => false,
				1 => array('article' => 1),
				2 => array('zorglub' => 1),
			),
			array(
				0 => 1,
				1 => array('auteur' => 1),
				2 => array('zorglub' => 1),
			),
			array(
				0 => 0,
				1 => array('auteur' => 1),
				2 => array('zorglub' => 1),
			),
			array(
				0 => 2,
				1 => array('auteur' => 1),
				2 => array('zorglub' => array(2, 3)),
			),
			array(
				0 => 1,
				1 => array('auteur' => 1),
				2 => array('zorglub' => array(2, 3, 4)),
			),
			array(
				0 => 4,
				1 => array('auteur' => 1),
				2 => array('zorglub' => array(5), 'spirou' => array(2, 3, 4)),
			),
			array(
				0 => 12,
				1 => array('auteur' => 1),
				2 => array('zorglub' => '*', 'spirou' => '*'),
			),
		);

		foreach ($essais as $k => $essai){
			$expected = array_shift($essai);
			$this->assertEquals($expected, objet_dissocier(...$essai), "Echec $k : objet_dissocier " . json_encode($essai));
		}

	}

}