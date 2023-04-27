<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction filtrer_entites du fichier inc/filtres.php
 */

namespace Spip\Test\Filtre;

use PHPUnit\Framework\TestCase;

class FiltrerEntitesTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		find_in_path('inc/filtres.php', '', true);
	}

	/**
	 * @dataProvider providerFiltresFiltrerEntites
	 */
	public function testFiltresFiltrerEntites($expected, ...$args): void
	{
		$actual = filtrer_entites(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresFiltrerEntites(): array
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
				0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
			],
			3 => [
				0 => 'Un texte avec des entités &<>"',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
			],
			4 => [
				0 => 'Un texte avec des entités numériques &<>"\'',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &amp;&lt;&gt;&#034;&#039;',
			],
			5 => [
				0 => 'Un texte sans entites &<>"\'',
				1 => 'Un texte sans entites &<>"\'',
			],
			6 => [
				0 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
			],
			7 => [
				0 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
			],
		];
	}
}
