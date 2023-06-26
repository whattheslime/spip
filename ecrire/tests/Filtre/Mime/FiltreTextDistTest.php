<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction filtre_text_dist du fichier inc/filtres_mime.php
 */

namespace Spip\Test\Filtre\Mime;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class FiltreTextDistTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('inc/filtres_mime.php', '', true);
	}

	#[DataProvider('providerFiltresMimeFiltreTextDist')]
	public function testFiltresMimeFiltreTextDist($expected, ...$args): void {
		$actual = filtre_text_dist(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresMimeFiltreTextDist(): array {
		return [
			0 => [
				0 => '<pre></pre>',
				1 => '',
			],
			2 => [
				0 => '<pre>0</pre>',
				1 => '0',
			],
			3 => [
				0 => '<pre>Un texte avec des &lt;a href="http://spip.net"&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net</pre>',
				1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
			],
			4 => [
				0 => '<pre>Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot;</pre>',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
			],
			5 => [
				0 => '<pre>Un texte sans entites &amp;&lt;&gt;"\'</pre>',
				1 => 'Un texte sans entites &<>"\'',
			],
			6 => [
				0 => '<pre>{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;</pre>',
				1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
			],
			7 => [
				0 => '<pre>Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;</pre>',
				1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
			],
			8 => [
				0 => '<pre>bla bla</pre>',
				1 => 'bla bla',
			],
			9 => [
				0 => '<pre>0</pre>',
				1 => 0,
			],
			10 => [
				0 => '<pre>-1</pre>',
				1 => -1,
			],
			11 => [
				0 => '<pre>1</pre>',
				1 => 1,
			],
			12 => [
				0 => '<pre>2</pre>',
				1 => 2,
			],
			13 => [
				0 => '<pre>3</pre>',
				1 => 3,
			],
			14 => [
				0 => '<pre>4</pre>',
				1 => 4,
			],
			15 => [
				0 => '<pre>5</pre>',
				1 => 5,
			],
			16 => [
				0 => '<pre>6</pre>',
				1 => 6,
			],
			17 => [
				0 => '<pre>7</pre>',
				1 => 7,
			],
			18 => [
				0 => '<pre>10</pre>',
				1 => 10,
			],
			19 => [
				0 => '<pre>20</pre>',
				1 => 20,
			],
			20 => [
				0 => '<pre>30</pre>',
				1 => 30,
			],
			21 => [
				0 => '<pre>50</pre>',
				1 => 50,
			],
			22 => [
				0 => '<pre>100</pre>',
				1 => 100,
			],
			23 => [
				0 => '<pre>1000</pre>',
				1 => 1000,
			],
			24 => [
				0 => '<pre>10000</pre>',
				1 => 10000,
			],
			29 => [
				0 => '<pre></pre>',
				1 => null,
			],
		];
	}
}
