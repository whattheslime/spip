<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction sinon du fichier inc/filtres.php
 */

namespace Spip\Core\Tests\Filtre;

use PHPUnit\Framework\TestCase;

class SinonTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		find_in_path('inc/filtres.php', '', true);
	}

	/**
	 * @dataProvider providerFiltresSinon
	 */
	public function testFiltresSinon($expected, ...$args): void
	{
		$actual = sinon(...$args);
		$this->assertSame($expected, $actual);
		$this->assertEquals($expected, $actual);
	}

	public function providerFiltresSinon(): array
	{
		return [
			0 => [
				0 => '',
				1 => '',
				2 => '',
			],
			1 => [
				0 => '0',
				1 => '',
				2 => '0',
			],
			2 => [
				0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				1 => '',
				2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
			],
			3 => [
				0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				1 => '',
				2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
			],
			4 => [
				0 => 'Un texte sans entites &<>"\'',
				1 => '',
				2 => 'Un texte sans entites &<>"\'',
			],
			5 => [
				0 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				1 => '',
				2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
			],
			6 => [
				0 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				1 => '',
				2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
			],
			7 => [
				0 => '0',
				1 => '0',
				2 => '',
			],
			8 => [
				0 => '0',
				1 => '0',
				2 => '0',
			],
			9 => [
				0 => '0',
				1 => '0',
				2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
			],
			10 => [
				0 => '0',
				1 => '0',
				2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
			],
			11 => [
				0 => '0',
				1 => '0',
				2 => 'Un texte sans entites &<>"\'',
			],
			12 => [
				0 => '0',
				1 => '0',
				2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
			],
			13 => [
				0 => '0',
				1 => '0',
				2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
			],
			14 => [
				0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				2 => '',
			],
			15 => [
				0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				2 => '0',
			],
			16 => [
				0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
			],
			17 => [
				0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
			],
			18 => [
				0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				2 => 'Un texte sans entites &<>"\'',
			],
			19 => [
				0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
			],
			20 => [
				0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
			],
			21 => [
				0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				2 => '',
			],
			22 => [
				0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				2 => '0',
			],
			23 => [
				0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
			],
			24 => [
				0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
			],
			25 => [
				0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				2 => 'Un texte sans entites &<>"\'',
			],
			26 => [
				0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
			],
			27 => [
				0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
			],
			28 => [
				0 => 'Un texte sans entites &<>"\'',
				1 => 'Un texte sans entites &<>"\'',
				2 => '',
			],
			29 => [
				0 => 'Un texte sans entites &<>"\'',
				1 => 'Un texte sans entites &<>"\'',
				2 => '0',
			],
			30 => [
				0 => 'Un texte sans entites &<>"\'',
				1 => 'Un texte sans entites &<>"\'',
				2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
			],
			31 => [
				0 => 'Un texte sans entites &<>"\'',
				1 => 'Un texte sans entites &<>"\'',
				2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
			],
			32 => [
				0 => 'Un texte sans entites &<>"\'',
				1 => 'Un texte sans entites &<>"\'',
				2 => 'Un texte sans entites &<>"\'',
			],
			33 => [
				0 => 'Un texte sans entites &<>"\'',
				1 => 'Un texte sans entites &<>"\'',
				2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
			],
			34 => [
				0 => 'Un texte sans entites &<>"\'',
				1 => 'Un texte sans entites &<>"\'',
				2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
			],
			35 => [
				0 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				2 => '',
			],
			36 => [
				0 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				2 => '0',
			],
			37 => [
				0 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
			],
			38 => [
				0 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
			],
			39 => [
				0 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				2 => 'Un texte sans entites &<>"\'',
			],
			40 => [
				0 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
			],
			41 => [
				0 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
			],
			42 => [
				0 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				2 => '',
			],
			43 => [
				0 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				2 => '0',
			],
			44 => [
				0 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
			],
			45 => [
				0 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
			],
			46 => [
				0 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				2 => 'Un texte sans entites &<>"\'',
			],
			47 => [
				0 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
			],
			48 => [
				0 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
			],
			49 => [
				0 => 0,
				1 => 0,
				2 => '',
			],
			50 => [
				0 => 0,
				1 => 0,
				2 => '0',
			],
			51 => [
				0 => 0,
				1 => 0,
				2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
			],
			52 => [
				0 => 0,
				1 => 0,
				2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
			],
			53 => [
				0 => 0,
				1 => 0,
				2 => 'Un texte sans entites &<>"\'',
			],
			54 => [
				0 => 0,
				1 => 0,
				2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
			],
			55 => [
				0 => 0,
				1 => 0,
				2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
			],
			56 => [
				0 => -1,
				1 => -1,
				2 => '',
			],
			57 => [
				0 => -1,
				1 => -1,
				2 => '0',
			],
			58 => [
				0 => -1,
				1 => -1,
				2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
			],
			59 => [
				0 => -1,
				1 => -1,
				2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
			],
			60 => [
				0 => -1,
				1 => -1,
				2 => 'Un texte sans entites &<>"\'',
			],
			61 => [
				0 => -1,
				1 => -1,
				2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
			],
			62 => [
				0 => -1,
				1 => -1,
				2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
			],
			63 => [
				0 => 1,
				1 => 1,
				2 => '',
			],
			64 => [
				0 => 1,
				1 => 1,
				2 => '0',
			],
			65 => [
				0 => 1,
				1 => 1,
				2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
			],
			66 => [
				0 => 1,
				1 => 1,
				2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
			],
			67 => [
				0 => 1,
				1 => 1,
				2 => 'Un texte sans entites &<>"\'',
			],
			68 => [
				0 => 1,
				1 => 1,
				2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
			],
			69 => [
				0 => 1,
				1 => 1,
				2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
			],
			70 => [
				0 => 2,
				1 => 2,
				2 => '',
			],
			71 => [
				0 => 2,
				1 => 2,
				2 => '0',
			],
			72 => [
				0 => 2,
				1 => 2,
				2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
			],
			73 => [
				0 => 2,
				1 => 2,
				2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
			],
			74 => [
				0 => 2,
				1 => 2,
				2 => 'Un texte sans entites &<>"\'',
			],
			75 => [
				0 => 2,
				1 => 2,
				2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
			],
			76 => [
				0 => 2,
				1 => 2,
				2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
			],
			77 => [
				0 => 3,
				1 => 3,
				2 => '',
			],
			78 => [
				0 => 3,
				1 => 3,
				2 => '0',
			],
			79 => [
				0 => 3,
				1 => 3,
				2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
			],
			80 => [
				0 => 3,
				1 => 3,
				2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
			],
			81 => [
				0 => 3,
				1 => 3,
				2 => 'Un texte sans entites &<>"\'',
			],
			82 => [
				0 => 3,
				1 => 3,
				2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
			],
			83 => [
				0 => 3,
				1 => 3,
				2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
			],
			84 => [
				0 => 4,
				1 => 4,
				2 => '',
			],
			85 => [
				0 => 4,
				1 => 4,
				2 => '0',
			],
			86 => [
				0 => 4,
				1 => 4,
				2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
			],
			87 => [
				0 => 4,
				1 => 4,
				2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
			],
			88 => [
				0 => 4,
				1 => 4,
				2 => 'Un texte sans entites &<>"\'',
			],
			89 => [
				0 => 4,
				1 => 4,
				2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
			],
			90 => [
				0 => 4,
				1 => 4,
				2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
			],
			91 => [
				0 => 5,
				1 => 5,
				2 => '',
			],
			92 => [
				0 => 5,
				1 => 5,
				2 => '0',
			],
			93 => [
				0 => 5,
				1 => 5,
				2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
			],
			94 => [
				0 => 5,
				1 => 5,
				2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
			],
			95 => [
				0 => 5,
				1 => 5,
				2 => 'Un texte sans entites &<>"\'',
			],
			96 => [
				0 => 5,
				1 => 5,
				2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
			],
			97 => [
				0 => 5,
				1 => 5,
				2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
			],
			98 => [
				0 => 6,
				1 => 6,
				2 => '',
			],
			99 => [
				0 => 6,
				1 => 6,
				2 => '0',
			],
			100 => [
				0 => 6,
				1 => 6,
				2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
			],
			101 => [
				0 => 6,
				1 => 6,
				2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
			],
			102 => [
				0 => 6,
				1 => 6,
				2 => 'Un texte sans entites &<>"\'',
			],
			103 => [
				0 => 6,
				1 => 6,
				2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
			],
			104 => [
				0 => 6,
				1 => 6,
				2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
			],
			105 => [
				0 => 7,
				1 => 7,
				2 => '',
			],
			106 => [
				0 => 7,
				1 => 7,
				2 => '0',
			],
			107 => [
				0 => 7,
				1 => 7,
				2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
			],
			108 => [
				0 => 7,
				1 => 7,
				2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
			],
			109 => [
				0 => 7,
				1 => 7,
				2 => 'Un texte sans entites &<>"\'',
			],
			110 => [
				0 => 7,
				1 => 7,
				2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
			],
			111 => [
				0 => 7,
				1 => 7,
				2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
			],
			112 => [
				0 => 10,
				1 => 10,
				2 => '',
			],
			113 => [
				0 => 10,
				1 => 10,
				2 => '0',
			],
			114 => [
				0 => 10,
				1 => 10,
				2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
			],
			115 => [
				0 => 10,
				1 => 10,
				2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
			],
			116 => [
				0 => 10,
				1 => 10,
				2 => 'Un texte sans entites &<>"\'',
			],
			117 => [
				0 => 10,
				1 => 10,
				2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
			],
			118 => [
				0 => 10,
				1 => 10,
				2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
			],
			119 => [
				0 => 20,
				1 => 20,
				2 => '',
			],
			120 => [
				0 => 20,
				1 => 20,
				2 => '0',
			],
			121 => [
				0 => 20,
				1 => 20,
				2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
			],
			122 => [
				0 => 20,
				1 => 20,
				2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
			],
			123 => [
				0 => 20,
				1 => 20,
				2 => 'Un texte sans entites &<>"\'',
			],
			124 => [
				0 => 20,
				1 => 20,
				2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
			],
			125 => [
				0 => 20,
				1 => 20,
				2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
			],
			126 => [
				0 => 30,
				1 => 30,
				2 => '',
			],
			127 => [
				0 => 30,
				1 => 30,
				2 => '0',
			],
			128 => [
				0 => 30,
				1 => 30,
				2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
			],
			129 => [
				0 => 30,
				1 => 30,
				2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
			],
			130 => [
				0 => 30,
				1 => 30,
				2 => 'Un texte sans entites &<>"\'',
			],
			131 => [
				0 => 30,
				1 => 30,
				2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
			],
			132 => [
				0 => 30,
				1 => 30,
				2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
			],
			133 => [
				0 => 50,
				1 => 50,
				2 => '',
			],
			134 => [
				0 => 50,
				1 => 50,
				2 => '0',
			],
			135 => [
				0 => 50,
				1 => 50,
				2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
			],
			136 => [
				0 => 50,
				1 => 50,
				2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
			],
			137 => [
				0 => 50,
				1 => 50,
				2 => 'Un texte sans entites &<>"\'',
			],
			138 => [
				0 => 50,
				1 => 50,
				2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
			],
			139 => [
				0 => 50,
				1 => 50,
				2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
			],
			140 => [
				0 => 100,
				1 => 100,
				2 => '',
			],
			141 => [
				0 => 100,
				1 => 100,
				2 => '0',
			],
			142 => [
				0 => 100,
				1 => 100,
				2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
			],
			143 => [
				0 => 100,
				1 => 100,
				2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
			],
			144 => [
				0 => 100,
				1 => 100,
				2 => 'Un texte sans entites &<>"\'',
			],
			145 => [
				0 => 100,
				1 => 100,
				2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
			],
			146 => [
				0 => 100,
				1 => 100,
				2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
			],
			147 => [
				0 => 1000,
				1 => 1000,
				2 => '',
			],
			148 => [
				0 => 1000,
				1 => 1000,
				2 => '0',
			],
			149 => [
				0 => 1000,
				1 => 1000,
				2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
			],
			150 => [
				0 => 1000,
				1 => 1000,
				2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
			],
			151 => [
				0 => 1000,
				1 => 1000,
				2 => 'Un texte sans entites &<>"\'',
			],
			152 => [
				0 => 1000,
				1 => 1000,
				2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
			],
			153 => [
				0 => 1000,
				1 => 1000,
				2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
			],
			154 => [
				0 => 10000,
				1 => 10000,
				2 => '',
			],
			155 => [
				0 => 10000,
				1 => 10000,
				2 => '0',
			],
			156 => [
				0 => 10000,
				1 => 10000,
				2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
			],
			157 => [
				0 => 10000,
				1 => 10000,
				2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
			],
			158 => [
				0 => 10000,
				1 => 10000,
				2 => 'Un texte sans entites &<>"\'',
			],
			159 => [
				0 => 10000,
				1 => 10000,
				2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
			],
			160 => [
				0 => 10000,
				1 => 10000,
				2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
			],
		];
	}
}
