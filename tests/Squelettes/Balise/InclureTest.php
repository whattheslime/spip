<?php
namespace Spip\Core\Tests\Squelettes\Balise;

use Spip\Core\Testing\SquelettesTestCase;
use Spip\Core\Testing\Templating;
use Spip\Core\Testing\Template\StringLoader;
use Spip\Core\Testing\Template\FileLoader;

class InclureTest extends SquelettesTestCase
{

	public function testInclureNormal(): void {
		$dir = $this->relativePath(__DIR__);
		$this->assertEqualsCode('Hello World', '<INCLURE{fond=' . $dir . '/data/texte_hello_world}>');
		$this->assertEqualsCode('Hello World', '<INCLURE{fond=' . $dir . '/data/texte_hello_world}/>');
	}

	public function testInclureDouble(): void {
		$dir = $this->relativePath(__DIR__);
		$this->assertEqualsCode(
			'Hello WorldHello World',
			'<INCLURE{fond=' . $dir . '/data/texte_hello_world}>'
			. '<INCLURE{fond=' . $dir . '/data/texte_hello_world}>'
		);
		$this->assertEqualsCode(
			'Hello WorldHello World','
			 <INCLURE{fond=' . $dir . '/data/texte_hello_world}>'
			. '<INCLURE{fond=' . $dir . '/data/texte_hello_world}>'
		);
	}
	public function testInclureArray(): void {
		$dir = $this->relativePath(__DIR__);
		$array = '#LISTE{
			' . $dir . '/data/texte_hello_world,
			' . $dir . '/data/texte_hello_world,
			' . $dir . '/data/texte_hello_world}';
		$this->assertEqualsCode('Hello WorldHello WorldHello World', "<INCLURE{fond=$array}>");
	}

	public function testInclureOldParam(): void {
		$dir = $this->relativePath(__DIR__);
		$this->assertEqualsCode('Kitty', '<INCLURE{fond=' . $dir . '/data/balise_env_test}{test=Kitty}>');
		$this->assertEqualsCode('Kitty', '<INCLURE{fond=' . $dir . '/data/balise_env_test}{test=Kitty}/>');
	}

	public function testInclureNormalParam(): void {
		$dir = $this->relativePath(__DIR__);
		$this->assertEqualsCode('Kitty', '<INCLURE{fond=' . $dir . '/data/balise_env_test, test=Kitty}>');
		$this->assertEqualsCode('Kitty', '<INCLURE{fond=' . $dir . '/data/balise_env_test, test=Kitty}/>');
	}

	public function testInclureArrayParam(): void {
		$dir = $this->relativePath(__DIR__);
		$array = '#LISTE{
			' . $dir . '/data/balise_env_test,
			' . $dir . '/data/texte_hello_world,
			' . $dir . '/data/balise_env_test}';
		$this->assertEqualsCode('KittyHello WorldKitty', "<INCLURE{fond=$array, test=Kitty}>");
		$this->assertEqualsCode('KittyHello WorldKitty', "<INCLURE{fond=$array, test=Kitty}/>");
	}

	/**
	 * Un inclure manquant doit creer une erreur de compilation pour SPIP
	 * qui ne doivent pas s'afficher dans le public si visiteur
	 */
	public function testInclureManquantGenereErreurCompilation(): void {
		$templating = Templating::fromString();
		$infos = $templating->rawRender('<INCLURE{fond=carabistouille/de/tripoli/absente}/>ok');
		$this->assertCount(1, $infos['erreurs']);
	}
}
