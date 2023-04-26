<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction taille_en_octets du fichier inc/filtres.php
 */

namespace Spip\Test\Filtre;

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
	 * @dataProvider providerFiltresTailleEnOctetsBI
	 */
	public function testFiltresTailleEnOctetsBI($source, $expected): void
	{
		$actual = taille_en_octets($source);
		$this->assertSame($expected, $actual);

		$actual = taille_en_octets($source, 'BI');
		$this->assertSame($expected, $actual);
	}

	/**
	 * @dataProvider providerFiltresTailleEnOctetsSI
	 */
	public function testFiltresTailleEnOctetsSI($source, $expected): void
	{
		$actual = taille_en_octets($source, 'SI');
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresTailleEnOctetsBI(): array
	{
		$list = [
			0 => '',
			-1 => '',
			1 => '1 octets',
			2 => '2 octets',
			10 => '10 octets',
			50 => '50 octets',
			100 => '100 octets',
			1000 => '1000 octets',
			10000 => '9.8 kio',
			100000 => '97.7 kio',
			1000000 => '976.6 kio',
			10000000 => '9.5 Mio',
			100000000 => '95.4 Mio',
			1000000000 => '953.7 Mio',
			10000000000 => '9.31 Gio',
		];
		return array_map(null, array_keys($list), array_values($list));
	}

	public static function providerFiltresTailleEnOctetsSI(): array
	{
		$list = [
			0 => '',
			-1 => '',
			1 => '1 octets',
			2 => '2 octets',
			10 => '10 octets',
			50 => '50 octets',
			100 => '100 octets',
			1000 => '1 ko',
			10000 => '10 ko',
			100000 => '100 ko',
			1000000 => '1 Mo',
			10000000 => '10 Mo',
			100000000 => '100 Mo',
			1000000000 => '1 Go',
			10000000000 => '10 Go',
		];
		return array_map(null, array_keys($list), array_values($list));
	}
}
