<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction moins du fichier inc/filtres.php
 */

namespace Spip\Test\Filtre;

use PHPUnit\Framework\TestCase;

class MoinsTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('inc/filtres.php', '', true);
	}

	/**
	 * @dataProvider providerFiltresMoins
	 */
	public function testFiltresMoins($expected, ...$args): void {
		$actual = moins(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresMoins(): array {
		return [
			0 => [
				0 => 0,
				1 => 0,
				2 => 0,
			],
			1 => [
				0 => 1,
				1 => 0,
				2 => -1,
			],
			2 => [
				0 => -1,
				1 => 0,
				2 => 1,
			],
			3 => [
				0 => -2,
				1 => 0,
				2 => 2,
			],
			4 => [
				0 => -1,
				1 => -1,
				2 => 0,
			],
			5 => [
				0 => 0,
				1 => -1,
				2 => -1,
			],
			6 => [
				0 => -996,
				1 => 4,
				2 => 1000,
			],
			7 => [
				0 => 9000,
				1 => 10000,
				2 => 1000,
			],
		];
	}
}
