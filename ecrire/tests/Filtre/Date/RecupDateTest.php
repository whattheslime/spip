<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction recup_date du fichier inc/filtres.php
 */

namespace Spip\Test\Filtre\Date;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class RecupDateTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('inc/filtres.php', '', true);
	}

	#[DataProvider('providerFiltresRecupDate')]
	public function testFiltresRecupDate($expected, ...$args): void {
		$actual = recup_date(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresRecupDate(): array {
		return [
			0 => [
				0 => [
					0 => '2001',
					1 => '1',
					2 => '1',
					3 => '12',
					4 => '33',
					5 => '44',
				],
				1 => '2001-00-00 12:33:44',
				2 => true,
			],
			1 => [
				0 => [
					0 => '2001',
					1 => '00',
					2 => '0',
					3 => '12',
					4 => '33',
					5 => '44',
				],
				1 => '2001-00-00 12:33:44',
				2 => false,
			],
			2 => [
				0 => [
					0 => '2001',
					1 => '03',
					2 => '1',
					3 => '09',
					4 => '12',
					5 => '57',
				],
				1 => '2001-03-00 09:12:57',
				2 => true,
			],
			3 => [
				0 => [
					0 => '2001',
					1 => '03',
					2 => '0',
					3 => '09',
					4 => '12',
					5 => '57',
				],
				1 => '2001-03-00 09:12:57',
				2 => false,
			],
			4 => [
				0 => [
					0 => '2001',
					1 => '02',
					2 => '29',
					3 => '14',
					4 => '12',
					5 => '33',
				],
				1 => '2001-02-29 14:12:33',
				2 => true,
			],
			5 => [
				0 => [
					0 => '2001',
					1 => '02',
					2 => '29',
					3 => '14',
					4 => '12',
					5 => '33',
				],
				1 => '2001-02-29 14:12:33',
				2 => false,
			],
			6 => [
				0 => [
					0 => '0000',
					1 => '1',
					2 => '1',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '0000-00-00',
				2 => true,
			],
			7 => [
				0 => [
					0 => '0000',
					1 => '00',
					2 => '0',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '0000-00-00',
				2 => false,
			],
			8 => [
				0 => [
					0 => '0001',
					1 => '01',
					2 => '1',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '0001-01-01',
				2 => true,
			],
			9 => [
				0 => [
					0 => '0001',
					1 => '01',
					2 => '1',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '0001-01-01',
				2 => false,
			],
			10 => [
				0 => [
					0 => '1970',
					1 => '01',
					2 => '1',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '1970-01-01',
				2 => true,
			],
			11 => [
				0 => [
					0 => '1970',
					1 => '01',
					2 => '1',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '1970-01-01',
				2 => false,
			],
			12 => [
				0 => [
					0 => '2001',
					1 => '07',
					2 => '5',
					3 => '18',
					4 => '25',
					5 => '24',
				],
				1 => '2001-07-05 18:25:24',
				2 => true,
			],
			13 => [
				0 => [
					0 => '2001',
					1 => '07',
					2 => '5',
					3 => '18',
					4 => '25',
					5 => '24',
				],
				1 => '2001-07-05 18:25:24',
				2 => false,
			],
			14 => [
				0 => [
					0 => '2001',
					1 => '01',
					2 => '1',
					3 => '00',
					4 => '00',
					5 => '00',
				],
				1 => '2001-01-01 00:00:00',
				2 => true,
			],
			15 => [
				0 => [
					0 => '2001',
					1 => '01',
					2 => '1',
					3 => '00',
					4 => '00',
					5 => '00',
				],
				1 => '2001-01-01 00:00:00',
				2 => false,
			],
			16 => [
				0 => [
					0 => '2001',
					1 => '12',
					2 => '31',
					3 => '23',
					4 => '59',
					5 => '59',
				],
				1 => '2001-12-31 23:59:59',
				2 => true,
			],
			17 => [
				0 => [
					0 => '2001',
					1 => '12',
					2 => '31',
					3 => '23',
					4 => '59',
					5 => '59',
				],
				1 => '2001-12-31 23:59:59',
				2 => false,
			],
			18 => [
				0 => [
					0 => '2001',
					1 => '03',
					2 => '1',
					3 => '14',
					4 => '12',
					5 => '33',
				],
				1 => '2001-03-01 14:12:33',
				2 => true,
			],
			19 => [
				0 => [
					0 => '2001',
					1 => '03',
					2 => '1',
					3 => '14',
					4 => '12',
					5 => '33',
				],
				1 => '2001-03-01 14:12:33',
				2 => false,
			],
			20 => [
				0 => [
					0 => '2004',
					1 => '02',
					2 => '29',
					3 => '14',
					4 => '12',
					5 => '33',
				],
				1 => '2004-02-29 14:12:33',
				2 => true,
			],
			21 => [
				0 => [
					0 => '2004',
					1 => '02',
					2 => '29',
					3 => '14',
					4 => '12',
					5 => '33',
				],
				1 => '2004-02-29 14:12:33',
				2 => false,
			],
			22 => [
				0 => [
					0 => '2012',
					1 => '03',
					2 => '20',
					3 => '12',
					4 => '00',
					5 => '00',
				],
				1 => '2012-03-20 12:00:00',
				2 => true,
			],
			23 => [
				0 => [
					0 => '2012',
					1 => '03',
					2 => '20',
					3 => '12',
					4 => '00',
					5 => '00',
				],
				1 => '2012-03-20 12:00:00',
				2 => false,
			],
			24 => [
				0 => [
					0 => '2012',
					1 => '12',
					2 => '22',
					3 => '12',
					4 => '00',
					5 => '00',
				],
				1 => '2012-12-22 12:00:00',
				2 => true,
			],
			25 => [
				0 => [
					0 => '2012',
					1 => '12',
					2 => '22',
					3 => '12',
					4 => '00',
					5 => '00',
				],
				1 => '2012-12-22 12:00:00',
				2 => false,
			],
			26 => [
				0 => [
					0 => '2001',
					1 => '07',
					2 => '5',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '2001-07-05',
				2 => true,
			],
			27 => [
				0 => [
					0 => '2001',
					1 => '07',
					2 => '5',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '2001-07-05',
				2 => false,
			],
			28 => [
				0 => [
					0 => '2001',
					1 => '01',
					2 => '1',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '2001-01-01',
				2 => true,
			],
			29 => [
				0 => [
					0 => '2001',
					1 => '01',
					2 => '1',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '2001-01-01',
				2 => false,
			],
			30 => [
				0 => [
					0 => '2001',
					1 => '12',
					2 => '31',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '2001-12-31',
				2 => true,
			],
			31 => [
				0 => [
					0 => '2001',
					1 => '12',
					2 => '31',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '2001-12-31',
				2 => false,
			],
			32 => [
				0 => [
					0 => '2001',
					1 => '03',
					2 => '1',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '2001-03-01',
				2 => true,
			],
			33 => [
				0 => [
					0 => '2001',
					1 => '03',
					2 => '1',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '2001-03-01',
				2 => false,
			],
			34 => [
				0 => [
					0 => '2004',
					1 => '02',
					2 => '29',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '2004-02-29',
				2 => true,
			],
			35 => [
				0 => [
					0 => '2004',
					1 => '02',
					2 => '29',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '2004-02-29',
				2 => false,
			],
			36 => [
				0 => [
					0 => '2012',
					1 => '03',
					2 => '20',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '2012-03-20',
				2 => true,
			],
			37 => [
				0 => [
					0 => '2012',
					1 => '03',
					2 => '20',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '2012-03-20',
				2 => false,
			],
			38 => [
				0 => [
					0 => '2012',
					1 => '12',
					2 => '22',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '2012-12-22',
				2 => true,
			],
			39 => [
				0 => [
					0 => '2012',
					1 => '12',
					2 => '22',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '2012-12-22',
				2 => false,
			],
			40 => [
				0 => [
					0 => 2005,
					1 => '07',
					2 => '1',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '2001/07/05',
				2 => true,
			],
			41 => [
				0 => [
					0 => 2005,
					1 => '07',
					2 => '1',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '2001/07/05',
				2 => false,
			],
			42 => [
				0 => [
					0 => 2001,
					1 => '01',
					2 => '1',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '2001/01/01',
				2 => true,
			],
			43 => [
				0 => [
					0 => 2001,
					1 => '01',
					2 => '1',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '2001/01/01',
				2 => false,
			],
			44 => [
				0 => [
					0 => 2031,
					1 => '12',
					2 => '1',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '2001/12/31',
				2 => true,
			],
			45 => [
				0 => [
					0 => 2031,
					1 => '12',
					2 => '1',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '2001/12/31',
				2 => false,
			],
			46 => [
				0 => [
					0 => 2001,
					1 => '03',
					2 => '1',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '2001/03/01',
				2 => true,
			],
			47 => [
				0 => [
					0 => 2001,
					1 => '03',
					2 => '1',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '2001/03/01',
				2 => false,
			],
			48 => [
				0 => [
					0 => 2029,
					1 => '02',
					2 => '4',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '2004/02/29',
				2 => true,
			],
			49 => [
				0 => [
					0 => 2029,
					1 => '02',
					2 => '4',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '2004/02/29',
				2 => false,
			],
			50 => [
				0 => [
					0 => 2020,
					1 => '03',
					2 => '12',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '2012/03/20',
				2 => true,
			],
			51 => [
				0 => [
					0 => 2020,
					1 => '03',
					2 => '12',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '2012/03/20',
				2 => false,
			],
			52 => [
				0 => [
					0 => 2022,
					1 => '12',
					2 => '12',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '2012/12/22',
				2 => true,
			],
			53 => [
				0 => [
					0 => 2022,
					1 => '12',
					2 => '12',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '2012/12/22',
				2 => false,
			],
			54 => [
				0 => [
					0 => '2001',
					1 => '07',
					2 => '5',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '05/07/2001',
				2 => true,
			],
			55 => [
				0 => [
					0 => '2001',
					1 => '07',
					2 => '5',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '05/07/2001',
				2 => false,
			],
			56 => [
				0 => [
					0 => '2001',
					1 => '01',
					2 => '1',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '01/01/2001',
				2 => true,
			],
			57 => [
				0 => [
					0 => '2001',
					1 => '01',
					2 => '1',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '01/01/2001',
				2 => false,
			],
			58 => [
				0 => [
					0 => '2001',
					1 => '12',
					2 => '31',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '31/12/2001',
				2 => true,
			],
			59 => [
				0 => [
					0 => '2001',
					1 => '12',
					2 => '31',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '31/12/2001',
				2 => false,
			],
			60 => [
				0 => [
					0 => '2001',
					1 => '03',
					2 => '1',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '01/03/2001',
				2 => true,
			],
			61 => [
				0 => [
					0 => '2001',
					1 => '03',
					2 => '1',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '01/03/2001',
				2 => false,
			],
			62 => [
				0 => [
					0 => '2004',
					1 => '02',
					2 => '29',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '29/02/2004',
				2 => true,
			],
			63 => [
				0 => [
					0 => '2004',
					1 => '02',
					2 => '29',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '29/02/2004',
				2 => false,
			],
			64 => [
				0 => [
					0 => '2012',
					1 => '03',
					2 => '20',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '20/03/2012',
				2 => true,
			],
			65 => [
				0 => [
					0 => '2012',
					1 => '03',
					2 => '20',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '20/03/2012',
				2 => false,
			],
			66 => [
				0 => [
					0 => '2012',
					1 => '12',
					2 => '22',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '22/12/2012',
				2 => true,
			],
			67 => [
				0 => [
					0 => '2012',
					1 => '12',
					2 => '22',
					3 => 0,
					4 => 0,
					5 => 0,
				],
				1 => '22/12/2012',
				2 => false,
			],
			68 => [
				0 => [
					0 => '2012',
					1 => '12',
					2 => '22',
					3 => '13',
					4 => '14',
					5 => '15',
				],
				1 => intval(mktime(13, 14, 15, 12, 22, 2012)),
				2 => false,
			],
			69 => [
				0 => [
					0 => '2012',
					1 => '12',
					2 => '22',
					3 => '13',
					4 => '14',
					5 => '15',
				],
				1 => strval(mktime(13, 14, 15, 12, 22, 2012)),
				2 => false,
			],
			70 => [
				0 => [
					0 => '2012',
					1 => '12',
					2 => '22',
					3 => '13',
					4 => '14',
					5 => '15',
				],
				1 => intval(mktime(13, 14, 15, 12, 22, 2012)),
				2 => true,
			],
			71 => [
				0 => [
					0 => '2012',
					1 => '12',
					2 => '22',
					3 => '13',
					4 => '14',
					5 => '15',
				],
				1 => strval(mktime(13, 14, 15, 12, 22, 2012)),
				2 => true,
			],
		];
	}
}
