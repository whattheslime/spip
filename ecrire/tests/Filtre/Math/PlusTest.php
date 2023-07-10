<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction plus du fichier inc/filtres.php
 */

namespace Spip\Test\Filtre\Math;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class PlusTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('inc/filtres.php', '', true);
	}

	#[DataProvider('providerFiltresPlus')]
	public function testFiltresPlus($expected, ...$args): void {
		$actual = plus(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresPlus(): array {
		return [
			0 => [
				0 => 0,
				1 => 0,
				2 => 0,
			],
			1 => [
				0 => -1,
				1 => 0,
				2 => -1,
			],
			2 => [
				0 => 1,
				1 => 0,
				2 => 1,
			],
			3 => [
				0 => -1,
				1 => -1,
				2 => 0,
			],
			4 => [
				0 => -2,
				1 => -1,
				2 => -1,
			],
			5 => [
				0 => 29,
				1 => 30,
				2 => -1,
			],
			6 => [
				0 => 11000,
				1 => 10000,
				2 => 1000,
			],
			7 => [
				0 => 20000,
				1 => 10000,
				2 => 10000,
			],
		];
	}
}
