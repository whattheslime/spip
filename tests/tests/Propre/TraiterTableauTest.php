<?php

declare(strict_types=1);

namespace Spip\Core\Tests\Propre;

use PHPUnit\Framework\TestCase;

class TraiterTableauTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		find_in_path('inc/texte.php', '', true);
	}

	/**
	 * @dataProvider providerPropreTraiterTableau
	 */
	public function testPropreTraiterTableau($expected, ...$args): void
	{
		$actual = traiter_raccourcis(...$args);
		if (is_array($expected)) {
			[$func, $pattern, $result] = $expected;
			if ($result) {
				$this->assertMatchesRegularExpression($pattern, $actual);
			} else {
				$this->assertDoesNotMatchRegularExpression($pattern, $actual);
			}
		} else {
			$this->assertSame($expected, $actual);
			$this->assertEquals($expected, $actual);
		}
	}

	public static function providerPropreTraiterTableau(): array
	{
		return [
			// trois tests un peu identiques sur <br />...
			'caption seul' => [['preg_match', ',<caption>\s*titre de mon tableau\s*</caption>,i', true],
				'|| titre de mon tableau||
|{{Colonne 0}} | {{Colonne 1}} | {{Colonne 2}} | {{Colonne 3}} | {{Colonne 4}} |
| {{Bourg-les-Valence}} | 10,39 | 20,14 | 46,02 | 15,99 |
| {{Valence}} | 16,25 | 23,31 | 49,21 | 13,43 |
| {{Romans}} | 14,09 | 20,54 | 67,85 | 17 |
| {{Montelimar}} | 20,15 | 26,43 | 70,21 | 16,82 |
| {{Bourg-de-Peage}} | 13,22 | 30 | 50 | 14,67 |',
			],
			'caption' => [['preg_match', ',<caption>\s*titre de mon tableau.*</caption>,i', true],
				'|| titre de mon tableau | resume de mon tableau ||
|{{Colonne 0}} | {{Colonne 1}} | {{Colonne 2}} | {{Colonne 3}} | {{Colonne 4}} |
| {{Bourg-les-Valence}} | 10,39 | 20,14 | 46,02 | 15,99 |
| {{Valence}} | 16,25 | 23,31 | 49,21 | 13,43 |
| {{Romans}} | 14,09 | 20,54 | 67,85 | 17 |
| {{Montelimar}} | 20,15 | 26,43 | 70,21 | 16,82 |
| {{Bourg-de-Peage}} | 13,22 | 30 | 50 | 14,67 |',
			],
			'summary' => [[
				'preg_match', ',<table[^>]*aria-describedby="([^"]*)"[^>]*>.*<caption>.* id="(\1)"[^>]*>\s*resume de mon tableau.*</caption>,is', true, ],
				'|| titre de mon tableau | resume de mon tableau ||
|{{Colonne 0}} | {{Colonne 1}} | {{Colonne 2}} | {{Colonne 3}} | {{Colonne 4}} |
| {{Bourg-les-Valence}} | 10,39 | 20,14 | 46,02 | 15,99 |
| {{Valence}} | 16,25 | 23,31 | 49,21 | 13,43 |
| {{Romans}} | 14,09 | 20,54 | 67,85 | 17 |
| {{Montelimar}} | 20,15 | 26,43 | 70,21 | 16,82 |
| {{Bourg-de-Peage}} | 13,22 | 30 | 50 | 14,67 |',
			],
			'thead simple' => [['preg_match', ',<thead>\s*<tr[^>]*>(:?<th[^>]*>.*</th>){5}\s*</tr>\s*</thead>,Uims', true],
				'|| titre de mon tableau | resume de mon tableau ||
|{{Colonne 0}} | {{Colonne 1}} | {{Colonne 2}} | {{Colonne 3}} | {{Colonne 4}} |
| {{Bourg-les-Valence}} | 10,39 | 20,14 | 46,02 | 15,99 |
| {{Valence}} | 16,25 | 23,31 | 49,21 | 13,43 |
| {{Romans}} | 14,09 | 20,54 | 67,85 | 17 |
| {{Montelimar}} | 20,15 | 26,43 | 70,21 | 16,82 |
| {{Bourg-de-Peage}} | 13,22 | 30 | 50 | 14,67 |',
			],
			'thead avec une colonne vide' => [[
				'preg_match', ',<thead>\s*<tr[^>]*>(:?<th[^>]*>.*</th>){5}\s*</tr>\s*</thead>,Uims', true, ],
				'|| titre de mon tableau | resume de mon tableau ||
| | {{Colonne 1}} | {{Colonne 2}} | {{Colonne 3}} | {{Colonne 4}} |
| {{Bourg-les-Valence}} | 10,39 | 20,14 | 46,02 | 15,99 |
| {{Valence}} | 16,25 | 23,31 | 49,21 | 13,43 |
| {{Romans}} | 14,09 | 20,54 | 67,85 | 17 |
| {{Montelimar}} | 20,15 | 26,43 | 70,21 | 16,82 |
| {{Bourg-de-Peage}} | 13,22 | 30 | 50 | 14,67 |',
			],
			'thead avec une colonne vide et un retour ligne' => [[
				'preg_match', ',<thead>\s*<tr[^>]*>(:?<th[^>]*>.*</th>){5}\s*</tr>\s*</thead>,Uims', true, ],
				'|| titre de mon tableau | resume de mon tableau ||
| | {{Colonne 1}} | {{Colonne 2}} | {{Colonne 3
_ avec retour ligne}} | {{Colonne 4}} |
| {{Bourg-les-Valence}} | 10,39 | 20,14 | 46,02 | 15,99 |
| {{Valence}} | 16,25 | 23,31 | 49,21 | 13,43 |
| {{Romans}} | 14,09 | 20,54 | 67,85 | 17 |
| {{Montelimar}} | 20,15 | 26,43 | 70,21 | 16,82 |
| {{Bourg-de-Peage}} | 13,22 | 30 | 50 | 14,67 |',
			],
			'thead errone' => [['preg_match', ',<thead>\s*<tr[^>]*>(:?<th[^>]*>.*</th>){5}\s*</tr>\s*</thead>,Uims', false],
				'|| titre de mon tableau | resume de mon tableau ||
|{{Colonne 0}} | {Colonne 1}} | {{Colonne 2}} | {{Colonne 3}} | {{Colonne 4}} |
| {{Bourg-les-Valence}} | 10,39 | 20,14 | 46,02 | 15,99 |
| {{Valence}} | 16,25 | 23,31 | 49,21 | 13,43 |
| {{Romans}} | 14,09 | 20,54 | 67,85 | 17 |
| {{Montelimar}} | 20,15 | 26,43 | 70,21 | 16,82 |
| {{Bourg-de-Peage}} | 13,22 | 30 | 50 | 14,67 |',
			],
			'fusion par |<|' => [['preg_match', ',colspan=.*colspan=,is', true], '| {{Bourg-de-Peage}} | 1-2 |<|3-4|<|'],
			"fusion |<| avec conservation d'URL dans un raccourci de liens" => [['preg_match', ',colspan=.*->,is', true],
				'|test avec fusion dans tous les sens|<|
|test1 |[mon beau lien->http://foo.fr]|',
			],
		];
	}
}
