<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction ajouter_class du fichier ./inc/filtres.php
 */

namespace Spip\Test\Filtre;

use PHPUnit\Framework\TestCase;

class AjouterClassTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('./inc/filtres.php', '', true);
	}

	/**
	 * @dataProvider providerFiltresAjouterClass
	 */
	public function testFiltresAjouterClass($expected, ...$args): void {
		$actual = ajouter_class(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresAjouterClass(): array {
		return [
			0 => [
				0 => "<span class='maclasse maclasse-prefixe suffixe-maclasse maclasse--bem autreclass'>toto</span>",
				1 => '<span class="maclasse maclasse-prefixe suffixe-maclasse maclasse--bem">toto</span>',
				2 => 'autreclass',
			],
			1 => [
				0 => '<span class="maclasse maclasse-prefixe suffixe-maclasse maclasse--bem">toto</span>',
				1 => '<span class="maclasse maclasse-prefixe suffixe-maclasse maclasse--bem">toto</span>',
				2 => 'maclasse',
			],
			2 => [
				0 => "<span class='maclasse-prefixe suffixe-maclasse maclasse--bem maclasse'>toto</span>",
				1 => '<span class="maclasse-prefixe suffixe-maclasse maclasse--bem">toto</span>',
				2 => 'maclasse',
			],
			3 => [
				0 => "<span class='maclasse maclasse-prefixe suffixe-maclasse maclasse--bem maclasse1 maclasse2'>toto</span>",
				1 => '<span class="maclasse maclasse-prefixe suffixe-maclasse maclasse--bem">toto</span>',
				2 => 'maclasse1 maclasse maclasse2',
			],
		];
	}
}
