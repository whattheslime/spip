<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction modulo du fichier inc/filtres.php
 */

namespace Spip\Test\Filtre;

use PHPUnit\Framework\TestCase;

class ModuloTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('inc/filtres.php', '', true);
	}

	/**
	 * @dataProvider providerFiltresModulo
	 */
	public function testFiltresModulo($expected, ...$args): void {
		$actual = modulo(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresModulo(): array {
		return [
			0 => [
				0 => 0,
				1 => 0,
				2 => 0,
			],
			1 => [
				0 => 0,
				1 => 0,
				2 => -1,
			],
			2 => [
				0 => 0,
				1 => 0,
				2 => 1,
			],
			3 => [
				0 => 0,
				1 => 0,
				2 => 2,
			],
			4 => [
				0 => 0,
				1 => 0,
				2 => 10000,
			],
			5 => [
				0 => -1,
				1 => -1,
				2 => 10000,
			],
			6 => [
				0 => 2,
				1 => 2,
				2 => 1000,
			],
			7 => [
				0 => 5,
				1 => 5,
				2 => 30,
			],
			8 => [
				0 => 2,
				1 => 30,
				2 => 4,
			],
			9 => [
				0 => 0,
				1 => 10000,
				2 => 10000,
			],
		];
	}
}
