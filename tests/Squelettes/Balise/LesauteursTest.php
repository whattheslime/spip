<?php
namespace Spip\Core\Tests\Squelettes\Balise;

use Spip\Core\Testing\SquelettesTestCase;
use Spip\Core\Testing\Templating;

class LesauteursTest extends SquelettesTestCase
{
	public function testLesAuteursRenvoieQqc(): void {
		$templating = Templating::fromString();
		$result = $templating->render(
			"<BOUCLE_a(ARTICLES){id_auteur>0}{0,1}>
				[(#LESAUTEURS|?{OK,'LESAUTEURS a echoue'})]
			</BOUCLE_a>
				NA Ce test ne fonctionne que s'il existe un article ayant un auteur !
			<//B_a>"
		);
		if ($this->isNa($result)) {
			$this->markTestSkipped($result);
		}

		$this->assertOk($result);
	}
}

