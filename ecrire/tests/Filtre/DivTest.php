<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction div du fichier inc/filtres.php
 */

namespace Spip\Test\Filtre;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class DivTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('inc/filtres.php', '', true);
	}

	#[DataProvider('providerFiltresDiv')]
	public function testFiltresDiv($expected, ...$args): void {
		$actual = div(...$args);
		//$this->assertSame($expected, $actual);
		$this->assertEquals($expected, $actual);
	}

	public static function providerFiltresDiv(): array {
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
				0 => 0,
				1 => -1,
				2 => 0,
			],
			6 => [
				0 => 1,
				1 => -1,
				2 => -1,
			],
			7 => [
				0 => -1,
				1 => -1,
				2 => 1,
			],
			8 => [
				0 => -0.5,
				1 => -1,
				2 => 2,
			],
			9 => [
				0 => -1 / 3,
				1 => -1,
				2 => 3,
			],
			10 => [
				0 => -0.25,
				1 => -1,
				2 => 4,
			],
			11 => [
				0 => 1 / 30,
				1 => 1,
				2 => 30,
			],
			12 => [
				0 => 0.002,
				1 => 2,
				2 => 1000,
			],
			13 => [
				0 => 5 / 3,
				1 => 5,
				2 => 3,
			],
			14 => [
				0 => 1,
				1 => 10000,
				2 => 10000,
			],
		];
	}
}
