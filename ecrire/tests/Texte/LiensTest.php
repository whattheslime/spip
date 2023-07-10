<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction interdire_script du fichier inc/texte.php
 */

namespace Spip\Test\Texte;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class LiensTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		include_spip('inc/texte');
		include_spip('inc/lang');
	}

	public function testLiensHrefLangAutomatique() {
		$article = sql_fetsel(
			['id_article', 'lang'],
			'spip_articles',
			[
				'statut = ' . sql_quote('publie'),
				'lang != ' . sql_quote('')
			],
			limit: '0,1',
		);

		$id_article = $article['id_article'];
		$lang = $article['lang'];

		// on se met dans une autre langue que celle de l'article
		lang_select($lang === 'eo' ? 'fa' : 'eo');

		$case = '[->' . $id_article . ']';
		$propre = propre($case);
		$this->assertEquals(
			$lang,
			extraire_attribut($propre, 'hreflang'),
			sprintf('hreflang automatique errone dans "%s". Propre: "%s"', $case, $propre)
		);
	}

	#[DataProvider('providerLiensClassCss')]
	public function testLiensClassCss(string $table, ?string $short) {
		$id = sql_getfetsel(id_table_objet($table), $table, "statut='publie'", limit: '0,1');
		$type = objet_type($table);
		if (!$id) {
			$this->markTestSkipped(sprintf('Necessite un·e %s publié', $type));
		}
		$cases = ["[->$type{$id}]"];
		if ($short) {
			$cases[] = "[->$short{$id}]";
		}
		foreach ($cases as $case) {
			$propre = propre($case);
			$classes = extraire_attribut($propre, 'class');
			$err = sprintf('Classe CSS "%s" errone dans "%s". Propre: "%s"', (string) $classes, $case, $propre);
			$this->assertNotNull($classes, $err);
			$this->assertStringContainsString('spip_in', $classes, $err);
			$this->assertStringNotContainsString('spip_out', $classes, $err);
		}
	}

	public static function providerLiensClassCss(): array {
		return [
			'article' => [
				'table' => 'spip_articles',
				'short' => 'art',
			],
			'rubrique' => [
				'table' => 'spip_rubriques',
				'short' => 'rub',
			],
			'site' => [
				'table' => 'spip_syndic',
				'short' => null,
			],
		];
	}

	#[DataProvider('providerLiens')]
	public function testLiens($case, $url, $hreflang, $title, $text) {
		lang_select('eo');
		$propre = propre($case);
		$this->assertEquals(
			$url,
			extraire_attribut($propre, 'href'),
			sprintf('URL mal extraite de "%s". Propre: "%s"', $case, $propre)
		);
		$this->assertEquals(
			$hreflang,
			extraire_attribut($propre, 'hreflang'),
			sprintf('Hreflang erroné dans "%s". Propre: "%s"', $case, $propre)
		);
		$this->assertEquals(
			$title,
			extraire_attribut($propre, 'title'),
			sprintf('Title erroné dans "%s". Propre: "%s"', $case, $propre)
		);
		$this->assertEquals(
			$text,
			supprimer_tags($propre),
			sprintf('Texte du lien abîmé dans "%s". Propre: "%s"', $case, $propre)
		);
	}

	public static function providerLiens(): array {
		return [
			'hreflang incorrect spécifié ignoré' => [
				'case' => '[bla {blabla}->url]',
				'url' => 'url',
				'hreflang' => null,
				'title' => null,
				'text' => 'bla blabla'
			],
			'hreflang correct spécifié pris en compte' => [
				'case' => '[bla{en}->url]',
				'url' => 'url',
				'hreflang' => 'en',
				'title' => null,
				'text' => 'bla'
			],
			'title spécifié pris en compte' => [
				'case' => '[bla|bulle de savon{eo}->url]',
				'url' => 'url',
				'hreflang' => 'eo',
				'title' => 'bulle de savon',
				'text' => 'bla'
			],
			'title comme une langue devient hreflang aussi' => [
				'case' => '[bla|fa->url]',
				'url' => 'url',
				'hreflang' => 'fa',
				'title' => 'fa',
				'text' => 'bla'
			],
			'title autre qu’une langue ne contamine pas hreflang' => [
				'case' => '[bla|bulle de savon->url]',
				'url' => 'url',
				'hreflang' => null,
				'title' => 'bulle de savon',
				'text' => 'bla'
			],
			'multi dans liens' => [
				'case' => '[<multi>[fr]X[eo]Y[fa]Z</multi>->url]',
				'url' => 'url',
				'hreflang' => null,
				'title' => null,
				'text' => 'Y'
			],
		];
	}

	#[DataProvider('providerLiensAutomatiques')]
	public function testLiensAutomatiques($case, $url) {
		$propre = propre($case);
		$this->assertEquals(
			$url,
			extraire_attribut(extraire_balise($propre, 'a'), 'href'),
			sprintf('Erreur lien dans "%s". Propre: "%s"', $case, $propre)
		);
	}

	public static function providerLiensAutomatiques(): array {
		return [
			'sans protocole' => [
				'case' => 'un superbe www.monsite.tld, pas mal',
				'url' => 'http://www.monsite.tld',
			],
			'protocole http' => [
				'case' => 'un superbe http://www.monsite.tld, pas mal',
				'url' => 'http://www.monsite.tld',
			],
			'protocole https' => [
				'case' => 'un superbe https://www.monsite.tld, pas mal',
				'url' => 'https://www.monsite.tld',
			],
		];
	}

	public function testLiensAvecAncre() {
		$case = '[uneancre<-] a [->www.monsite.tld]';
		$url = 'http://www.monsite.tld';
		$propre = propre($case);
		$this->assertEquals(
			$url,
			extraire_attribut(extraire_balises($propre, 'a')[1], 'href'),
			sprintf('Erreur lien dans "%s". Propre: "%s"', $case, $propre)
		);
	}

	public function testLienModele() {
		$case = '<flv|url=http://rezo.net/>';
		$propre = propre($case);
		$expected = '<p><tt>&lt;flv|url=http://rezo.net/&gt;</tt></p>';
		$this->assertEquals(
			$expected,
			$propre,
			sprintf('Erreur lien dans "%s". Propre: "%s"', $case, $propre)
		);
	}
}
