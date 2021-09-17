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

namespace Spip\Core\Tests;

use PHPUnit\Framework\TestCase;


/**
 * TypographieFrTextwheelTest test
 */
class TypographieFrTextwheelTest extends TestCase {

	private static $lang = 'fr';
	private static $fnTypographie;

	public static function setUpBeforeClass(): void{
		include_spip('inc/texte');
		changer_langue(self::$lang);
		include_spip('typographie/' . self::$lang);
		self::$fnTypographie = 'typographie_fr';
	}

	public function providerBase() {
		$list = [
			'bonjour' => 'bonjour',
			'bonjour ' => 'bonjour ',
			'bonjour à toutes et tous' => 'bonjour à toutes et tous',
		];
		return array_map(null, array_keys($list), array_values($list));
	}

	/** 
	 * @dataProvider providerBase
	 */
	public function testBase($source, $expected) {
		$typographie = self::$fnTypographie;
		$this->assertEquals($expected, $typographie($source));
	}


	public function providerAddsSpaceOnPonctuation() {
		$list = [
			'bonjour:' => 'bonjour&nbsp;:',
			'bonjour;' => 'bonjour&nbsp;;',
			'bonjour!' => 'bonjour&nbsp;!',
			'bonjour?' => 'bonjour&nbsp;?',
		];
		return array_map(null, array_keys($list), array_values($list));
	}

	/** 
	 * @dataProvider providerAddsSpaceOnPonctuation
	 */
	public function testAddsSpaceOnPonctuation($source, $expected) {
		$typographie = self::$fnTypographie;
		$this->assertEquals($expected, $typographie($source));
	}

	public function providerChangeSpaceToNonBreakingSpaceOnPonctuation() {
		$list = [
			'bonjour :' => 'bonjour&nbsp;:',
			'bonjour ;' => 'bonjour&nbsp;;',
			'bonjour !' => 'bonjour&nbsp;!',
			'bonjour ?' => 'bonjour&nbsp;?',
		];
		return array_map(null, array_keys($list), array_values($list));
	}

	/** 
	 * @dataProvider providerChangeSpaceToNonBreakingSpaceOnPonctuation
	 */
	public function testChangeSpaceToNonBreakingSpaceOnPonctuation($source, $expected) {
		$typographie = self::$fnTypographie;
		$this->assertEquals($expected, $typographie($source));
	}

	public function providerChangeTildeToNonBreakingSpace() {
		$list = [
			'bonjour~toi' => 'bonjour&nbsp;toi',
			'bonjour~le~monde' => 'bonjour&nbsp;le&nbsp;monde',
		];
		return array_map(null, array_keys($list), array_values($list));
	}

	/** 
	 * @dataProvider providerChangeTildeToNonBreakingSpace
	 */
	public function testChangeTildeToNonBreakingSpace($source, $expected) {
		$typographie = self::$fnTypographie;
		$this->assertEquals($expected, $typographie($source));
	}

	public function providerChangeTildeToNonBreakingSpaceOnPonctuation() {
		$list = [
			'bonjour~:' => 'bonjour&nbsp;:',
			'bonjour~;' => 'bonjour&nbsp;;',
			'bonjour~!' => 'bonjour&nbsp;!',
			'bonjour~?' => 'bonjour&nbsp;?',
		];
		return array_map(null, array_keys($list), array_values($list));
	}

	/** 
	 * @dataProvider providerChangeTildeToNonBreakingSpaceOnPonctuation
	 */
	public function testChangeTildeToNonBreakingSpaceOnPonctuation($source, $expected) {
		$typographie = self::$fnTypographie;
		$this->assertEquals($expected, $typographie($source));
	}

	public function providerDontChangeDoubleTwoPoints() {
		$list = [
			'bonjour::' => 'bonjour::',
			'::1/128' => '::1/128',
			'ff00::/8' => 'ff00::/8',
		];
		return array_map(null, array_keys($list), array_values($list));
	}

	/** 
	 * @dataProvider providerDontChangeDoubleTwoPoints
	 */
	public function testDontChangeDoubleTwoPoints($source, $expected) {
		$typographie = self::$fnTypographie;
		$this->assertEquals($expected, $typographie($source));
	}
}