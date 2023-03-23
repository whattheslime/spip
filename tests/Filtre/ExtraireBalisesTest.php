<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction extraire_multi du fichier ./inc/filtres.php
 */

namespace Spip\Core\Tests\Filtre;

use PHPUnit\Framework\TestCase;

class ExtraireBalisesTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		find_in_path('./inc/filtres.php', '', true);
		find_in_path('./inc/lang.php', '', true);
	}

	public function testFiltresExtraireBalisesMediaRss(): void
	{

		$rss = file_get_contents(dirname(__DIR__) . '/Fixtures/data/dailymotion.rss');
		if (empty($rss)) {
			$this->markTestSkipped();
		}

		$balises_media = extraire_balises($rss, 'media:content');
		$this->assertIsArray($balises_media);
		$this->assertEquals(count($balises_media), 40);
	}


	/**
	 * @dataProvider providerFiltresExtraireBalises
	 */
	public function testFiltresExtraireBalises($expected, ...$args): void
	{
		$actual = extraire_balises(...$args);
		$this->assertSame($expected, $actual);
		$this->assertEquals($expected, $actual);
	}

	public function providerFiltresExtraireBalises(): array
	{

		return [
			[
				['<a href="truc">chose</a>'],
				'allo <a href="truc">chose</a>'
			],
			[
				['<a href="truc" />'],
				'allo <a href="truc" />'
			],
			[
				["<a\nhref='truc' />"],
				'allo' . "\n" . " <a\nhref='truc' />"
			],
			[
				[['<a href="1">'], ['<a href="2">']],
				['allo <a href="1">', 'allo <a href="2">']
			],
			[
				['<a href="truc">chose</a>'],
				'bonjour <a href="truc">chose</a> machin'
			],
			[
				['<a href="truc">chose</a>', '<A href="truc">machin</a>'],
				'bonjour <a href="truc">chose</a> machin <A href="truc">machin</a>',
			],
			[
				['<a href="truc">'],
				'bonjour <a href="truc">chose'
			],
			[
				['<a href="truc"/>'],
				'<a href="truc"/>chose</a>'
			],
			[
				['<a>chose</a>'],
				'<a>chose</a>'
			]
		];
	}
}
