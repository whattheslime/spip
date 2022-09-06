<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction supprimer_tags du fichier inc/filtres.php
 */

namespace Spip\Core\Tests\Filtre;

use PHPUnit\Framework\TestCase;

class SupprimerTagsTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		find_in_path('inc/filtres.php', '', true);
	}

	/**
	 * @dataProvider providerFiltresSupprimerTags
	 */
	public function testFiltresSupprimerTags($expected, ...$args): void
	{
		$actual = supprimer_tags(...$args);
		$this->assertSame($expected, $actual);
		$this->assertEquals($expected, $actual);
	}

	public function providerFiltresSupprimerTags(): array
	{
		return [
			0 => [
				0 => '',
				1 => '',
			],
			1 => [
				0 => '0',
				1 => '0',
			],
			2 => [
				0 => 'Un texte avec des liens [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
			],
			3 => [
				0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
			],
			4 => [
				0 => 'Un texte sans entites &&lt;>"\'',
				1 => 'Un texte sans entites &<>"\'',
			],
			5 => [
				0 => '{{{Des raccourcis}}} {italique} {{gras}} du code',
				1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
			],
			6 => [
				0 => 'Un modele http://www.spip.net]>',
				1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
			],
		];
	}
}
