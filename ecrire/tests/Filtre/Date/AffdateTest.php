<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction affdate_court du fichier inc/filtres.php
 */

namespace Spip\Test\Filtre\Date;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class AffdateTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('inc/filtres.php', '', true);
	}

	#[DataProvider('providerAffdateWithoutDay')]
	public function testAffdateWithoutDay($expected, $date, $lang): void {
		$GLOBALS['spip_lang'] = $lang;
		$actual = affdate($date);
		$this->assertEquals($expected, $actual);
	}

	public static function providerAffdateWithoutDay(): array {
		return [
			'ca-nc-01-2010' => [
				'expected' => 'gener de 2010',
				'date' => '2010-01-00 01:00:00',
				'lang' => 'ca',
			],
			'de-nc-01-2010' => [
				'expected' => 'Januar 2010',
				'date' => '2010-01-00 01:00:00',
				'lang' => 'de',
			],
			'en-nc-01-2010' => [
				'expected' => 'January 2010',
				'date' => '2010-01-00 01:00:00',
				'lang' => 'en',
			],
			'es-nc-01-2010' => [
				'expected' => 'enero de 2010',
				'date' => '2010-01-00 01:00:00',
				'lang' => 'es',
			],
			'fr-nc-01-2010' => [
				'expected' => 'janvier 2010',
				'date' => '2010-01-00 01:00:00',
				'lang' => 'fr',
			],
			'it-nc-01-2010' => [
				'expected' => 'Gennaio 2010',
				'date' => '2010-01-00 01:00:00',
				'lang' => 'it',
			],
			'nl-nc-01-2010' => [
				'expected' => 'januari 2010',
				'date' => '2010-01-00 01:00:00',
				'lang' => 'nl',
			],
			'pl-nc-01-2010' => [
				'expected' => 'Styczeń 2010',
				'date' => '2010-01-00 01:00:00',
				'lang' => 'pl',
			],
			'pt-nc-01-2010' => [
				'expected' => 'Janeiro de 2010',
				'date' => '2010-01-00 01:00:00',
				'lang' => 'pt',
			],
		];
	}

	#[DataProvider('providerAWithoutDayAndMonth')]
	public function testAffdateWithoutDayAndMonth($lang): void {
		$GLOBALS['spip_lang'] = $lang;
		$this->assertEquals(2010, affdate('2010-00-00 01:00:00'));
	}

	public static function providerAWithoutDayAndMonth(): array {
		$list = array_column(self::providerAffdateWithoutDay(), null, 'lang');
		return array_map(fn ($entry) => [
			'lang' => $entry['lang'],
		], $list);
	}
}
