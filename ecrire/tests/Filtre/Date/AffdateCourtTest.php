<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction affdate_court du fichier inc/filtres.php
 */

namespace Spip\Test\Filtre\Date;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class AffdateCourtTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('inc/filtres.php', '', true);
	}

	#[DataProvider('providerFiltresAffdateCourt')]
 public function testFiltresAffdateCourt($expected, ...$args): void {
		changer_langue('fr');
		$actual = affdate_court(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresAffdateCourt(): array {
		return [
			0 => [
				0 => ' 2001',
				1 => '2001-00-00 12:33:44',
				2 => '2011',
			],
			1 => [
				0 => 'Mars 2001',
				1 => '2001-03-00 09:12:57',
				2 => '2011',
			],
			2 => [
				0 => 'Février 2001',
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
				0 => 'Janvier 1970',
				1 => '1970-01-01',
				2 => '2011',
			],
			6 => [
				0 => 'Juillet 2001',
				1 => '2001-07-05 18:25:24',
				2 => '2011',
			],
			7 => [
				0 => 'Janvier 2001',
				1 => '2001-01-01 00:00:00',
				2 => '2011',
			],
			8 => [
				0 => 'Décembre 2001',
				1 => '2001-12-31 23:59:59',
				2 => '2011',
			],
			9 => [
				0 => 'Mars 2001',
				1 => '2001-03-01 14:12:33',
				2 => '2011',
			],
			10 => [
				0 => 'Février 2004',
				1 => '2004-02-29 14:12:33',
				2 => '2011',
			],
			11 => [
				0 => 'Mars 2012',
				1 => '2012-03-20 12:00:00',
				2 => '2011',
			],
			12 => [
				0 => 'Juin 2012',
				1 => '2012-06-22 12:00:00',
				2 => '2011',
			],
			13 => [
				0 => 'Septembre 2012',
				1 => '2012-09-21 12:00:00',
				2 => '2011',
			],
			14 => [
				0 => 'Décembre 2012',
				1 => '2012-12-22 12:00:00',
				2 => '2011',
			],
			15 => [
				0 => 'Juillet 2001',
				1 => '2001-07-05',
				2 => '2011',
			],
			16 => [
				0 => 'Janvier 2001',
				1 => '2001-01-01',
				2 => '2011',
			],
			17 => [
				0 => 'Décembre 2001',
				1 => '2001-12-31',
				2 => '2011',
			],
			18 => [
				0 => 'Mars 2001',
				1 => '2001-03-01',
				2 => '2011',
			],
			19 => [
				0 => 'Février 2004',
				1 => '2004-02-29',
				2 => '2011',
			],
			20 => [
				0 => 'Juillet 2005',
				1 => '2001/07/05',
				2 => '2011',
			],
			21 => [
				0 => 'Janvier 2001',
				1 => '2001/01/01',
				2 => '2011',
			],
			22 => [
				0 => 'Décembre 2031',
				1 => '2001/12/31',
				2 => '2011',
			],
			23 => [
				0 => 'Mars 2001',
				1 => '2001/03/01',
				2 => '2011',
			],
			24 => [
				0 => 'Juin 2020',
				1 => '2012/06/20',
				2 => '2011',
			],
		];
	}
}
