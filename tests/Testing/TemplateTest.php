<?php

namespace Spip\Core\Tests\Testing;

use Spip\Core\Testing\SquelettesTestCase;
use Spip\Core\Testing\Template;

class TemplateTest extends SquelettesTestCase
{
	public function testNativeRecupererFond(): void {
		$dir = $this->relativePath(__DIR__);
		$this->assertEquals('Hello World', recuperer_fond($dir . '/data/texte_hello_world'));
	}

	public function testRenderer(): void {
		$dir = $this->relativePath(__DIR__);
		$template = new Template($dir . '/data/texte_hello_world');
		$this->assertEquals('Hello World', $template->render());
	}
}
