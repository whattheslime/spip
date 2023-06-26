<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction date_interface du fichier inc/filtres.php
 */

namespace Spip\Test\Filtre\Date;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class DateInterfaceTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('inc/filtres.php', '', true);
	}

	protected function setUp(): void {
		changer_langue('fr');
		// ce test est en fr
	}

	#[DataProvider('providerFiltresDateInterface')]
 public function testFiltresDateInterface($expected, ...$args): void {
		$actual = date_interface(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresDateInterface(): array {
		return [
			0 => [
				0 => '2001 à 12h33min',
				1 => '2001-00-00 12:33:44',
			],
			1 => [
				0 => 'mars 2001 à 09h12min',
				1 => '2001-03-00 09:12:57',
			],
			2 => [
				0 => '29 février 2001 à 14h12min',
				1 => '2001-02-29 14:12:33',
			],
			3 => [
				0 => '0000 à 0h0min',
				1 => '0000-00-00',
			],
			4 => [
				0 => '1er janvier 0001 à 0h0min',
				1 => '0001-01-01',
			],
			5 => [
				0 => '1er janvier 1970 à 0h0min',
				1 => '1970-01-01',
			],
			6 => [
				0 => '5 juillet 2001 à 18h25min',
				1 => '2001-07-05 18:25:24',
			],
			7 => [
				0 => '1er janvier 2001 à 00h00min',
				1 => '2001-01-01 00:00:00',
			],
			8 => [
				0 => '31 décembre 2001 à 23h59min',
				1 => '2001-12-31 23:59:59',
			],
			9 => [
				0 => '1er mars 2001 à 14h12min',
				1 => '2001-03-01 14:12:33',
			],
			10 => [
				0 => '29 février 2004 à 14h12min',
				1 => '2004-02-29 14:12:33',
			],
			11 => [
				0 => '20 mars 2012 à 12h00min',
				1 => '2012-03-20 12:00:00',
			],
			12 => [
				0 => '21 mars 2012 à 12h00min',
				1 => '2012-03-21 12:00:00',
			],
			14 => [
				0 => '22 juin 2012 à 12h00min',
				1 => '2012-06-22 12:00:00',
			],
			15 => [
				0 => '22 décembre 2012 à 12h00min',
				1 => '2012-12-22 12:00:00',
			],
			16 => [
				0 => '5 juillet 2001 à 0h0min',
				1 => '2001-07-05',
			],
			17 => [
				0 => '1er janvier 2001 à 0h0min',
				1 => '2001-01-01',
			],
			18 => [
				0 => '31 décembre 2001 à 0h0min',
				1 => '2001-12-31',
			],
			19 => [
				0 => '1er mars 2001 à 0h0min',
				1 => '2001-03-01',
			],
			20 => [
				0 => '29 février 2004 à 0h0min',
				1 => '2004-02-29',
			],
			21 => [
				0 => '20 mars 2012 à 0h0min',
				1 => '2012-03-20',
			],
			22 => [
				0 => '22 juin 2012 à 0h0min',
				1 => '2012-06-22',
			],
			23 => [
				0 => '22 décembre 2012 à 0h0min',
				1 => '2012-12-22',
			],
			24 => [
				0 => '1er juillet 2005 à 0h0min',
				1 => '2001/07/05',
			],
			25 => [
				0 => '1er janvier 2001 à 0h0min',
				1 => '2001/01/01',
			],
			26 => [
				0 => '1er décembre 2031 à 0h0min',
				1 => '2001/12/31',
			],
			27 => [
				0 => '1er mars 2001 à 0h0min',
				1 => '2001/03/01',
			],
			28 => [
				0 => '4 février 2029 à 0h0min',
				1 => '2004/02/29',
			],
			29 => [
				0 => '12 mars 2020 à 0h0min',
				1 => '2012/03/20',
			],
			30 => [
				0 => '12 mars 2021 à 0h0min',
				1 => '2012/03/21',
			],
			31 => [
				0 => '12 juin 2021 à 0h0min',
				1 => '2012/06/21',
			],
			32 => [
				0 => '12 septembre 2022 à 0h0min',
				1 => '2012/09/22',
			],
			33 => [
				0 => '12 décembre 2020 à 0h0min',
				1 => '2012/12/20',
			],
			34 => [
				0 => '5 juillet 2001 à 0h0min',
				1 => '05/07/2001',
			],
			35 => [
				0 => '1er janvier 2001 à 0h0min',
				1 => '01/01/2001',
			],
			36 => [
				0 => '31 décembre 2001 à 0h0min',
				1 => '31/12/2001',
			],
			37 => [
				0 => '1er mars 2001 à 0h0min',
				1 => '01/03/2001',
			],
			38 => [
				0 => '29 février 2004 à 0h0min',
				1 => '29/02/2004',
			],
			39 => [
				0 => '22 décembre 2012 à 0h0min',
				1 => '22/12/2012',
			],
		];
	}
}
