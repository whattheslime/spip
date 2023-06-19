<?php

declare(strict_types=1);

/***************************************************************************\
 *  SPIP, Système de publication pour l'internet                           *
 *                                                                         *
 *  Copyright © avec tendresse depuis 2001                                 *
 *  Arnaud Martin, Antoine Pitrou, Philippe Rivière, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribué sous licence GNU/GPL.     *
 *  Pour plus de détails voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

namespace Spip\Test\Action;

use PHPUnit\Framework\TestCase;

class EditerLiensTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		include_spip('action/editer_liens');
	}

	public static function tearDownAfterClass(): void {
		include_spip('base/abstract_sql');
		sql_delete('spip_auteurs_liens', "objet='spirou'");
		sql_delete('spip_auteurs_liens', "objet='zorglub'");
	}

	public function testObjetAssociable() {
		$essais = [
			[
				0 => false,
				1 => 'article',
			],
			[
				0 => ['id_auteur', 'spip_auteurs_liens'],
				1 => 'auteur',
			],
			[
				0 => ['id_mot', 'spip_mots_liens'],
				1 => 'mot',
			],
			[
				0 => ['id_document', 'spip_documents_liens'],
				1 => 'document',
			],
			[
				0 => false,
				1 => "mot' OR 1=1'",
			],
		];

		foreach ($essais as $k => $essai) {
			$expected = array_shift($essai);
			$this->assertEquals($expected, objet_associable(...$essai), "Echec {$k} : objet_associable " . end($essai));
		}
	}

	/**
	 * @depends testObjetAssociable
	 */
	public function testObjetAssocier() {
		$essais = [
			[
				0 => false,
				1 => [
					'article' => 1,
				],
				2 => [
					'spirou' => 1,
				],
			],
			[
				0 => 1,
				1 => [
					'auteur' => 1,
				],
				2 => [
					'spirou' => 1,
				],
			],
			[
				0 => 0,
				1 => [
					'auteur' => 1,
				],
				2 => [
					'spirou' => 1,
				],
			],
			[
				0 => 2,
				1 => [
					'auteur' => 1,
				],
				2 => [
					'spirou' => [2, 3],
				],
			],
			[
				0 => 1,
				1 => [
					'auteur' => 1,
				],
				2 => [
					'spirou' => [2, 3, 4],
				],
			],
			[
				10,
				[
					'auteur' => 1,
				],
				[
					'zorglub' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
				],
			],
			[
				6,
				[
					'auteur' => 1,
				],
				[
					'spirou' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
				],
			],
		];

		foreach ($essais as $k => $essai) {
			$expected = array_shift($essai);
			$this->assertEquals(
				$expected,
				objet_associer(...$essai),
				"Echec {$k} : objet_associer " . json_encode($essai, JSON_THROW_ON_ERROR)
			);
		}
	}

	/**
	 * @depends testObjetAssocier
	 */
	public function testObjetQualifierLiens() {
		$essais = [
			[
				0 => false,
				1 => [
					'article' => 1,
				],
				2 => [
					'zorglub' => 1,
				],
				3 => [
					'vu' => 'oui',
				],
			],
			[
				0 => 1,
				1 => [
					'auteur' => 1,
				],
				2 => [
					'zorglub' => 1,
				],
				3 => [
					'vu' => 'oui',
				],
			],
			[
				0 => 1,
				1 => [
					'auteur' => 1,
				],
				2 => [
					'zorglub' => 1,
				],
				3 => [
					'vu' => 'oui',
				],
			],
			[
				0 => false,
				1 => [
					'auteur' => 1,
				],
				2 => [
					'zorglub' => 1,
				],
				3 => [
					'veraer' => 'oui',
				],
			],
			[
				0 => 2,
				1 => [
					'auteur' => 1,
				],
				2 => [
					'zorglub' => [2, 3],
				],
				3 => [
					'vu' => 'oui',
				],
			],
		];

		foreach ($essais as $k => $essai) {
			$expected = array_shift($essai);
			$this->assertEquals(
				$expected,
				objet_qualifier_liens(...$essai),
				"Echec {$k} : objet_qualifier_liens " . json_encode($essai, JSON_THROW_ON_ERROR)
			);
		}
	}

	/**
	 * @depends testObjetQualifierLiens
	 */
	public function testObjetDissocier() {
		$essais = [
			[
				0 => false,
				1 => [
					'article' => 1,
				],
				2 => [
					'zorglub' => 1,
				],
			],
			[
				0 => 1,
				1 => [
					'auteur' => 1,
				],
				2 => [
					'zorglub' => 1,
				],
			],
			[
				0 => 0,
				1 => [
					'auteur' => 1,
				],
				2 => [
					'zorglub' => 1,
				],
			],
			[
				0 => 2,
				1 => [
					'auteur' => 1,
				],
				2 => [
					'zorglub' => [2, 3],
				],
			],
			[
				0 => 1,
				1 => [
					'auteur' => 1,
				],
				2 => [
					'zorglub' => [2, 3, 4],
				],
			],
			[
				0 => 4,
				1 => [
					'auteur' => 1,
				],
				2 => [
					'zorglub' => [5],
					'spirou' => [2, 3, 4],
				],
			],
			[
				0 => 12,
				1 => [
					'auteur' => 1,
				],
				2 => [
					'zorglub' => '*',
					'spirou' => '*',
				],
			],
		];

		foreach ($essais as $k => $essai) {
			$expected = array_shift($essai);
			$this->assertEquals(
				$expected,
				objet_dissocier(...$essai),
				"Echec {$k} : objet_dissocier " . json_encode($essai, JSON_THROW_ON_ERROR)
			);
		}
	}
}
