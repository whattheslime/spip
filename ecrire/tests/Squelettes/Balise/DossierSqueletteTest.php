<?php

declare(strict_types=1);

namespace Spip\Test\Squelettes\Balise;

use Spip\Test\SquelettesTestCase;
use Spip\Test\Template\Loader\StringLoader;
use Spip\Test\Templating;

class DossierSqueletteTest extends SquelettesTestCase
{
	public function testBaliseDossierSquelette(): void {
		$loader = new StringLoader();
		$templating = new Templating($loader);
		$expected = dirname($loader->getSourceFile('#DOSSIER_SQUELETTE'));
		$this->assertEqualsTemplate($expected, $templating, "#DOSSIER_SQUELETTE");
	}
}
