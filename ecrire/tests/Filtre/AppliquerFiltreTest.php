<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction appliquer_filtre du fichier inc/filtres.php
 */

namespace Spip\Test\Filtre;

use PHPUnit\Framework\TestCase;

class AppliquerFiltreTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('inc/filtres.php', '', true);
	}

	/**
	 * @dataProvider providerFiltresAppliquerFiltre
	 */
	public function testFiltresAppliquerFiltre($expected, ...$args): void {
		$actual = appliquer_filtre(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresAppliquerFiltre(): array {
		return [
			0 => [
				0 => '&lt;&gt;&quot;&#039;&amp;',
				1 => '<>"\'&',
				2 => 'entites_html',
			],
			1 => [
				0 => '&amp;',
				1 => '&amp;',
				2 => 'entites_html',
			],
		];
	}
}
