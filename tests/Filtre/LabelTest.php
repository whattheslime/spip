<?php

/***************************************************************************\
 *  SPIP, Système de publication pour l'internet                           *
 *                                                                         *
 *  Copyright © avec tendresse depuis 2001                                 *
 *  Arnaud Martin, Antoine Pitrou, Philippe Rivière, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribué sous licence GNU/GPL.     *
 *  Pour plus de détails voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

namespace Spip\Core\Tests\Filtre;

use PHPUnit\Framework\TestCase;

class LabelTest extends TestCase {

	public static function setUpBeforeClass(): void{
		include_spip('inc/filtres');
		changer_langue('fr');
	}

	public function providerlabelNettoyer() {
		$list = [
			'bonjour' => 'bonjour',
			'bonjour ' => 'bonjour',
			'bonjour : ' => 'bonjour',
			"bonjour\t:\t" => 'bonjour',
			"bonjour\n:\n" => 'bonjour',
			"boujour\v:\v" => 'boujour',
			"bonjour\u{a0}:\u{a0}" => 'bonjour',
			'bonjour&nbsp;:&nbsp;' => 'bonjour',
			'Ah là là' => 'Ah là là',
		];
		return array_map(null, array_keys($list), array_values($list));
	}


	public function providerlabelNettoyerInitialeMajuscule() {
		$list = [
			'bonjour' => 'Bonjour',
			'à l’arrivée : ' => 'À l’arrivée',
			'Êtes-vous prêt·es ? ' => 'Êtes-vous prêt·es ?',
		];
		return array_map(null, array_keys($list), array_values($list));
	}

	public function providerlabelPonctuer() {
		$list = [
			'bonjour' => 'bonjour :',
			'bonjour :' => 'bonjour :',
			'bonjour : ' => 'bonjour :',
			'à la bonne heure : ' => 'à la bonne heure :',
		];
		return array_map(null, array_keys($list), array_values($list));
	}

	public function providerlabelPonctuerInitialeMajuscule() {
		$list = [
			'bonjour' => 'Bonjour :',
			'à la bonne heure : ' => 'À la bonne heure :',
		];
		return array_map(null, array_keys($list), array_values($list));
	}

	/**
	 * @dataProvider providerLabelNettoyer
	 */
	public function testLabelNettoyer($source, $expected) {
		$this->assertEquals($expected, label_nettoyer($source, false));
	}

	/**
	 * @depends testLabelNettoyer
	 * @dataProvider providerLabelNettoyerInitialeMajuscule
	 */
	public function testLabelNettoyerInitialeMajuscule($source, $expected) {
		$this->assertEquals($expected, label_nettoyer($source, true));
	}

	/**
	 * @depends testLabelNettoyer
	 * @dataProvider providerLabelNettoyerInitialeMajuscule
	 */
	public function testLabelNettoyerInitialeMajusculeParDefaut($source, $expected) {
		$this->assertEquals($expected, label_nettoyer($source));
	}

	/**
	 * @depends testLabelNettoyer
	 * @dataProvider providerLabelPonctuer
	 */
	public function testLabelPonctuer($source, $expected) {
		// TODO
		$this->markTestSkipped('NIY');
		$this->assertEquals($expected, label_ponctuer($source, false));
	}

	/**
	 * @depends testLabelPonctuer
	 * @dataProvider providerLabelPonctuerInitialeMajuscule
	 */
	public function testLabelPonctuerInitialeMajuscule($source, $expected) {
		$this->assertEquals($expected, label_ponctuer($source, true));
	}

	/**
	 * @depends testLabelPonctuer
	 * @dataProvider providerLabelPonctuerInitialeMajuscule
	 */
	public function testLabelPonctuerInitialeMajusculeParDefaut($source, $expected) {
		$this->assertEquals($expected, label_ponctuer($source));
	}

}
