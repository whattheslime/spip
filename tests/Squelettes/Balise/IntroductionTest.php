<?php

declare(strict_types=1);

namespace Spip\Core\Tests\Squelettes\Balise;

use Spip\Core\Testing\SquelettesTestCase;
use Spip\Core\Testing\Templating;

class IntroductionTest extends SquelettesTestCase
{
	public function testArticleLongExiste(): void
	{
		$templating = Templating::fromString();
		$code = "<BOUCLE_a(ARTICLES){chapo=='.{100}'}{texte!=''}{descriptif=''}{0,1}>OK</BOUCLE_a>NA<//B_a>";
		$result = $templating->render($code);
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
		$code = "<BOUCLE_a(ARTICLES){chapo=='.{100}'}{texte!=''}{descriptif=''}{0,1}>#INTRODUCTION</BOUCLE_a>";
		$result = $templating->render($code);
		$suite = '&nbsp;(...)';
		$this->assertMatchesRegularExpression('#' . preg_quote($suite . '</p>', '#') . '$#', $result);
	}

	/**
	 * @depends testArticleLongExiste
	 */
	public function testCoupeIntroductionSuite(): void
	{
		$templating = Templating::fromString();
		$code = "<BOUCLE_a(ARTICLES){chapo=='.{100}'}{texte!=''}{descriptif=''}{0,1}>#INTRODUCTION{…}</BOUCLE_a>";
		$result = $templating->render($code);
		$suite = '…';
		$this->assertMatchesRegularExpression('#' . preg_quote($suite . '</p>', '#') . '$#', $result);

		$code = "<BOUCLE_a(ARTICLES){chapo=='.{100}'}{texte!=''}{descriptif=''}{0,1}>#INTRODUCTION{#ENV{suite}}</BOUCLE_a>";
		$result = $templating->render($code, [
			'suite' => $suite,
		]);
		$this->assertMatchesRegularExpression('#' . preg_quote($suite . '</p>', '#') . '$#', $result);
	}

	/**
	 * @depends testCoupeIntroduction
	 */
	public function testCoupeIntroductionConstante(): void
	{
		$templating = Templating::fromString([
			'fonctions' => "
				if (!defined('_INTRODUCTION_SUITE')) {
					define('_INTRODUCTION_SUITE', '!!!');
				}
			",
		]);
		$code = "#CACHE{0}<BOUCLE_a(ARTICLES){chapo=='.{100}'}{texte!=''}{descriptif=''}{0,1}>#INTRODUCTION</BOUCLE_a>";
		$result = $templating->render($code);
		$suite = _INTRODUCTION_SUITE;
		$this->assertMatchesRegularExpression('#' . preg_quote($suite . '</p>', '#') . '$#', $result);
	}
}
