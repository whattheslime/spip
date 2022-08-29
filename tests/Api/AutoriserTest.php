<?php

namespace Spip\Core\Tests\Api;

use PHPUnit\Framework\TestCase;

class AutoriserTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		include_spip('inc/autoriser');
		require_once(__DIR__ . '/data/autoriser.php');
	}

	public function testAutoriserOkNiet(): void {
		$this->assertFalse(autoriser('niet'));
		$this->assertTrue(autoriser('ok'));
	}

	public function testAutoriserNouvelleFonction(): void {
		$this->assertTrue(autoriser('chaparder'));
		$this->assertFalse(autoriser('paschaparder'));
		$this->assertTrue(autoriser('chaparder','velo'));
		$this->assertTrue(autoriser('velo','chaparder'));
		$this->assertTrue(autoriser('chaparder','carottes'));
		$this->assertTrue(autoriser('carottes','chaparder'));
	}

	public function testAutoriserIdentifiant(): void {
		$this->assertFalse(autoriser('unidentifiant'));
		$this->assertTrue(autoriser('unidentifiant', '', 1));
		$this->assertFalse(autoriser('unidentifiant', '', 2));
	}
}
