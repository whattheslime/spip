<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction post_autobr du fichier ./inc/filtres.php
 */

namespace Spip\Test\Filtre;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class PostAutobrTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('./inc/filtres.php', '', true);
	}

	#[DataProvider('providerFiltresPostAutobr')]
	public function testFiltresPostAutobr($expected, ...$args): void {
		$actual = post_autobr(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresPostAutobr(): array {
		return [
			0 => [
				0 => 'Texte avec un
_ un retour simple à la ligne.',
				1 => 'Texte avec un
un retour simple à la ligne.',
				2 => '
_ ',
			],
			1 => [
				0 => '<cadre>cadre contenant un
retour simple (doit rester inchangé)</cadre>',
				1 => '<cadre>cadre contenant un
retour simple (doit rester inchangé)</cadre>',
				2 => '
_ ',
			],
			2 => [
				0 => 'Un double saut de ligne

 ne doit pas être modifié par post_autobr.',
				1 => 'Un double saut de ligne

 ne doit pas être modifié par post_autobr.',
				2 => '
_ ',
			],
			3 => [
				0 => '<modele123|param1=un appel de modèle
  |param2=avec retour à la ligne
  ne doit pas être modifié>',
				1 => '<modele123|param1=un appel de modèle
  |param2=avec retour à la ligne
  ne doit pas être modifié>',
				2 => '
_ ',
			],
		];
	}
}
