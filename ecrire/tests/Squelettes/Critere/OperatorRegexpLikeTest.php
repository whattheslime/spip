<?php

declare(strict_types=1);

namespace Spip\Test\Squelettes\Critere;

use PHPUnit\Framework\Attributes\Depends;
use Spip\Test\SquelettesTestCase;
use Spip\Test\Templating;

class OperatorRegexpLikeTest extends SquelettesTestCase
{
	private function getArticle(): string {
		$templating = Templating::fromString();
		return $templating->render(<<<SPIP
		<BOUCLE_a(ARTICLES){titre>=A}{titre<=Z}{0,1}>#ID_ARTICLE:[(#TITRE|substr{0,1})]</BOUCLE_a>
		NA Ce test exige un article ayant un titre qui commence par une lettre A-Z
		<//B_a>
		SPIP);
	}

	/** @return array{id_article: int, starts_with: string} */
	private function getArticleIdTitle(): array {
		$result = $this->getArticle();
		[$id_article, $starts_with] = explode(':', trim($result));
		return [
			'id_article' => (int) $id_article,
			'starts_with' => $starts_with
		];
	}

	public function testHasArticle(): void {
		$result = $this->getArticle();
		if ($this->isNa($result)) {
			$this->markTestSkipped($result);
		}
		[$id_article, $starts_with] = explode(':', trim($result));
		$id_article = (int) $id_article;

		$this->assertGreaterThan(0, $id_article);
	}

	#[Depends('testHasArticle')]
	public function testLike(): void {
		$art = $this->getArticleIdTitle();
		$contexte = [
			'id_article' => $art['id_article'],
			'like' => $art['starts_with'] . '%',
		];
		$this->assertOkCode(<<<SPIP
			<BOUCLE_b(ARTICLES){titre like #ENV{like}}{id_article}>ok</BOUCLE_b>
			Echec de {titre like #ENV{like}}
			<//B_b>
			SPIP,
			$contexte
		);
		$this->assertOkCode(<<<SPIP
			<BOUCLE_c(ARTICLES){titre !like #ENV{like}}{id_article}> </BOUCLE_c>
			Echec de {titre !like #ENV{like}}
			</B_c>
			ok
			<//B_c>
			SPIP,
			$contexte
		);
	}

	#[Depends('testHasArticle')]
	public function testRegexp(): void {
		$art = $this->getArticleIdTitle();
		$contexte = [
			'id_article' => $art['id_article'],
			'regexp' => '^' . $art['starts_with'],
		];
		$this->assertOkCode(<<<SPIP
			<BOUCLE_b(ARTICLES){titre == #ENV{regexp}}{id_article}>ok</BOUCLE_b>
			Echec de {titre == #ENV{regexp}}
			<//B_b>
			SPIP,
			$contexte
		);
		$this->assertOkCode(<<<SPIP
			<BOUCLE_c(ARTICLES){titre !== #ENV{regexp}}{id_article}> </BOUCLE_c>
			Echec de {titre !== #GET{regexp}}
			</B_c>
			ok
			<//B_c>
			SPIP,
			$contexte
		);
	}
}
