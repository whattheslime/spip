<?php

declare(strict_types=1);

namespace Spip\Test\Squelettes\Balise;

use Spip\Test\SquelettesTestCase;
use Spip\Test\Templating;

class LesauteursTest extends SquelettesTestCase
{
	public function testLesAuteursRenvoieQqc(): void
	{
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
