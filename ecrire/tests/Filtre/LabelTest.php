<?php

declare(strict_types=1);

/***************************************************************************\
 *  SPIP, Système de publication pour l'internet                           *
 *                                                                         *
 *  Copyright © avec tendresse depuis 2001                                 *
 *  Arnaud Martin, Antoine Pitrou, Philippe Rivière, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribué sous licence GNU/GPL.     *
 *  Pour plus de détails voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

namespace Spip\Test\Filtre;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;

class LabelTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		include_spip('inc/filtres');
		changer_langue('fr');
	}

	public static function providerlabelNettoyer(): array {
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

	public static function providerlabelNettoyerInitialeMajuscule(): array {
		$list = [
			'bonjour' => 'Bonjour',
			'à l’arrivée : ' => 'À l’arrivée',
			'Êtes-vous prêt·es ? ' => 'Êtes-vous prêt·es ?',
		];
		return array_map(null, array_keys($list), array_values($list));
	}

	public static function providerlabelPonctuer(): array {
		$list = [
			'bonjour' => 'bonjour :',
			'bonjour :' => 'bonjour :',
			'bonjour : ' => 'bonjour :',
			'à la bonne heure : ' => 'à la bonne heure :',
		];
		return array_map(null, array_keys($list), array_values($list));
	}

	public static function providerlabelPonctuerInitialeMajuscule(): array {
		$list = [
			'bonjour' => 'Bonjour :',
			'à la bonne heure : ' => 'À la bonne heure :',
		];
		return array_map(null, array_keys($list), array_values($list));
	}

	#[DataProvider('providerLabelNettoyer')]
	public function testLabelNettoyer($source, $expected): void {
		$this->assertEquals($expected, label_nettoyer($source, false));
	}

	#[Depends('testLabelNettoyer')]
	#[DataProvider('providerLabelNettoyerInitialeMajuscule')]
	public function testLabelNettoyerInitialeMajuscule($source, $expected): void {
		$this->assertEquals($expected, label_nettoyer($source, true));
	}

	#[Depends('testLabelNettoyer')]
	#[DataProvider('providerLabelNettoyerInitialeMajuscule')]
	public function testLabelNettoyerInitialeMajusculeParDefaut($source, $expected): void {
		$this->assertEquals($expected, label_nettoyer($source));
	}

	#[Depends('testLabelNettoyer')]
	public function testLabelPonctuerEmpty(): void {
		$this->assertEquals('', label_ponctuer('', false));
		$this->assertEquals('', label_ponctuer('', true));
	}

	#[Depends('testLabelNettoyer')]
	#[DataProvider('providerLabelPonctuer')]
	public function testLabelPonctuer($source, $expected): never {
		// TODO
		$this->markTestSkipped('NIY');
		$this->assertEquals($expected, label_ponctuer($source, false));
	}

	#[Depends('testLabelNettoyer')]
	#[DataProvider('providerLabelPonctuerInitialeMajuscule')]
	public function testLabelPonctuerInitialeMajuscule($source, $expected): void {
		$this->assertEquals($expected, label_ponctuer($source, true));
	}

	#[Depends('testLabelNettoyer')]
	#[DataProvider('providerLabelPonctuerInitialeMajuscule')]
	public function testLabelPonctuerInitialeMajusculeParDefaut($source, $expected): void {
		$this->assertEquals($expected, label_ponctuer($source));
	}
}
