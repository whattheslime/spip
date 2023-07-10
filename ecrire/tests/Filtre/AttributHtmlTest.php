<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction ajouter_class du fichier ./inc/filtres.php
 */

namespace Spip\Test\Filtre;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class AttributHtmlTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('./inc/filtres.php', '', true);
	}

	#[DataProvider('providerAttributHtml')]
	public function testAttributHtml($expected, $texte): void {
		$actual = attribut_html($texte);
		$this->assertSame($expected, $actual);
	}

	public static function providerAttributHtml(): array {
		return [
			0 => [
				'expected' => 'aujourd&#039;hui &gt; &#034;30&#034; &rarr; 50',
				'texte' => 'aujourd\'hui > "30" &rarr; <a href=\'http://www.spip.net\'>50</a>',
			],
			1 => [
				'expected' => 'L&#039;histoire &#039;tr&#232;s&#039; &#034;folle&#034; des m&#233;tas en iitalik',
				'texte' => 'L\'histoire \'tr&egrave;s\' "folle" <strong>des</strong>&nbsp;m&eacute;tas<p>en <em>ii</em>talik</p>',
			],
			2 => [
				'expected' => 'allons &#224; la mer',
				'texte' => 'allons ' . chr(195) . chr(160) . ' la mer', // le a` risque de matcher \s
			],
		];
	}
}
