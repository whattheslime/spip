<?php

declare(strict_types=1);

namespace Spip\Test\Squelettes\Balise;

use Spip\Test\SquelettesTestCase;

class DoublonsTest extends SquelettesTestCase
{

	/**
	 * Test pour la gestion de `#DOUBLONS`
	 *
	 * `#DOUBLONS{mots}` ou `#DOUBLONS{mots,famille}`
	 * donne l'etat des doublons `(MOTS)` à cet endroit
	 * sous forme de tableau d'id_mot  `array(1,2,3,...)`
	 *
	 * `#DOUBLONS` tout seul donne la liste brute de tous les doublons
	 * `#DOUBLONS*{mots}` donne la chaine brute `",1,2,3,..."`
	 * (changera si la gestion des doublons evolue)
	 */
	public function testBaliseDoublons(): void {
		$skel = <<<SPIP
			#SET{d,''}
			<BOUCLE_t(ARTICLES) />[(#TOTAL_BOUCLE|<{2}|?{NA})]<//B_t>
			<BOUCLE_a(ARTICLES){par hasard}{0,2}{doublons test}>
				#SET{d,#GET{d}|concat{','}|concat{#ID_ARTICLE}}
			</BOUCLE_a>
			[(#DOUBLONS|count|=={1}|?{'', 'erreur doublons 1'})]
			[(#DOUBLONS{articles}|count|?{'erreur doublons 2 non vide'})]
			[(#DOUBLONS{articles,test}|=={
				#GET{d}|explode{","}|array_filter
			}|?{'','erreur doublons 3'})]
			[(#DOUBLONS*{articles,test}|=={#GET{d}}|?{'','erreur doublons*'})]
			OK
		SPIP;
		$this->assertOkCode($skel);
	}

}
