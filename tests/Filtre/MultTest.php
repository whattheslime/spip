<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction mult du fichier inc/filtres.php
 */

namespace Spip\Core\Tests\Filtre;

use PHPUnit\Framework\TestCase;

class MultTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		find_in_path('inc/filtres.php', '', true);
	}

	/**
	 * @dataProvider providerFiltresMult
	 */
	public function testFiltresMult($expected, ...$args): void
	{
		$actual = mult(...$args);
		$this->assertSame($expected, $actual);
		$this->assertEquals($expected, $actual);
	}

	public static function providerFiltresMult(): array
	{
		return [
			0 => [
				0 => 0,
				1 => 0,
				2 => 0,
			],
			1 => [
				0 => 0,
				1 => 0,
				2 => -1,
			],
			2 => [
				0 => 0,
				1 => 0,
				2 => 1,
			],
			3 => [
				0 => 0,
				1 => 0,
				2 => 2,
			],
			4 => [
				0 => 0,
				1 => 0,
				2 => 3,
			],
			5 => [
				0 => 0,
				1 => 0,
				2 => 4,
			],
			6 => [
				0 => 0,
				1 => 0,
				2 => 5,
			],
			7 => [
				0 => 0,
				1 => 0,
				2 => 6,
			],
			8 => [
				0 => 0,
				1 => 0,
				2 => 7,
			],
			9 => [
				0 => 0,
				1 => 0,
				2 => 10,
			],
			10 => [
				0 => 0,
				1 => 0,
				2 => 20,
			],
			11 => [
				0 => 0,
				1 => 0,
				2 => 30,
			],
			12 => [
				0 => 0,
				1 => 0,
				2 => 50,
			],
			13 => [
				0 => 0,
				1 => 0,
				2 => 100,
			],
			14 => [
				0 => 0,
				1 => 0,
				2 => 1000,
			],
			15 => [
				0 => 0,
				1 => 0,
				2 => 10000,
			],
			16 => [
				0 => 0,
				1 => -1,
				2 => 0,
			],
			17 => [
				0 => 1,
				1 => -1,
				2 => -1,
			],
			18 => [
				0 => -1,
				1 => -1,
				2 => 1,
			],
			19 => [
				0 => -2,
				1 => -1,
				2 => 2,
			],
			20 => [
				0 => -3,
				1 => -1,
				2 => 3,
			],
			21 => [
				0 => -4,
				1 => -1,
				2 => 4,
			],
			22 => [
				0 => -5,
				1 => -1,
				2 => 5,
			],
			23 => [
				0 => -6,
				1 => -1,
				2 => 6,
			],
			24 => [
				0 => -7,
				1 => -1,
				2 => 7,
			],
			25 => [
				0 => -10,
				1 => -1,
				2 => 10,
			],
			26 => [
				0 => -20,
				1 => -1,
				2 => 20,
			],
			27 => [
				0 => -30,
				1 => -1,
				2 => 30,
			],
			28 => [
				0 => -50,
				1 => -1,
				2 => 50,
			],
			29 => [
				0 => -100,
				1 => -1,
				2 => 100,
			],
			30 => [
				0 => -1000,
				1 => -1,
				2 => 1000,
			],
			31 => [
				0 => -10000,
				1 => -1,
				2 => 10000,
			],
			32 => [
				0 => 0,
				1 => 1,
				2 => 0,
			],
			33 => [
				0 => -1,
				1 => 1,
				2 => -1,
			],
			34 => [
				0 => 1,
				1 => 1,
				2 => 1,
			],
			35 => [
				0 => 2,
				1 => 1,
				2 => 2,
			],
			36 => [
				0 => 3,
				1 => 1,
				2 => 3,
			],
			37 => [
				0 => 4,
				1 => 1,
				2 => 4,
			],
			38 => [
				0 => 5,
				1 => 1,
				2 => 5,
			],
			39 => [
				0 => 6,
				1 => 1,
				2 => 6,
			],
			40 => [
				0 => 7,
				1 => 1,
				2 => 7,
			],
			41 => [
				0 => 10,
				1 => 1,
				2 => 10,
			],
			42 => [
				0 => 20,
				1 => 1,
				2 => 20,
			],
			43 => [
				0 => 30,
				1 => 1,
				2 => 30,
			],
			44 => [
				0 => 50,
				1 => 1,
				2 => 50,
			],
			45 => [
				0 => 100,
				1 => 1,
				2 => 100,
			],
			46 => [
				0 => 1000,
				1 => 1,
				2 => 1000,
			],
			47 => [
				0 => 10000,
				1 => 1,
				2 => 10000,
			],
			48 => [
				0 => 0,
				1 => 2,
				2 => 0,
			],
			49 => [
				0 => -2,
				1 => 2,
				2 => -1,
			],
			50 => [
				0 => 2,
				1 => 2,
				2 => 1,
			],
			51 => [
				0 => 4,
				1 => 2,
				2 => 2,
			],
			52 => [
				0 => 6,
				1 => 2,
				2 => 3,
			],
			53 => [
				0 => 8,
				1 => 2,
				2 => 4,
			],
			54 => [
				0 => 10,
				1 => 2,
				2 => 5,
			],
			55 => [
				0 => 12,
				1 => 2,
				2 => 6,
			],
			56 => [
				0 => 14,
				1 => 2,
				2 => 7,
			],
			57 => [
				0 => 20,
				1 => 2,
				2 => 10,
			],
			58 => [
				0 => 40,
				1 => 2,
				2 => 20,
			],
			59 => [
				0 => 60,
				1 => 2,
				2 => 30,
			],
			60 => [
				0 => 100,
				1 => 2,
				2 => 50,
			],
			61 => [
				0 => 200,
				1 => 2,
				2 => 100,
			],
			62 => [
				0 => 2000,
				1 => 2,
				2 => 1000,
			],
			63 => [
				0 => 20000,
				1 => 2,
				2 => 10000,
			],
			64 => [
				0 => 0,
				1 => 3,
				2 => 0,
			],
			65 => [
				0 => -3,
				1 => 3,
				2 => -1,
			],
			66 => [
				0 => 3,
				1 => 3,
				2 => 1,
			],
			67 => [
				0 => 6,
				1 => 3,
				2 => 2,
			],
			68 => [
				0 => 9,
				1 => 3,
				2 => 3,
			],
			69 => [
				0 => 12,
				1 => 3,
				2 => 4,
			],
			70 => [
				0 => 15,
				1 => 3,
				2 => 5,
			],
			71 => [
				0 => 18,
				1 => 3,
				2 => 6,
			],
			72 => [
				0 => 21,
				1 => 3,
				2 => 7,
			],
			73 => [
				0 => 30,
				1 => 3,
				2 => 10,
			],
			74 => [
				0 => 60,
				1 => 3,
				2 => 20,
			],
			75 => [
				0 => 90,
				1 => 3,
				2 => 30,
			],
			76 => [
				0 => 150,
				1 => 3,
				2 => 50,
			],
			77 => [
				0 => 300,
				1 => 3,
				2 => 100,
			],
			78 => [
				0 => 3000,
				1 => 3,
				2 => 1000,
			],
			79 => [
				0 => 30000,
				1 => 3,
				2 => 10000,
			],
			80 => [
				0 => 0,
				1 => 4,
				2 => 0,
			],
			81 => [
				0 => -4,
				1 => 4,
				2 => -1,
			],
			82 => [
				0 => 4,
				1 => 4,
				2 => 1,
			],
			83 => [
				0 => 8,
				1 => 4,
				2 => 2,
			],
			84 => [
				0 => 12,
				1 => 4,
				2 => 3,
			],
			85 => [
				0 => 16,
				1 => 4,
				2 => 4,
			],
			86 => [
				0 => 20,
				1 => 4,
				2 => 5,
			],
			87 => [
				0 => 24,
				1 => 4,
				2 => 6,
			],
			88 => [
				0 => 28,
				1 => 4,
				2 => 7,
			],
			89 => [
				0 => 40,
				1 => 4,
				2 => 10,
			],
			90 => [
				0 => 80,
				1 => 4,
				2 => 20,
			],
			91 => [
				0 => 120,
				1 => 4,
				2 => 30,
			],
			92 => [
				0 => 200,
				1 => 4,
				2 => 50,
			],
			93 => [
				0 => 400,
				1 => 4,
				2 => 100,
			],
			94 => [
				0 => 4000,
				1 => 4,
				2 => 1000,
			],
			95 => [
				0 => 40000,
				1 => 4,
				2 => 10000,
			],
			96 => [
				0 => 0,
				1 => 5,
				2 => 0,
			],
			97 => [
				0 => -5,
				1 => 5,
				2 => -1,
			],
			98 => [
				0 => 5,
				1 => 5,
				2 => 1,
			],
			99 => [
				0 => 10,
				1 => 5,
				2 => 2,
			],
			100 => [
				0 => 15,
				1 => 5,
				2 => 3,
			],
			101 => [
				0 => 20,
				1 => 5,
				2 => 4,
			],
			102 => [
				0 => 25,
				1 => 5,
				2 => 5,
			],
			103 => [
				0 => 30,
				1 => 5,
				2 => 6,
			],
			104 => [
				0 => 35,
				1 => 5,
				2 => 7,
			],
			105 => [
				0 => 50,
				1 => 5,
				2 => 10,
			],
			106 => [
				0 => 100,
				1 => 5,
				2 => 20,
			],
			107 => [
				0 => 150,
				1 => 5,
				2 => 30,
			],
			108 => [
				0 => 250,
				1 => 5,
				2 => 50,
			],
			109 => [
				0 => 500,
				1 => 5,
				2 => 100,
			],
			110 => [
				0 => 5000,
				1 => 5,
				2 => 1000,
			],
			111 => [
				0 => 50000,
				1 => 5,
				2 => 10000,
			],
			112 => [
				0 => 0,
				1 => 6,
				2 => 0,
			],
			113 => [
				0 => -6,
				1 => 6,
				2 => -1,
			],
			114 => [
				0 => 6,
				1 => 6,
				2 => 1,
			],
			115 => [
				0 => 12,
				1 => 6,
				2 => 2,
			],
			116 => [
				0 => 18,
				1 => 6,
				2 => 3,
			],
			117 => [
				0 => 24,
				1 => 6,
				2 => 4,
			],
			118 => [
				0 => 30,
				1 => 6,
				2 => 5,
			],
			119 => [
				0 => 36,
				1 => 6,
				2 => 6,
			],
			120 => [
				0 => 42,
				1 => 6,
				2 => 7,
			],
			121 => [
				0 => 60,
				1 => 6,
				2 => 10,
			],
			122 => [
				0 => 120,
				1 => 6,
				2 => 20,
			],
			123 => [
				0 => 180,
				1 => 6,
				2 => 30,
			],
			124 => [
				0 => 300,
				1 => 6,
				2 => 50,
			],
			125 => [
				0 => 600,
				1 => 6,
				2 => 100,
			],
			126 => [
				0 => 6000,
				1 => 6,
				2 => 1000,
			],
			127 => [
				0 => 60000,
				1 => 6,
				2 => 10000,
			],
			128 => [
				0 => 0,
				1 => 7,
				2 => 0,
			],
			129 => [
				0 => -7,
				1 => 7,
				2 => -1,
			],
			130 => [
				0 => 7,
				1 => 7,
				2 => 1,
			],
			131 => [
				0 => 14,
				1 => 7,
				2 => 2,
			],
			132 => [
				0 => 21,
				1 => 7,
				2 => 3,
			],
			133 => [
				0 => 28,
				1 => 7,
				2 => 4,
			],
			134 => [
				0 => 35,
				1 => 7,
				2 => 5,
			],
			135 => [
				0 => 42,
				1 => 7,
				2 => 6,
			],
			136 => [
				0 => 49,
				1 => 7,
				2 => 7,
			],
			137 => [
				0 => 70,
				1 => 7,
				2 => 10,
			],
			138 => [
				0 => 140,
				1 => 7,
				2 => 20,
			],
			139 => [
				0 => 210,
				1 => 7,
				2 => 30,
			],
			140 => [
				0 => 350,
				1 => 7,
				2 => 50,
			],
			141 => [
				0 => 700,
				1 => 7,
				2 => 100,
			],
			142 => [
				0 => 7000,
				1 => 7,
				2 => 1000,
			],
			143 => [
				0 => 70000,
				1 => 7,
				2 => 10000,
			],
			144 => [
				0 => 0,
				1 => 10,
				2 => 0,
			],
			145 => [
				0 => -10,
				1 => 10,
				2 => -1,
			],
			146 => [
				0 => 10,
				1 => 10,
				2 => 1,
			],
			147 => [
				0 => 20,
				1 => 10,
				2 => 2,
			],
			148 => [
				0 => 30,
				1 => 10,
				2 => 3,
			],
			149 => [
				0 => 40,
				1 => 10,
				2 => 4,
			],
			150 => [
				0 => 50,
				1 => 10,
				2 => 5,
			],
			151 => [
				0 => 60,
				1 => 10,
				2 => 6,
			],
			152 => [
				0 => 70,
				1 => 10,
				2 => 7,
			],
			153 => [
				0 => 100,
				1 => 10,
				2 => 10,
			],
			154 => [
				0 => 200,
				1 => 10,
				2 => 20,
			],
			155 => [
				0 => 300,
				1 => 10,
				2 => 30,
			],
			156 => [
				0 => 500,
				1 => 10,
				2 => 50,
			],
			157 => [
				0 => 1000,
				1 => 10,
				2 => 100,
			],
			158 => [
				0 => 10000,
				1 => 10,
				2 => 1000,
			],
			159 => [
				0 => 100000,
				1 => 10,
				2 => 10000,
			],
			160 => [
				0 => 0,
				1 => 20,
				2 => 0,
			],
			161 => [
				0 => -20,
				1 => 20,
				2 => -1,
			],
			162 => [
				0 => 20,
				1 => 20,
				2 => 1,
			],
			163 => [
				0 => 40,
				1 => 20,
				2 => 2,
			],
			164 => [
				0 => 60,
				1 => 20,
				2 => 3,
			],
			165 => [
				0 => 80,
				1 => 20,
				2 => 4,
			],
			166 => [
				0 => 100,
				1 => 20,
				2 => 5,
			],
			167 => [
				0 => 120,
				1 => 20,
				2 => 6,
			],
			168 => [
				0 => 140,
				1 => 20,
				2 => 7,
			],
			169 => [
				0 => 200,
				1 => 20,
				2 => 10,
			],
			170 => [
				0 => 400,
				1 => 20,
				2 => 20,
			],
			171 => [
				0 => 600,
				1 => 20,
				2 => 30,
			],
			172 => [
				0 => 1000,
				1 => 20,
				2 => 50,
			],
			173 => [
				0 => 2000,
				1 => 20,
				2 => 100,
			],
			174 => [
				0 => 20000,
				1 => 20,
				2 => 1000,
			],
			175 => [
				0 => 200000,
				1 => 20,
				2 => 10000,
			],
			176 => [
				0 => 0,
				1 => 30,
				2 => 0,
			],
			177 => [
				0 => -30,
				1 => 30,
				2 => -1,
			],
			178 => [
				0 => 30,
				1 => 30,
				2 => 1,
			],
			179 => [
				0 => 60,
				1 => 30,
				2 => 2,
			],
			180 => [
				0 => 90,
				1 => 30,
				2 => 3,
			],
			181 => [
				0 => 120,
				1 => 30,
				2 => 4,
			],
			182 => [
				0 => 150,
				1 => 30,
				2 => 5,
			],
			183 => [
				0 => 180,
				1 => 30,
				2 => 6,
			],
			184 => [
				0 => 210,
				1 => 30,
				2 => 7,
			],
			185 => [
				0 => 300,
				1 => 30,
				2 => 10,
			],
			186 => [
				0 => 600,
				1 => 30,
				2 => 20,
			],
			187 => [
				0 => 900,
				1 => 30,
				2 => 30,
			],
			188 => [
				0 => 1500,
				1 => 30,
				2 => 50,
			],
			189 => [
				0 => 3000,
				1 => 30,
				2 => 100,
			],
			190 => [
				0 => 30000,
				1 => 30,
				2 => 1000,
			],
			191 => [
				0 => 300000,
				1 => 30,
				2 => 10000,
			],
			192 => [
				0 => 0,
				1 => 50,
				2 => 0,
			],
			193 => [
				0 => -50,
				1 => 50,
				2 => -1,
			],
			194 => [
				0 => 50,
				1 => 50,
				2 => 1,
			],
			195 => [
				0 => 100,
				1 => 50,
				2 => 2,
			],
			196 => [
				0 => 150,
				1 => 50,
				2 => 3,
			],
			197 => [
				0 => 200,
				1 => 50,
				2 => 4,
			],
			198 => [
				0 => 250,
				1 => 50,
				2 => 5,
			],
			199 => [
				0 => 300,
				1 => 50,
				2 => 6,
			],
			200 => [
				0 => 350,
				1 => 50,
				2 => 7,
			],
			201 => [
				0 => 500,
				1 => 50,
				2 => 10,
			],
			202 => [
				0 => 1000,
				1 => 50,
				2 => 20,
			],
			203 => [
				0 => 1500,
				1 => 50,
				2 => 30,
			],
			204 => [
				0 => 2500,
				1 => 50,
				2 => 50,
			],
			205 => [
				0 => 5000,
				1 => 50,
				2 => 100,
			],
			206 => [
				0 => 50000,
				1 => 50,
				2 => 1000,
			],
			207 => [
				0 => 500000,
				1 => 50,
				2 => 10000,
			],
			208 => [
				0 => 0,
				1 => 100,
				2 => 0,
			],
			209 => [
				0 => -100,
				1 => 100,
				2 => -1,
			],
			210 => [
				0 => 100,
				1 => 100,
				2 => 1,
			],
			211 => [
				0 => 200,
				1 => 100,
				2 => 2,
			],
			212 => [
				0 => 300,
				1 => 100,
				2 => 3,
			],
			213 => [
				0 => 400,
				1 => 100,
				2 => 4,
			],
			214 => [
				0 => 500,
				1 => 100,
				2 => 5,
			],
			215 => [
				0 => 600,
				1 => 100,
				2 => 6,
			],
			216 => [
				0 => 700,
				1 => 100,
				2 => 7,
			],
			217 => [
				0 => 1000,
				1 => 100,
				2 => 10,
			],
			218 => [
				0 => 2000,
				1 => 100,
				2 => 20,
			],
			219 => [
				0 => 3000,
				1 => 100,
				2 => 30,
			],
			220 => [
				0 => 5000,
				1 => 100,
				2 => 50,
			],
			221 => [
				0 => 10000,
				1 => 100,
				2 => 100,
			],
			222 => [
				0 => 100000,
				1 => 100,
				2 => 1000,
			],
			223 => [
				0 => 1000000,
				1 => 100,
				2 => 10000,
			],
			224 => [
				0 => 0,
				1 => 1000,
				2 => 0,
			],
			225 => [
				0 => -1000,
				1 => 1000,
				2 => -1,
			],
			226 => [
				0 => 1000,
				1 => 1000,
				2 => 1,
			],
			227 => [
				0 => 2000,
				1 => 1000,
				2 => 2,
			],
			228 => [
				0 => 3000,
				1 => 1000,
				2 => 3,
			],
			229 => [
				0 => 4000,
				1 => 1000,
				2 => 4,
			],
			230 => [
				0 => 5000,
				1 => 1000,
				2 => 5,
			],
			231 => [
				0 => 6000,
				1 => 1000,
				2 => 6,
			],
			232 => [
				0 => 7000,
				1 => 1000,
				2 => 7,
			],
			233 => [
				0 => 10000,
				1 => 1000,
				2 => 10,
			],
			234 => [
				0 => 20000,
				1 => 1000,
				2 => 20,
			],
			235 => [
				0 => 30000,
				1 => 1000,
				2 => 30,
			],
			236 => [
				0 => 50000,
				1 => 1000,
				2 => 50,
			],
			237 => [
				0 => 100000,
				1 => 1000,
				2 => 100,
			],
			238 => [
				0 => 1000000,
				1 => 1000,
				2 => 1000,
			],
			239 => [
				0 => 10000000,
				1 => 1000,
				2 => 10000,
			],
			240 => [
				0 => 0,
				1 => 10000,
				2 => 0,
			],
			241 => [
				0 => -10000,
				1 => 10000,
				2 => -1,
			],
			242 => [
				0 => 10000,
				1 => 10000,
				2 => 1,
			],
			243 => [
				0 => 20000,
				1 => 10000,
				2 => 2,
			],
			244 => [
				0 => 30000,
				1 => 10000,
				2 => 3,
			],
			245 => [
				0 => 40000,
				1 => 10000,
				2 => 4,
			],
			246 => [
				0 => 50000,
				1 => 10000,
				2 => 5,
			],
			247 => [
				0 => 60000,
				1 => 10000,
				2 => 6,
			],
			248 => [
				0 => 70000,
				1 => 10000,
				2 => 7,
			],
			249 => [
				0 => 100000,
				1 => 10000,
				2 => 10,
			],
			250 => [
				0 => 200000,
				1 => 10000,
				2 => 20,
			],
			251 => [
				0 => 300000,
				1 => 10000,
				2 => 30,
			],
			252 => [
				0 => 500000,
				1 => 10000,
				2 => 50,
			],
			253 => [
				0 => 1000000,
				1 => 10000,
				2 => 100,
			],
			254 => [
				0 => 10000000,
				1 => 10000,
				2 => 1000,
			],
			255 => [
				0 => 100000000,
				1 => 10000,
				2 => 10000,
			],
		];
	}
}
