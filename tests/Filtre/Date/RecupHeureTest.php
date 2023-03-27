<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction recup_heure du fichier inc/filtres.php
 */

namespace Spip\Core\Tests\Filtre\Date;

use PHPUnit\Framework\TestCase;

class RecupHeureTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		find_in_path('inc/filtres.php', '', true);
	}

	/**
	 * @dataProvider providerFiltresRecupHeure
	 */
	public function testFiltresRecupHeure($expected, ...$args): void
	{
		$actual = recup_heure(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresRecupHeure(): array
	{
		return [
			// pas d’heure
			'yyyy-mm-dd #1' => [
				0 => [
					0 => 0,
					1 => 0,
					2 => 0,
				],
				1 => '0000-00-00',
			],
			'yyyy-mm-dd #2' => [
				0 => [
					0 => 0,
					1 => 0,
					2 => 0,
				],
				1 => '0001-01-01',
			],
			'yyyy-mm-dd #3' => [
				0 => [
					0 => 0,
					1 => 0,
					2 => 0,
				],
				1 => '1970-01-01',
			],
			'yyyy-mm-dd #4' => [
				0 => [
					0 => 0,
					1 => 0,
					2 => 0,
				],
				1 => '2001-07-05',
			],
			'yyyy/mm/dd #1' => [
				0 => [
					0 => 0,
					1 => 0,
					2 => 0,
				],
				1 => '2001/07/05',
			],

			// date(-) + heures avec secondes
			'yyyy-mm-dd hh:mm:ss #1' => [
				0 => [
					0 => '00',
					1 => '00',
					2 => '00',
				],
				1 => '2001-01-01 00:00:00',
			],
			'yyyy-mm-dd hh:mm:ss #2' => [
				0 => [
					0 => '23',
					1 => '59',
					2 => '59',
				],
				1 => '2001-12-31 23:59:59',
			],
			'yyyy-mm-dd hh:mm:ss #3' => [
				0 => [
					0 => '12',
					1 => '33',
					2 => '44',
				],
				1 => '2001-00-00 12:33:44',
			],
			'yyyy-mm-dd hh:mm:ss #4' => [
				0 => [
					0 => '09',
					1 => '12',
					2 => '57',
				],
				1 => '2001-03-00 09:12:57',
			],

			// date(/) + heures avec secondes
			'yyyy/mm/dd hh:mm:ss #1' => [
				0 => [
					0 => '00',
					1 => '00',
					2 => '00',
				],
				1 => '2001/01/01 00:00:00',
			],
			'yyyy/mm/dd hh:mm:ss #2' => [
				0 => [
					0 => '23',
					1 => '59',
					2 => '59',
				],
				1 => '2001/12/31 23:59:59',
			],
			'yyyy/mm/dd hh:mm:ss #3' => [
				0 => [
					0 => '12',
					1 => '33',
					2 => '44',
				],
				1 => '2001/00/00 12:33:44',
			],
			'yyyy/mm/dd hh:mm:ss #4' => [
				0 => [
					0 => '09',
					1 => '12',
					2 => '57',
				],
				1 => '2001/03/00 09:12:57',
			],

			// date + heure sans seconde
			'yyyy-mm-dd hh:mm' => [
				0 => [
					0 => '09',
					1 => '12',
					2 => 0,
				],
				1 => '2001-03-01 09:12',
			],
			'yyyy/mm/dd hh:mm'  => [
				0 => [
					0 => '09',
					1 => '59',
					2 => 0,
				],
				1 => '2001/03/01 09:59',
			],

			// seulement heures
			'hh:mm:ss' => [
				0 => [
					0 => '09',
					1 => '12',
					2 => '38',
				],
				1 => '09:12:38',
			],
			'hh:mm' => [
				0 => [
					0 => '09',
					1 => '59',
					2 => 0,
				],
				1 => '09:59',
			],
		];
	}
}
