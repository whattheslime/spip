<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction annee du fichier inc/filtres.php
 */

namespace Spip\Test\Filtre\Date;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class AnneeTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('inc/filtres.php', '', true);
	}

	#[DataProvider('providerFiltresAnnee')]
	public function testFiltresAnnee($expected, ...$args): void {
		$actual = annee(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresAnnee(): array {
		return [
			0 => [
				0 => '2001',
				1 => '2001-00-00 12:33:44',
			],
			1 => [
				0 => '2001',
				1 => '2001-03-00 09:12:57',
			],
			2 => [
				0 => '2001',
				1 => '2001-02-29 14:12:33',
			],
			3 => [
				0 => '0000',
				1 => '0000-00-00',
			],
			4 => [
				0 => '0001',
				1 => '0001-01-01',
			],
			5 => [
				0 => '1970',
				1 => '1970-01-01',
			],
			6 => [
				0 => '2001',
				1 => '2001-07-05 18:25:24',
			],
			7 => [
				0 => '2001',
				1 => '2001-01-01 00:00:00',
			],
			8 => [
				0 => '2001',
				1 => '2001-12-31 23:59:59',
			],
			9 => [
				0 => '2001',
				1 => '2001-03-01 14:12:33',
			],
			10 => [
				0 => '2004',
				1 => '2004-02-29 14:12:33',
			],
			11 => [
				0 => '2012',
				1 => '2012-03-20 12:00:00',
			],
			12 => [
				0 => '2012',
				1 => '2012-12-22 12:00:00',
			],
			13 => [
				0 => '2001',
				1 => '2001-07-05',
			],
			14 => [
				0 => '2001',
				1 => '2001-01-01',
			],
			15 => [
				0 => '2001',
				1 => '2001-12-31',
			],
			16 => [
				0 => '2005',
				1 => '2001/07/05',
			],
			17 => [
				0 => '2001',
				1 => '2001/01/01',
			],
			18 => [
				0 => '2031',
				1 => '2001/12/31',
			],
			19 => [
				0 => '2012',
				1 => '22/12/2012',
			],
		];
	}
}
