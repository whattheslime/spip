<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction secondes du fichier inc/filtres.php
 */

namespace Spip\Test\Filtre\Date;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class SecondesTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('inc/filtres.php', '', true);
	}

	#[DataProvider('providerFiltresSecondes')]
	public function testFiltresSecondes($expected, ...$args): void {
		$actual = secondes(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresSecondes(): array {
		return [
			0 => [
				0 => '44',
				1 => '2001-00-00 12:33:44',
			],
			1 => [
				0 => '57',
				1 => '2001-03-00 09:12:57',
			],
			2 => [
				0 => '33',
				1 => '2001-02-29 14:12:33',
			],
			3 => [
				0 => '0',
				1 => '0000-00-00',
			],
			4 => [
				0 => '0',
				1 => '0001-01-01',
			],
			5 => [
				0 => '0',
				1 => '1970-01-01',
			],
			6 => [
				0 => '00',
				1 => '2001-01-01 00:00:00',
			],
			7 => [
				0 => '0',
				1 => '2001-07-05',
			],
			8 => [
				0 => '0',
				1 => '2001-01-01',
			],
			9 => [
				0 => '0',
				1 => '2001/07/05',
			],
			10 => [
				0 => '0',
				1 => '2001/01/01',
			],
		];
	}
}
