<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction spip_htmlentities du fichier ./inc/filtres.php
 */

namespace Spip\Core\Tests\Filtre;

use PHPUnit\Framework\TestCase;

class SpipHtmlentitiesTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		find_in_path('./inc/filtres.php', '', true);
	}

	/**
	 * @dataProvider providerFiltresSpipHtmlentities
	 */
	public function testFiltresSpipHtmlentities($expected, ...$args): void
	{
		$actual = spip_htmlentities(...$args);
		$this->assertSame($expected, $actual);
		$this->assertEquals($expected, $actual);
	}

	public function providerFiltresSpipHtmlentities(): array
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
				1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents ISO aàâä eéèêë iîï oô uùü</a> [Article 1 avec des accents ISO aàâä eéèêë iîï oô uùü->art1] [spip avec des accents ISO aàâä eéèêë iîï oô uùü->http://www.spip.net] http://www.spip.net',
			],
			12 => [
				0 => '',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
			],
			13 => [
				0 => '',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
			],
			14 => [
				0 => '',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
			],
			15 => [
				0 => '',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
			],
			16 => [
				0 => '',
				1 => 'Un texte sans entites &<>"\' et avec des accents ISO aàâä eéèêë iîï oô uùü',
			],
			17 => [
				0 => '',
				1 => '{{{Des raccourcis avec des accents ISO aàâä eéèêë iîï oô uùü}}} {italique avec des accents ISO aàâä eéèêë iîï oô uùü} {{gras avec des accents ISO aàâä eéèêë iîï oô uùü}} <code>du code avec des accents ISO aàâä eéèêë iîï oô uùü</code>',
			],
			18 => [
				0 => '',
				1 => 'Un modele avec des accents ISO aàâä eéèêë iîï oô uùü <modeleinexistant|lien=[avec des accents ISO aàâä eéèêë iîï oô uùü->http://www.spip.net]>',
			],
			19 => [
				0 => '',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents ISO aàâä eéèêë iîï oô uùü',
			],
			20 => [
				0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;&lt;/a&gt; [Article 1 avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;art1] [spip avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</a> [Article 1 avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->art1] [spip avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->http://www.spip.net] http://www.spip.net',
			],
			21 => [
				0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
			],
			22 => [
				0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
			],
			23 => [
				0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
			],
			24 => [
				0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
			],
			25 => [
				0 => "Un texte sans entites &amp;&lt;&gt;&quot;' et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;",
				1 => 'Un texte sans entites &<>"\' et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
			],
			26 => [
				0 => '{{{Des raccourcis avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;}}} {italique avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;} {{gras avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;}} &lt;code&gt;du code avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;&lt;/code&gt;',
				1 => '{{{Des raccourcis avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}}} {italique avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼} {{gras avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}} <code>du code avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</code>',
			],
			27 => [
				0 => 'Un modele avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml; &lt;modeleinexistant|lien=[avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;http://www.spip.net]&gt;',
				1 => 'Un modele avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼ <modeleinexistant|lien=[avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->http://www.spip.net]>',
			],
			28 => [
				0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
			],
			29 => [
				0 => '',
				1 => '',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			30 => [
				0 => '0',
				1 => '0',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			31 => [
				0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			32 => [
				0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			33 => [
				0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot;',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			34 => [
				0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			35 => [
				0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot;',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			36 => [
				0 => "Un texte sans entites &amp;&lt;&gt;&quot;'",
				1 => 'Un texte sans entites &<>"\'',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			37 => [
				0 => '{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;',
				1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			38 => [
				0 => 'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;',
				1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			39 => [
				0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			40 => [
				0 => '',
				1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents ISO aàâä eéèêë iîï oô uùü</a> [Article 1 avec des accents ISO aàâä eéèêë iîï oô uùü->art1] [spip avec des accents ISO aàâä eéèêë iîï oô uùü->http://www.spip.net] http://www.spip.net',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			41 => [
				0 => '',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			42 => [
				0 => '',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			43 => [
				0 => '',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			44 => [
				0 => '',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			45 => [
				0 => '',
				1 => 'Un texte sans entites &<>"\' et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			46 => [
				0 => '',
				1 => '{{{Des raccourcis avec des accents ISO aàâä eéèêë iîï oô uùü}}} {italique avec des accents ISO aàâä eéèêë iîï oô uùü} {{gras avec des accents ISO aàâä eéèêë iîï oô uùü}} <code>du code avec des accents ISO aàâä eéèêë iîï oô uùü</code>',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			47 => [
				0 => '',
				1 => 'Un modele avec des accents ISO aàâä eéèêë iîï oô uùü <modeleinexistant|lien=[avec des accents ISO aàâä eéèêë iîï oô uùü->http://www.spip.net]>',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			48 => [
				0 => '',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			49 => [
				0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;&lt;/a&gt; [Article 1 avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;art1] [spip avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</a> [Article 1 avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->art1] [spip avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->http://www.spip.net] http://www.spip.net',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			50 => [
				0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			51 => [
				0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			52 => [
				0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			53 => [
				0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			54 => [
				0 => "Un texte sans entites &amp;&lt;&gt;&quot;' et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;",
				1 => 'Un texte sans entites &<>"\' et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			55 => [
				0 => '{{{Des raccourcis avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;}}} {italique avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;} {{gras avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;}} &lt;code&gt;du code avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;&lt;/code&gt;',
				1 => '{{{Des raccourcis avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}}} {italique avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼} {{gras avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}} <code>du code avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</code>',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			56 => [
				0 => 'Un modele avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml; &lt;modeleinexistant|lien=[avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;http://www.spip.net]&gt;',
				1 => 'Un modele avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼ <modeleinexistant|lien=[avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->http://www.spip.net]>',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			57 => [
				0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_COMPAT | ENT_HTML401,
			],
			58 => [
				0 => '',
				1 => '',
				2 => ENT_QUOTES,
			],
			59 => [
				0 => '0',
				1 => '0',
				2 => ENT_QUOTES,
			],
			60 => [
				0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				2 => ENT_QUOTES,
			],
			61 => [
				0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				2 => ENT_QUOTES,
			],
			62 => [
				0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot;',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
				2 => ENT_QUOTES,
			],
			63 => [
				0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
				2 => ENT_QUOTES,
			],
			64 => [
				0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot;',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
				2 => ENT_QUOTES,
			],
			65 => [
				0 => 'Un texte sans entites &amp;&lt;&gt;&quot;&#039;',
				1 => 'Un texte sans entites &<>"\'',
				2 => ENT_QUOTES,
			],
			66 => [
				0 => '{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;',
				1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				2 => ENT_QUOTES,
			],
			67 => [
				0 => 'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;',
				1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				2 => ENT_QUOTES,
			],
			68 => [
				0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				2 => ENT_QUOTES,
			],
			69 => [
				0 => '',
				1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents ISO aàâä eéèêë iîï oô uùü</a> [Article 1 avec des accents ISO aàâä eéèêë iîï oô uùü->art1] [spip avec des accents ISO aàâä eéèêë iîï oô uùü->http://www.spip.net] http://www.spip.net',
				2 => ENT_QUOTES,
			],
			70 => [
				0 => '',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_QUOTES,
			],
			71 => [
				0 => '',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_QUOTES,
			],
			72 => [
				0 => '',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_QUOTES,
			],
			73 => [
				0 => '',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_QUOTES,
			],
			74 => [
				0 => '',
				1 => 'Un texte sans entites &<>"\' et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_QUOTES,
			],
			75 => [
				0 => '',
				1 => '{{{Des raccourcis avec des accents ISO aàâä eéèêë iîï oô uùü}}} {italique avec des accents ISO aàâä eéèêë iîï oô uùü} {{gras avec des accents ISO aàâä eéèêë iîï oô uùü}} <code>du code avec des accents ISO aàâä eéèêë iîï oô uùü</code>',
				2 => ENT_QUOTES,
			],
			76 => [
				0 => '',
				1 => 'Un modele avec des accents ISO aàâä eéèêë iîï oô uùü <modeleinexistant|lien=[avec des accents ISO aàâä eéèêë iîï oô uùü->http://www.spip.net]>',
				2 => ENT_QUOTES,
			],
			77 => [
				0 => '',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_QUOTES,
			],
			78 => [
				0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;&lt;/a&gt; [Article 1 avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;art1] [spip avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</a> [Article 1 avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->art1] [spip avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->http://www.spip.net] http://www.spip.net',
				2 => ENT_QUOTES,
			],
			79 => [
				0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_QUOTES,
			],
			80 => [
				0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_QUOTES,
			],
			81 => [
				0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_QUOTES,
			],
			82 => [
				0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_QUOTES,
			],
			83 => [
				0 => 'Un texte sans entites &amp;&lt;&gt;&quot;&#039; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte sans entites &<>"\' et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_QUOTES,
			],
			84 => [
				0 => '{{{Des raccourcis avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;}}} {italique avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;} {{gras avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;}} &lt;code&gt;du code avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;&lt;/code&gt;',
				1 => '{{{Des raccourcis avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}}} {italique avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼} {{gras avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}} <code>du code avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</code>',
				2 => ENT_QUOTES,
			],
			85 => [
				0 => 'Un modele avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml; &lt;modeleinexistant|lien=[avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;http://www.spip.net]&gt;',
				1 => 'Un modele avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼ <modeleinexistant|lien=[avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->http://www.spip.net]>',
				2 => ENT_QUOTES,
			],
			86 => [
				0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_QUOTES,
			],
			87 => [
				0 => '',
				1 => '',
				2 => ENT_NOQUOTES,
			],
			88 => [
				0 => '0',
				1 => '0',
				2 => ENT_NOQUOTES,
			],
			89 => [
				0 => 'Un texte avec des &lt;a href="http://spip.net"&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				2 => ENT_NOQUOTES,
			],
			90 => [
				0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				2 => ENT_NOQUOTES,
			],
			91 => [
				0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot;',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
				2 => ENT_NOQUOTES,
			],
			92 => [
				0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
				2 => ENT_NOQUOTES,
			],
			93 => [
				0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot;',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
				2 => ENT_NOQUOTES,
			],
			94 => [
				0 => 'Un texte sans entites &amp;&lt;&gt;"\'',
				1 => 'Un texte sans entites &<>"\'',
				2 => ENT_NOQUOTES,
			],
			95 => [
				0 => '{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;',
				1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				2 => ENT_NOQUOTES,
			],
			96 => [
				0 => 'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;',
				1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				2 => ENT_NOQUOTES,
			],
			97 => [
				0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				2 => ENT_NOQUOTES,
			],
			98 => [
				0 => '',
				1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents ISO aàâä eéèêë iîï oô uùü</a> [Article 1 avec des accents ISO aàâä eéèêë iîï oô uùü->art1] [spip avec des accents ISO aàâä eéèêë iîï oô uùü->http://www.spip.net] http://www.spip.net',
				2 => ENT_NOQUOTES,
			],
			99 => [
				0 => '',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_NOQUOTES,
			],
			100 => [
				0 => '',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_NOQUOTES,
			],
			101 => [
				0 => '',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_NOQUOTES,
			],
			102 => [
				0 => '',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_NOQUOTES,
			],
			103 => [
				0 => '',
				1 => 'Un texte sans entites &<>"\' et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_NOQUOTES,
			],
			104 => [
				0 => '',
				1 => '{{{Des raccourcis avec des accents ISO aàâä eéèêë iîï oô uùü}}} {italique avec des accents ISO aàâä eéèêë iîï oô uùü} {{gras avec des accents ISO aàâä eéèêë iîï oô uùü}} <code>du code avec des accents ISO aàâä eéèêë iîï oô uùü</code>',
				2 => ENT_NOQUOTES,
			],
			105 => [
				0 => '',
				1 => 'Un modele avec des accents ISO aàâä eéèêë iîï oô uùü <modeleinexistant|lien=[avec des accents ISO aàâä eéèêë iîï oô uùü->http://www.spip.net]>',
				2 => ENT_NOQUOTES,
			],
			106 => [
				0 => '',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_NOQUOTES,
			],
			107 => [
				0 => 'Un texte avec des &lt;a href="http://spip.net"&gt;liens avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;&lt;/a&gt; [Article 1 avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;art1] [spip avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</a> [Article 1 avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->art1] [spip avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->http://www.spip.net] http://www.spip.net',
				2 => ENT_NOQUOTES,
			],
			108 => [
				0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_NOQUOTES,
			],
			109 => [
				0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_NOQUOTES,
			],
			110 => [
				0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_NOQUOTES,
			],
			111 => [
				0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_NOQUOTES,
			],
			112 => [
				0 => 'Un texte sans entites &amp;&lt;&gt;"\' et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte sans entites &<>"\' et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_NOQUOTES,
			],
			113 => [
				0 => '{{{Des raccourcis avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;}}} {italique avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;} {{gras avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;}} &lt;code&gt;du code avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;&lt;/code&gt;',
				1 => '{{{Des raccourcis avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}}} {italique avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼} {{gras avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}} <code>du code avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</code>',
				2 => ENT_NOQUOTES,
			],
			114 => [
				0 => 'Un modele avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml; &lt;modeleinexistant|lien=[avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;http://www.spip.net]&gt;',
				1 => 'Un modele avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼ <modeleinexistant|lien=[avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->http://www.spip.net]>',
				2 => ENT_NOQUOTES,
			],
			115 => [
				0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_NOQUOTES,
			],
			116 => [
				0 => '',
				1 => '',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			117 => [
				0 => '0',
				1 => '0',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			118 => [
				0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			119 => [
				0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			120 => [
				0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot;',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			121 => [
				0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			122 => [
				0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot;',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			123 => [
				0 => "Un texte sans entites &amp;&lt;&gt;&quot;'",
				1 => 'Un texte sans entites &<>"\'',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			124 => [
				0 => '{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;',
				1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			125 => [
				0 => 'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;',
				1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			126 => [
				0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			127 => [
				0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;&lt;/a&gt; [Article 1 avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;art1] [spip avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents ISO aàâä eéèêë iîï oô uùü</a> [Article 1 avec des accents ISO aàâä eéèêë iîï oô uùü->art1] [spip avec des accents ISO aàâä eéèêë iîï oô uùü->http://www.spip.net] http://www.spip.net',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			128 => [
				0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			129 => [
				0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			130 => [
				0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			131 => [
				0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			132 => [
				0 => "Un texte sans entites &amp;&lt;&gt;&quot;' et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;",
				1 => 'Un texte sans entites &<>"\' et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			133 => [
				0 => '{{{Des raccourcis avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;}}} {italique avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;} {{gras avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;}} &lt;code&gt;du code avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;&lt;/code&gt;',
				1 => '{{{Des raccourcis avec des accents ISO aàâä eéèêë iîï oô uùü}}} {italique avec des accents ISO aàâä eéèêë iîï oô uùü} {{gras avec des accents ISO aàâä eéèêë iîï oô uùü}} <code>du code avec des accents ISO aàâä eéèêë iîï oô uùü</code>',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			134 => [
				0 => 'Un modele avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml; &lt;modeleinexistant|lien=[avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;http://www.spip.net]&gt;',
				1 => 'Un modele avec des accents ISO aàâä eéèêë iîï oô uùü <modeleinexistant|lien=[avec des accents ISO aàâä eéèêë iîï oô uùü->http://www.spip.net]>',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			135 => [
				0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			136 => [
				0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;&lt;/a&gt; [Article 1 avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;-&gt;art1] [spip avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;-&gt;http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</a> [Article 1 avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->art1] [spip avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->http://www.spip.net] http://www.spip.net',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			137 => [
				0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			138 => [
				0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			139 => [
				0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			140 => [
				0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			141 => [
				0 => "Un texte sans entites &amp;&lt;&gt;&quot;' et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;",
				1 => 'Un texte sans entites &<>"\' et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			142 => [
				0 => '{{{Des raccourcis avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;}}} {italique avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;} {{gras avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;}} &lt;code&gt;du code avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;&lt;/code&gt;',
				1 => '{{{Des raccourcis avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}}} {italique avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼} {{gras avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}} <code>du code avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</code>',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			143 => [
				0 => 'Un modele avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14; &lt;modeleinexistant|lien=[avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;-&gt;http://www.spip.net]&gt;',
				1 => 'Un modele avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼ <modeleinexistant|lien=[avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->http://www.spip.net]>',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			144 => [
				0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
			],
			145 => [
				0 => '',
				1 => '',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			146 => [
				0 => '0',
				1 => '0',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			147 => [
				0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			148 => [
				0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			149 => [
				0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot;',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			150 => [
				0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			151 => [
				0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot;',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			152 => [
				0 => "Un texte sans entites &amp;&lt;&gt;&quot;'",
				1 => 'Un texte sans entites &<>"\'',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			153 => [
				0 => '{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;',
				1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			154 => [
				0 => 'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;',
				1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			155 => [
				0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			156 => [
				0 => '',
				1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents ISO aàâä eéèêë iîï oô uùü</a> [Article 1 avec des accents ISO aàâä eéèêë iîï oô uùü->art1] [spip avec des accents ISO aàâä eéèêë iîï oô uùü->http://www.spip.net] http://www.spip.net',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			157 => [
				0 => '',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			158 => [
				0 => '',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			159 => [
				0 => '',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			160 => [
				0 => '',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			161 => [
				0 => '',
				1 => 'Un texte sans entites &<>"\' et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			162 => [
				0 => '',
				1 => '{{{Des raccourcis avec des accents ISO aàâä eéèêë iîï oô uùü}}} {italique avec des accents ISO aàâä eéèêë iîï oô uùü} {{gras avec des accents ISO aàâä eéèêë iîï oô uùü}} <code>du code avec des accents ISO aàâä eéèêë iîï oô uùü</code>',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			163 => [
				0 => '',
				1 => 'Un modele avec des accents ISO aàâä eéèêë iîï oô uùü <modeleinexistant|lien=[avec des accents ISO aàâä eéèêë iîï oô uùü->http://www.spip.net]>',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			164 => [
				0 => '',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			165 => [
				0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;&lt;/a&gt; [Article 1 avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;art1] [spip avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</a> [Article 1 avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->art1] [spip avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->http://www.spip.net] http://www.spip.net',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			166 => [
				0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			167 => [
				0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			168 => [
				0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			169 => [
				0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			170 => [
				0 => "Un texte sans entites &amp;&lt;&gt;&quot;' et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;",
				1 => 'Un texte sans entites &<>"\' et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			171 => [
				0 => '{{{Des raccourcis avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;}}} {italique avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;} {{gras avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;}} &lt;code&gt;du code avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;&lt;/code&gt;',
				1 => '{{{Des raccourcis avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}}} {italique avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼} {{gras avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}} <code>du code avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</code>',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			172 => [
				0 => 'Un modele avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml; &lt;modeleinexistant|lien=[avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;http://www.spip.net]&gt;',
				1 => 'Un modele avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼ <modeleinexistant|lien=[avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->http://www.spip.net]>',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			173 => [
				0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
			],
			174 => [
				0 => '',
				1 => '',
				2 => ENT_QUOTES,
				3 => 'ISO-8859-1',
			],
			175 => [
				0 => '0',
				1 => '0',
				2 => ENT_QUOTES,
				3 => 'ISO-8859-1',
			],
			176 => [
				0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;&lt;/a&gt; [Article 1 avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;art1] [spip avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents ISO aàâä eéèêë iîï oô uùü</a> [Article 1 avec des accents ISO aàâä eéèêë iîï oô uùü->art1] [spip avec des accents ISO aàâä eéèêë iîï oô uùü->http://www.spip.net] http://www.spip.net',
				2 => ENT_QUOTES,
				3 => 'ISO-8859-1',
			],
			177 => [
				0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_QUOTES,
				3 => 'ISO-8859-1',
			],
			178 => [
				0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_QUOTES,
				3 => 'ISO-8859-1',
			],
			179 => [
				0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_QUOTES,
				3 => 'ISO-8859-1',
			],
			180 => [
				0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_QUOTES,
				3 => 'ISO-8859-1',
			],
			181 => [
				0 => 'Un texte sans entites &amp;&lt;&gt;&quot;&#039; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte sans entites &<>"\' et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_QUOTES,
				3 => 'ISO-8859-1',
			],
			182 => [
				0 => '{{{Des raccourcis avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;}}} {italique avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;} {{gras avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;}} &lt;code&gt;du code avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;&lt;/code&gt;',
				1 => '{{{Des raccourcis avec des accents ISO aàâä eéèêë iîï oô uùü}}} {italique avec des accents ISO aàâä eéèêë iîï oô uùü} {{gras avec des accents ISO aàâä eéèêë iîï oô uùü}} <code>du code avec des accents ISO aàâä eéèêë iîï oô uùü</code>',
				2 => ENT_QUOTES,
				3 => 'ISO-8859-1',
			],
			183 => [
				0 => 'Un modele avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml; &lt;modeleinexistant|lien=[avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;http://www.spip.net]&gt;',
				1 => 'Un modele avec des accents ISO aàâä eéèêë iîï oô uùü <modeleinexistant|lien=[avec des accents ISO aàâä eéèêë iîï oô uùü->http://www.spip.net]>',
				2 => ENT_QUOTES,
				3 => 'ISO-8859-1',
			],
			184 => [
				0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_QUOTES,
				3 => 'ISO-8859-1',
			],
			185 => [
				0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;&lt;/a&gt; [Article 1 avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;-&gt;art1] [spip avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;-&gt;http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</a> [Article 1 avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->art1] [spip avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->http://www.spip.net] http://www.spip.net',
				2 => ENT_QUOTES,
				3 => 'ISO-8859-1',
			],
			186 => [
				0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_QUOTES,
				3 => 'ISO-8859-1',
			],
			187 => [
				0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_QUOTES,
				3 => 'ISO-8859-1',
			],
			188 => [
				0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_QUOTES,
				3 => 'ISO-8859-1',
			],
			189 => [
				0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_QUOTES,
				3 => 'ISO-8859-1',
			],
			190 => [
				0 => 'Un texte sans entites &amp;&lt;&gt;&quot;&#039; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
				1 => 'Un texte sans entites &<>"\' et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_QUOTES,
				3 => 'ISO-8859-1',
			],
			191 => [
				0 => '{{{Des raccourcis avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;}}} {italique avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;} {{gras avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;}} &lt;code&gt;du code avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;&lt;/code&gt;',
				1 => '{{{Des raccourcis avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}}} {italique avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼} {{gras avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}} <code>du code avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</code>',
				2 => ENT_QUOTES,
				3 => 'ISO-8859-1',
			],
			192 => [
				0 => 'Un modele avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14; &lt;modeleinexistant|lien=[avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;-&gt;http://www.spip.net]&gt;',
				1 => 'Un modele avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼ <modeleinexistant|lien=[avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->http://www.spip.net]>',
				2 => ENT_QUOTES,
				3 => 'ISO-8859-1',
			],
			193 => [
				0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_QUOTES,
				3 => 'ISO-8859-1',
			],
			194 => [
				0 => '',
				1 => '',
				2 => ENT_QUOTES,
				3 => 'UTF-8',
			],
			195 => [
				0 => '0',
				1 => '0',
				2 => ENT_QUOTES,
				3 => 'UTF-8',
			],
			196 => [
				0 => '',
				1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents ISO aàâä eéèêë iîï oô uùü</a> [Article 1 avec des accents ISO aàâä eéèêë iîï oô uùü->art1] [spip avec des accents ISO aàâä eéèêë iîï oô uùü->http://www.spip.net] http://www.spip.net',
				2 => ENT_QUOTES,
				3 => 'UTF-8',
			],
			197 => [
				0 => '',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_QUOTES,
				3 => 'UTF-8',
			],
			198 => [
				0 => '',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_QUOTES,
				3 => 'UTF-8',
			],
			199 => [
				0 => '',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_QUOTES,
				3 => 'UTF-8',
			],
			200 => [
				0 => '',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_QUOTES,
				3 => 'UTF-8',
			],
			201 => [
				0 => '',
				1 => 'Un texte sans entites &<>"\' et avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_QUOTES,
				3 => 'UTF-8',
			],
			202 => [
				0 => '',
				1 => '{{{Des raccourcis avec des accents ISO aàâä eéèêë iîï oô uùü}}} {italique avec des accents ISO aàâä eéèêë iîï oô uùü} {{gras avec des accents ISO aàâä eéèêë iîï oô uùü}} <code>du code avec des accents ISO aàâä eéèêë iîï oô uùü</code>',
				2 => ENT_QUOTES,
				3 => 'UTF-8',
			],
			203 => [
				0 => '',
				1 => 'Un modele avec des accents ISO aàâä eéèêë iîï oô uùü <modeleinexistant|lien=[avec des accents ISO aàâä eéèêë iîï oô uùü->http://www.spip.net]>',
				2 => ENT_QUOTES,
				3 => 'UTF-8',
			],
			204 => [
				0 => '',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents ISO aàâä eéèêë iîï oô uùü',
				2 => ENT_QUOTES,
				3 => 'UTF-8',
			],
			205 => [
				0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;&lt;/a&gt; [Article 1 avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;art1] [spip avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</a> [Article 1 avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->art1] [spip avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->http://www.spip.net] http://www.spip.net',
				2 => ENT_QUOTES,
				3 => 'UTF-8',
			],
			206 => [
				0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_QUOTES,
				3 => 'UTF-8',
			],
			207 => [
				0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_QUOTES,
				3 => 'UTF-8',
			],
			208 => [
				0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_QUOTES,
				3 => 'UTF-8',
			],
			209 => [
				0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_QUOTES,
				3 => 'UTF-8',
			],
			210 => [
				0 => 'Un texte sans entites &amp;&lt;&gt;&quot;&#039; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte sans entites &<>"\' et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_QUOTES,
				3 => 'UTF-8',
			],
			211 => [
				0 => '{{{Des raccourcis avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;}}} {italique avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;} {{gras avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;}} &lt;code&gt;du code avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;&lt;/code&gt;',
				1 => '{{{Des raccourcis avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}}} {italique avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼} {{gras avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}} <code>du code avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</code>',
				2 => ENT_QUOTES,
				3 => 'UTF-8',
			],
			212 => [
				0 => 'Un modele avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml; &lt;modeleinexistant|lien=[avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;http://www.spip.net]&gt;',
				1 => 'Un modele avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼ <modeleinexistant|lien=[avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->http://www.spip.net]>',
				2 => ENT_QUOTES,
				3 => 'UTF-8',
			],
			213 => [
				0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
				2 => ENT_QUOTES,
				3 => 'UTF-8',
			],
			214 => [
				0 => '',
				1 => '',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
				4 => false,
			],
			215 => [
				0 => '0',
				1 => '0',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
				4 => false,
			],
			216 => [
				0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
				4 => false,
			],
			217 => [
				0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
				4 => false,
			],
			218 => [
				0 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
				4 => false,
			],
			219 => [
				0 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
				4 => false,
			],
			220 => [
				0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
				4 => false,
			],
			221 => [
				0 => "Un texte sans entites &amp;&lt;&gt;&quot;'",
				1 => 'Un texte sans entites &<>"\'',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
				4 => false,
			],
			222 => [
				0 => '{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;',
				1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
				4 => false,
			],
			223 => [
				0 => 'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;',
				1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
				4 => false,
			],
			224 => [
				0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
				4 => false,
			],
			225 => [
				0 => '',
				1 => '',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
				4 => true,
			],
			226 => [
				0 => '0',
				1 => '0',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
				4 => true,
			],
			227 => [
				0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
				4 => true,
			],
			228 => [
				0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
				4 => true,
			],
			229 => [
				0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot;',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
				4 => true,
			],
			230 => [
				0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
				4 => true,
			],
			231 => [
				0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot;',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
				4 => true,
			],
			232 => [
				0 => "Un texte sans entites &amp;&lt;&gt;&quot;'",
				1 => 'Un texte sans entites &<>"\'',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
				4 => true,
			],
			233 => [
				0 => '{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;',
				1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
				4 => true,
			],
			234 => [
				0 => 'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;',
				1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
				4 => true,
			],
			235 => [
				0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'ISO-8859-1',
				4 => true,
			],
			236 => [
				0 => '',
				1 => '',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
				4 => false,
			],
			237 => [
				0 => '0',
				1 => '0',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
				4 => false,
			],
			238 => [
				0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
				4 => false,
			],
			239 => [
				0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
				4 => false,
			],
			240 => [
				0 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
				4 => false,
			],
			241 => [
				0 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
				4 => false,
			],
			242 => [
				0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
				4 => false,
			],
			243 => [
				0 => "Un texte sans entites &amp;&lt;&gt;&quot;'",
				1 => 'Un texte sans entites &<>"\'',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
				4 => false,
			],
			244 => [
				0 => '{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;',
				1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
				4 => false,
			],
			245 => [
				0 => 'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;',
				1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
				4 => false,
			],
			246 => [
				0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
				4 => false,
			],
			247 => [
				0 => '',
				1 => '',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
				4 => true,
			],
			248 => [
				0 => '0',
				1 => '0',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
				4 => true,
			],
			249 => [
				0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
				4 => true,
			],
			250 => [
				0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
				4 => true,
			],
			251 => [
				0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot;',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
				4 => true,
			],
			252 => [
				0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
				4 => true,
			],
			253 => [
				0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot;',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
				4 => true,
			],
			254 => [
				0 => "Un texte sans entites &amp;&lt;&gt;&quot;'",
				1 => 'Un texte sans entites &<>"\'',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
				4 => true,
			],
			255 => [
				0 => '{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;',
				1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
				4 => true,
			],
			256 => [
				0 => 'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;',
				1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
				4 => true,
			],
			257 => [
				0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				2 => ENT_COMPAT | ENT_HTML401,
				3 => 'UTF-8',
				4 => true,
			],
		];
	}
}
