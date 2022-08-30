<?php

namespace Spip\Core\Tests\Testing;


use Spip\Core\Testing\Exception\TemplateNotFoundException;
use Spip\Core\Testing\SquelettesTestCase;
use Spip\Core\Testing\Template;
use Spip\Core\Testing\Template\ChainLoader;
use Spip\Core\Testing\Template\FileLoader;
use Spip\Core\Testing\Template\StringLoader;

class TemplateTest extends SquelettesTestCase
{
	public function testNativeRecupererFond(): void {
		$dir = substr(__DIR__, strlen(_SPIP_TEST_CHDIR) + 1);
		$this->assertEquals('Hello World', recuperer_fond($dir . '/data/inclus_hello_world'));
	}

	public function testRenderer(): void {
		$dir = substr(__DIR__, strlen(_SPIP_TEST_CHDIR) + 1);
		$template = new Template($dir . '/data/inclus_hello_world');
		$this->assertEquals('Hello World', $template->render());
	}
}
