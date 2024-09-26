<?php

declare(strict_types=1);

namespace Spip\Test\Rubriques;

use Spip\Test\SquelettesTestCase;

class CreerRubriqueNommeeTest extends SquelettesTestCase
{
	/**
	 * La fonction creer_rubrique_nommee('a/b/c/d') creee une arborescence et renvoie l'id_rubrique
	 * Ici on en prend 10 au pif et on essaie de voir si on retombe bien dessus (attention, le
	 * test est potentiellement "destructeur" (ou plutot "constructeur", puisqu'il creera des
	 * rubriques superflues) si la fonction echoue, ou si deux rubriques soeurs portent le meme titre).
	 */
	public function testCreerRubriqueNommee(): void {
		$this->assertOkCode(<<<SPIP
			<BOUCLE_r(RUBRIQUES){par hasard}{0,10}>
			[(#SET{hier,''})]
			<BOUCLE_h(HIERARCHIE){tout}>
			[(#SET{hier,[(#GET{hier})][/(#TITRE**)]})]
			</BOUCLE_h>
			[(#GET{hier}|creer_rubrique_nommee|=={#ID_RUBRIQUE}|?{'',
				[(#GET{hier}|htmlspecialchars)]
				[(#SET{bug,1})]
			})]
			</B_h>
			</BOUCLE_r>
			[(#GET{bug}|?{'',OK})]
		SPIP);
	}
}
