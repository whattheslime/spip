<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction supprimer_numero du fichier inc/filtres.php
 */

namespace Spip\Test\Filtre;

use PHPUnit\Framework\TestCase;

class SupprimerNumeroTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		find_in_path('inc/filtres.php', '', true);
	}

	/**
	 * @dataProvider providerFiltresSupprimerNumero
	 */
	public function testFiltresSupprimerNumero($expected, ...$args): void
	{
		$actual = supprimer_numero(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresSupprimerNumero(): array
	{
		return [
			0 => [
				0 => '1.titre',
				1 => '1.titre',
			],
			1 => [
				0 => 'titre',
				1 => '1. titre',
			],
			2 => [
				0 => '1 .titre',
				1 => '1 .titre',
			],
			3 => [
				0 => '1 . titre',
				1 => '1 . titre',
			],
			5 => [
				0 => 'titre',
				1 => '0. titre',
			],
			6 => [
				0 => 'titre',
				1 => ' 0. titre',
			],
			7 => [
				0 => '-1. titre',
				1 => '-1. titre',
			],
		];
	}
}
