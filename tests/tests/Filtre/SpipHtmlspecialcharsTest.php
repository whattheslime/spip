<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction spip_htmlspecialchars du fichier ./inc/filtres.php
 */

namespace Spip\Core\Tests\Filtre;

use PHPUnit\Framework\TestCase;

class SpipHtmlspecialcharsTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		find_in_path('./inc/filtres.php', '', true);
	}

	/**
	 * @dataProvider providerFiltresSpipHtmlspecialchars
	 */
	public function testFiltresSpipHtmlspecialchars($expected, ...$args): void
	{
		$actual = spip_htmlspecialchars(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresSpipHtmlspecialchars(): array
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
				0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
			],
			3 => [
				0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
			],
			4 => [
				0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot;',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
			],
			5 => [
				0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
			],
			6 => [
				0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot;',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
			],
			7 => [
				0 => "Un texte sans entites &amp;&lt;&gt;&quot;'",
				1 => 'Un texte sans entites &<>"\'',
			],
			8 => [
				0 => '{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;',
				1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
			],
			9 => [
				0 => 'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;',
				1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
			],
			10 => [
				0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
			],
			11 => [
				0 => '',
				1 => "Un texte avec des <a href=\"http://spip.net\">liens avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC</a> [Article 1 avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC->art1] [spip avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC->http://www.spip.net] http://www.spip.net",
			],
			12 => [
				0 => '',
				1 => "Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
			],
			13 => [
				0 => '',
				1 => "Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
			],
			14 => [
				0 => '',
				1 => "Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
			],
			15 => [
				0 => '',
				1 => "Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
			],
			16 => [
				0 => '',
				1 => "Un texte sans entites &<>\"\' et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
			],
			17 => [
				0 => '',
				1 => "{{{Des raccourcis avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC}}} {italique avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC} {{gras avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC}} <code>du code avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC</code>",
			],
			18 => [
				0 => '',
				1 => "Un modele avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC <modeleinexistant|lien=[avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC->http://www.spip.net]>",
			],
			19 => [
				0 => '',
				1 => "Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
			],
			20 => [
				0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens avec des accents UTF-8 aàâä eéèêë iîï oô uùü&lt;/a&gt; [Article 1 avec des accents UTF-8 aàâä eéèêë iîï oô uùü-&gt;art1] [spip avec des accents UTF-8 aàâä eéèêë iîï oô uùü-&gt;http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents UTF-8 aàâä eéèêë iîï oô uùü</a> [Article 1 avec des accents UTF-8 aàâä eéèêë iîï oô uùü->art1] [spip avec des accents UTF-8 aàâä eéèêë iîï oô uùü->http://www.spip.net] http://www.spip.net',
			],
			21 => [
				0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
			],
			22 => [
				0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
			],
			23 => [
				0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
			],
			24 => [
				0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
			],
			25 => [
				0 => "Un texte sans entites &amp;&lt;&gt;&quot;' et avec des accents UTF-8 aàâä eéèêë iîï oô uùü",
				1 => 'Un texte sans entites &<>"\' et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
			],
			26 => [
				0 => '{{{Des raccourcis avec des accents UTF-8 aàâä eéèêë iîï oô uùü}}} {italique avec des accents UTF-8 aàâä eéèêë iîï oô uùü} {{gras avec des accents UTF-8 aàâä eéèêë iîï oô uùü}} &lt;code&gt;du code avec des accents UTF-8 aàâä eéèêë iîï oô uùü&lt;/code&gt;',
				1 => '{{{Des raccourcis avec des accents UTF-8 aàâä eéèêë iîï oô uùü}}} {italique avec des accents UTF-8 aàâä eéèêë iîï oô uùü} {{gras avec des accents UTF-8 aàâä eéèêë iîï oô uùü}} <code>du code avec des accents UTF-8 aàâä eéèêë iîï oô uùü</code>',
			],
			27 => [
				0 => 'Un modele avec des accents UTF-8 aàâä eéèêë iîï oô uùü &lt;modeleinexistant|lien=[avec des accents UTF-8 aàâä eéèêë iîï oô uùü-&gt;http://www.spip.net]&gt;',
				1 => 'Un modele avec des accents UTF-8 aàâä eéèêë iîï oô uùü <modeleinexistant|lien=[avec des accents UTF-8 aàâä eéèêë iîï oô uùü->http://www.spip.net]>',
			],
			28 => [
				0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
			],
			29 => [
				0 => '',
				1 => '',
				2 => ENT_QUOTES,
			],
			30 => [
				0 => '0',
				1 => '0',
				2 => ENT_QUOTES,
			],
			31 => [
				0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				2 => ENT_QUOTES,
			],
			32 => [
				0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				2 => ENT_QUOTES,
			],
			33 => [
				0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot;',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
				2 => ENT_QUOTES,
			],
			34 => [
				0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
				2 => ENT_QUOTES,
			],
			35 => [
				0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot;',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
				2 => ENT_QUOTES,
			],
			36 => [
				0 => 'Un texte sans entites &amp;&lt;&gt;&quot;&#039;',
				1 => 'Un texte sans entites &<>"\'',
				2 => ENT_QUOTES,
			],
			37 => [
				0 => '{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;',
				1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				2 => ENT_QUOTES,
			],
			38 => [
				0 => 'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;',
				1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				2 => ENT_QUOTES,
			],
			39 => [
				0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				2 => ENT_QUOTES,
			],
			40 => [
				0 => '',
				1 => "Un texte avec des <a href=\"http://spip.net\">liens avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC</a> [Article 1 avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC->art1] [spip avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC->http://www.spip.net] http://www.spip.net",
				2 => ENT_QUOTES,
			],
			41 => [
				0 => '',
				1 => "Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
				2 => ENT_QUOTES,
			],
			42 => [
				0 => '',
				1 => "Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
				2 => ENT_QUOTES,
			],
			43 => [
				0 => '',
				1 => "Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
				2 => ENT_QUOTES,
			],
			44 => [
				0 => '',
				1 => "Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
				2 => ENT_QUOTES,
			],
			45 => [
				0 => '',
				1 => "Un texte sans entites &<>\"\' et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
				2 => ENT_QUOTES,
			],
			46 => [
				0 => '',
				1 => "{{{Des raccourcis avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC}}} {italique avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC} {{gras avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC}} <code>du code avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC</code>",
				2 => ENT_QUOTES,
			],
			47 => [
				0 => '',
				1 => "Un modele avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC <modeleinexistant|lien=[avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC->http://www.spip.net]>",
				2 => ENT_QUOTES,
			],
			48 => [
				0 => '',
				1 => "Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
				2 => ENT_QUOTES,
			],
			49 => [
				0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens avec des accents UTF-8 aàâä eéèêë iîï oô uùü&lt;/a&gt; [Article 1 avec des accents UTF-8 aàâä eéèêë iîï oô uùü-&gt;art1] [spip avec des accents UTF-8 aàâä eéèêë iîï oô uùü-&gt;http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents UTF-8 aàâä eéèêë iîï oô uùü</a> [Article 1 avec des accents UTF-8 aàâä eéèêë iîï oô uùü->art1] [spip avec des accents UTF-8 aàâä eéèêë iîï oô uùü->http://www.spip.net] http://www.spip.net',
				2 => ENT_QUOTES,
			],
			50 => [
				0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				2 => ENT_QUOTES,
			],
			51 => [
				0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				2 => ENT_QUOTES,
			],
			52 => [
				0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				2 => ENT_QUOTES,
			],
			53 => [
				0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				2 => ENT_QUOTES,
			],
			54 => [
				0 => 'Un texte sans entites &amp;&lt;&gt;&quot;&#039; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				1 => 'Un texte sans entites &<>"\' et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				2 => ENT_QUOTES,
			],
			55 => [
				0 => '{{{Des raccourcis avec des accents UTF-8 aàâä eéèêë iîï oô uùü}}} {italique avec des accents UTF-8 aàâä eéèêë iîï oô uùü} {{gras avec des accents UTF-8 aàâä eéèêë iîï oô uùü}} &lt;code&gt;du code avec des accents UTF-8 aàâä eéèêë iîï oô uùü&lt;/code&gt;',
				1 => '{{{Des raccourcis avec des accents UTF-8 aàâä eéèêë iîï oô uùü}}} {italique avec des accents UTF-8 aàâä eéèêë iîï oô uùü} {{gras avec des accents UTF-8 aàâä eéèêë iîï oô uùü}} <code>du code avec des accents UTF-8 aàâä eéèêë iîï oô uùü</code>',
				2 => ENT_QUOTES,
			],
			56 => [
				0 => 'Un modele avec des accents UTF-8 aàâä eéèêë iîï oô uùü &lt;modeleinexistant|lien=[avec des accents UTF-8 aàâä eéèêë iîï oô uùü-&gt;http://www.spip.net]&gt;',
				1 => 'Un modele avec des accents UTF-8 aàâä eéèêë iîï oô uùü <modeleinexistant|lien=[avec des accents UTF-8 aàâä eéèêë iîï oô uùü->http://www.spip.net]>',
				2 => ENT_QUOTES,
			],
			57 => [
				0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				2 => ENT_QUOTES,
			],
			58 => [
				0 => '',
				1 => '',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			59 => [
				0 => '0',
				1 => '0',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			60 => [
				0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			61 => [
				0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			62 => [
				0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot;',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			63 => [
				0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			64 => [
				0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot;',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			65 => [
				0 => "Un texte sans entites &amp;&lt;&gt;&quot;'",
				1 => 'Un texte sans entites &<>"\'',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			66 => [
				0 => '{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;',
				1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			67 => [
				0 => 'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;',
				1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			68 => [
				0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			69 => [
				0 => '',
				1 => "Un texte avec des <a href=\"http://spip.net\">liens avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC</a> [Article 1 avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC->art1] [spip avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC->http://www.spip.net] http://www.spip.net",
				2 => ENT_COMPAT | ENT_HTML401,
			],
			70 => [
				0 => '',
				1 => "Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
				2 => ENT_COMPAT | ENT_HTML401,
			],
			71 => [
				0 => '',
				1 => "Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
				2 => ENT_COMPAT | ENT_HTML401,
			],
			72 => [
				0 => '',
				1 => "Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
				2 => ENT_COMPAT | ENT_HTML401,
			],
			73 => [
				0 => '',
				1 => "Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
				2 => ENT_COMPAT | ENT_HTML401,
			],
			74 => [
				0 => '',
				1 => "Un texte sans entites &<>\"\' et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
				2 => ENT_COMPAT | ENT_HTML401,
			],
			75 => [
				0 => '',
				1 => "{{{Des raccourcis avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC}}} {italique avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC} {{gras avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC}} <code>du code avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC</code>",
				2 => ENT_COMPAT | ENT_HTML401,
			],
			76 => [
				0 => '',
				1 => "Un modele avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC <modeleinexistant|lien=[avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC->http://www.spip.net]>",
				2 => ENT_COMPAT | ENT_HTML401,
			],
			77 => [
				0 => '',
				1 => "Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
				2 => ENT_COMPAT | ENT_HTML401,
			],
			78 => [
				0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens avec des accents UTF-8 aàâä eéèêë iîï oô uùü&lt;/a&gt; [Article 1 avec des accents UTF-8 aàâä eéèêë iîï oô uùü-&gt;art1] [spip avec des accents UTF-8 aàâä eéèêë iîï oô uùü-&gt;http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents UTF-8 aàâä eéèêë iîï oô uùü</a> [Article 1 avec des accents UTF-8 aàâä eéèêë iîï oô uùü->art1] [spip avec des accents UTF-8 aàâä eéèêë iîï oô uùü->http://www.spip.net] http://www.spip.net',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			79 => [
				0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			80 => [
				0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			81 => [
				0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			82 => [
				0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			83 => [
				0 => "Un texte sans entites &amp;&lt;&gt;&quot;' et avec des accents UTF-8 aàâä eéèêë iîï oô uùü",
				1 => 'Un texte sans entites &<>"\' et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			84 => [
				0 => '{{{Des raccourcis avec des accents UTF-8 aàâä eéèêë iîï oô uùü}}} {italique avec des accents UTF-8 aàâä eéèêë iîï oô uùü} {{gras avec des accents UTF-8 aàâä eéèêë iîï oô uùü}} &lt;code&gt;du code avec des accents UTF-8 aàâä eéèêë iîï oô uùü&lt;/code&gt;',
				1 => '{{{Des raccourcis avec des accents UTF-8 aàâä eéèêë iîï oô uùü}}} {italique avec des accents UTF-8 aàâä eéèêë iîï oô uùü} {{gras avec des accents UTF-8 aàâä eéèêë iîï oô uùü}} <code>du code avec des accents UTF-8 aàâä eéèêë iîï oô uùü</code>',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			85 => [
				0 => 'Un modele avec des accents UTF-8 aàâä eéèêë iîï oô uùü &lt;modeleinexistant|lien=[avec des accents UTF-8 aàâä eéèêë iîï oô uùü-&gt;http://www.spip.net]&gt;',
				1 => 'Un modele avec des accents UTF-8 aàâä eéèêë iîï oô uùü <modeleinexistant|lien=[avec des accents UTF-8 aàâä eéèêë iîï oô uùü->http://www.spip.net]>',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			86 => [
				0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			87 => [
				0 => '',
				1 => '',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			88 => [
				0 => '0',
				1 => '0',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			89 => [
				0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			90 => [
				0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			91 => [
				0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot;',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			92 => [
				0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			93 => [
				0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot;',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			94 => [
				0 => "Un texte sans entites &amp;&lt;&gt;&quot;'",
				1 => 'Un texte sans entites &<>"\'',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			95 => [
				0 => '{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;',
				1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			96 => [
				0 => 'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;',
				1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			97 => [
				0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			98 => [
				0 => "Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC&lt;/a&gt; [Article 1 avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC-&gt;art1] [spip avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC-&gt;http://www.spip.net] http://www.spip.net",
				1 => "Un texte avec des <a href=\"http://spip.net\">liens avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC</a> [Article 1 avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC->art1] [spip avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC->http://www.spip.net] http://www.spip.net",
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			99 => [
				0 => "Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
				1 => "Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			100 => [
				0 => "Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot; et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
				1 => "Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			101 => [
				0 => "Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
				1 => "Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			102 => [
				0 => "Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot; et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
				1 => "Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			103 => [
				0 => "Un texte sans entites &amp;&lt;&gt;&quot;' et avec des accents ISO a\xe0\xe2\xe4 e\xe9\xe8\xea\xeb i\xee\xef o\xf4 u\xf9\xfc",
				1 => "Un texte sans entites &<>\"' et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			104 => [
				0 => "{{{Des raccourcis avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC}}} {italique avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC} {{gras avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC}} &lt;code&gt;du code avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC&lt;/code&gt;",
				1 => "{{{Des raccourcis avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC}}} {italique avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC} {{gras avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC}} <code>du code avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC</code>",
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			105 => [
				0 => "Un modele avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC &lt;modeleinexistant|lien=[avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC-&gt;http://www.spip.net]&gt;",
				1 => "Un modele avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC <modeleinexistant|lien=[avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC->http://www.spip.net]>",
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			106 => [
				0 => "Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
				1 => "Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			107 => [
				0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens avec des accents UTF-8 aàâä eéèêë iîï oô uùü&lt;/a&gt; [Article 1 avec des accents UTF-8 aàâä eéèêë iîï oô uùü-&gt;art1] [spip avec des accents UTF-8 aàâä eéèêë iîï oô uùü-&gt;http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents UTF-8 aàâä eéèêë iîï oô uùü</a> [Article 1 avec des accents UTF-8 aàâä eéèêë iîï oô uùü->art1] [spip avec des accents UTF-8 aàâä eéèêë iîï oô uùü->http://www.spip.net] http://www.spip.net',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			108 => [
				0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			109 => [
				0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			110 => [
				0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			111 => [
				0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			112 => [
				0 => "Un texte sans entites &amp;&lt;&gt;&quot;' et avec des accents UTF-8 aàâä eéèêë iîï oô uùü",
				1 => 'Un texte sans entites &<>"\' et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			113 => [
				0 => '{{{Des raccourcis avec des accents UTF-8 aàâä eéèêë iîï oô uùü}}} {italique avec des accents UTF-8 aàâä eéèêë iîï oô uùü} {{gras avec des accents UTF-8 aàâä eéèêë iîï oô uùü}} &lt;code&gt;du code avec des accents UTF-8 aàâä eéèêë iîï oô uùü&lt;/code&gt;',
				1 => '{{{Des raccourcis avec des accents UTF-8 aàâä eéèêë iîï oô uùü}}} {italique avec des accents UTF-8 aàâä eéèêë iîï oô uùü} {{gras avec des accents UTF-8 aàâä eéèêë iîï oô uùü}} <code>du code avec des accents UTF-8 aàâä eéèêë iîï oô uùü</code>',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			114 => [
				0 => 'Un modele avec des accents UTF-8 aàâä eéèêë iîï oô uùü &lt;modeleinexistant|lien=[avec des accents UTF-8 aàâä eéèêë iîï oô uùü-&gt;http://www.spip.net]&gt;',
				1 => 'Un modele avec des accents UTF-8 aàâä eéèêë iîï oô uùü <modeleinexistant|lien=[avec des accents UTF-8 aàâä eéèêë iîï oô uùü->http://www.spip.net]>',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			115 => [
				0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			116 => [
				0 => '',
				1 => '',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			117 => [
				0 => '0',
				1 => '0',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			118 => [
				0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			119 => [
				0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			120 => [
				0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot;',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			121 => [
				0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			122 => [
				0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot;',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			123 => [
				0 => "Un texte sans entites &amp;&lt;&gt;&quot;'",
				1 => 'Un texte sans entites &<>"\'',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			124 => [
				0 => '{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;',
				1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			125 => [
				0 => 'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;',
				1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			126 => [
				0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			127 => [
				0 => '',
				1 => "Un texte avec des <a href=\"http://spip.net\">liens avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC</a> [Article 1 avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC->art1] [spip avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC->http://www.spip.net] http://www.spip.net",
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			128 => [
				0 => '',
				1 => "Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			129 => [
				0 => '',
				1 => "Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			130 => [
				0 => '',
				1 => "Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			131 => [
				0 => '',
				1 => "Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			132 => [
				0 => '',
				1 => "Un texte sans entites &<>\"\' et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			133 => [
				0 => '',
				1 => "{{{Des raccourcis avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC}}} {italique avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC} {{gras avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC}} <code>du code avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC</code>",
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			134 => [
				0 => '',
				1 => "Un modele avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC <modeleinexistant|lien=[avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC->http://www.spip.net]>",
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			135 => [
				0 => '',
				1 => "Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			136 => [
				0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens avec des accents UTF-8 aàâä eéèêë iîï oô uùü&lt;/a&gt; [Article 1 avec des accents UTF-8 aàâä eéèêë iîï oô uùü-&gt;art1] [spip avec des accents UTF-8 aàâä eéèêë iîï oô uùü-&gt;http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents UTF-8 aàâä eéèêë iîï oô uùü</a> [Article 1 avec des accents UTF-8 aàâä eéèêë iîï oô uùü->art1] [spip avec des accents UTF-8 aàâä eéèêë iîï oô uùü->http://www.spip.net] http://www.spip.net',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			137 => [
				0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			138 => [
				0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			139 => [
				0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			140 => [
				0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			141 => [
				0 => "Un texte sans entites &amp;&lt;&gt;&quot;' et avec des accents UTF-8 aàâä eéèêë iîï oô uùü",
				1 => 'Un texte sans entites &<>"\' et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			142 => [
				0 => '{{{Des raccourcis avec des accents UTF-8 aàâä eéèêë iîï oô uùü}}} {italique avec des accents UTF-8 aàâä eéèêë iîï oô uùü} {{gras avec des accents UTF-8 aàâä eéèêë iîï oô uùü}} &lt;code&gt;du code avec des accents UTF-8 aàâä eéèêë iîï oô uùü&lt;/code&gt;',
				1 => '{{{Des raccourcis avec des accents UTF-8 aàâä eéèêë iîï oô uùü}}} {italique avec des accents UTF-8 aàâä eéèêë iîï oô uùü} {{gras avec des accents UTF-8 aàâä eéèêë iîï oô uùü}} <code>du code avec des accents UTF-8 aàâä eéèêë iîï oô uùü</code>',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			143 => [
				0 => 'Un modele avec des accents UTF-8 aàâä eéèêë iîï oô uùü &lt;modeleinexistant|lien=[avec des accents UTF-8 aàâä eéèêë iîï oô uùü-&gt;http://www.spip.net]&gt;',
				1 => 'Un modele avec des accents UTF-8 aàâä eéèêë iîï oô uùü <modeleinexistant|lien=[avec des accents UTF-8 aàâä eéèêë iîï oô uùü->http://www.spip.net]>',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			144 => [
				0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
		];
	}
}
