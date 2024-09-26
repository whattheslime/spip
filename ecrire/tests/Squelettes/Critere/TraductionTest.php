<?php

declare(strict_types=1);

namespace Spip\Test\Squelettes\Critere;

use Spip\Test\SquelettesTestCase;
use Spip\Test\Templating;

class TraductionTest extends SquelettesTestCase
{
	/**
	 * Un article sans trad
	 */
	public function testArticleSansTraduction(): void {
		$templating = Templating::fromString();
		$result = $templating->render(<<<SPIP
		<BOUCLE_principale(ARTICLES){id_trad=0}{0,1}>
		<BOUCLE_check(ARTICLES){traduction}> </BOUCLE_check>
			boucle check: le critere {traduction} a echoue
			sur un article non traduit (article #ID_ARTICLE)
		<//B_check>
		</BOUCLE_principale>
		NA Le test 1 requiert un article publie sur le site
		<//B_principale>
		ok
		SPIP);
		if ($this->isNa($result)) {
			$this->markTestSkipped($result);
		}

		$this->assertOk($result);
	}

	/**
	 * un article et ses traductions
	 */
	public function testArticleAvecTraductions(): void {
		$templating = Templating::fromString();
		$result = $templating->render(<<<SPIP
		<BOUCLE_s(ARTICLES){id_trad>0}{0,1}>
		<BOUCLE_t(ARTICLES){traduction}> </BOUCLE_t>
		</BOUCLE_s>
		NA	Le test 2 necessite un article publie et traduit
		<//B_s>
		ok
		SPIP);
		if ($this->isNa($result)) {
			$this->markTestSkipped($result);
		}

		$this->assertOk($result);
	}
}
