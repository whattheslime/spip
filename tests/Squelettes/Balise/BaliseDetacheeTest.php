<?php

namespace Spip\Core\Tests\Squelettes\Balise;

use Spip\Core\Testing\SquelettesTestCase;
use Spip\Core\Testing\Code;

class BaliseDetacheeTest extends SquelettesTestCase
{
	public function testNecessiteNomSite(): void {
		$val = (new Code())->render('<BOUCLE_meta(spip_meta){nom=nom_site}>#VALEUR</BOUCLE_meta>');
		$this->assertNotEmpty($val);
	}

	/**
	 * @depends testNecessiteNomSite
	 */
	public function testBaliseDetacheeInterne(): void {
		$code = new Code();
		$expected = $code->render('<BOUCLE_meta(spip_meta){nom=nom_site}>#VALEUR</BOUCLE_meta>');
		$actual = $code->render(
			'<BOUCLE_meta(spip_meta){nom=nom_site}>
				<BOUCLE_meta2(spip_meta){nom=adresse_site}>
					#_meta:VALEUR
				</BOUCLE_meta2>
			</BOUCLE_meta>'
		);

		$this->assertEquals($expected, trim($actual));
	}

	public function testBaliseDetacheeHorsBoucle(): void {
		$actual = (new Code())->render(
			'<BOUCLE_meta(spip_meta){nom=nom_site}></BOUCLE_meta>
			<BOUCLE_meta2(spip_meta){nom=version_base}>#_meta:VALEUR</BOUCLE_meta2>'
		);
		// en dehors de sa boucle, une balise detachee n'est pas reconnue
		$this->assertEquals('', trim($actual));
	}
}

