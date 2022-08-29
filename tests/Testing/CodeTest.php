<?php

namespace Spip\Core\Tests\Testing;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\TestCase;
use Spip\Core\Testing\SquelettesTestCase;
use Spip\Core\Testing\Code;

class CodeTest extends SquelettesTestCase
{
	public function testRecupererFond(): void {
		$dir = substr(__DIR__, strlen(_SPIP_TEST_CHDIR) + 1);
		$this->assertEquals('Hello World', recuperer_fond($dir . '/data/inclus_hello_world'));
	}

	public function testCodeRender(): void {
		$this->assertEqualsCode('Hello World', 'Hello World');
	}

	public function testCodeRenderAvecFonctionEtApresCode(): void {
		$code = new Code([
			'fonctions' => "
				function so_smile(): string {
					return ' So Smile';
				}
			",
			'apres_code' => '[(#VAL|so_smile)]'
		]);
		$this->assertEquals('Hello World So Smile', $code->render('Hello World'));
		$this->assertNotEquals('Hello World', $code->render('Hello World'));
	}

	public function testCodeRenderAvecFonctionPrecedenteNonPresente(){
		$this->assertNotEqualsCode('Hello Kitty So Smile', 'Hello Kitty');
		$this->assertEqualsCode('Hello Kitty', 'Hello Kitty');
	}

	public function testCodeRenderAvecFonctionVide(): void {

		// pas de fichier de fonctions
		$this->assertOkCode("[(#SQUELETTE|replace{'.html','_fonctions.php'}|find_in_path|non)ok]");

		// fichier de fonction
		$code = new Code([
			'fonctions' => "
				function so_smile(): string {
					return ' So Smile';
				}
			",
		]);
		$this->assertOk($code->render("[(#SQUELETTE|replace{'.html','_fonctions.php'}|find_in_path|oui)ok]"));

		// pas de fichier de fonctions
		$code = new Code();
		$this->assertNotOk($code->render("[(#SQUELETTE|replace{'.html','_fonctions.php'}|find_in_path|oui)ok]"));;
	}

	public function testCodeRenderAvantApres(): void {
		$code = new Code([
			'avant_code'=>'Nice ',
			'apres_code'=>' So Beautiful',
		]);
		$this->assertEquals('Nice Hello World So Beautiful', $code->render('Hello World'));
	}

	public function testCodeRawRenderInfos(): void {
		$code = new Code();
		$infos = $code->rawRender('#SELF');
		$this->assertTrue(is_array($infos));
		$this->assertTrue(isset($infos['squelette']));
		$this->assertTrue(isset($infos['fond']));
	}

	public function testCodeRawRenderInfosErreurCompilationFiltreAbsent(): void {
		$code = new Code();
		$infos = $code->rawRender('#CACHE{0}[(#SELF|ce_filtre_nexiste_pas)]');
		$this->assertTrue(is_array($infos['erreurs']));
		$this->assertCount(1, $infos['erreurs']);
	}

	public function testCodeRawRenderInfosErreurCompilationAbsentsDansNouvelleDemandeCorrecte(): void {
		$code = new Code();
		$infos = $code->rawRender('#CACHE{0}Aucun Probleme ici');
		$this->assertCount(0, $infos['erreurs']);
	}
}
