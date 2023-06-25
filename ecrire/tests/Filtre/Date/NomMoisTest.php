<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction nom_mois du fichier inc/filtres.php
 */

namespace Spip\Test\Filtre\Date;

use PHPUnit\Framework\TestCase;

class NomMoisTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('inc/filtres.php', '', true);
	}

	protected function setUp(): void {
		changer_langue('fr');
		// ce test est en fr
	}

	/**
	 * @dataProvider providerFiltresNomMois
	 */
	public function testFiltresNomMois($expected, ...$args): void {
		$actual = nom_mois(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresNomMois(): array {
		return [
			0 => [
				0 => '',
				1 => '2001-00-00 12:33:44',
			],
			1 => [
				0 => 'mars',
				1 => '2001-03-00 09:12:57',
			],
			2 => [
				0 => 'février',
				1 => '2001-02-29 14:12:33',
			],
			3 => [
				0 => '',
				1 => '0000-00-00',
			],
			4 => [
				0 => 'janvier',
				1 => '0001-01-01',
			],
			5 => [
				0 => 'janvier',
				1 => '1970-01-01',
			],
			6 => [
				0 => 'juillet',
				1 => '2001-07-05 18:25:24',
			],
			7 => [
				0 => 'janvier',
				1 => '2001-01-01 00:00:00',
			],
			8 => [
				0 => 'décembre',
				1 => '2001-12-31 23:59:59',
			],
			9 => [
				0 => 'mars',
				1 => '2001-03-01 14:12:33',
			],
			10 => [
				0 => 'février',
				1 => '2004-02-29 14:12:33',
			],
			11 => [
				0 => 'mars',
				1 => '2012-03-20 12:00:00',
			],
			12 => [
				0 => 'juin',
				1 => '2012-06-22 12:00:00',
			],
			13 => [
				0 => 'décembre',
				1 => '2012-12-21 12:00:00',
			],
			14 => [
				0 => 'juillet',
				1 => '2001-07-05',
			],
			15 => [
				0 => 'janvier',
				1 => '2001-01-01',
			],
			16 => [
				0 => 'décembre',
				1 => '2001-12-31',
			],
			17 => [
				0 => 'mars',
				1 => '2001-03-01',
			],
			18 => [
				0 => 'février',
				1 => '2004-02-29',
			],
			19 => [
				0 => 'mars',
				1 => '2012-03-20',
			],
			20 => [
				0 => 'septembre',
				1 => '2012-09-21',
			],
			21 => [
				0 => 'décembre',
				1 => '2012-12-22',
			],
			22 => [
				0 => 'juillet',
				1 => '2001/07/05',
			],
			23 => [
				0 => 'janvier',
				1 => '2001/01/01',
			],
			24 => [
				0 => 'décembre',
				1 => '2001/12/31',
			],
			25 => [
				0 => 'mars',
				1 => '2001/03/01',
			],
			26 => [
				0 => 'février',
				1 => '2004/02/29',
			],
			27 => [
				0 => 'mars',
				1 => '2012/03/20',
			],
			28 => [
				0 => 'décembre',
				1 => '2012/12/21',
			],
			29 => [
				0 => 'juillet',
				1 => '05/07/2001',
			],
			30 => [
				0 => 'janvier',
				1 => '01/01/2001',
			],
			31 => [
				0 => 'décembre',
				1 => '31/12/2001',
			],
			32 => [
				0 => 'mars',
				1 => '01/03/2001',
			],
			33 => [
				0 => 'février',
				1 => '29/02/2004',
			],
			34 => [
				0 => 'mars',
				1 => '20/03/2012',
			],
			35 => [
				0 => 'décembre',
				1 => '22/12/2012',
			],
		];
	}
}
