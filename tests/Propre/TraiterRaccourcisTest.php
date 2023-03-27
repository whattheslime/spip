<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction traiter_raccourcis du fichier inc/texte.php
 */

namespace Spip\Core\Tests\Propre;

use PHPUnit\Framework\TestCase;

class TraiterRaccourcisTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		find_in_path('inc/texte.php', '', true);
	}

	protected function setUp(): void
	{
		$this->preparePropreTraiterRaccourcis();
	}

	protected function tearDown(): void
	{
		$this->preparePropreTraiterRaccourcis(true);
	}

	public function preparePropreTraiterRaccourcis(bool $revert = false)
	{
		static $mem = [null, null];
		if ($revert) {
			$GLOBALS['toujours_paragrapher'] = $mem[0];
			$GLOBALS['puce'] = $mem[1];
		} else {
			$mem = [$GLOBALS['toujours_paragrapher'] ?? null, $GLOBALS['puce'] ?? null];
			// ces tests sont prevus pour la variable de personnalisation :
			$GLOBALS['toujours_paragrapher'] = false;
			$GLOBALS['puce'] = '-';
		}
	}

	/**
	 * @dataProvider providerPropreTraiterRaccourcis
	 */
	public function testPropreTraiterRaccourcis($expected, ...$args): void
	{
		$actual = traiter_raccourcis(...$args);
		$this->assertSame($expected, $actual);
		$this->assertEquals($expected, $actual);
	}

	public static function providerPropreTraiterRaccourcis(): array
	{
		return [
			/*
			if (!preg_match($c = ",<p\b.*?>titi</p>\n<p\b.*?>toto</p>,",
			$b = propre( $a = "titi\n\ntoto")))
				$err[] = htmlentities ("$a -- $b -- $c");

			if (!preg_match(",<p\b.*?>titi</p>\n<p\b.*?>toto<br /></p>,",
			propre("titi\n\n<br />toto<br />")))
				$err[] = 'erreur 2';


			if (!strpos(propre("Ligne\n\n<br class=\"n\" />\n\nAutre"), '<br class="n" />'))
				$err[] = "erreur le &lt;br class='truc'> n'est pas preserve";
			*/
			// trois tests un peu identiques sur <br />...
			'div' => ["<div>titi<br />toto</div>\n<p><br />tata</p>\n", '<div>titi<br />toto</div><br />tata'],
			'span' => ['<span>titi<br />toto</span><br />tata', '<span>titi<br />toto</span><br />tata'],
			'table' => [
				"<table><tr><td>titi<br />toto</td></tr></table>\n<p><br />tata</p>\n",
				'<table><tr><td>titi<br />toto</td></tr></table><br />tata',
			],
			// melanges de \n et de <br />
			'\n_x1_mixte1' => ["titi\n<br />toto<br />", "titi\n<br />toto<br />"],
			'\n_x1_mixte2' => ["titi\n<br />\ntoto<br />", "titi\n<br />\ntoto<br />"],
			// des tirets en debut de texte
			'tirets1' => ["&mdash;&nbsp;chose\n<br />&mdash;&nbsp;truc", "-- chose\n-- truc"],
			'tirets2' => ["-&nbsp;chose\n<br />-&nbsp;truc", "- chose\n- truc"],
			// ligne horizontale
			'lignehorizontale' => ['<hr class="spip" />', "\n----\n"],
		];
	}
}
