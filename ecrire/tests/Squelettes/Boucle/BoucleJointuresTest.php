<?php

declare(strict_types=1);

namespace Spip\Test\Squelettes\Boucle;

use Spip\Test\SquelettesTestCase;
use Spip\Test\Templating;

class BoucleJointuresTest extends SquelettesTestCase
{
	public function testJointureArticleIdmot1(): void {
		// S'assurer que la seconde boucle est bien optimisée en l'absence de id_mot dans le env
		$code1 = '<BOUCLE(ARTICLES){id_rubrique?}{par id_article}{0,3}>:#ID_ARTICLE:</BOUCLE>';
		$code2 = '<BOUCLE(ARTICLES){id_rubrique?}{id_mot?}{par id_article}{0,3}>:#ID_ARTICLE:</BOUCLE>';

		$templating = Templating::fromString();
		$result1 = $templating->render($code1, ['id_mot' => 1]);
		if (empty($result1)) {
			$this->markTestSkipped("Pas d'articles dans la base pour tester la jointure id_mot");
		}
		$result2 = $templating->render($code2, ['id_mot' => 1]);
		$this->assertNotEquals($result1, $result2, "La jointure conditionnelle {id_mot?} n'a pas d'effet si un id_mot est dans le contexte");

		$templating = Templating::fromString();
		$result1 = $templating->render($code1, []);
		$result2 = $templating->render($code2, []);
		$this->assertEquals($result1, $result2, "La jointure conditionnelle {id_mot?} n'est pas neutre en l'absence de id_mot dans le contexte");
	}

	public function testJointureArticleIdmot2(): void {
		// S'assurer que la seconde boucle est bien optimisée en l'absence de id_mot dans le env
		$code1 = '<BOUCLE(ARTICLES){id_rubrique?}{par id_article}{0,3}>:#ID_ARTICLE+#ENV{id_mot}:</BOUCLE>';
		$code2 = '<BOUCLE(ARTICLES){id_rubrique?}{id_mot?}{par id_article}{0,3}>:#ID_ARTICLE+#ENV{id_mot}:</BOUCLE>';

		$templating = Templating::fromString();
		$result1 = $templating->render($code1, ['id_mot' => 1]);
		if (empty($result1)) {
			$this->markTestSkipped("Pas d'articles dans la base pour tester la jointure id_mot");
		}
		$result2 = $templating->render($code2, ['id_mot' => 1]);
		$this->assertNotEquals($result1, $result2, "La jointure conditionnelle {id_mot?} n'a pas d'effet si un id_mot est dans le contexte");

		$templating = Templating::fromString();
		$result1 = $templating->render($code1, []);
		$result2 = $templating->render($code2, []);
		$this->assertEquals($result1, $result2, "La jointure conditionnelle {id_mot?} n'est pas neutre en l'absence de id_mot dans le contexte");
	}

	public function testJointureArticleIdmot3(): void {
		// S'assurer que la seconde boucle conserve sa jointure sur id_mot du fait de l'utilisation de #ID_MOT dans la boucle
		$code1 = '<BOUCLE(ARTICLES){id_rubrique?}{par id_article}{0,3}>:#ID_ARTICLE+#ID_MOT:</BOUCLE>';
		$code2 = '<BOUCLE(ARTICLES){id_rubrique?}{id_mot?}{par id_article}{0,3}>:#ID_ARTICLE+#ID_MOT:</BOUCLE>';

		$templating = Templating::fromString();
		$result1 = $templating->render($code1, ['id_mot' => 1]);
		if (empty($result1)) {
			$this->markTestSkipped("Pas d'articles dans la base pour tester la jointure id_mot");
		}
		$result2 = $templating->render($code2, ['id_mot' => 1]);
		$this->assertNotEquals($result1, $result2, "La jointure conditionnelle {id_mot?} n'a pas d'effet si un id_mot est dans le contexte");

		$templating = Templating::fromString();
		$result1 = $templating->render($code1, []);
		$result2 = $templating->render($code2, []);
		$this->assertNotEquals($result1, $result2, "La jointure conditionnelle {id_mot?} n'a pas été conservée en l'absence de id_mot dans le contexte");
	}
}
