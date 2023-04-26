<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction wrap du fichier inc/filtres.php
 */

namespace Spip\Test\Filtre;

use PHPUnit\Framework\TestCase;

class WrapTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		find_in_path('inc/filtres.php', '', true);
	}

	/**
	 * @dataProvider providerFiltresWrap
	 */
	public function testFiltresWrap($expected, ...$args): void
	{
		$actual = wrap(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresWrap(): array
	{
		return [
			0 => [
				0 => '<h3>un mot</h3>',
				1 => 'un mot',
				2 => '<h3>',
			],
			1 => [
				0 => '<h3><b>un mot</b></h3>',
				1 => 'un mot',
				2 => '<h3><b>',
			],
			2 => [
				0 => '<h3 class="spip"><b>un mot</b></h3>',
				1 => 'un mot',
				2 => '<h3 class="spip"><b>',
			],
		];
	}
}
