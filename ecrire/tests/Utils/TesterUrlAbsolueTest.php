<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction tester_url_absolue du fichier ./inc/utils.php
 */

namespace Spip\Test\Utils;

use PHPUnit\Framework\TestCase;

class TesterUrlAbsolueTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		find_in_path('./inc/utils.php', '', true);
	}

	/**
	 * @dataProvider providerUtilsTesterUrlAbsolue
	 */
	public function testUtilsTesterUrlAbsolue($expected, ...$args): void
	{
		$actual = tester_url_absolue(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerUtilsTesterUrlAbsolue(): array
	{
		return [
			0 => [
				0 => true,
				1 => 'http://www.spip.net/',
			],
			1 => [
				0 => true,
				1 => 'https://www.spip.net/',
			],
			2 => [
				0 => true,
				1 => 'http://www.spip.net/sousrep/fr/',
			],
			3 => [
				0 => true,
				1 => 'ftp://www.spip.net/',
			],
			4 => [
				0 => true,
				1 => '//www.spip.net/',
			],
			5 => [
				0 => false,
				1 => '/spip/?page=sommaire',
			],
			6 => [
				0 => false,
				1 => 'spip/?page=sommaire',
			],
		];
	}
}
