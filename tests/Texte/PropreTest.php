<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction propre du fichier inc/texte.php
 */

namespace Spip\Core\Tests\Texte;

use PHPUnit\Framework\TestCase;

class PropreTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		find_in_path('inc/texte.php', '', true);
	}

	protected function setUp(): void
	{
		$GLOBALS['meta']['type_urls'] = 'page';
		$GLOBALS['type_urls'] = 'page';
		changer_langue('fr');
		// ce test est en fr
		$GLOBALS['toujours_paragrapher'] = true;
		foreach (['puce', 'puce_rtl', 'puce_prive', 'puce_prive_rtl'] as $puce) {
			unset($GLOBALS[$puce]);
		}
		definir_puce();
		// initialiser les plugins qui changent les intertitre (Z), et les restaurer juste apres
		$mem = [$GLOBALS['debut_intertitre'] ?? null, $GLOBALS['spip_raccourcis_typo'] ?? null];
		propre('rien du tout');
		[$GLOBALS['debut_intertitre'], $GLOBALS['spip_raccourcis_typo']] = $mem;
	}

	/**
	 * @dataProvider providerTextePropre
	 */
	public function testTextePropre($expected, ...$args): void
	{
		$actual = propre(...$args);
		$this->assertSame($expected, $actual);
		$this->assertEquals($expected, $actual);
	}

	public function providerTextePropre(): array
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
				0 => '<p>Un texte avec des <a href="http://spip.net">liens</a> <a href="spip.php?article1" class="spip_in">Article 1</a> <a href="http://www.spip.net" class="spip_out" rel="external">spip</a> <a href="http://www.spip.net" class="spip_url spip_out auto" rel="nofollow external">http://www.spip.net</a></p>',
				1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
			],
			3 => [
				0 => '<p>Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;</p>',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
			],
			4 => [
				0 => '<p>Un texte sans entites &amp;&lt;>"&#8217;</p>',
				1 => 'Un texte sans entites &<>"\'',
			],
			5 => [
				0 => '<h2 class="spip">Des raccourcis</h2>
<p> <i>italique</i> <strong>gras</strong> <code class=\'spip_code\' dir=\'ltr\'>du code</code></p>',
				1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
			],
			6 => [
				0 => '<p>Un modele <tt>&lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;</tt></p>',
				1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
			],
			7 => [
				0 => '<p><span class="spip-puce ltr"><b>–</b></span>&nbsp;propre</p>',
				1 => '- propre',
			],
		];
	}
}
