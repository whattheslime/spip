<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction inserer_attribut du fichier ./inc/filtres.php
 */

namespace Spip\Test\Filtre;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class InsererAttributTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('./inc/filtres.php', '', true);
	}

	#[DataProvider('providerFiltresInsererAttributTitleSimples')]
	public function testFiltresInsererAttributTitleSimples($expected, ...$args): void {
		$actual = inserer_attribut(...$args);
		$this->assertSame($expected, $actual);
	}

	#[DataProvider('providerFiltresInsererAttributTitleEntites')]
	public function testFiltresInsererAttributTitleEntites($expected, ...$args): void {
		$actual = inserer_attribut(...$args);
		$this->assertSame($expected, $actual);
	}

	#[DataProvider('providerFiltresInsererAttributTitleRaccourcis')]
	public function testFiltresInsererAttributTitleRaccourcis($expected, ...$args): void {
		$actual = inserer_attribut(...$args);
		$this->assertSame($expected, $actual);
	}

	#[DataProvider('providerFiltresInsererAttributTitleRemplacementsSimples')]
	public function testFiltresInsererAttributTitleRemplacementsSimples($expected, ...$args): void {
		$actual = inserer_attribut(...$args);
		$this->assertSame($expected, $actual);
	}

	#[DataProvider('providerFiltresInsererAttributTitleRemplacementsEntites')]
	public function testFiltresInsererAttributTitleRemplacementsEntites($expected, ...$args): void {
		$actual = inserer_attribut(...$args);
		$this->assertSame($expected, $actual);
	}

	#[DataProvider('providerFiltresInsererAttributTitleRemplacementsRaccourcis')]
	public function testFiltresInsererAttributTitleRemplacementsRaccourcis($expected, ...$args): void {
		$actual = inserer_attribut(...$args);
		$this->assertSame($expected, $actual);
	}


	#[DataProvider('providerFiltresInsererAttributLienImgSimples')]
	public function testFiltresInsererAttributLienImgSimples($expected, ...$args): void {
		$actual = inserer_attribut(...$args);
		$this->assertSame($expected, $actual);
	}

	#[DataProvider('providerFiltresInsererAttributAutres')]
	public function testFiltresInsererAttributAutres($expected, ...$args): void {
		$actual = inserer_attribut(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresInsererAttributTitleSimples(): array {
		return [
			0 => [
				0 => "<a href='https://www.spip.net'>SPIP</a>",
				1 => "<a href='https://www.spip.net'>SPIP</a>",
				2 => 'title',
				3 => '',
				4 => true,
				5 => true,
			],
			1 => [
				0 => "<a href='https://www.spip.net' title=''>SPIP</a>",
				1 => "<a href='https://www.spip.net'>SPIP</a>",
				2 => 'title',
				3 => '',
				4 => true,
				5 => false,
			],
			2 => [
				0 => "<a href='https://www.spip.net'>SPIP</a>",
				1 => "<a href='https://www.spip.net'>SPIP</a>",
				2 => 'title',
				3 => '',
				4 => false,
				5 => true,
			],
			3 => [
				0 => "<a href='https://www.spip.net' title=''>SPIP</a>",
				1 => "<a href='https://www.spip.net'>SPIP</a>",
				2 => 'title',
				3 => '',
				4 => false,
				5 => false,
			],
			4 => [
				0 => "<a href='https://www.spip.net' title='0'>SPIP</a>",
				1 => "<a href='https://www.spip.net'>SPIP</a>",
				2 => 'title',
				3 => '0',
				4 => true,
				5 => true,
			],
			5 => [
				0 => "<a href='https://www.spip.net' title='0'>SPIP</a>",
				1 => "<a href='https://www.spip.net'>SPIP</a>",
				2 => 'title',
				3 => '0',
				4 => true,
				5 => false,
			],
			6 => [
				0 => "<a href='https://www.spip.net' title='0'>SPIP</a>",
				1 => "<a href='https://www.spip.net'>SPIP</a>",
				2 => 'title',
				3 => '0',
				4 => false,
				5 => true,
			],
			7 => [
				0 => "<a href='https://www.spip.net' title='0'>SPIP</a>",
				1 => "<a href='https://www.spip.net'>SPIP</a>",
				2 => 'title',
				3 => '0',
				4 => false,
				5 => false,
			],
		];
	}

	public static function providerFiltresInsererAttributTitleEntites(): array {
		return [
			0 => [
				0 => "<a href='https://www.spip.net' title='Un texte avec des &lt;a href=&#034;http://spip.net&#034;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;https://www.spip.net] https://www.spip.net'>SPIP</a>",
				1 => "<a href='https://www.spip.net'>SPIP</a>",
				2 => 'title',
				3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
				4 => true,
				5 => true,
			],
			1 => [
				0 => "<a href='https://www.spip.net' title='Un texte avec des &lt;a href=&#034;http://spip.net&#034;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;https://www.spip.net] https://www.spip.net'>SPIP</a>",
				1 => "<a href='https://www.spip.net'>SPIP</a>",
				2 => 'title',
				3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
				4 => true,
				5 => false,
			],
			2 => [
				0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net\'>SPIP</a>',
				1 => "<a href='https://www.spip.net'>SPIP</a>",
				2 => 'title',
				3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
				4 => false,
				5 => true,
			],
			3 => [
				0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net\'>SPIP</a>',
				1 => "<a href='https://www.spip.net'>SPIP</a>",
				2 => 'title',
				3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
				4 => false,
				5 => false,
			],
			4 => [
				0 => "<a href='https://www.spip.net' title='Un texte avec des entit&#233;s &#38;&lt;&gt;&#034;'>SPIP</a>",
				1 => "<a href='https://www.spip.net'>SPIP</a>",
				2 => 'title',
				3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&#034;',
				4 => true,
				5 => true,
			],
			5 => [
				0 => "<a href='https://www.spip.net' title='Un texte avec des entit&#233;s &#38;&lt;&gt;&#034;'>SPIP</a>",
				1 => "<a href='https://www.spip.net'>SPIP</a>",
				2 => 'title',
				3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&#034;',
				4 => true,
				5 => false,
			],
			6 => [
				0 => "<a href='https://www.spip.net' title='Un texte avec des entit&eacute;s &amp;&lt;&gt;&#034;'>SPIP</a>",
				1 => "<a href='https://www.spip.net'>SPIP</a>",
				2 => 'title',
				3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&#034;',
				4 => false,
				5 => true,
			],
			7 => [
				0 => "<a href='https://www.spip.net' title='Un texte avec des entit&eacute;s &amp;&lt;&gt;&#034;'>SPIP</a>",
				1 => "<a href='https://www.spip.net'>SPIP</a>",
				2 => 'title',
				3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&#034;',
				4 => false,
				5 => false,
			],
			8 => [
				0 => "<a href='https://www.spip.net' title='Un texte sans entites &#38;&lt;&gt;&#034;&#039;'>SPIP</a>",
				1 => "<a href='https://www.spip.net'>SPIP</a>",
				2 => 'title',
				3 => 'Un texte sans entites &<>"\'',
				4 => true,
				5 => true,
			],
			9 => [
				0 => "<a href='https://www.spip.net' title='Un texte sans entites &#38;&lt;&gt;&#034;&#039;'>SPIP</a>",
				1 => "<a href='https://www.spip.net'>SPIP</a>",
				2 => 'title',
				3 => 'Un texte sans entites &<>"\'',
				4 => true,
				5 => false,
			],
			10 => [
				0 => '<a href=\'https://www.spip.net\' title=\'Un texte sans entites &<>"&#039;\'>SPIP</a>',
				1 => "<a href='https://www.spip.net'>SPIP</a>",
				2 => 'title',
				3 => 'Un texte sans entites &<>"\'',
				4 => false,
				5 => true,
			],
			11 => [
				0 => '<a href=\'https://www.spip.net\' title=\'Un texte sans entites &<>"&#039;\'>SPIP</a>',
				1 => "<a href='https://www.spip.net'>SPIP</a>",
				2 => 'title',
				3 => 'Un texte sans entites &<>"\'',
				4 => false,
				5 => false,
			],
		];
	}


	public static function providerFiltresInsererAttributTitleRaccourcis(): array {
		return [
			0 => [
				0 => "<a href='https://www.spip.net' title='{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;'>SPIP</a>",
				1 => "<a href='https://www.spip.net'>SPIP</a>",
				2 => 'title',
				3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				4 => true,
				5 => true,
			],
			1 => [
				0 => "<a href='https://www.spip.net' title='{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;'>SPIP</a>",
				1 => "<a href='https://www.spip.net'>SPIP</a>",
				2 => 'title',
				3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				4 => true,
				5 => false,
			],
			2 => [
				0 => "<a href='https://www.spip.net' title='{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>'>SPIP</a>",
				1 => "<a href='https://www.spip.net'>SPIP</a>",
				2 => 'title',
				3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				4 => false,
				5 => true,
			],
			3 => [
				0 => "<a href='https://www.spip.net' title='{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>'>SPIP</a>",
				1 => "<a href='https://www.spip.net'>SPIP</a>",
				2 => 'title',
				3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				4 => false,
				5 => false,
			],
			4 => [
				0 => "<a href='https://www.spip.net' title='Un modele &lt;modeleinexistant|lien=[-&gt;https://www.spip.net]&gt;'>SPIP</a>",
				1 => "<a href='https://www.spip.net'>SPIP</a>",
				2 => 'title',
				3 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
				4 => true,
				5 => true,
			],
			5 => [
				0 => "<a href='https://www.spip.net' title='Un modele &lt;modeleinexistant|lien=[-&gt;https://www.spip.net]&gt;'>SPIP</a>",
				1 => "<a href='https://www.spip.net'>SPIP</a>",
				2 => 'title',
				3 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
				4 => true,
				5 => false,
			],
			6 => [
				0 => "<a href='https://www.spip.net' title='Un modele <modeleinexistant|lien=[->https://www.spip.net]>'>SPIP</a>",
				1 => "<a href='https://www.spip.net'>SPIP</a>",
				2 => 'title',
				3 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
				4 => false,
				5 => true,
			],
			7 => [
				0 => "<a href='https://www.spip.net' title='Un modele <modeleinexistant|lien=[->https://www.spip.net]>'>SPIP</a>",
				1 => "<a href='https://www.spip.net'>SPIP</a>",
				2 => 'title',
				3 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
				4 => false,
				5 => false,
			],
			8 => [
				0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des retour
a la ligne et meme des paragraphes\'>SPIP</a>',
				1 => "<a href='https://www.spip.net'>SPIP</a>",
				2 => 'title',
				3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				4 => true,
				5 => true,
			],
			9 => [
				0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des retour
a la ligne et meme des paragraphes\'>SPIP</a>',
				1 => "<a href='https://www.spip.net'>SPIP</a>",
				2 => 'title',
				3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				4 => true,
				5 => false,
			],
			10 => [
				0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des retour
a la ligne et meme des

paragraphes\'>SPIP</a>',
				1 => "<a href='https://www.spip.net'>SPIP</a>",
				2 => 'title',
				3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				4 => false,
				5 => true,
			],
			11 => [
				0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des retour
a la ligne et meme des

paragraphes\'>SPIP</a>',
				1 => "<a href='https://www.spip.net'>SPIP</a>",
				2 => 'title',
				3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				4 => false,
				5 => false,
			],
		];
	}


	public static function providerFiltresInsererAttributTitleRemplacementsSimples(): array {
		return [
			9 => [
				0 => "<a href='https://www.spip.net'>SPIP</a>",
				1 => "<a href='https://www.spip.net' title='Simplement'>SPIP</a>",
				2 => 'title',
				3 => '',
				4 => true,
				5 => true,
			],
			1 => [
				0 => "<a href='https://www.spip.net' title=''>SPIP</a>",
				1 => "<a href='https://www.spip.net' title='Simplement'>SPIP</a>",
				2 => 'title',
				3 => '',
				4 => true,
				5 => false,
			],
			2 => [
				0 => "<a href='https://www.spip.net'>SPIP</a>",
				1 => "<a href='https://www.spip.net' title='Simplement'>SPIP</a>",
				2 => 'title',
				3 => '',
				4 => false,
				5 => true,
			],
			3 => [
				0 => "<a href='https://www.spip.net' title=''>SPIP</a>",
				1 => "<a href='https://www.spip.net' title='Simplement'>SPIP</a>",
				2 => 'title',
				3 => '',
				4 => false,
				5 => false,
			],
			4 => [
				0 => "<a href='https://www.spip.net' title='0'>SPIP</a>",
				1 => "<a href='https://www.spip.net' title='Simplement'>SPIP</a>",
				2 => 'title',
				3 => '0',
				4 => true,
				5 => true,
			],
			5 => [
				0 => "<a href='https://www.spip.net' title='0'>SPIP</a>",
				1 => "<a href='https://www.spip.net' title='Simplement'>SPIP</a>",
				2 => 'title',
				3 => '0',
				4 => true,
				5 => false,
			],
			6 => [
				0 => "<a href='https://www.spip.net' title='0'>SPIP</a>",
				1 => "<a href='https://www.spip.net' title='Simplement'>SPIP</a>",
				2 => 'title',
				3 => '0',
				4 => false,
				5 => true,
			],
			7 => [
				0 => "<a href='https://www.spip.net' title='0'>SPIP</a>",
				1 => "<a href='https://www.spip.net' title='Simplement'>SPIP</a>",
				2 => 'title',
				3 => '0',
				4 => false,
				5 => false,
			],
		];
	}

	public static function providerFiltresInsererAttributTitleRemplacementsEntites(): array {
		return [
			0 => [
				0 => "<a href='https://www.spip.net' title='Un texte avec des &lt;a href=&#034;http://spip.net&#034;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;https://www.spip.net] https://www.spip.net'>SPIP</a>",
				1 => "<a href='https://www.spip.net' title='Simplement'>SPIP</a>",
				2 => 'title',
				3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
				4 => true,
				5 => true,
			],
			1 => [
				0 => "<a href='https://www.spip.net' title='Un texte avec des &lt;a href=&#034;http://spip.net&#034;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;https://www.spip.net] https://www.spip.net'>SPIP</a>",
				1 => "<a href='https://www.spip.net' title='Simplement'>SPIP</a>",
				2 => 'title',
				3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
				4 => true,
				5 => false,
			],
			2 => [
				0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net\'>SPIP</a>',
				1 => "<a href='https://www.spip.net' title='Simplement'>SPIP</a>",
				2 => 'title',
				3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
				4 => false,
				5 => true,
			],
			3 => [
				0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net\'>SPIP</a>',
				1 => "<a href='https://www.spip.net' title='Simplement'>SPIP</a>",
				2 => 'title',
				3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
				4 => false,
				5 => false,
			],
			4 => [
				0 => "<a href='https://www.spip.net' title='Un texte avec des entit&#233;s &#38;&lt;&gt;&#034;'>SPIP</a>",
				1 => "<a href='https://www.spip.net' title='Simplement'>SPIP</a>",
				2 => 'title',
				3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&#034;',
				4 => true,
				5 => true,
			],
			5 => [
				0 => "<a href='https://www.spip.net' title='Un texte avec des entit&#233;s &#38;&lt;&gt;&#034;'>SPIP</a>",
				1 => "<a href='https://www.spip.net' title='Simplement'>SPIP</a>",
				2 => 'title',
				3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&#034;',
				4 => true,
				5 => false,
			],
			6 => [
				0 => "<a href='https://www.spip.net' title='Un texte avec des entit&eacute;s &amp;&lt;&gt;&#034;'>SPIP</a>",
				1 => "<a href='https://www.spip.net' title='Simplement'>SPIP</a>",
				2 => 'title',
				3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&#034;',
				4 => false,
				5 => true,
			],
			7 => [
				0 => "<a href='https://www.spip.net' title='Un texte avec des entit&eacute;s &amp;&lt;&gt;&#034;'>SPIP</a>",
				1 => "<a href='https://www.spip.net' title='Simplement'>SPIP</a>",
				2 => 'title',
				3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&#034;',
				4 => false,
				5 => false,
			],
			8 => [
				0 => "<a href='https://www.spip.net' title='Un texte sans entites &#38;&lt;&gt;&#034;&#039;'>SPIP</a>",
				1 => "<a href='https://www.spip.net' title='Simplement'>SPIP</a>",
				2 => 'title',
				3 => 'Un texte sans entites &<>"\'',
				4 => true,
				5 => true,
			],
			9 => [
				0 => "<a href='https://www.spip.net' title='Un texte sans entites &#38;&lt;&gt;&#034;&#039;'>SPIP</a>",
				1 => "<a href='https://www.spip.net' title='Simplement'>SPIP</a>",
				2 => 'title',
				3 => 'Un texte sans entites &<>"\'',
				4 => true,
				5 => false,
			],
			10 => [
				0 => '<a href=\'https://www.spip.net\' title=\'Un texte sans entites &<>"&#039;\'>SPIP</a>',
				1 => "<a href='https://www.spip.net' title='Simplement'>SPIP</a>",
				2 => 'title',
				3 => 'Un texte sans entites &<>"\'',
				4 => false,
				5 => true,
			],
			11 => [
				0 => '<a href=\'https://www.spip.net\' title=\'Un texte sans entites &<>"&#039;\'>SPIP</a>',
				1 => "<a href='https://www.spip.net' title='Simplement'>SPIP</a>",
				2 => 'title',
				3 => 'Un texte sans entites &<>"\'',
				4 => false,
				5 => false,
			],
		];
	}

	public static function providerFiltresInsererAttributTitleRemplacementsRaccourcis(): array {
		return [
			0 => [
				0 => "<a href='https://www.spip.net' title='{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;'>SPIP</a>",
				1 => "<a href='https://www.spip.net' title='Simplement'>SPIP</a>",
				2 => 'title',
				3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				4 => true,
				5 => true,
			],
			1 => [
				0 => "<a href='https://www.spip.net' title='{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;'>SPIP</a>",
				1 => "<a href='https://www.spip.net' title='Simplement'>SPIP</a>",
				2 => 'title',
				3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				4 => true,
				5 => false,
			],
			2 => [
				0 => "<a href='https://www.spip.net' title='{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>'>SPIP</a>",
				1 => "<a href='https://www.spip.net' title='Simplement'>SPIP</a>",
				2 => 'title',
				3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				4 => false,
				5 => true,
			],
			3 => [
				0 => "<a href='https://www.spip.net' title='{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>'>SPIP</a>",
				1 => "<a href='https://www.spip.net' title='Simplement'>SPIP</a>",
				2 => 'title',
				3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				4 => false,
				5 => false,
			],
			4 => [
				0 => "<a href='https://www.spip.net' title='Un modele &lt;modeleinexistant|lien=[-&gt;https://www.spip.net]&gt;'>SPIP</a>",
				1 => "<a href='https://www.spip.net' title='Simplement'>SPIP</a>",
				2 => 'title',
				3 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
				4 => true,
				5 => true,
			],
			5 => [
				0 => "<a href='https://www.spip.net' title='Un modele &lt;modeleinexistant|lien=[-&gt;https://www.spip.net]&gt;'>SPIP</a>",
				1 => "<a href='https://www.spip.net' title='Simplement'>SPIP</a>",
				2 => 'title',
				3 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
				4 => true,
				5 => false,
			],
			6 => [
				0 => "<a href='https://www.spip.net' title='Un modele <modeleinexistant|lien=[->https://www.spip.net]>'>SPIP</a>",
				1 => "<a href='https://www.spip.net' title='Simplement'>SPIP</a>",
				2 => 'title',
				3 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
				4 => false,
				5 => true,
			],
			7 => [
				0 => "<a href='https://www.spip.net' title='Un modele <modeleinexistant|lien=[->https://www.spip.net]>'>SPIP</a>",
				1 => "<a href='https://www.spip.net' title='Simplement'>SPIP</a>",
				2 => 'title',
				3 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
				4 => false,
				5 => false,
			],
			8 => [
				0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des retour
a la ligne et meme des paragraphes\'>SPIP</a>',
				1 => "<a href='https://www.spip.net' title='Simplement'>SPIP</a>",
				2 => 'title',
				3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				4 => true,
				5 => true,
			],
			9 => [
				0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des retour
a la ligne et meme des paragraphes\'>SPIP</a>',
				1 => "<a href='https://www.spip.net' title='Simplement'>SPIP</a>",
				2 => 'title',
				3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				4 => true,
				5 => false,
			],
			10 => [
				0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des retour
a la ligne et meme des

paragraphes\'>SPIP</a>',
				1 => "<a href='https://www.spip.net' title='Simplement'>SPIP</a>",
				2 => 'title',
				3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				4 => false,
				5 => true,
			],
			11 => [
				0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des retour
a la ligne et meme des

paragraphes\'>SPIP</a>',
				1 => "<a href='https://www.spip.net' title='Simplement'>SPIP</a>",
				2 => 'title',
				3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				4 => false,
				5 => false,
			],
		];
	}

	public static function providerFiltresInsererAttributLienImgSimples(): array {
		return [
			0 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' /></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' /></a>",
				2 => 'alt',
				3 => '',
				4 => true,
				5 => true,
			],
			1 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				2 => 'alt',
				3 => '',
				4 => true,
				5 => true,
			],
			2 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt=''></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				2 => 'alt',
				3 => '',
				4 => true,
				5 => false,
			],
			3 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='' /></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' /></a>",
				2 => 'alt',
				3 => '',
				4 => true,
				5 => false,
			],
			4 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				2 => 'alt',
				3 => '',
				4 => false,
				5 => true,
			],
			5 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' /></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' /></a>",
				2 => 'alt',
				3 => '',
				4 => false,
				5 => true,
			],
			6 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt=''></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				2 => 'alt',
				3 => '',
				4 => false,
				5 => false,
			],
			7 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='' /></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' /></a>",
				2 => 'alt',
				3 => '',
				4 => false,
				5 => false,
			],


			8 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='0'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				2 => 'alt',
				3 => '0',
				4 => true,
				5 => true,
			],
			9 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='0'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				2 => 'alt',
				3 => '0',
				4 => true,
				5 => false,
			],
			10 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='0'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				2 => 'alt',
				3 => '0',
				4 => false,
				5 => true,
			],
			11 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='0'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				2 => 'alt',
				3 => '0',
				4 => false,
				5 => false,
			],
		];
	}

	public static function providerFiltresInsererAttributAutres(): array {
		return [
			72 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='Un texte avec des &lt;a href=&#034;http://spip.net&#034;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;https://www.spip.net] https://www.spip.net'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				2 => 'alt',
				3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
				4 => true,
				5 => true,
			],
			73 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='Un texte avec des &lt;a href=&#034;http://spip.net&#034;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;https://www.spip.net] https://www.spip.net'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				2 => 'alt',
				3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
				4 => true,
				5 => false,
			],
			74 => [
				0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net\'></a>',
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				2 => 'alt',
				3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
				4 => false,
				5 => true,
			],
			75 => [
				0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net\'></a>',
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				2 => 'alt',
				3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
				4 => false,
				5 => false,
			],
			76 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='Un texte avec des entit&#233;s &#38;&lt;&gt;&#034;'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				2 => 'alt',
				3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				4 => true,
				5 => true,
			],
			77 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='Un texte avec des entit&#233;s &#38;&lt;&gt;&#034;'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				2 => 'alt',
				3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				4 => true,
				5 => false,
			],
			78 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='Un texte avec des entit&eacute;s &amp;&lt;&gt;&#034;'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				2 => 'alt',
				3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&#034;',
				4 => false,
				5 => true,
			],
			79 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				2 => 'alt',
				3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				4 => false,
				5 => false,
			],
			80 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='Un texte sans entites &#38;&lt;&gt;&#034;&#039;'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				2 => 'alt',
				3 => 'Un texte sans entites &<>"\'',
				4 => true,
				5 => true,
			],
			81 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='Un texte sans entites &#38;&lt;&gt;&#034;&#039;'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				2 => 'alt',
				3 => 'Un texte sans entites &<>"\'',
				4 => true,
				5 => false,
			],
			82 => [
				0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte sans entites &<>"&#039;\'></a>',
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				2 => 'alt',
				3 => 'Un texte sans entites &<>"\'',
				4 => false,
				5 => true,
			],
			83 => [
				0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte sans entites &<>"&#039;\'></a>',
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				2 => 'alt',
				3 => 'Un texte sans entites &<>"\'',
				4 => false,
				5 => false,
			],
			84 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				2 => 'alt',
				3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				4 => true,
				5 => true,
			],
			85 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				2 => 'alt',
				3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				4 => true,
				5 => false,
			],
			86 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				2 => 'alt',
				3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				4 => false,
				5 => true,
			],
			87 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				2 => 'alt',
				3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				4 => false,
				5 => false,
			],
			88 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='Un modele &lt;modeleinexistant|lien=[-&gt;https://www.spip.net]&gt;'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				2 => 'alt',
				3 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
				4 => true,
				5 => true,
			],
			89 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='Un modele &lt;modeleinexistant|lien=[-&gt;https://www.spip.net]&gt;'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				2 => 'alt',
				3 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
				4 => true,
				5 => false,
			],
			90 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='Un modele <modeleinexistant|lien=[->https://www.spip.net]>'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				2 => 'alt',
				3 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
				4 => false,
				5 => true,
			],
			91 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='Un modele <modeleinexistant|lien=[->https://www.spip.net]>'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				2 => 'alt',
				3 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
				4 => false,
				5 => false,
			],
			92 => [
				0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des retour
a la ligne et meme des paragraphes\'></a>',
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				2 => 'alt',
				3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				4 => true,
				5 => true,
			],
			93 => [
				0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des retour
a la ligne et meme des paragraphes\'></a>',
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				2 => 'alt',
				3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				4 => true,
				5 => false,
			],
			94 => [
				0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des retour
a la ligne et meme des

paragraphes\'></a>',
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				2 => 'alt',
				3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				4 => false,
				5 => true,
			],
			95 => [
				0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des retour
a la ligne et meme des

paragraphes\'></a>',
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				2 => 'alt',
				3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				4 => false,
				5 => false,
			],
			96 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='SPIP'></a>",
				2 => 'alt',
				3 => '',
				4 => true,
				5 => true,
			],
			97 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt=''></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='SPIP'></a>",
				2 => 'alt',
				3 => '',
				4 => true,
				5 => false,
			],
			98 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='SPIP'></a>",
				2 => 'alt',
				3 => '',
				4 => false,
				5 => true,
			],
			99 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt=''></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='SPIP'></a>",
				2 => 'alt',
				3 => '',
				4 => false,
				5 => false,
			],
			100 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='0'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='SPIP'></a>",
				2 => 'alt',
				3 => '0',
				4 => true,
				5 => true,
			],
			101 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='0'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='SPIP'></a>",
				2 => 'alt',
				3 => '0',
				4 => true,
				5 => false,
			],
			102 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='0'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='SPIP'></a>",
				2 => 'alt',
				3 => '0',
				4 => false,
				5 => true,
			],
			103 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='0'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='SPIP'></a>",
				2 => 'alt',
				3 => '0',
				4 => false,
				5 => false,
			],
			104 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='Un texte avec des &lt;a href=&#034;http://spip.net&#034;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;https://www.spip.net] https://www.spip.net'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='SPIP'></a>",
				2 => 'alt',
				3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
				4 => true,
				5 => true,
			],
			105 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='Un texte avec des &lt;a href=&#034;http://spip.net&#034;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;https://www.spip.net] https://www.spip.net'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='SPIP'></a>",
				2 => 'alt',
				3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
				4 => true,
				5 => false,
			],
			106 => [
				0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net\'></a>',
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='SPIP'></a>",
				2 => 'alt',
				3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
				4 => false,
				5 => true,
			],
			107 => [
				0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net\'></a>',
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='SPIP'></a>",
				2 => 'alt',
				3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
				4 => false,
				5 => false,
			],
			108 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='Un texte avec des entit&#233;s &#38;&lt;&gt;&#034;'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='SPIP'></a>",
				2 => 'alt',
				3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				4 => true,
				5 => true,
			],
			109 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='Un texte avec des entit&#233;s &#38;&lt;&gt;&#034;'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='SPIP'></a>",
				2 => 'alt',
				3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				4 => true,
				5 => false,
			],
			110 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='SPIP'></a>",
				2 => 'alt',
				3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				4 => false,
				5 => true,
			],
			111 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='SPIP'></a>",
				2 => 'alt',
				3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
				4 => false,
				5 => false,
			],
			112 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='Un texte sans entites &#38;&lt;&gt;&#034;&#039;'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='SPIP'></a>",
				2 => 'alt',
				3 => 'Un texte sans entites &<>"\'',
				4 => true,
				5 => true,
			],
			113 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='Un texte sans entites &#38;&lt;&gt;&#034;&#039;'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='SPIP'></a>",
				2 => 'alt',
				3 => 'Un texte sans entites &<>"\'',
				4 => true,
				5 => false,
			],
			114 => [
				0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte sans entites &<>"&#039;\'></a>',
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='SPIP'></a>",
				2 => 'alt',
				3 => 'Un texte sans entites &<>"\'',
				4 => false,
				5 => true,
			],
			115 => [
				0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte sans entites &<>"&#039;\'></a>',
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='SPIP'></a>",
				2 => 'alt',
				3 => 'Un texte sans entites &<>"\'',
				4 => false,
				5 => false,
			],
			116 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='SPIP'></a>",
				2 => 'alt',
				3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				4 => true,
				5 => true,
			],
			117 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='SPIP'></a>",
				2 => 'alt',
				3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				4 => true,
				5 => false,
			],
			118 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='SPIP'></a>",
				2 => 'alt',
				3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				4 => false,
				5 => true,
			],
			119 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='SPIP'></a>",
				2 => 'alt',
				3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
				4 => false,
				5 => false,
			],
			120 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='Un modele &lt;modeleinexistant|lien=[-&gt;https://www.spip.net]&gt;'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='SPIP'></a>",
				2 => 'alt',
				3 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
				4 => true,
				5 => true,
			],
			121 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='Un modele &lt;modeleinexistant|lien=[-&gt;https://www.spip.net]&gt;'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='SPIP'></a>",
				2 => 'alt',
				3 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
				4 => true,
				5 => false,
			],
			122 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='Un modele <modeleinexistant|lien=[->https://www.spip.net]>'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='SPIP'></a>",
				2 => 'alt',
				3 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
				4 => false,
				5 => true,
			],
			123 => [
				0 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='Un modele <modeleinexistant|lien=[->https://www.spip.net]>'></a>",
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='SPIP'></a>",
				2 => 'alt',
				3 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
				4 => false,
				5 => false,
			],
			124 => [
				0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des retour
a la ligne et meme des paragraphes\'></a>',
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='SPIP'></a>",
				2 => 'alt',
				3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				4 => true,
				5 => true,
			],
			125 => [
				0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des retour
a la ligne et meme des paragraphes\'></a>',
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='SPIP'></a>",
				2 => 'alt',
				3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				4 => true,
				5 => false,
			],
			126 => [
				0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des retour
a la ligne et meme des

paragraphes\'></a>',
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='SPIP'></a>",
				2 => 'alt',
				3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				4 => false,
				5 => true,
			],
			127 => [
				0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des retour
a la ligne et meme des

paragraphes\'></a>',
				1 => "<a href='https://www.spip.net'><img src='https://www.spip.net/IMG/logo/siteon0.png' alt='SPIP'></a>",
				2 => 'alt',
				3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
				4 => false,
				5 => false,
			],
			128 => [
				0 => "<input value='&lt;span style=&#034;color:red;&#034;&gt;ho&lt;/span&gt;'>",
				1 => '<input>',
				2 => 'value',
				3 => '<span style="color:red;">ho</span>',
			],
			129 => [
				0 => "<input value='&lt;span style=&#034;color:red;&#034;&gt;ho&lt;/span&gt;' />",
				1 => '<input />',
				2 => 'value',
				3 => '<span style="color:red;">ho</span>',
			],
		];
	}
}
