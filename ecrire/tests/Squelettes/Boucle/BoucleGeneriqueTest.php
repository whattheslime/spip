<?php

declare(strict_types=1);

namespace Spip\Test\Squelettes\Boucle;

use Spip\Test\SquelettesTestCase;

class BoucleGeneriqueTest extends SquelettesTestCase
{
	public function testBoucleMetaSimple(): void {
		$this->assertNotEmptyCode('<BOUCLE_meta(spip_meta)>#NOM</BOUCLE_meta>');
		$this->assertOkCode('ok<BOUCLE_meta(spip_meta)> </BOUCLE_meta>');
		$this->assertOkCode('<BOUCLE_meta(spip_meta)> </BOUCLE_meta>ok');
	}

	public function testBoucleMetaSimpleRaccourcisFinBoucle(): void {
		$this->assertOkCode('<BOUCLE_meta(spip_meta) />ok');
	}

	public function testBoucleMetaSimpleAvantApres(): void {
		$this->assertOkCode('<B_meta>ok<BOUCLE_meta(spip_meta)> </BOUCLE_meta>');
		$this->assertOkCode('<BOUCLE_meta(spip_meta)> </BOUCLE_meta>ok</B_meta>');
	}

	public function testBoucleMetaSimpleSinon(): void {
		$this->assertNotOkCode('<BOUCLE_meta(spip_meta)> </BOUCLE_meta>ok<//B_meta>');
		$this->assertOkCode('<BOUCLE_meta(spip_meta)> </BOUCLE_meta>ok</B_meta>non<//B_meta>');

		$this->assertOkCode('<BOUCLE_meta(spip_meta)></BOUCLE_meta>ok<//B_meta>');
		$this->assertOkCode('<BOUCLE_meta(spip_meta)></BOUCLE_meta>non</B_meta>ok<//B_meta>');

		$this->assertOkCode('<BOUCLE_meta(spip_meta) />ok<//B_meta>');
		$this->assertOkCode('<BOUCLE_meta(spip_meta) />non</B_meta>ok<//B_meta>');
	}

	public function testBoucleMetaSimpleCritere(): void {
		$this->assertEqualsCode($GLOBALS['meta']['nom_site'], '<BOUCLE_meta(spip_meta){nom=nom_site}>#VALEUR</BOUCLE_meta>');
		$this->assertEmptyCode('<BOUCLE_meta(spip_meta){nom=gristinapolitainsic}>#VALEUR</BOUCLE_meta>');
		$this->assertOkCode('<BOUCLE_meta(spip_meta){nom=gristinapolitainsic}>#VALEUR</BOUCLE_meta>ok<//B_meta>');
	}

	/**
	 * @link http://trac.rezo.net/trac/spip/ticket/1931
	 */
	public function testBoucleVide(): void {
		$this->assertOkSquelette(__DIR__ . '/data/boucle_vide.html');
	}
}
