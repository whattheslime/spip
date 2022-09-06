<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction protocole_verifier du fichier ./inc/filtres_mini.php
 */

namespace Spip\Core\Tests\Filtre\Mini;

use PHPUnit\Framework\TestCase;

class ProtocoleVerifierTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		find_in_path('./inc/filtres_mini.php', '', true);
	}

	/**
	 * @dataProvider providerFiltresMiniProtocoleVerifier
	 */
	public function testFiltresMiniProtocoleVerifier($expected, ...$args): void
	{
		$actual = protocole_verifier(...$args);
		$this->assertSame($expected, $actual);
		$this->assertEquals($expected, $actual);
	}

	public function providerFiltresMiniProtocoleVerifier(): array
	{
		return [
			0 => [
				0 => true,
				1 => 'http://www.spip.net',
			],
			1 => [
				0 => true,
				1 => 'https://www.spip.net',
			],
			2 => [
				0 => false,
				1 => 'ftp://www.spip.net',
			],
			3 => [
				0 => true,
				1 => 'ftp://www.spip.net',
				2 => [
					0 => 'http',
					1 => 'https',
					2 => 'ftp',
				],
			],
			4 => [
				0 => false,
				1 => '/etc/password',
			],
			5 => [
				0 => false,
				1 => 'squelettes/img/recherche.png',
			],
			6 => [
				0 => true,
				1 => 'HTTP://WWW.SPIP.NET',
			],
			7 => [
				0 => true,
				1 => 'http://www.spip.net',
				2 => [
					0 => 'HTTP',
					1 => 'HTTPS',
				],
			],
		];
	}
}
