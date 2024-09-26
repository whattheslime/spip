<?php

declare(strict_types=1);

namespace Spip\Test\Squelettes\Critere;

use Spip\Test\SquelettesTestCase;

class BrancheTest extends SquelettesTestCase
{
	/**
	 * 	Un test pour le critere {branche}
	 *
	 * 	verifie :
	 * 	- une rubrique est dans sa branche
	 * 	- sa fille est dans sa branche
	 * 	- elle n'est pas dans la branche de sa fille
	 *  - que la boucle documents compile sans erreur
	 * 	- que la boucle articles compile sans erreur
	 */
	public function testCritereBranche(): void {
		$this->assertOkCode(<<<SPIP
		<BOUCLE_a(RUBRIQUES){id_parent>0}>
			<BOUCLE_b(RUBRIQUES){id_rubrique=#ID_PARENT}>
				<BOUCLE_d(RUBRIQUES){branche}{id_rubrique}>
				</BOUCLE_d>
				#_b:ID_RUBRIQUE devrait etre dans sa propre branche<br />
				<//B_d>

				<BOUCLE_c(RUBRIQUES){branche}{id_rubrique=#_a:ID_RUBRIQUE}>
				</BOUCLE_c>
				#_a:ID_RUBRIQUE devrait etre dans la branche de #_b:ID_RUBRIQUE<br />
				<//B_c>
			</BOUCLE_b>
			<BOUCLE_e(RUBRIQUES){branche}{id_rubrique=#ID_PARENT}>
			#ID_RUBRIQUE ne devrait pas etre dans la branche de sa fille ! <br />
			</BOUCLE_e>
		</BOUCLE_a>
		ok
		SPIP);
	}

	public function testCompileBoucle(): void {
		$this->assertOkCode(<<<SPIP
		<BOUCLE_art(ARTICLES){branche}{0,1}> </BOUCLE_art>
		<BOUCLE_docs(DOCUMENTS){branche}{0,1}> </BOUCLE_docs>
		OK
		SPIP);
	}
}
