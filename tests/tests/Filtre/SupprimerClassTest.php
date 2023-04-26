<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction supprimer_class du fichier ./inc/filtres.php
 */

namespace Spip\Core\Tests\Filtre;

use PHPUnit\Framework\TestCase;

class SupprimerClassTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		find_in_path('./inc/filtres.php', '', true);
	}

	/**
	 * @dataProvider providerFiltresSupprimerClass
	 */
	public function testFiltresSupprimerClass($expected, ...$args): void
	{
		$actual = supprimer_class(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresSupprimerClass(): array
	{
		return [
			0 => [
				0 => "<span class='maclasse-prefixe suffixe-maclasse maclasse--bem'>toto</span>",
				1 => '<span class="maclasse maclasse-prefixe suffixe-maclasse maclasse--bem">toto</span>',
				2 => 'maclasse',
			],
			1 => [
				0 => '<span class="maclasse maclasse-prefixe suffixe-maclasse maclasse--bem">toto</span>',
				1 => '<span class="maclasse maclasse-prefixe suffixe-maclasse maclasse--bem">toto</span>',
				2 => 'autreclass',
			],
			2 => [
				0 => "<span class='maclasse-prefixe suffixe-maclasse maclasse--bem'>toto</span>",
				1 => '<span class="maclasse maclasse-prefixe suffixe-maclasse maclasse--bem">toto</span>',
				2 => 'maclasse1 maclasse maclasse2',
			],
			3 => [
				0 => "<span class='maclasse suffixe-maclasse'>toto</span>",
				1 => '<span class="maclasse maclasse-prefixe suffixe-maclasse maclasse--bem">toto</span>',
				2 => 'maclasse-prefixe maclasse--bem',
			],
			4 => [
				0 => "<span class='maclasse-prefixe'>toto</span>",
				1 => '<span class="maclasse maclasse-prefixe">toto</span>',
				2 => 'maclasse',
			],
			5 => [
				0 => "<span class='maclasse'>toto</span>",
				1 => '<span class="maclasse maclasse-prefixe">toto</span>',
				2 => 'maclasse-prefixe',
			],
			6 => [
				0 => '<span>toto</span>',
				1 => '<span class="maclasse maclasse-prefixe">toto</span>',
				2 => 'maclasse maclasse-prefixe',
			],
			7 => [
				0 => '<span>toto</span>',
				1 => '<span class="maclasse maclasse-prefixe">toto</span>',
				2 => 'maclasse-prefixe maclasse',
			],
		];
	}
}
