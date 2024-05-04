<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction svg_nettoyer du fichier ./inc/svg.php
 */

namespace Spip\Test\Svg;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class NettoyerTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('./inc/svg.php', '', true);
	}

	#[DataProvider('providerNettoyer')]
	public function testNettoyer($expected, ...$args): void {
		$actual = svg_nettoyer(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerNettoyer(): array {
		return [
			'bom' => [
				// Expected
				'toto',
				// Provided
				"\xEF\xBB\xBFtoto",
			],
			'entete' => [
				// Expected
				'<svg xmlns="http://www.w3.org/2000/svg"></svg>',
				// Provided
				'<?xml version="1.0" encoding="utf-8"?><svg xmlns="http://www.w3.org/2000/svg"></svg>',
			],
			'ajout_xmlns' => [
				// Expected
				'<svg xmlns="http://www.w3.org/2000/svg"></svg>',
				// Provided
				'<svg></svg>',
			],
			'supprimer_commentaire' => [
				// Expected
				'<hop></hop>',
				// Provided
				'<hop><!--- ceci est un commentaire--></hop>',
			],
		];
	}
}
