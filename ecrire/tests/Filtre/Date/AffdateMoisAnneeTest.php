<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction affdate_mois_annee du fichier inc/filtres.php
 */

namespace Spip\Test\Filtre\Date;

use PHPUnit\Framework\TestCase;

class AffdateMoisAnneeTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('inc/filtres.php', '', true);
	}

	protected function setUp(): void {
		changer_langue('fr');
		// ce test est en fr
	}

	/**
	 * @dataProvider providerFiltresAffdateMoisAnnee
	 */
	public function testFiltresAffdateMoisAnnee($expected, ...$args): void {
		$actual = affdate_mois_annee(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresAffdateMoisAnnee(): array {
		return [
			0 => [
				0 => '2001',
				1 => '2001-00-00 12:33:44',
			],
			1 => [
				0 => 'mars 2001',
				1 => '2001-03-00 09:12:57',
			],
			2 => [
				0 => 'février 2001',
				1 => '2001-02-29 14:12:33',
			],
			3 => [
				0 => '0000',
				1 => '0000-00-00',
			],
			4 => [
				0 => 'janvier 0001',
				1 => '0001-01-01',
			],
			5 => [
				0 => 'janvier 1970',
				1 => '1970-01-01',
			],
			6 => [
				0 => 'juillet 2001',
				1 => '2001-07-05 18:25:24',
			],
			7 => [
				0 => 'janvier 2001',
				1 => '2001-01-01 00:00:00',
			],
			8 => [
				0 => 'décembre 2001',
				1 => '2001-12-31 23:59:59',
			],
			9 => [
				0 => 'mars 2001',
				1 => '2001-03-01 14:12:33',
			],
			10 => [
				0 => 'février 2004',
				1 => '2004-02-29 14:12:33',
			],
			11 => [
				0 => 'mars 2012',
				1 => '2012-03-20 12:00:00',
			],
			12 => [
				0 => 'juin 2012',
				1 => '2012-06-20 12:00:00',
			],
			13 => [
				0 => 'septembre 2012',
				1 => '2012-09-22 12:00:00',
			],
			14 => [
				0 => 'décembre 2012',
				1 => '2012-12-22 12:00:00',
			],
			15 => [
				0 => 'juillet 2001',
				1 => '2001-07-05',
			],
			16 => [
				0 => 'janvier 2001',
				1 => '2001-01-01',
			],
			17 => [
				0 => 'décembre 2001',
				1 => '2001-12-31',
			],
			18 => [
				0 => 'juillet 2005',
				1 => '2001/07/05',
			],
			19 => [
				0 => 'janvier 2001',
				1 => '2001/01/01',
			],
			20 => [
				0 => 'décembre 2031',
				1 => '2001/12/31',
			],
			21 => [
				0 => 'mars 2001',
				1 => '2001/03/01',
			],
			22 => [
				0 => 'février 2029',
				1 => '2004/02/29',
			],
			23 => [
				0 => 'décembre 2012',
				1 => '21/12/2012',
			],
			24 => [
				0 => 'décembre 2012',
				1 => '22/12/2012',
			],
		];
	}
}
