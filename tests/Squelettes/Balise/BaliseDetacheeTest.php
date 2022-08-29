<?php

namespace Spip\Core\Tests\Squelettes\Balise;

use Spip\Core\Testing\SquelettesTestCase;
use Spip\Core\Testing\Template;
use Spip\Core\Testing\Template\StringLoader;
use Spip\Core\Testing\Template\FileLoader;

class BaliseDetacheeTest extends SquelettesTestCase
{
	public function testNecessiteNomSite(): void {
		$template = new Template(new StringLoader());
		$val = $template->render('<BOUCLE_meta(spip_meta){nom=nom_site}>#VALEUR</BOUCLE_meta>');
		$this->assertNotEmpty($val);
	}

	/**
	 * @depends testNecessiteNomSite
	 */
	public function testBaliseDetacheeInterne(): void {
		$template = new Template(new StringLoader());
		$expected = $template->render('<BOUCLE_meta(spip_meta){nom=nom_site}>#VALEUR</BOUCLE_meta>');
		$actual = $template->render(
			'<BOUCLE_meta(spip_meta){nom=nom_site}>
				<BOUCLE_meta2(spip_meta){nom=adresse_site}>
					#_meta:VALEUR
				</BOUCLE_meta2>
			</BOUCLE_meta>'
		);

		$this->assertEquals($expected, trim($actual));
	}

	public function testBaliseDetacheeHorsBoucle(): void {
		$template = new Template(new StringLoader());
		$actual = $template->render(
			'<BOUCLE_meta(spip_meta){nom=nom_site}></BOUCLE_meta>
			<BOUCLE_meta2(spip_meta){nom=version_base}>#_meta:VALEUR</BOUCLE_meta2>'
		);
		// en dehors de sa boucle, une balise detachee n'est pas reconnue
		$this->assertEquals('', trim($actual));
	}

	/**
	 * @depends testBaliseDetacheeInterne
	 */
	public function testBaliseDetacheeComplexe(): void {
		$template = new Template(new FileLoader());
		$this->assertOk($template->render(__DIR__ . '/data/balise_detachee.html'));
	}
}

