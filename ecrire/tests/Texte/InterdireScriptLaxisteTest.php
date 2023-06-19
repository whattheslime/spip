<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction interdire_script du fichier inc/texte.php
 */

namespace Spip\Test\Texte;

use PHPUnit\Framework\TestCase;

class InterdireScriptLaxisteTest extends TestCase
{
	protected static $save_filtrer_javascript;
	public static function setUpBeforeClass(): void {
		self::$save_filtrer_javascript = $GLOBALS['filtrer_javascript'];
		find_in_path('inc/texte.php', '', true);
	}

	public static function tearDownAfterClass(): void {
		$GLOBALS['filtrer_javascript'] = self::$save_filtrer_javascript;
	}

	protected function setUp(): void {
		$GLOBALS['filtrer_javascript'] = 1;
	}

	/**
	 * @dataProvider providerTexteInterdireScriptLaxiste
	 */
	public function testTexteInterdireScriptLaxiste($expected, ...$args): void {
		$actual = interdire_scripts(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerTexteInterdireScriptLaxiste(): array {
		return [
			[
				"<script type='text/javascript' src='toto.js'></script>", "<script type='text/javascript' src='toto.js'></script>",
			],
			[
				"<script type='text/javascript' src='spip.php?page=toto'></script>",
				"<script type='text/javascript' src='spip.php?page=toto'></script>",
			],
			["<script type='text/javascript'>var php=5;</script>", "<script type='text/javascript'>var php=5;</script>"],
			[
				"<script language='javascript' src='spip.php?page=toto'></script>",
				"<script language='javascript' src='spip.php?page=toto'></script>",
			],
			["&lt;script language='php'>die();</script>", "<script language='php'>die();</script>"],
			['&lt;script language=php>die();</script>', '<script language=php>die();</script>'],
			['&lt;script language = php >die();</script>', '<script language = php >die();</script>'],
		];
	}
}
