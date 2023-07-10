<?php

declare(strict_types=1);

namespace Spip\Test\Filtre;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class EntitesHtmlTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('inc/filtres.php', '', true);
	}

	#[DataProvider('providerEntitesHtml')]
	public function testEntitesHtml($expected, ...$args): void {
		$actual = entites_html(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerEntitesHtml(): array {
		return [
			'empty' => [
				'expected' => '',
				'texte' => '',
				'tout' => false,
			],
			'zero' => [
				'expected' => '0',
				'texte' => '0',
				'tout' => false,
			],
			'liens' => [
				'expected' => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net',
				'texte' =>'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				'tout' => false,
			],
			'entites_echappees' => [
				'expected' => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
				'texte' => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
				'tout' => false,
			],
			'entites_numeriques' => [
				'expected' => 'Un texte avec des entit&#233;s num&#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
				'texte' => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
				'tout' => false,
			],
			'entites_numeriques_echappees' => [
				'expected' => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
				'texte' => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
				'tout' => false,
			],
			'sans_entites' => [
				'expected' => 'Un texte sans entites &amp;&lt;&gt;&quot;&#039;',
				'texte' => 'Un texte sans entites &<>"\'',
				'tout' => false,
			],
			'code' => [
				'expected' => '&lt;code&gt;&amp;#233;&lt;/code&gt;&#233;',
				'texte' => '<code>&#233;</code>&#233;',
			],
			'raccourcis_spip' => [
				'expected' => '{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;',
				'texte' => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				'tout' => false,
			],
			'modele_inexistant' => [
				'expected' => 'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;',
				'texte' => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				'tout' => false,
			],
			'multiligne' => [
				'expected' => <<<TEXT
				Un texte avec des retour
				a la ligne et meme des

				paragraphes
				TEXT,
				'texte' => <<<TEXT
				Un texte avec des retour
				a la ligne et meme des

				paragraphes
				TEXT,
				'tout' => false,
			],
		];
	}
}
