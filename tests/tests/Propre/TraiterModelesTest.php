<?php

declare(strict_types=1);

namespace Spip\Core\Tests\Propre;

use PHPUnit\Framework\TestCase;

class TraiterModelesTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		find_in_path('inc/modeles.php', '', true);
	}

	public function testTraiterModelesDefaut(): void
	{
		unset($GLOBALS['doublons_documents_inclus']);

		$texte = "Mon texte <doc1> <img2> <emb3> et paf les doublons";
		traiter_modeles($texte);
		$this->assertNull($GLOBALS['doublons_documents_inclus'] ?? null);


		traiter_modeles($texte, ['documents' => ['doc', 'emb', 'img']]);
		$this->assertNotEmpty($GLOBALS['doublons_documents_inclus']);
		$this->assertEquals([1, 2, 3], $GLOBALS['doublons_documents_inclus']);

	}

	public function testTraiterModelesAlbums(): void
	{
		unset($GLOBALS['doublons_documents_inclus']);
		unset($GLOBALS['doublons_albums_inclus']);

		$texte = "Mon texte <doc1> <img2> <emb3> et paf les doublons";

		traiter_modeles($texte, ['albums' => ['album']]);
		$this->assertNull($GLOBALS['doublons_documents_inclus'] ?? null);
		$this->assertNull($GLOBALS['doublons_albums_inclus'] ?? null);

		$texte = "Mon texte <doc1> <img2> <emb3> et paf les doublons avec un album <album4> ?";
		traiter_modeles($texte, ['albums' => ['album']]);
		$this->assertNull($GLOBALS['doublons_documents_inclus'] ?? null);
		$this->assertNotEmpty($GLOBALS['doublons_albums_inclus']);
		$this->assertEquals([4], $GLOBALS['doublons_albums_inclus']);

	}

}
