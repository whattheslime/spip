<?php

declare(strict_types=1);

namespace Spip\Core\Tests\Testing;

use Spip\Core\Testing\Exception\TemplateNotFoundException;
use Spip\Core\Testing\SquelettesTestCase;
use Spip\Core\Testing\Template\Loader\ChainLoader;
use Spip\Core\Testing\Template\Loader\FileLoader;
use Spip\Core\Testing\Template\Loader\StringLoader;
use Spip\Core\Testing\Templating;

class TemplatingTest extends SquelettesTestCase
{
	public function testFileLoader(): void
	{
		$loader = new FileLoader();
		$templating = new Templating($loader);
		$this->assertInstanceOf(FileLoader::class, $templating->getLoader());
		$this->assertEquals($loader, $templating->getLoader());

		$file = __DIR__ . '/data/texte_hello_world.html';
		$expected = trim(file_get_contents($file));

		// Indirect render
		$template = $templating->load($file);
		$actual = $template->render();
		$this->assertEquals($expected, $actual);

		// Quick render
		$actual = $templating->render($file);
		$this->assertEquals($expected, $actual);

		// Assert render
		$this->assertEqualsTemplate($expected, $templating, $file);
	}

	public function testFileLoaderException(): void
	{
		$templating = new Templating(new FileLoader());
		$file = __DIR__ . '/data/inexistant_file.html';
		$this->expectException(TemplateNotFoundException::class);
		$templating->render($file);
	}

	public function testStringLoader(): void
	{
		$templating = Templating::fromString();
		$expected = 'Hello World';
		$actual = $templating->render($expected);
		$this->assertEquals($expected, $actual);
	}

	public function testChainLoader(): void
	{
		$template = new Templating(new ChainLoader([new FileLoader(), new StringLoader()]));

		$file = __DIR__ . '/data/texte_hello_world.html';
		$expected = trim(file_get_contents($file));
		$actual = $template->render($file);
		$this->assertEquals($expected, $actual);

		$string = 'Not a file';
		$actual = $template->render($string);
		$this->assertEquals($string, $actual);
	}

	public function testCodeRenderAvecFonctionEtApresCode(): void
	{
		$loader = new StringLoader([
			'fonctions' => "
				function so_smile(): string {
					return ' So Smile';
				}
			",
			'apres_code' => '[(#VAL|so_smile)]',
		]);
		$templating = new Templating($loader);
		$this->assertEquals('Hello World So Smile', $templating->render('Hello World'));

		$templating = Templating::fromString([
			'fonctions' => "
				function so_smile(): string {
					return ' So Smile';
				}
			",
			'apres_code' => '[(#VAL|so_smile)]',
		]);
		$this->assertEquals('Hello World So Smile', $templating->render('Hello World'));
	}

	public function testCodeRenderAvecFonctionPrecedenteNonPresente(): void
	{
		$template = Templating::fromString();
		$this->assertNotEquals('Hello World So Smile', $template->render('Hello World'));
		$this->assertEquals('Hello World', $template->render('Hello World'));
		$this->assertNotEquals('Hello Kitty So Smile', $template->render('Hello Kitty'));
		$this->assertEquals('Hello Kitty', $template->render('Hello Kitty'));
	}

	public function testCodeRender(): void
	{
		$this->assertEqualsCode('Hello World', 'Hello World');
	}

	public function testCodeRenderAvecFonctionVide(): void
	{
		// pas de fichier de fonctions
		$this->assertOkCode("[(#SQUELETTE|replace{'.html','_fonctions.php'}|find_in_path|non)ok]");

		// fichier de fonction
		$templating = Templating::fromString([
			'fonctions' => "
				function so_smile(): string {
					return ' So Smile';
				}
			",
		]);
		$this->assertOk($templating->render("[(#SQUELETTE|replace{'.html','_fonctions.php'}|find_in_path|oui)ok]"));

		// pas de fichier de fonctions
		$templating = Templating::fromString();
		$this->assertNotOk($templating->render("[(#SQUELETTE|replace{'.html','_fonctions.php'}|find_in_path|oui)ok]"));
	}

	public function testCodeRenderAvantApres(): void
	{
		$templating = Templating::fromString([
			'avant_code' => 'Nice ',
			'apres_code' => ' So Beautiful',
		]);
		$this->assertEquals('Nice Hello World So Beautiful', $templating->render('Hello World'));
	}

	public function testCodeRawRenderInfos(): void
	{
		$templating = Templating::fromString();
		$infos = $templating->rawRender('#SELF');
		$this->assertTrue(is_array($infos));
		$this->assertTrue(isset($infos['squelette']));
		$this->assertTrue(isset($infos['fond']));
	}

	public function testCodeRawRenderInfosErreurCompilationFiltreAbsent(): void
	{
		$templating = Templating::fromString();

		$infos = $templating->rawRender('#CACHE{0}[(#SELF|ce_filtre_nexiste_pas)]');
		$this->assertTrue(is_array($infos['erreurs']));
		$this->assertCount(1, $infos['erreurs']);
	}

	public function testCodeRawRenderInfosErreurCompilationAbsentsDansNouvelleDemandeCorrecte(): void
	{
		$templating = Templating::fromString();

		$infos = $templating->rawRender('#CACHE{0}Aucun Probleme ici');
		$this->assertCount(0, $infos['erreurs']);
	}
}
