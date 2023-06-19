<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction recuperer_numero du fichier inc/filtres.php
 */

namespace Spip\Test\Filtre;

use PHPUnit\Framework\TestCase;

class RecupererNumeroTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('inc/filtres.php', '', true);
	}

	/**
	 * @dataProvider providerFiltresRecupererNumero
	 */
	public function testFiltresRecupererNumero($expected, ...$args): void {
		$actual = recuperer_numero(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresRecupererNumero(): array {
		return [
			0 => [
				0 => '1',
				1 => '1. titre',
			],
			1 => [
				0 => '',
				1 => '1.titre',
			],
			2 => [
				0 => '',
				1 => '1 .titre',
			],
			3 => [
				0 => '',
				1 => '1 . titre',
			],
			4 => [
				0 => '0',
				1 => '0. titre',
			],
			5 => [
				0 => '',
				1 => '-1. titre',
			],
		];
	}
}
