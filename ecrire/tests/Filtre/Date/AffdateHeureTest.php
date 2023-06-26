<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction affdate_heure du fichier inc/filtres.php
 */

namespace Spip\Test\Filtre\Date;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class AffdateHeureTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('inc/filtres.php', '', true);
	}

	protected function setUp(): void {
		changer_langue('fr');
		// ce test est en fr
	}

	#[DataProvider('providerFiltresAffdateHeure')]
 public function testFiltresAffdateHeure($expected, ...$args): void {
		$actual = affdate_heure(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresAffdateHeure(): array {
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
			13 => [
				0 => '21 juin 2012 à 12h00min',
				1 => '2012-06-21 12:00:00',
			],
			14 => [
				0 => '22 septembre 2012 à 12h00min',
				1 => '2012-09-22 12:00:00',
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
				0 => '22 mars 2012 à 0h0min',
				1 => '2012-03-22',
			],
			22 => [
				0 => '21 juin 2012 à 0h0min',
				1 => '2012-06-21',
			],
			23 => [
				0 => '22 septembre 2012 à 0h0min',
				1 => '2012-09-22',
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
				0 => '22 décembre 2012 à 0h0min',
				1 => '22/12/2012',
			],
		];
	}
}
