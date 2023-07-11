<?php

declare(strict_types=1);

namespace Spip\Test\Urls;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Spip\Test\SquelettesTestCase;

class AbsUrlTest extends SquelettesTestCase
{
	public static function setUpBeforeClass(): void {
		find_in_path('./inc/utils.php', '', true);
	}

	/**
	 * Le filtre |abs_url doit modifier les liens a@href et img@src
	 * a l'interieur d'un texte, et modifier les simples chaines de caracteres
	 * quand elles proviennent de # URL_ARTICLE, mais pas ailleurs (# TITRE par ex)
	 */
	public function testAbsUrl() {
		$this->assertOkCode(<<<SPIP
		<BOUCLE_a(ARTICLES){texte=='<(a|img) '}{0,1}>
		[(#URL_ARTICLE
			|abs_url
			|=={#URL_ARTICLE}
			|?{#VAL{'erreur sur #URL_ARTICLE 1 :'}
				|concat{#URL_ARTICLE|abs_url}
				|concat{'=',#URL_ARTICLE}})]
		[(#URL_ARTICLE
			|abs_url{#URL_SITE_SPIP/}
			|=={#URL_SITE_SPIP|concat{/}|suivre_lien{#URL_ARTICLE}}
			|?{'',#VAL{'erreur sur #URL_ARTICLE 2 :'}
				|concat{#URL_ARTICLE|abs_url{#URL_SITE_SPIP/}
				|concat{'!=',#URL_SITE_SPIP,/,#URL_ARTICLE}}})]
		[(#TITRE|abs_url|=={#TITRE}|?{'','erreur sur #TITRE'})]
		[(#TITRE|abs_url|=={#TEXTE}|?{'erreur sur #TEXTE'})]
		</BOUCLE_a>
		OK
		<//B_a>
		SPIP);
	}

}
