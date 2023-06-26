<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction nom_jour du fichier inc/filtres.php
 */

namespace Spip\Test\Filtre\Date;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class NomJourTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('inc/filtres.php', '', true);
	}

	protected function setUp(): void {
		changer_langue('fr');
		// ce test est en fr
	}

	#[DataProvider('providerFiltresNomJour')]
	public function testFiltresNomJour($expected, ...$args): void {
		$actual = nom_jour(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresNomJour(): array {
		return [
			0 => [
				0 => '',
				1 => '2001-00-00 12:33:44',
			],
			1 => [
				0 => '',
				1 => '2001-03-00 09:12:57',
			],
			2 => [
				0 => 'jeudi',
				1 => '2001-02-29 14:12:33',
			],
			3 => [
				0 => '',
				1 => '0000-00-00',
			],
			4 => [
				0 => 'lundi',
				1 => '0001-01-01',
			],
			5 => [
				0 => 'jeudi',
				1 => '1970-01-01',
			],
			6 => [
				0 => 'jeudi',
				1 => '2001-07-05 18:25:24',
			],
			7 => [
				0 => 'lundi',
				1 => '2001-01-01 00:00:00',
			],
			8 => [
				0 => 'lundi',
				1 => '2001-12-31 23:59:59',
			],
			9 => [
				0 => 'jeudi',
				1 => '2001-03-01 14:12:33',
			],
			10 => [
				0 => 'dimanche',
				1 => '2004-02-29 14:12:33',
			],
			11 => [
				0 => 'mardi',
				1 => '2012-03-20 12:00:00',
			],
			12 => [
				0 => 'mercredi',
				1 => '2012-06-20 12:00:00',
			],
			13 => [
				0 => 'jeudi',
				1 => '2012-09-20 12:00:00',
			],
			14 => [
				0 => 'samedi',
				1 => '2012-09-22 12:00:00',
			],
			15 => [
				0 => 'samedi',
				1 => '2012-12-22 12:00:00',
			],
			16 => [
				0 => 'jeudi',
				1 => '2001-07-05',
			],
			17 => [
				0 => 'lundi',
				1 => '2001-01-01',
			],
			18 => [
				0 => 'lundi',
				1 => '2001-12-31',
			],
			19 => [
				0 => 'jeudi',
				1 => '2001-03-01',
			],
			20 => [
				0 => 'dimanche',
				1 => '2004-02-29',
			],
			21 => [
				0 => 'mardi',
				1 => '2012-03-20',
			],
			22 => [
				0 => 'jeudi',
				1 => '2012-06-21',
			],
			23 => [
				0 => 'samedi',
				1 => '2012-12-22',
			],
			24 => [
				0 => 'vendredi',
				1 => '2001/07/05',
			],
			25 => [
				0 => 'lundi',
				1 => '2001/01/01',
			],
			26 => [
				0 => 'lundi',
				1 => '2001/12/31',
			],
			27 => [
				0 => 'jeudi',
				1 => '2001/03/01',
			],
			28 => [
				0 => 'dimanche',
				1 => '2004/02/29',
			],
			29 => [
				0 => 'jeudi',
				1 => '2012/03/20',
			],
			30 => [
				0 => 'vendredi',
				1 => '2012/06/20',
			],
			31 => [
				0 => 'dimanche',
				1 => '2012/09/21',
			],
			32 => [
				0 => 'lundi',
				1 => '2012/12/22',
			],
			33 => [
				0 => 'jeudi',
				1 => '05/07/2001',
			],
			34 => [
				0 => 'lundi',
				1 => '01/01/2001',
			],
			35 => [
				0 => 'lundi',
				1 => '31/12/2001',
			],
			36 => [
				0 => 'jeudi',
				1 => '01/03/2001',
			],
			37 => [
				0 => 'dimanche',
				1 => '29/02/2004',
			],
			38 => [
				0 => 'mardi',
				1 => '20/03/2012',
			],
			39 => [
				0 => 'mercredi',
				1 => '20/06/2012',
			],
			40 => [
				0 => 'vendredi',
				1 => '21/09/2012',
			],
			41 => [
				0 => 'samedi',
				1 => '22/12/2012',
			],
		];
	}
}
