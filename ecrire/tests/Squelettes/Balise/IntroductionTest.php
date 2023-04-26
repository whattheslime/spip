<?php

declare(strict_types=1);

namespace Spip\Test\Squelettes\Balise;

use Spip\Test\SquelettesTestCase;
use Spip\Test\Templating;

class IntroductionTest extends SquelettesTestCase
{
	protected function getIdArticleLong(): int
	{
		include_spip('base/abstract_sql');
		$id_article = sql_getfetsel(
			'id_article',
			'spip_articles',
			"descriptif='' AND LENGTH(CONCAT(chapo, texte)) > 520 AND texte!='' AND LENGTH(chapo) > 100",
			'',
			'id_article',
			'0,1'
		);
		return intval($id_article);
	}

	public function testArticleLongExiste(): void
	{
		$templating = Templating::fromString();
		$id_article = $this->getIdArticleLong();
		$code = "<BOUCLE_a(ARTICLES){id_article}{tout}>OK</BOUCLE_a>NA<//B_a>";
		$result = $templating->render($code, ['id_article' => $id_article]);
		if ($this->isNA($result)) {
			$this->markTestSkipped($result);
		}

		$this->assertOK($result);
	}

	/**
	 * @depends testArticleLongExiste
	 */
	public function testCoupeIntroduction(): void
	{
		$templating = Templating::fromString();
		$id_article = $this->getIdArticleLong();
		$code = "<BOUCLE_a(ARTICLES){id_article}{tout}{0,1}>#INTRODUCTION</BOUCLE_a>";
		$result = $templating->render($code, ['id_article' => $id_article]);
		$suite = '&nbsp;(...)';
		$this->assertMatchesRegularExpression('#' . preg_quote($suite . '</p>', '#') . '$#', $result);
	}

	/**
	 * @depends testArticleLongExiste
	 */
	public function testCoupeIntroductionSuite(): void
	{
		$templating = Templating::fromString();
		$id_article = $this->getIdArticleLong();
		$code = "<BOUCLE_a(ARTICLES){id_article}{tout}{0,1}>#INTRODUCTION{…}</BOUCLE_a>";
		$result = $templating->render($code, ['id_article' => $id_article]);
		$suite = '…';
		$this->assertMatchesRegularExpression('#' . preg_quote($suite . '</p>', '#') . '$#', $result);

		$code = "<BOUCLE_a(ARTICLES){id_article}{tout}{0,1}>#INTRODUCTION{#ENV{suite}}</BOUCLE_a>";
		$result = $templating->render($code, [
			'id_article' => $id_article,
			'suite' => $suite,
		]);
		$this->assertMatchesRegularExpression('#' . preg_quote($suite . '</p>', '#') . '$#', $result);
	}

	/**
	 * @depends testCoupeIntroduction
	 */
	public function testCoupeIntroductionConstante(): void
	{
		$id_article = $this->getIdArticleLong();
		$templating = Templating::fromString([
			'fonctions' => "
				if (!defined('_INTRODUCTION_SUITE')) {
					define('_INTRODUCTION_SUITE', '!!!');
				}
			",
		]);
		$code = "#CACHE{0}<BOUCLE_a(ARTICLES){id_article}{tout}{0,1}>#INTRODUCTION</BOUCLE_a>";
		$result = $templating->render($code, ['id_article' => $id_article]);
		$suite = _INTRODUCTION_SUITE;
		$this->assertMatchesRegularExpression('#' . preg_quote($suite . '</p>', '#') . '$#', $result);
	}
}
