<?php

declare(strict_types=1);

namespace Spip\Test\Urls;

/**
 * FIXME: Ce test fonctionnait (avec un hack dans les vieux tests legacy)
 * Il redéfinissait _SPIP_TEST_CHDIR (mais qui est déjà défini en entrant ici maintenant)
 */
class LiensAbsolusPriveTest extends LiensAbsolusTest
{
	public static function setUpBeforeClass(): void {
		#chdir(dirname(__DIR__, 2));
		find_in_path('./inc/utils.php', '', true);
	}

	public static function tearDownAfterClass(): void {
		#chdir(_SPIP_TEST_CHDIR);
	}

	public function testVerifierEspace(): void {
		if (!test_espace_prive()) {
			$this->markTestIncomplete('FIXME: être considéré dans l’espace privé dans le test');
		}
		$this->assertTrue(test_espace_prive(), 'On doit être dans l’espace privé');

	}
}
