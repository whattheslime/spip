<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction hauteur du fichier inc/filtres.php
 */

namespace Spip\Test\Filtre;

use PHPUnit\Framework\TestCase;

class HauteurTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		find_in_path('inc/filtres.php', '', true);
	}

	/**
	 * @dataProvider providerFiltresHauteur
	 */
	public function testFiltresHauteur($expected, ...$args): void
	{
		$actual = hauteur(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresHauteur(): array
	{
		return [
			0 => [
				0 => 223,
				1 => 'https://www.spip.net/IMG/logo/siteon0.png',
			],
			2 => [
				0 => 172,
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
