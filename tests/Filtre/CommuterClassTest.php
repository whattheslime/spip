<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction commuter_class du fichier ./inc/filtres.php
 */

namespace Spip\Core\Tests\Filtre;

use PHPUnit\Framework\TestCase;

class CommuterClassTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		find_in_path('./inc/filtres.php', '', true);
	}

	/**
	 * @dataProvider providerFiltresCommuterClass
	 */
	public function testFiltresCommuterClass($expected, ...$args): void
	{
		$actual = commuter_class(...$args);
		$this->assertSame($expected, $actual);
		$this->assertEquals($expected, $actual);
	}

	public function providerFiltresCommuterClass(): array
	{
		return [
			0 => [
				0 => "<span class='maclasse-prefixe suffixe-maclasse maclasse--bem'>toto</span>",
				1 => '<span class="maclasse maclasse-prefixe suffixe-maclasse maclasse--bem">toto</span>',
				2 => 'maclasse',
			],
			1 => [
				0 => "<span class='maclasse maclasse-prefixe suffixe-maclasse maclasse--bem autreclass'>toto</span>",
				1 => '<span class="maclasse maclasse-prefixe suffixe-maclasse maclasse--bem">toto</span>',
				2 => 'autreclass',
			],
			2 => [
				0 => "<span class='maclasse-prefixe suffixe-maclasse maclasse--bem maclasse1 maclasse2'>toto</span>",
				1 => '<span class="maclasse maclasse-prefixe suffixe-maclasse maclasse--bem">toto</span>',
				2 => 'maclasse1 maclasse maclasse2',
			],
			3 => [
				0 => "<span class='maclasse maclasse--bem &lt;span class=&#034;maclasse maclasse--bem&#034;&gt;toto&lt;/span&gt;'>toto</span>",
				1 => '<span class="maclasse maclasse-prefixe suffixe-maclasse maclasse--bem">toto</span>',
				2 => '<span class="maclasse maclasse-prefixe suffixe-maclasse maclasse--bem">toto</span>',
			],
		];
	}
}
