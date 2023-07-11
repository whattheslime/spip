<?php

declare(strict_types=1);


namespace Spip\Test\Urls;

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;

class LiensAbsolusTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('./inc/utils.php', '', true);
	}

	public function testVerifierEspace() {
		$this->assertFalse(test_espace_prive(), 'On doit être dans l’espace public');
	}

	#[Depends('testVerifierEspace')]
	public function testLienPrive() {
		$relatif = generer_url_ecrire('toto', 'truc=machin&chose=bidule', false, true);
		$absolu = generer_url_ecrire('toto', 'truc=machin&chose=bidule', false, false);
		$expected = 'bla bla <a href=\'' . str_replace('&amp;', '&#38;', $absolu) . '\'>lien prive</a>';
		$case = 'bla bla <a href=\'' . $relatif . '\'>lien prive</a>';
		$actual = liens_absolus($case);
		$this->assertEquals($expected, $actual);
	}

	#[Depends('testVerifierEspace')]
	public function testLienPublic() {
		$relatif = generer_url_public('toto', 'truc=machin&chose=bidule', false, true);
		$absolu = generer_url_public('toto', 'truc=machin&chose=bidule', false, false);
		$expected = 'bla bla <a href=\'' . str_replace('&amp;', '&#38;', $absolu) . '\'>lien public</a>';
		$case = 'bla bla <a href=\'' . $relatif . '\'>lien public</a>';
		$actual = liens_absolus($case);
		$this->assertEquals($expected, $actual);
	}

	#[Depends('testVerifierEspace')]
	public function testLienMailto() {
		$expected = 'bla bla <a href="mailto:toto">email</a>';
		$case = 'bla bla <a href="mailto:toto">email</a>';
		$actual = liens_absolus($case);
		$this->assertEquals($expected, $actual);
	}

	#[Depends('testVerifierEspace')]
	public function testLienJavascript() {
		$expected = 'bla bla <a href="javascript:open()">javascript</a>';
		$case = 'bla bla <a href="javascript:open()">javascript</a>';
		$actual = liens_absolus($case);
		$this->assertEquals($expected, $actual);
	}
}
