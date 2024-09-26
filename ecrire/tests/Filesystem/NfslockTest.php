<?php

declare(strict_types=1);

namespace Spip\Test\Filesystem;

use PHPUnit\Framework\TestCase;

class NfslockTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		include_spip('inc/nfslock');
	}

	public function testNfslock(): void {
		$verrou = spip_nfslock('monfichier');
		$this->assertNotFalse($verrou, 'Echec: pose du verrou');

		$this->assertTrue(spip_nfslock_test('monfichier', $verrou), 'Échec: Ne valide pas le verrou posé sur le fichier');
		$this->assertFalse(spip_nfslock_test('un autre', $verrou), 'Échec: valide le verrou sur un autre fichier');
		$this->assertTrue(spip_nfsunlock('monfichier', $verrou), 'Échec: déverrouillage du verrou sur notre fichier');

		$this->assertFalse(spip_nfslock_test('monfichier', $verrou), 'Échec: verrou toujours présent sur notre fichier');
		$this->assertFalse(spip_nfslock_test('monfichier', 0));
	}
}
