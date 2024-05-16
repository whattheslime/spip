<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction date_ical du fichier inc/filtres.php
 */

namespace Spip\Test\Filtre\Date;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class DateIsoTest extends TestCase
{
	protected string $original_timezone;

	public static function setUpBeforeClass(): void {
		find_in_path('inc/filtres.php', '', true);
	}

	protected function setUp(): void {
		$this->original_timezone = date_default_timezone_get();
		date_default_timezone_set('UTC');
	}

	protected function tearDown(): void {
		date_default_timezone_set($this->original_timezone);
	}

	#[DataProvider('providerDateIso')]
	public function testDateIso($expected, ...$args): void {
		$actual = date_iso(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerDateIso(): array {
		$tz = date_default_timezone_get();
		date_default_timezone_set('UTC');
		$data = [
			'01-01-2010' => [
				0 => gmdate('Y-m-d\TH:i:s\Z', mktime(2, 5, 30, 1, 1, 2010)),
				1 => '2010-01-01 02:05:30',
			],
			'nc-01-2010' => [
				0 => gmdate('Y-m-d\TH:i:s\Z', mktime(3, 6, 40, 1, 1, 2010)),
				1 => '2010-01-00 03:06:40',
			],
			'nc-nc-2010' => [
				0 => gmdate('Y-m-d\TH:i:s\Z', mktime(4, 7, 50, 1, 1, 2010)),
				1 => '2010-00-00 04:07:50',
			],
		];
		date_default_timezone_set($tz);
		return $data;
	}
}
