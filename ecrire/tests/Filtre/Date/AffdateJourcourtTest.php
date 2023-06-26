<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction affdate_jourcourt du fichier inc/filtres.php
 */

namespace Spip\Test\Filtre\Date;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class AffdateJourcourtTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('inc/filtres.php', '', true);
	}

	protected function setUp(): void {
		changer_langue('fr');
		// ce test est en fr
	}

	#[DataProvider('providerFiltresAffdateJourcourt')]
	public function testFiltresAffdateJourcourt($expected, ...$args): void {
		$actual = affdate_jourcourt(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresAffdateJourcourt(): array {
		return [
			0 => [
				0 => '  2001',
				1 => '2001-00-00 12:33:44',
				2 => '2011',
			],
			1 => [
				0 => ' mars 2001',
				1 => '2001-03-00 09:12:57',
				2 => '2011',
			],
			2 => [
				0 => '29 février 2001',
				1 => '2001-02-29 14:12:33',
				2 => '2011',
			],
			3 => [
				0 => '0000',
				1 => '0000-00-00',
				2 => '2011',
			],
			4 => [
				0 => '0001',
				1 => '0001-01-01',
				2 => '2011',
			],
			5 => [
				0 => '1er janvier 1970',
				1 => '1970-01-01',
				2 => '2011',
			],
			6 => [
				0 => '5 juillet 2001',
				1 => '2001-07-05 18:25:24',
				2 => '2011',
			],
			7 => [
				0 => '1er janvier 2001',
				1 => '2001-01-01 00:00:00',
				2 => '2011',
			],
			8 => [
				0 => '31 décembre 2001',
				1 => '2001-12-31 23:59:59',
				2 => '2011',
			],
			9 => [
				0 => '1er mars 2001',
				1 => '2001-03-01 14:12:33',
				2 => '2011',
			],
			10 => [
				0 => '29 février 2004',
				1 => '2004-02-29 14:12:33',
				2 => '2011',
			],
			11 => [
				0 => '20 mars 2012',
				1 => '2012-03-20 12:00:00',
				2 => '2011',
			],
			12 => [
				0 => '21 juin 2012',
				1 => '2012-06-21 12:00:00',
				2 => '2011',
			],
			13 => [
				0 => '22 septembre 2012',
				1 => '2012-09-22 12:00:00',
				2 => '2011',
			],
			14 => [
				0 => '22 décembre 2012',
				1 => '2012-12-22 12:00:00',
				2 => '2011',
			],
			15 => [
				0 => '5 juillet 2001',
				1 => '2001-07-05',
				2 => '2011',
			],
			16 => [
				0 => '1er janvier 2001',
				1 => '2001-01-01',
				2 => '2011',
			],
			17 => [
				0 => '31 décembre 2001',
				1 => '2001-12-31',
				2 => '2011',
			],
			18 => [
				0 => '1er mars 2001',
				1 => '2001-03-01',
				2 => '2011',
			],
			19 => [
				0 => '29 février 2004',
				1 => '2004-02-29',
				2 => '2011',
			],
			20 => [
				0 => '20 mars 2012',
				1 => '2012-03-20',
				2 => '2011',
			],
			21 => [
				0 => '1er janvier 2001',
				1 => '2001/01/01',
				2 => '2011',
			],
			22 => [
				0 => '1er décembre 2031',
				1 => '2001/12/31',
				2 => '2011',
			],
			23 => [
				0 => '1er mars 2001',
				1 => '2001/03/01',
				2 => '2011',
			],
			24 => [
				0 => '4 février 2029',
				1 => '2004/02/29',
				2 => '2011',
			],
			25 => [
				0 => '12 mars 2020',
				1 => '2012/03/20',
				2 => '2011',
			],
			26 => [
				0 => '22 décembre 2012',
				1 => '22/12/2012',
				2 => '2011',
			],
		];
	}
}
