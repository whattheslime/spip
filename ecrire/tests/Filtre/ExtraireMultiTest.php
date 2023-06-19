<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction extraire_multi du fichier ./inc/filtres.php
 */

namespace Spip\Test\Filtre;

use PHPUnit\Framework\TestCase;

class ExtraireMultiTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('./inc/filtres.php', '', true);
		find_in_path('./inc/lang.php', '', true);
	}

	/**
	 * @dataProvider providerFiltresExtraireMulti
	 */
	public function testFiltresExtraireMulti($expected, ...$args): void {
		$actual = extraire_multi(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresExtraireMulti(): array {
		return [
			0 => [
				0 => 'english',
				1 => '<multi>[fr]francais[en]english[de]deutsch</multi>',
				2 => 'en',
			],
			1 => [
				0 => 'deutsch',
				1 => '<multi>[fr]francais[en]english[de]deutsch</multi>',
				2 => 'de',
			],
			2 => [
				0 => 'francais',
				1 => '<multi>[fr]francais[en]english[de]deutsch</multi>',
				2 => 'fr',
			],
			3 => [
				0 => "<span lang='fr'>francais</span>",
				1 => '<multi>[fr]francais[en]english[de]deutsch</multi>',
				2 => 'it',
			],
			4 => [
				0 => "<span lang='fr' dir='ltr'>francais</span>",
				1 => '<multi>[fr]francais[en]english[de]deutsch</multi>',
				2 => 'ar',
			],
			5 => [
				0 => 'english',
				1 => '<multi>[fr]francais[en]english[de]deutsch</multi>',
				2 => 'en',
				3 => true,
			],
			6 => [
				0 => 'deutsch',
				1 => '<multi>[fr]francais[en]english[de]deutsch</multi>',
				2 => 'de',
				3 => true,
			],
			7 => [
				0 => 'francais',
				1 => '<multi>[fr]francais[en]english[de]deutsch</multi>',
				2 => 'fr',
				3 => true,
			],
			8 => [
				0 => '<span class="base64multi" title="ZnJhbmNhaXM=" lang="fr"></span>',
				1 => '<multi>[fr]francais[en]english[de]deutsch</multi>',
				2 => 'it',
				3 => true,
			],
			9 => [
				0 => '<span class="base64multi" title="ZnJhbmNhaXM=" lang="fr" dir="ltr"></span>',
				1 => '<multi>[fr]francais[en]english[de]deutsch</multi>',
				2 => 'ar',
				3 => true,
			],
		];
	}
}
