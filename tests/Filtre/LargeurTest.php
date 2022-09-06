<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction largeur du fichier inc/filtres.php
 */

namespace Spip\Core\Tests\Filtre;

use PHPUnit\Framework\TestCase;

class LargeurTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		find_in_path('inc/filtres.php', '', true);
	}

	/**
	 * @dataProvider providerFiltresLargeur
	 */
	public function testFiltresLargeur($expected, ...$args): void
	{
		$actual = largeur(...$args);
		$this->assertSame($expected, $actual);
		$this->assertEquals($expected, $actual);
	}

	public function providerFiltresLargeur(): array
	{
		return [
			0 => [
				0 => 300,
				1 => 'https://www.spip.net/IMG/logo/siteon0.png',
			],
			2 => [
				0 => 231,
				1 => 'prive/images/logo-spip.png',
			],
			3 => [
				0 => 0,
				1 => 'prive/aide_body.css',
			],
			4 => [
				0 => 16,
				1 => 'prive/images/searching.gif',
			],
		];
	}
}
