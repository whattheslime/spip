<?php

declare(strict_types=1);

namespace Spip\Test\Urls;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class SuivreLienTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('./inc/utils.php', '', true);
	}

	#[DataProvider('providerSuivreLien')]
	public function testSuivreLien($expected, ...$args): void {
		$actual = suivre_lien(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerSuivreLien(): array {
		return [
			['http://tata/', 'http://host/', 'http://tata/'],
			['http://tata/', '//host/', 'http://tata/'],
			['//tata/', 'http://host/', '//tata/'],
			['http://host/tata/', 'http://host/', '/tata/'],
			['//host/tata/', '//host/', '/tata/'],
			['http://host/#tata', 'http://host/', '#tata'],
			['//host/#tata', '//host/', '#tata'],
			['http://host/', 'http://host/', ''],
			['//host/', '//host/', ''],
			['http://host/tata', 'http://host/', 'tata'],
			['//host/tata', '//host/', 'tata'],
			['http://host/?par=value', 'http://host/', '?par=value'],
			['//host/?par=value', '//host/', '?par=value'],
			['http://host/tata?par=value', 'http://host/', 'tata?par=value'],
			['//host/tata?par=value', '//host/', 'tata?par=value'],
			['http://host/tata#ancre', 'http://host/', 'tata#ancre'],
			['//host/tata#ancre', '//host/', 'tata#ancre'],
			['http://host/tata?par=value#ancre', 'http://host/', 'tata?par=value#ancre'],
			['//host/tata?par=value#ancre', '//host/', 'tata?par=value#ancre'],

			['http://tata/', 'http://host/page', 'http://tata/'],
			['http://tata/', '//host/page', 'http://tata/'],
			['//tata/', 'http://host/page', '//tata/'],
			['http://host/tata/', 'http://host/page', '/tata/'],
			['//host/tata/', '//host/page', '/tata/'],
			['http://host/page#tata', 'http://host/page', '#tata'],
			['//host/page#tata', '//host/page', '#tata'],
			['http://host/page', 'http://host/page', ''],
			['//host/page', '//host/page', ''],
			['http://host/tata', 'http://host/page', 'tata'],
			['//host/tata', '//host/page', 'tata'],
			['http://host/?par=value', 'http://host/page', '?par=value'],
			['//host/?par=value', '//host/page', '?par=value'],
			['http://host/tata?par=value', 'http://host/page', 'tata?par=value'],
			['//host/tata?par=value', '//host/page', 'tata?par=value'],
			['http://host/tata#ancre', 'http://host/page', 'tata#ancre'],
			['//host/tata#ancre', '//host/page', 'tata#ancre'],
			['http://host/tata?par=value#ancre', 'http://host/page', 'tata?par=value#ancre'],
			['//host/tata?par=value#ancre', '//host/page', 'tata?par=value#ancre'],

			['http://tata/', 'http://host/rep/page', 'http://tata/'],
			['http://tata/', '//host/rep/page', 'http://tata/'],
			['//tata/', 'http://host/rep/page', '//tata/'],
			['http://host/tata/', 'http://host/rep/page', '/tata/'],
			['//host/tata/', '//host/rep/page', '/tata/'],
			['http://host/rep/page#tata', 'http://host/rep/page', '#tata'],
			['//host/rep/page#tata', '//host/rep/page', '#tata'],
			['http://host/rep/page', 'http://host/rep/page', ''],
			['//host/rep/page', '//host/rep/page', ''],
			['http://host/rep/tata', 'http://host/rep/page', 'tata'],
			['//host/rep/tata', '//host/rep/page', 'tata'],
			['http://host/rep/?par=value', 'http://host/rep/page', '?par=value'],
			['//host/rep/?par=value', '//host/rep/page', '?par=value'],
			['http://host/rep/tata?par=value', 'http://host/rep/page', 'tata?par=value'],
			['//host/rep/tata?par=value', '//host/rep/page', 'tata?par=value'],
			['http://host/rep/tata#ancre', 'http://host/rep/page', 'tata#ancre'],
			['//host/rep/tata#ancre', '//host/rep/page', 'tata#ancre'],
			['http://host/rep/tata?par=value#ancre', 'http://host/rep/page', 'tata?par=value#ancre'],
			['//host/rep/tata?par=value#ancre', '//host/rep/page', 'tata?par=value#ancre'],

			['http://tata/', 'http://host/rep/page#anchor', 'http://tata/'],
			['http://host/tata/', 'http://host/rep/page#anchor', '/tata/'],
			['http://host/rep/page#tata', 'http://host/rep/page#anchor', '#tata'],
			['http://host/rep/page#anchor', 'http://host/rep/page#anchor', ''],
			['http://host/rep/tata', 'http://host/rep/page#anchor', 'tata'],
			['http://host/rep/?par=value', 'http://host/rep/page#anchor', '?par=value'],
			['http://host/rep/tata?par=value', 'http://host/rep/page#anchor', 'tata?par=value'],
			['http://host/rep/tata#ancre', 'http://host/rep/page#anchor', 'tata#ancre'],
			['http://host/rep/tata?par=value#ancre', 'http://host/rep/page#anchor', 'tata?par=value#ancre'],

			['http://tata/', 'http://host/rep/page?titi=valeur&bidule=chose/truc', 'http://tata/'],
			['http://host/tata/', 'http://host/rep/page?titi=valeur&bidule=chose/truc', '/tata/'],
			[
				'http://host/rep/page?titi=valeur&bidule=chose/truc#tata',
				'http://host/rep/page?titi=valeur&bidule=chose/truc',
				'#tata',
			],
			[
				'http://host/rep/page?titi=valeur&bidule=chose/truc',
				'http://host/rep/page?titi=valeur&bidule=chose/truc',
				'',
			],
			['http://host/rep/tata', 'http://host/rep/page?titi=valeur&bidule=chose/truc', 'tata'],
			['http://host/rep/?par=value', 'http://host/rep/page?titi=valeur&bidule=chose/truc', '?par=value'],
			['http://host/rep/tata?par=value', 'http://host/rep/page?titi=valeur&bidule=chose/truc', 'tata?par=value'],
			['http://host/rep/tata#ancre', 'http://host/rep/page?titi=valeur&bidule=chose/truc', 'tata#ancre'],
			[
				'http://host/rep/tata?par=value#ancre',
				'http://host/rep/page?titi=valeur&bidule=chose/truc',
				'tata?par=value#ancre',
			],

			['http://tata/', 'http://host/rep/page?titi=valeur&bidule=chose/truc#anchor', 'http://tata/'],
			['http://host/tata/', 'http://host/rep/page?titi=valeur&bidule=chose/truc#anchor', '/tata/'],
			[
				'http://host/rep/page?titi=valeur&bidule=chose/truc#tata',
				'http://host/rep/page?titi=valeur&bidule=chose/truc#anchor',
				'#tata',
			],
			[
				'http://host/rep/page?titi=valeur&bidule=chose/truc#anchor',
				'http://host/rep/page?titi=valeur&bidule=chose/truc#anchor',
				'',
			],
			['http://host/rep/tata', 'http://host/rep/page?titi=valeur&bidule=chose/truc#anchor', 'tata'],
			['http://host/rep/?par=value', 'http://host/rep/page?titi=valeur&bidule=chose/truc#anchor', '?par=value'],
			[
				'http://host/rep/tata?par=value',
				'http://host/rep/page?titi=valeur&bidule=chose/truc#anchor',
				'tata?par=value',
			],
			['http://host/rep/tata#ancre', 'http://host/rep/page?titi=valeur&bidule=chose/truc#anchor', 'tata#ancre'],
			[
				'http://host/rep/tata?par=value#ancre',
				'http://host/rep/page?titi=valeur&bidule=chose/truc#anchor',
				'tata?par=value#ancre',
			],

			['http://toto/?hoc', 'http://toto/ad?hic', '?hoc'],
			['http://toto/#hup', 'http://toto/./', '#hup'],
			['http://toto/bois/', 'http://toto/fleche/de/tout', '/bois/'],
			['http://toto/du/yop', 'http://toto/du/lac#1', 'yop'],
			['http://tata/', 'http://toto/', 'http://tata/'],
			['http://toto/allo#3', 'http://toto/allo', '#3'],
			['http://tata/', 'http://toto/', 'http://tata/./'],
			['http://toto/et#lui', 'http://toto/et#lui', ''],
			['http://toto/', 'http://toto', './'],
			['http://toto/hop/', 'http://toto/hop/a', './'],
		];
	}
}
