<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction ajouter_class du fichier ./inc/filtres.php
 */

namespace Spip\Test\Filtre;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class AttributUrlTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('./inc/filtres.php', '', true);
	}

	#[DataProvider('providerAttributUrl')]
	public function testAttributUrl($expected, $url): void {
		$actual = attribut_url($url);
		$this->assertSame($expected, $actual);
	}

	#[DataProvider('providerAttributUrl')]
	public function testAttributUrlUnipotence($expected, $url): void {
		$actual = attribut_url(attribut_url($url));
		$this->assertSame($expected, $actual);
	}

	public static function providerAttributUrl(): array {
		return [
			0 => [
				'expected' => 'https://example.org/ecrire/?exec=exec&amp;id_obj=id_obj&amp;no_val',
				'url' => 'https://example.org/ecrire/?exec=exec&id_obj=id_obj&no_val',
			],
			1 => [
				'expected' => 'https://example.org/ecrire/?exec=exec&amp;id_obj=id_obj&amp;no_val&amp;tab[]=1&amp;tab[]=',
				'url' => 'https://example.org/ecrire/?exec=exec&id_obj=id_obj&no_val&tab[]=1&tab[]=',
			],
			2 => [
				'expected' => 'https://example.org/spip.php?t[]=1&amp;t[]=2',
				'url' => 'https://example.org/spip.php?t[]=1&t[]=2',
			],
			3 => [
				'expected' => 'https://example.org/-url-propre-',
				'url' => 'https://example.org/-url-propre-',
			],
			4 => [
				'expected' => 'https://example.org/+url-propre+',
				'url' => 'https://example.org/+url-propre+',
			],
			5 => [
				'expected' => 'https://example.org/@url-propre@',
				'url' => 'https://example.org/@url-propre@',
			],
			6 => [
				'expected' => 'https://example.org/_url-propre_',
				'url' => 'https://example.org/_url-propre_',
			],
			7 => [
				'expected' => 'https://example.org/+-url-propre-+',
				'url' => 'https://example.org/+-url-propre-+',
			],
			8 => [
				'expected' => 'https://example.org/url-propre?val=&lt;code&gt;',
				'url' => 'https://example.org/url-propre?val=<code>',
			],
			8 => [
				'expected' => 'https://example.org/url-propre?val=&#034;code&#034;',
				'url' => 'https://example.org/url-propre?val="code"',
			],
			9 => [
				'expected' => 'https://example.org/url-propre?val=&#039;code&#039;',
				'url' => 'https://example.org/url-propre?val=\'code\'',
			],
			10 => [
				'expected' => 'https://example.org/url-propre?val=texte avec un espace',
				'url' => 'https://example.org/url-propre?val=texte avec un espace',
			],
			11 => [
				'expected' => 'https://example.org/url-propre?val=texte avec un espace#et une ancre',
				'url' => 'https://example.org/url-propre?val=texte avec un espace#et une ancre',
			],
			12 => [
				'expected' => 'https://example.org/url-propre?val=texte avec un espace#et une &lt;ancre&gt;',
				'url' => 'https://example.org/url-propre?val=texte avec un espace#et une &lt;ancre&gt;',
			],
			13 => [
				'expected' => 'https://example.org/url-propre?val=texte avec un espace#et une &#034;ancre&#034;',
				'url' => 'https://example.org/url-propre?val=texte avec un espace#et une "ancre"',
			],
			14 => [
				'expected' => 'https://example.org/url-propre?val=texte avec un espace#et une &#039;ancre&#039;',
				'url' => 'https://example.org/url-propre?val=texte avec un espace#et une \'ancre\'',
			],
		];
	}
}
