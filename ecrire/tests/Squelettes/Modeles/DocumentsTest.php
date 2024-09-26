<?php

declare(strict_types=1);

namespace Spip\Test\Squelettes\Modeles;

use PHPUnit\Framework\Attributes\DataProvider;
use Spip\Test\SquelettesTestCase;
use Spip\Test\Templating;

class DocumentsTest extends SquelettesTestCase
{
	/**
	 * D'abord une image uploadee en vignette, et sans titre
	 * On teste le rendu de son src, width, height
	 */
	#[DataProvider('providerDocumentSansTitreModeles')]
	public function testDocumentSansTitreModeles(string $modele): void {
		$id_document = $this->getIdDocumentImageSansTitreNiDescriptif();
		$modele = sprintf($modele, $id_document);
		$this->assertOkCode(
			<<<SPIP
			[(#SET{modele,[(#ENV*{modele}|propre)]})]
			[(#SET{src,#GET{modele}|extraire_balise{img}|extraire_attribut{src}})]
			[(#GET{src}|quote_amp|=={#URL_DOCUMENT}|oui)OK ]
			\<img#ID_DOCUMENT\> src pas bon: "#URL_DOCUMENT" != "[(#GET{src})]"
			SPIP
			,
			[
				'id_document' => $id_document,
				'modele' => $modele,
			]
		);
	}

	public static function providerDocumentSansTitreModeles() {
		return [
			'img' => ['<img%s>'],
			'doc' => ['<doc%s>'],
			'emb' => ['<emb%s>'],
		];
	}

	private function getIdDocumentImageSansTitreNiDescriptif(): int {
		$templating = Templating::fromString();
		$result = $templating->render(<<<SPIP
		<BOUCLE_d(DOCUMENTS){mode=image}{titre=''}{descriptif=''}{0,1}>#ID_DOCUMENT</BOUCLE_d>
		NA Ce test exige une image chargee en mode "image" et n'ayant ni titre ni descriptif
		<//B_d>
		SPIP);
		if ($this->isNa($result)) {
			$this->markTestSkipped($result);
		}
		return (int) $result;
	}
}
