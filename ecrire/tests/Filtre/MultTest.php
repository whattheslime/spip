<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction mult du fichier inc/filtres.php
 */

namespace Spip\Test\Filtre;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class MultTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('inc/filtres.php', '', true);
	}

	#[DataProvider('providerFiltresMult')]
 public function testFiltresMult($expected, ...$args): void {
		$actual = mult(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresMult(): array {
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
				2 => 10000,
			],
			4 => [
				0 => 0,
				1 => -1,
				2 => 0,
			],
			5 => [
				0 => 1,
				1 => -1,
				2 => -1,
			],
			6 => [
				0 => -1,
				1 => -1,
				2 => 1,
			],
			7 => [
				0 => 484,
				1 => 11,
				2 => 44,
			],
			8 => [
				0 => 1_000_000,
				1 => 100,
				2 => 10000,
			],
			9 => [
				0 => 10_000_000,
				1 => 1000,
				2 => 10000,
			],

		];
	}
}
