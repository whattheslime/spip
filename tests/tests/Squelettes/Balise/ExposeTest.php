<?php

declare(strict_types=1);

namespace Spip\Core\Tests\Squelettes\Balise;

use Spip\Core\Testing\SquelettesTestCase;

class ExposeTest extends SquelettesTestCase
{
	public static function setUpBeforeClass(): void
	{
		include_spip('base/abstract_sql');
	}

	public function testExposerRubrique(): void
	{
		$id_rubrique = sql_getfetsel('id_rubrique', 'spip_rubriques', [
			'id_parent=' . sql_quote(0),
			'statut=' . sql_quote('publie'),
		]);

		$id_seconde_rubrique = sql_getfetsel('id_rubrique', 'spip_rubriques', [
			'id_parent=' . sql_quote(0),
			'statut=' . sql_quote('publie'),
			'id_rubrique != ' . (int) $id_rubrique,
		]);

		if (! $id_rubrique || ! $id_seconde_rubrique) {
			$this->markTestSkipped('Vous devez avoir au moins 2 rubriques racines publiees pour tester #EXPOSE...');
		}

		$this->assertOkCode(
			"<BOUCLE_racine(RUBRIQUES){racine}>
			[(#EXPOSE{ON,''}|oui)ok]
			</BOUCLE_racine>",
			[
				'id_rubrique' => $id_rubrique,
			]
		);

		$this->assertOkCode(
			"<BOUCLE_racine(RUBRIQUES){racine}{id_rubrique!=#ENV{id_rubrique}}{0,1}>
			[(#EXPOSE{ON,''}|non)ok]
			</BOUCLE_racine>",
			[
				'id_rubrique' => $id_rubrique,
			]
		);
	}

	/**
	 * @depends testExposerRubrique
	 */
	public function testExposerRubriqueInclus(): void
	{
		$this->assertOkSquelette(__DIR__ . '/data/balise_expose.html');
	}
}
