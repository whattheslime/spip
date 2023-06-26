<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction proteger_amp du fichier inc/filtres.php
 */

namespace Spip\Test\Filtre;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ProtegerAmpTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('inc/filtres.php', '', true);
	}

	#[DataProvider('providerFiltresProtegerAmp')]
 public function testFiltresProtegerAmp($expected, ...$args): void {
		$actual = proteger_amp(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresProtegerAmp(): array {
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
				0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
			],
			4 => [
				0 => 'Un texte sans entites &amp;<>"\'',
				1 => 'Un texte sans entites &<>"\'',
			],
			5 => [
				0 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
			],
			6 => [
				0 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
			],
		];
	}
}
