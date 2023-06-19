<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction url_to_ascii du fichier ./inc/distant.php
 */

namespace Spip\Test\Distant;

use PHPUnit\Framework\TestCase;

class UrlToAsciiTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('./inc/distant.php', '', true);
	}

	/**
	 * @dataProvider providerDistantUrlToAscii
	 */
	public function testDistantUrlToAscii($expected, ...$args): void {
		$actual = url_to_ascii(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerDistantUrlToAscii(): array {
		return [
			0 => [
				0 => 'http://www.spip.net/',
				1 => 'http://www.spip.net/',
			],
			1 => [
				0 => 'http://www.spip.net/fr_article879.html#BOUCLE-ARTICLES-',
				1 => 'http://www.spip.net/fr_article879.html#BOUCLE-ARTICLES-',
			],
			2 => [
				0 => 'http://user:pass@www.spip.net:80/fr_article879.html#BOUCLE-ARTICLES-',
				1 => 'http://user:pass@www.spip.net:80/fr_article879.html#BOUCLE-ARTICLES-',
			],
			3 => [
				0 => 'http://www.xn--spap-7pa.net/',
				1 => 'http://www.spaïp.net/',
			],
			4 => [
				0 => 'http://www.xn--spap-7pa.net/fr_article879.html#BOUCLE-ARTICLES-',
				1 => 'http://www.spaïp.net/fr_article879.html#BOUCLE-ARTICLES-',
			],
			5 => [
				0 => 'http://user:pass@www.xn--spap-7pa.net:80/fr_article879.html#BOUCLE-ARTICLES-',
				1 => 'http://user:pass@www.spaïp.net:80/fr_article879.html#BOUCLE-ARTICLES-',
			],
		];
	}
}
