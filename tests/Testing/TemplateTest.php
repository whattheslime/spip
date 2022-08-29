<?php

namespace Spip\Core\Tests\Testing;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\TestCase;
use Spip\Core\Testing\SquelettesTestCase;
use Spip\Core\Testing\Template;
use Spip\Core\Testing\Template\FileLoader;
use Spip\Core\Testing\Exception\TemplateNotFoundException;
use Spip\Core\Testing\Template\StringLoader;

class TemplateTest extends SquelettesTestCase
{
	public function testNativeRecupererFond(): void {
		$dir = substr(__DIR__, strlen(_SPIP_TEST_CHDIR) + 1);
		$this->assertEquals('Hello World', recuperer_fond($dir . '/data/inclus_hello_world'));
	}

	public function testFileLoader(): void {
		$template = new Template(new FileLoader());
		$file = __DIR__ . '/data/inclus_hello_world.html';
		$expected = file_get_contents($file);
		$actual = $template->render($file);
		$this->assertEquals($expected, $actual);
	}

	public function testFileLoaderException(): void {
		$template = new Template(new FileLoader());
		$file = __DIR__ . '/data/inexistant_file.html';
		$this->expectException(TemplateNotFoundException::class);
		$template->render($file);
	}

	public function testStringLoader(): void {
		$template = new Template(new StringLoader());
		$expected = "Hello World";
		$actual = $template->render($expected);
		$this->assertEquals($expected, $actual);
	}

	public function testCodeRenderAvecFonctionEtApresCode(): void {
		$loader = new StringLoader([
			'fonctions' => "
				function so_smile(): string {
					return ' So Smile';
				}
			",
			'apres_code' => '[(#VAL|so_smile)]'
		]);
		$template = new Template($loader);
		$this->assertEquals('Hello World So Smile', $template->render('Hello World'));
		$this->assertNotEquals('Hello World', $template->render('Hello World'));
	}

	public function testCodeRenderAvecFonctionPrecedenteNonPresente(): void {
		$template = new Template(new StringLoader());
		$this->assertNotEquals('Hello World So Smile', $template->render('Hello World'));
		$this->assertEquals('Hello World', $template->render('Hello World'));
		$this->assertNotEquals('Hello Kitty So Smile', $template->render('Hello Kitty'));
		$this->assertEquals('Hello Kitty', $template->render('Hello Kitty'));
	}


	public function testCodeRender(): void {
		$this->assertEqualsCode('Hello World', 'Hello World');
	}

	public function testCodeRenderAvecFonctionVide(): void {

		// pas de fichier de fonctions
		$this->assertOkCode("[(#SQUELETTE|replace{'.html','_fonctions.php'}|find_in_path|non)ok]");

		// fichier de fonction
		$template = new Template(new StringLoader([
			'fonctions' => "
				function so_smile(): string {
					return ' So Smile';
				}
			",
		]));
		$this->assertOk($template->render("[(#SQUELETTE|replace{'.html','_fonctions.php'}|find_in_path|oui)ok]"));

		// pas de fichier de fonctions
		$template = new Template(new StringLoader());
		$this->assertNotOk($template->render("[(#SQUELETTE|replace{'.html','_fonctions.php'}|find_in_path|oui)ok]"));
	}

	public function testCodeRenderAvantApres(): void {
		$template = new Template(new StringLoader([
			'avant_code'=>'Nice ',
			'apres_code'=>' So Beautiful',
		]));
		$this->assertEquals('Nice Hello World So Beautiful', $template->render('Hello World'));
	}

	public function testCodeRawRenderInfos(): void {
		$template = new Template(new StringLoader());
		$infos = $template->rawRender('#SELF');
		$this->assertTrue(is_array($infos));
		$this->assertTrue(isset($infos['squelette']));
		$this->assertTrue(isset($infos['fond']));
	}

	public function testCodeRawRenderInfosErreurCompilationFiltreAbsent(): void {
		$template = new Template(new StringLoader());
		$infos = $template->rawRender('#CACHE{0}[(#SELF|ce_filtre_nexiste_pas)]');
		$this->assertTrue(is_array($infos['erreurs']));
		$this->assertCount(1, $infos['erreurs']);
	}

	public function testCodeRawRenderInfosErreurCompilationAbsentsDansNouvelleDemandeCorrecte(): void {
		$template = new Template(new StringLoader());
		$infos = $template->rawRender('#CACHE{0}Aucun Probleme ici');
		$this->assertCount(0, $infos['erreurs']);
	}
}
