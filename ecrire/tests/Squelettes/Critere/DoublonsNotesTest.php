<?php

declare(strict_types=1);

namespace Spip\Test\Squelettes\Critere;

use PHPUnit\Framework\Attributes\Depends;
use Spip\Test\SquelettesTestCase;
use Spip\Test\Templating;

class DoublonsNotesTest extends SquelettesTestCase
{
	public static function tearDownAfterClass(): void {
		sql_delete('spip_articles', 'id_article = -1');
	}

	/**
	 * On cherche un article avec un document en note dans le texte,
	 * et on veut qu'il soit pris par {doublons}
	 * cf. https://git.spip.net/spip/spip/issues/779
	 */
	public function testCritereDoublonsNotes(): void {
		$id_document = $this->creer_article_a_doublons_notes();

		$this->assertOkCode(<<<SPIP
			<BOUCLE_d(DOCUMENTS){id_document=#ENV{id_document}}{statut==.*}>
				<BOUCLE_a(ARTICLES){id_article=-1}{statut==.*}>[(#TEXTE|?)]</BOUCLE_a>
				<BOUCLE_test(DOCUMENTS){id_document}{doublons}>
					erreur, _test n'a pas doublonne ! (#ID_DOCUMENT)
				</BOUCLE_test>
					OK #_d:ID_DOCUMENT
				<//B_test>
			</BOUCLE_d>
				erreur, pas de document
			<//B_d>
			SPIP,
			[
				'id_article' => -1,
				'id_document' => $id_document,
			]
		);
	}

	/**
	 * Creation article de test pour doublons_notes.html
	 * On cherche un document, on le met dans la note d'un texte,
	 * @return int id_document
	 */
	private function creer_article_a_doublons_notes(): int {
		$id_document = sql_getfetsel(
			'id_document',
			'spip_documents',
			sql_in('mode', ['logoon','logooff','vignette'], 'not'),
			orderby: 'rand()',
			limit: '0,1'
		);
		if (!$id_document) {
			$this->markTestSkipped('Il faut un document');
		}
		$data = [
			'id_article' => -1,
			'titre' => 'test pour doublons_notes.html',
			'statut' => 'prepa',
			'texte' => 'hello [[ xx <doc' . $id_document . '> ]].'
		];
		$id_article = sql_getfetsel('id_article', 'spip_articles', 'id_article = -1');
		if ($id_article === null) {
			sql_insertq('spip_articles', $data);
		} else {
			sql_updateq('spip_articles', $data, ['id_article = -1']);
		}
		return $id_document;
	}
}
