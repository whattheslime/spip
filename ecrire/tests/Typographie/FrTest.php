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

namespace Spip\Test\Typographie;

use PHPUnit\Framework\TestCase;

class FrTest extends TestCase
{
	protected static $lang = 'fr';

	protected static $root = 'ecrire/';

	protected static $fnTypographie = 'typographie_fr_dist';

	public static function setUpBeforeClass(): void
	{
		include_spip('inc/texte');
		changer_langue(static::$lang);
		include_spip(static::$root . 'typographie/' . static::$lang);
	}

	public static function providerBase()
	{
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
	public function testBase($source, $expected)
	{
		$typographie = static::$fnTypographie;
		$this->assertEquals($expected, $typographie($source));
	}

	public static function providerAddsSpaceOnPonctuation()
	{
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
	public function testAddsSpaceOnPonctuation($source, $expected)
	{
		$typographie = static::$fnTypographie;
		$this->assertEquals($expected, $typographie($source));
	}

	public static function providerChangeSpaceToNonBreakingSpaceOnPonctuation()
	{
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
	public function testChangeSpaceToNonBreakingSpaceOnPonctuation($source, $expected)
	{
		$typographie = static::$fnTypographie;
		$this->assertEquals($expected, $typographie($source));
	}

	public static function providerChangeTildeToNonBreakingSpace()
	{
		$list = [
			'bonjour~toi' => 'bonjour&nbsp;toi',
			'bonjour~le~monde' => 'bonjour&nbsp;le&nbsp;monde',
		];
		return array_map(null, array_keys($list), array_values($list));
	}

	/**
	 * @dataProvider providerChangeTildeToNonBreakingSpace
	 */
	public function testChangeTildeToNonBreakingSpace($source, $expected)
	{
		$typographie = static::$fnTypographie;
		$this->assertEquals($expected, $typographie($source));
	}

	public static function providerChangeTildeToNonBreakingSpaceOnPonctuation()
	{
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
	public function testChangeTildeToNonBreakingSpaceOnPonctuation($source, $expected)
	{
		$typographie = static::$fnTypographie;
		$this->assertEquals($expected, $typographie($source));
	}

	public static function providerKeepNonBreakingSpaceEntity()
	{
		$list = [
			'bonjour&nbsp;toi' => 'bonjour&nbsp;toi',
			'bonjour&nbsp;toi&nbsp;!' => 'bonjour&nbsp;toi&nbsp;!',
		];
		return array_map(null, array_keys($list), array_values($list));
	}

	/**
	 * @dataProvider providerKeepNonBreakingSpaceEntity
	 */
	public function testKeepNonBreakingSpaceEntity($source, $expected)
	{
		$typographie = static::$fnTypographie;
		$this->assertEquals($expected, $typographie($source));
	}

	public static function providerKeepNonBreakingSpaceUtf()
	{
		$list = [
			'bonjour toi' => 'bonjour toi',
			'bonjour toi !' => 'bonjour toi !',
		];
		return array_map(null, array_keys($list), array_values($list));
	}

	/**
	 * @dataProvider providerKeepNonBreakingSpaceUtf
	 */
	public function testKeepNonBreakingSpaceUtf($source, $expected)
	{
		$typographie = static::$fnTypographie;
		// TODO
		$this->markTestSkipped('NIY');
		$this->assertEquals($expected, $typographie($source));
	}

	public static function providerKeepDoubleTwoPoints()
	{
		$list = [
			'bonjour::' => 'bonjour::',
			'::1/128' => '::1/128',
			'ff00::/8' => 'ff00::/8',
		];
		return array_map(null, array_keys($list), array_values($list));
	}

	/**
	 * @dataProvider providerKeepDoubleTwoPoints
	 */
	public function testKeepDoubleTwoPoints($source, $expected)
	{
		$typographie = static::$fnTypographie;
		// TODO
		$this->markTestSkipped('NIY');
		$this->assertEquals($expected, $typographie($source));
	}
}
