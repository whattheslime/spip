<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction extraire_multi du fichier ./inc/filtres.php
 */

namespace Spip\Test\Filtre;

use PHPUnit\Framework\TestCase;

class ExtraireBalisesTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('./inc/filtres.php', '', true);
		find_in_path('./inc/lang.php', '', true);
	}

	/**
	 * @dataProvider providerFiltresExtraireBalises
	 */
	public function testFiltresExtraireBalises($expected, ...$args): void {
		$actual = extraire_balises(...$args);
		$this->assertSame($expected, $actual);
	}

	/**
	 * @dataProvider providerFiltresExtraireBalises
	 */
	public function testFiltresExtraireBalise($expected, ...$args): void {
		// extraire_balise doit renvoyer le premier résultat de extraire_balises
		// sauf si on fournit un tableau de chaine en entree, ce doit être alors le premier résultat de chaque sous-tableau
		if (count($args) === 3) {
			$options = array_pop($args);
			$profondeur = ($options['profondeur'] ?? 1);
			$args[] = $profondeur;
		}
		$first_result = reset($expected);
		if (is_array($first_result)) {
			$first_result = [];
			foreach ($expected as $e) {
				$first_result[] = (empty($e) ? '' : reset($e));
			}
			$expected = $first_result;
		} else {
			$expected = (empty($expected) ? '' : $first_result);
		}
		$actual = extraire_balise(...$args);
		$this->assertSame($expected, $actual);
	}

	public function testFiltresExtraireBalisesMediaRss(): void {

		$rss = file_get_contents(dirname(__DIR__) . '/Fixtures/data/dailymotion.rss');
		if (empty($rss)) {
			$this->markTestSkipped();
		}

		$balises_media = extraire_balises($rss, 'media:content');
		$this->assertIsArray($balises_media);
		$this->assertEquals(count($balises_media), 40);
	}

	public static function providerFiltresExtraireBalises(): array {

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
			],
			[
				['<a href="truc">chose</a>'],
				'allo <a href="truc">chose</a>',
				'a'
			],
			[
				['<a href="truc" />'],
				'allo <a href="truc" />',
				'a'
			],
			[
				["<a\nhref='truc' />"],
				'allo' . "\n" . " <a\nhref='truc' />",
				'a'
			],
			[
				[['<a href="1">'], ['<a href="2">']],
				['allo <a href="1">', 'allo <a href="2">'],
				'a'
			],
			[
				['<a href="truc">chose</a>'],
				'bonjour <a href="truc">chose</a> machin',
				'a'
			],
			[
				['<a href="truc">chose</a>', '<A href="truc">machin</a>'],
				'bonjour <a href="truc">chose</a> machin <A href="truc">machin</a>',
				'a'
			],
			[
				['<a href="truc">'],
				'bonjour <a href="truc">chose',
				'a'
			],
			[
				['<a href="truc"/>'],
				'<a href="truc"/>chose</a>',
				'a'
			],
			[
				['<a>chose</a>'],
				'<a>chose</a>',
				'a'
			],
			[
				[],
				'allo <a href="truc">chose</a>',
				'b'
			],
			[
				[],
				'allo <a href="truc" />',
				'b'
			],
			[
				[],
				'allo' . "\n" . " <a\nhref='truc' />",
				'b'
			],
			[
				[[], []],
				['allo <a href="1">', 'allo <a href="2">'],
				'b'
			],
			[
				[],
				'bonjour <a href="truc">chose</a> machin',
				'b'
			],
			[
				[],
				'bonjour <a href="truc">chose</a> machin <A href="truc">machin</a>',
				'b'
			],
			[
				[],
				'bonjour <a href="truc">chose',
				'b'
			],
			[
				[],
				'<a href="truc"/>chose</a>',
				'b'
			],
			[
				[],
				'<a>chose</a>',
				'b'
			],
			'div_2' => [
				['<div class="message">Hello <div class="inside">World!</div></div>'],
				'<div class="message">Hello <div class="inside">World!</div></div>',
				'div'
			],
			'div_3' => [
				['<div class="message">Hello <div class="inside">World<div>!</div></div></div>'],
				'<div class="message">Hello <div class="inside">World<div>!</div></div></div>',
				'div'
			],
			'div_3_et_autofermante_1' => [
				['<div class="message">Hello <div class="inside">World<div>! <div/> </div></div></div>'],
				'<div class="message">Hello <div class="inside">World<div>! <div/> </div></div></div>',
				'div'
			],
			'div_3_et_autofermante_2' => [
				['<div class="message">Hello <div class="inside">World<div>!<div/></div><div/></div></div>'],
				'<div class="message">Hello <div class="inside">World<div>!<div/></div><div/></div></div>',
				'div'
			],
			'div_3_et_autofermante_3' => [
				['<div class="message">Hello <div class="inside">World<div>!<div/></div><div/></div><div/></div>'],
				'<div class="message">Hello <div class="inside">World<div>!<div/></div><div/></div><div/></div>',
				'div'
			],
			'div_3_et_autofermante_4' => [
				['<div class="message">Hello <div class="inside">World<div>!<div/></div><div/></div><div/></div>', '<div/>'],
				'<div class="message">Hello <div class="inside">World<div>!<div/></div><div/></div><div/></div><div/>',
				'div'
			],
			'div_3_et_autofermante_5' => [
				['<div/>', '<div class="message">Hello <div class="inside">World<div>!<div/></div><div/></div><div/></div>', '<div/>'],
				'<div/><div class="message">Hello <div class="inside">World<div>!<div/></div><div/></div><div/></div><div/>',
				'div'
			],
			'div_3_et_autofermante_5_nbmax' => [
				['<div/>'],
				'<div/><div class="message">Hello <div class="inside">World<div>!<div/></div><div/></div><div/></div><div/>',
				'div',
				['nb_max' => 1]
			],
			'div_3_et_autofermante_5_profondeur_2' => [
				['<div class="hello">Hello</div>', '<div class="world">World</div>', '<div>!</div>', '<div/>'],
				'<div class="message"><div class="hello">Hello</div> <div class="world">World</div><div>!</div> <div/></div>',
				'div',
				['profondeur' => '2'],
			],
			'div_3_et_autofermante_5_profondeur_3' => [
				[],
				'<div class="message"><div class="hello">Hello</div> <div class="world">World</div><div>!</div> <div/></div>',
				'div',
				['profondeur' => '3'],
			],
			'div_3_et_autofermante_5_profondeur_3_2' => [
				['<div>lo</div>'],
				'<div class="message"><div class="hello">Hel<div>lo</div></div> <div class="world">World</div><div>!</div> <div/></div>',
				'div',
				['profondeur' => '3'],
			],
		];
	}
}
