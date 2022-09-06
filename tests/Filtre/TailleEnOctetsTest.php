<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction taille_en_octets du fichier inc/filtres.php
 */

namespace Spip\Core\Tests\Filtre;

use PHPUnit\Framework\TestCase;

class TailleEnOctetsTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		find_in_path('inc/filtres.php', '', true);
	}

	protected function setUp(): void
	{
		changer_langue('fr');
		// ce test est en fr
	}

	/**
	 * @dataProvider providerFiltresTailleEnOctets
	 */
	public function testFiltresTailleEnOctets($expected, ...$args): void
	{
		$actual = taille_en_octets(...$args);
		$this->assertSame($expected, $actual);
		$this->assertEquals($expected, $actual);
	}

	public function providerFiltresTailleEnOctets(): array
	{
		return [
			0 => [
				0 => '',
				1 => 0,
			],
			1 => [
				0 => '',
				1 => -1,
			],
			2 => [
				0 => '1 octets',
				1 => 1,
			],
			3 => [
				0 => '2 octets',
				1 => 2,
			],
			4 => [
				0 => '3 octets',
				1 => 3,
			],
			5 => [
				0 => '4 octets',
				1 => 4,
			],
			6 => [
				0 => '5 octets',
				1 => 5,
			],
			7 => [
				0 => '6 octets',
				1 => 6,
			],
			8 => [
				0 => '7 octets',
				1 => 7,
			],
			9 => [
				0 => '10 octets',
				1 => 10,
			],
			10 => [
				0 => '20 octets',
				1 => 20,
			],
			11 => [
				0 => '30 octets',
				1 => 30,
			],
			12 => [
				0 => '50 octets',
				1 => 50,
			],
			13 => [
				0 => '100 octets',
				1 => 100,
			],
			14 => [
				0 => '1000 octets',
				1 => 1000,
			],
			15 => [
				0 => '9.8 ko',
				1 => 10000,
			],
			16 => [
				0 => '97.7 ko',
				1 => 100000,
			],
			17 => [
				0 => '976.6 ko',
				1 => 1000000,
			],
			18 => [
				0 => '9.5 Mo',
				1 => 10000000,
			],
			19 => [
				0 => '95.4 Mo',
				1 => 100000000,
			],
			20 => [
				0 => '953.7 Mo',
				1 => 1000000000,
			],
			21 => [
				0 => '9.31 Go',
				1 => 10000000000,
			],
		];
	}
}
