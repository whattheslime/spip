<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction echapper_tags du fichier inc/filtres.php
 */

namespace Spip\Test\Filtre;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class EchapperTagsTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('inc/filtres.php', '', true);
	}

	#[DataProvider('providerFiltresEchapperTags')]
 public function testFiltresEchapperTags($expected, ...$args): void {
		$actual = echapper_tags(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresEchapperTags(): array {
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
				0 => 'Un texte avec des &lt;a href="http://spip.net"&gt;liens&lt;/a&gt; [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
			],
			3 => [
				0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
			],
			4 => [
				0 => 'Un texte sans entites &&lt;&gt;"\'',
				1 => 'Un texte sans entites &<>"\'',
			],
			5 => [
				0 => '{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;',
				1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
			],
			6 => [
				0 => 'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]>',
				1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
			],
		];
	}
}
