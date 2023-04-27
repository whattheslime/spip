<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction info_maj_versions du fichier ./genie/mise_a_jour.php
 */

namespace Spip\Test\Genie;

use PHPUnit\Framework\TestCase;

class MajTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		find_in_path('./genie/mise_a_jour.php', '', true);
	}

	/**
	 * @dataProvider providerInfoMajVersions
	 */
	public function testInfoMajVersions($expected, ...$args): void
	{
		$actual = info_maj_versions(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerInfoMajVersions(): array
	{
		return [
			'version locale inconnue, maj distantes inconnues : ne rien signaler' => [
				0 => ['mineure' => '', 'majeure' => ''],
				1 => '',
				2 => [],
			],
			'maj distantes inconnues : ne rien signaler' => [
				0 => ['mineure' => '', 'majeure' => ''],
				1 => '4.1.8',
				2 => [],
			],
			'version locale inconnue : ne rien signaler' => [
				0 => ['mineure' => '', 'majeure' => ''],
				1 => '',
				2 => ['4.2.0', '4.2.1'],
			],
			'une maj mineure existe, sans maj majeure : signaler la mineure' => [
				0 => ['mineure' => '4.2.1', 'majeure' => ''],
				1 => '4.2.0-beta',
				2 => ['4.2.0', '4.2.1'],
			],
			'aucune maj mineure, une maj majeure uniquement : signaler la majeure' => [
				0 => ['mineure' => '', 'majeure' => '4.2.1'],
				1 => '4.1.7',
				2 => ['3.2.24', '4.1.7', '4.2.1'],
			],
			'aucune maj mineure, plusieurs maj majeures : signaler la majeure la plus haute' => [
				0 => ['mineure' => '', 'majeure' => '4.3.0'],
				1 => '4.1.7',
				2 => ['4.1.7', '4.2.1', '4.3.0'],
			],
			'maj majeure en alpha : ne pas la signaler' => [
				0 => ['mineure' => '', 'majeure' => ''],
				1 => '4.1.7',
				2 => ['4.1.7', '4.2.0-alpha'],
			],
			'plusieurs maj majeures, mais la plus haute en alpha : signaler la plus haute stable' => [
				0 => ['mineure' => '', 'majeure' => '4.2.1'],
				1 => '4.0.7',
				2 => ['4.0.7', '4.1.10', '4.2.1', '4.3.0-rc'],
			],
			'maj mineure et majeure : signaler les deux' => [
				0 => ['mineure' => '4.1.7', 'majeure' => '4.2.1'],
				1 => '4.1.2',
				2 => ['4.0.10', '4.1.7', '4.2.1'],
			],
		];
	}
}
