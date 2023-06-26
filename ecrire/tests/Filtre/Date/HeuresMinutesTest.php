<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction heures_minutes du fichier inc/filtres.php
 */

namespace Spip\Test\Filtre\Date;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class HeuresMinutesTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('inc/filtres.php', '', true);
	}

	protected function setUp(): void {
		changer_langue('fr');
		// ce test est en fr
	}

	#[DataProvider('providerFiltresHeuresMinutes')]
	public function testFiltresHeuresMinutes($expected, ...$args): void {
		$actual = heures_minutes(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresHeuresMinutes(): array {
		return [
			0 => [
				0 => '12h33min',
				1 => '2001-00-00 12:33:44',
			],
			1 => [
				0 => '09h12min',
				1 => '2001-03-00 09:12:57',
			],
			2 => [
				0 => '14h12min',
				1 => '2001-02-29 14:12:33',
			],
			3 => [
				0 => '0h0min',
				1 => '0000-00-00',
			],
			4 => [
				0 => '0h0min',
				1 => '0001-01-01',
			],
			5 => [
				0 => '0h0min',
				1 => '1970-01-01',
			],
			6 => [
				0 => '18h25min',
				1 => '2001-07-05 18:25:24',
			],
			7 => [
				0 => '00h00min',
				1 => '2001-01-01 00:00:00',
			],
			8 => [
				0 => '23h59min',
				1 => '2001-12-31 23:59:59',
			],
			9 => [
				0 => '14h12min',
				1 => '2001-03-01 14:12:33',
			],
			10 => [
				0 => '14h12min',
				1 => '2004-02-29 14:12:33',
			],
			11 => [
				0 => '12h00min',
				1 => '2012-03-22 12:00:00',
			],
			12 => [
				0 => '12h00min',
				1 => '2012-06-22 12:00:00',
			],
			13 => [
				0 => '12h00min',
				1 => '2012-12-22 12:00:00',
			],
			14 => [
				0 => '0h0min',
				1 => '2001-07-05',
			],
			15 => [
				0 => '0h0min',
				1 => '2001-01-01',
			],
			16 => [
				0 => '0h0min',
				1 => '2001-12-31',
			],
			17 => [
				0 => '0h0min',
				1 => '2001-03-01',
			],
			18 => [
				0 => '0h0min',
				1 => '2001/07/05',
			],
			19 => [
				0 => '0h0min',
				1 => '2001/01/01',
			],
			20 => [
				0 => '0h0min',
				1 => '2001/12/31',
			],
			21 => [
				0 => '0h0min',
				1 => '2001/03/01',
			],
			22 => [
				0 => '0h0min',
				1 => '2004/02/29',
			],
			23 => [
				0 => '0h0min',
				1 => '2012/03/20',
			],
			24 => [
				0 => '0h0min',
				1 => '05/07/2001',
			],
			25 => [
				0 => '0h0min',
				1 => '01/01/2001',
			],
			26 => [
				0 => '0h0min',
				1 => '31/12/2001',
			],
			27 => [
				0 => '0h0min',
				1 => '01/03/2001',
			],
			28 => [
				0 => '0h0min',
				1 => '29/02/2004',
			],
			29 => [
				0 => '0h0min',
				1 => '22/12/2012',
			],
		];
	}
}
