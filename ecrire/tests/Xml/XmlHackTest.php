<?php

declare(strict_types=1);

namespace Spip\Test\Xml;

use PHPUnit\Framework\Attributes\DataProvider;
use Spip\Test\SquelettesTestCase;

/**
 * Le hack xml repère dans le squelette la sequence "< ?xml"
 * et évite de l'éxecuter en php
 */
class XmlHackTest extends SquelettesTestCase
{
	#[DataProvider('providerXmlIsNotPhp')]
	public function testXmlIsNotPhp(string $squelette): void {
		$skel = $this->relativePath(__DIR__ . '/data/' . $squelette);
		$out = recuperer_fond($skel, [], [
			'raw' => true,
			'trim' => true,
		]);
		$this->assertEmpty($out['erreur'] ?? null);
		$this->assertNotEmpty($out['texte']);
		$xml = simplexml_load_string($out['texte']);
		$this->assertOk((string) $xml[0]);
	}

	public static function providerXmlIsNotPhp(): array {
		return [
			['xmlhack'],
			['xmlhack_php'],
			['xmlhack_inclure'],
			['xmlhack_inclure_php'],
			['xmlhack_inclure_dyn'],
			['xmlhack_inclure_dyn_php'],
		];
	}
}
