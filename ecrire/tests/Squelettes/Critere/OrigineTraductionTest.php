<?php

declare(strict_types=1);

namespace Spip\Test\Squelettes\Critere;

use PHPUnit\Framework\Attributes\Depends;
use Spip\Test\SquelettesTestCase;
use Spip\Test\Templating;

class OrigineTraductionTest extends SquelettesTestCase
{

	/** Un article non traduit est bien {origine_traduction} */
	public function testArticleTraduitEstOrigineTraduction(): void {
		$templating = Templating::fromString();
		$result = $templating->render(<<<SPIP
		<BOUCLE_t(ARTICLES)/>[(#TOTAL_BOUCLE|<{2}|?{NA il faut des articles})]<//B_t>
		<BOUCLE_ori(ARTICLES){origine_traduction}{id_trad=0}{0,1}> </BOUCLE_ori>
		Erreur boucle origine
		<//B_ori>
		ok
		SPIP);
		if ($this->isNa($result)) {
			$this->markTestSkipped($result);
		}

		$this->assertOk($result);
	}

	/** Un article traduit n'a qu'une traduction qui est {origine_traduction} */
	public function testArticleTraduitAUneSeuleTraductionOrigineTraduction(): void {
		$templating = Templating::fromString();
		$result = $templating->render(<<<SPIP
		<BOUCLE_ori2(ARTICLES){id_trad>0}{origine_traduction}>
		<BOUCLE_casse(ARTICLES){traduction}{origine_traduction}{!id_article}>
			Boum ! #ID_ARTICLE ne devrait pas etre origine
		</BOUCLE_casse>
		</BOUCLE_ori2>
		NA ce test exige d'avoir au moins un article traduit
		<//B_ori2>
		OK
		SPIP);
		if ($this->isNa($result)) {
			$this->markTestSkipped($result);
		}

		$this->assertOk($result);
	}
}
