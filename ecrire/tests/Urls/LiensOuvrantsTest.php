<?php

declare(strict_types=1);

namespace Spip\Test\Urls;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class LiensOuvrantsTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('./inc/utils.php', '', true);
	}

	#[DataProvider('providerAttendus')]
	public function testAttendus($text) {
		$link = liens_ouvrants($text);
		$this->assertEquals(
			'_blank',
			extraire_attribut($link, 'target'),
			sprintf('Lien ouvrant "%s" n’a pas target', $link)
		);
		$this->assertStringContainsString(
			'noopener',
			extraire_attribut($link, 'rel'),
			sprintf('Lien ouvrant "%s" n’a pas noopener', $link)
		);
		$this->assertStringContainsString(
			'noreferrer',
			extraire_attribut($link, 'rel'),
			sprintf('Lien ouvrant "%s" n’a pas noreferrer', $link)
		);
	}

	public static function providerAttendus(): array {
		return [
			'lien spip #1' => [
				'text' => '<a href="https://www.spip.net/" class="spip_out">link</a>',
			],
			'lien spip #2' => [
				'text' => '<a href="https://www.spip.net/" class="spip_url">link</a>',
			],
		];
	}

	#[DataProvider('providerNonAttendus')]
	public function testNonAttendus($text) {
		$link = liens_ouvrants($text);
		$this->assertNull(extraire_attribut($link, 'target'), sprintf('Lien "%s" a un target imprevu', $link));
		$this->assertNull(extraire_attribut($link, 'rel'), sprintf('Lien "%s" a un rel imprevu', $link));
	}

	public static function providerNonAttendus(): array {
		return [
			'non spip #1' => [
				'text' => '<a href="https://www.spip.net/">link</a>',
			],
			'non spip #2' => [
				'text' => '<a href="https://www.spip.net/" class="spip_in">link</a>',
			],
			'non spip #3' => [
				'text' => '<a href="https://www.spip.net/" class="spip_outside">link</a>',
			],
			'non spip #4' => [
				'text' => '<a href="https://www.spip.net/" class="spip_urls">link</a>',
			],
		];
	}

	#[DataProvider('providerLiensOuvrantsPropre')]
	public function testLiensOuvrantsPropre($text) {
		$link = liens_ouvrants(propre($text));
		$this->assertEquals('_blank', extraire_attribut($link, 'target'));
		$this->assertStringContainsString('noopener', extraire_attribut($link, 'rel'));
		$this->assertStringContainsString('noreferrer', extraire_attribut($link, 'rel'));
	}

	public static function providerLiensOuvrantsPropre(): array {
		return [
			'propre lien http' => [
				'text' => 'Ceci est un lien [ouvrant->http://www.spip.net/ar] rondtudiou.',
			],
			'propre lien https' => [
				'text' => 'Ceci est un lien [ouvrant->https://www.spip.net/ar] rondtudiou.',
			],
		];
	}
}
