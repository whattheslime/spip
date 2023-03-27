<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction valider_url_distante du fichier ./inc/distant.php
 */

namespace Spip\Core\Tests\Distant;

use PHPUnit\Framework\TestCase;

class ValiderUrlDistanteTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		find_in_path('./inc/distant.php', '', true);
	}

	/**
	 * @dataProvider providerDistantValiderUrlDistante
	 */
	public function testDistantValiderUrlDistante($expected, ...$args): void
	{
		$actual = valider_url_distante(...$args);
		$this->assertSame($expected, $actual);
		$this->assertEquals($expected, $actual);
	}

	public static function providerDistantValiderUrlDistante(): array
	{
		return [
			0 => [
				0 => 'http://www.spip.net',
				1 => 'http://www.spip.net',
			],
			1 => [
				0 => 'https://www.spip.net',
				1 => 'https://www.spip.net',
			],
			2 => [
				0 => false,
				1 => 'ftp://www.spip.net',
			],
			3 => [
				0 => false,
				1 => 'http://user@www.spip.net',
			],
			4 => [
				0 => false,
				1 => 'https://user:password@www.spip.net',
			],
			5 => [
				0 => false,
				1 => 'http://127.0.0.1/munin/graph.png',
			],
			6 => [
				0 => false,
				1 => 'http://localhost:8765',
			],
			7 => [
				0 => 'http://localhost:8765/test.png',
				1 => 'http://localhost:8765/test.png',
				2 => [
					0 => 'localhost:8765',
				],
			],
			8 => [
				0 => false,
				1 => 'http://localhost:9100/test.png',
			],
			9 => [
				0 => false,
				1 => 'http://user@password:localhost:8765/test.png',
				2 => [
					0 => 'localhost:8765',
				],
			],
			10 => [
				0 => false,
				1 => 'http://user@password:localhost:8765/test.png',
				2 => [
					0 => 'http://user@password:localhost:8765',
				],
			],
		];
	}
}
