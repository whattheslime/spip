<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction propre du fichier inc/texte.php
 */

namespace Spip\Test\Texte;

use PHPUnit\Framework\TestCase;

class TypoTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		find_in_path('inc/texte.php', '', true);
	}

	protected function setUp(): void
	{
		$GLOBALS['meta']['type_urls'] = 'page';
		$GLOBALS['type_urls'] = 'page';
		// ce test est en fr
		changer_langue('fr');
	}

	/**
	 * @dataProvider providerTexteTypo
	 */
	public function testTexteTypo($expected, ...$args): void
	{
		$actual = typo(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerTexteTypo(): array
	{
		return [
			0 =>
			[
				0 => 'Quelle question&nbsp;!',
				1 => 'Quelle question!',
			],
			1 =>
			[
				0 => '',
				1 => '',
				2 => true,
			],
			2 =>
			[
				0 => '',
				1 => '',
				2 => false,
			],
			3 =>
			[
				0 => '0',
				1 => '0',
				2 => true,
			],
			4 =>
			[
				0 => '0',
				1 => '0',
				2 => false,
			],
			5 =>
			[
				0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				2 => true,
			],
			6 =>
			[
				0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
				2 => false,
			],
			7 =>
			[
				0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				2 => true,
			],
			8 =>
			[
				0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				2 => false,
			],
			9 =>
			[
				0 => 'Un texte sans entites &amp;&lt;>"&#8217;',
				1 => 'Un texte sans entites &<>"\'',
				2 => true,
			],
			10 =>
			[
				0 => 'Un texte sans entites &amp;&lt;>"&#8217;',
				1 => 'Un texte sans entites &<>"\'',
				2 => false,
			],
			11 =>
			[
				0 => "{{{Des raccourcis}}} {italique} {{gras}} <code class=\"spip_code spip_code_inline\" dir=\"ltr\">du code</code>",
				1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				2 => true,
			],
			12 =>
			[
				0 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				2 => false,
			],
			13 =>
			[
				0 => 'Un modele <tt>&lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;</tt>',
				1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				2 => true,
			],
			14 =>
			[
				0 => 'Un modele <tt>&lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;</tt>',
				1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
				2 => false,
			],
			15 =>
			[
				0 => 'Chat&nbsp;!!',
				1 => 'Chat!!'
			],
			// et pas apres "(" -- http://trac.rezo.net/trac/spip/changeset/10177
			'r10177' =>
			[
				0 => '(!)',
				1 => '(!)'
			],
		];
	}
}
