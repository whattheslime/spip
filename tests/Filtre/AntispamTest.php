<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction antispam du fichier inc/filtres.php
 */

namespace Spip\Core\Tests\Filtre;

use PHPUnit\Framework\TestCase;

class AntispamTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		find_in_path('inc/filtres.php', '', true);
	}

	/**
	 * @dataProvider providerFiltresAntispam
	 */
	public function testFiltresAntispam($expected, ...$args): void
	{
		$actual = antispam(...$args);
		$this->assertSame($expected, $actual);
		$this->assertEquals($expected, $actual);
	}

	public static function providerFiltresAntispam(): array
	{
		return [];
	}
}
