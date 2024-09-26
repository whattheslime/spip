<?php

declare(strict_types=1);

namespace Spip\Test\Filesystem;

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;

class DirPluginsSupplTest extends TestCase
{
	public const DIR_PLUGINS_SUPPL = _DIR_TMP . 'test_dir_plugins_suppl/';

	public const DIR_PLUGINS_OUTSIDE = _DIR_TMP . 'test_dir_plugins_outisde/';

	public const PAQUET_TEST = 'toto/paquet.xml';

	public static function setUpBeforeClass(): void {
		find_in_path('./inc/plugin.php', '', true);
		supprimer_repertoire(self::DIR_PLUGINS_SUPPL);
		mkdir(self::DIR_PLUGINS_SUPPL . 'toto', 0777, true);
		mkdir(self::DIR_PLUGINS_OUTSIDE . 'toto', 0777, true);
		copy(__DIR__ . '/data/paquet.xml', self::DIR_PLUGINS_SUPPL . self::PAQUET_TEST);
		copy(__DIR__ . '/data/paquet.xml', self::DIR_PLUGINS_OUTSIDE . self::PAQUET_TEST);
	}

	public static function tearDownAfterClass(): void {
		supprimer_repertoire(self::DIR_PLUGINS_SUPPL);
		supprimer_repertoire(self::DIR_PLUGINS_OUTSIDE);
	}

	public function testConstant() {
		// preparation: la constante est elle definie et comprend uniquement 1 reps suppl?
		if (defined('_DIR_PLUGINS_SUPPL') && _DIR_PLUGINS_SUPPL !== self::DIR_PLUGINS_SUPPL) {
			$this->markTestSkipped(
				sprintf(
					'La constante _DIR_PLUGINS_SUPPL est déjà définie, le test ne peut s’appliquer. Valeur "%s"',
					_DIR_PLUGINS_SUPPL
				)
			);
		}
		define('_DIR_PLUGINS_SUPPL', self::DIR_PLUGINS_SUPPL);
		if (substr_count(_DIR_PLUGINS_SUPPL, ':') !== 0) {
			$this->markTestSkipped(
				sprintf(
					'La constante _DIR_PLUGINS_SUPPL ne doit contenir qu’un seul chemin supplémentaire. Valeur: "%s"',
					_DIR_PLUGINS_SUPPL
				)
			);
		}
		if (!str_ends_with(_DIR_PLUGINS_SUPPL, '/')) {
			$this->markTestSkipped(
				sprintf('La constante _DIR_PLUGINS_SUPPL doit terminer par un /. Valeur: "%s"', _DIR_PLUGINS_SUPPL)
			);
		}
		$this->assertTrue(true);
	}

	#[Depends('testConstant')]
	public function testDirectory() {
		// le rep suppl existe
		$this->assertTrue(
			is_dir(self::DIR_PLUGINS_SUPPL),
			sprintf('Le répertoire "%s" aurait du être créé', self::DIR_PLUGINS_SUPPL)
		);
		$this->assertTrue(
			file_exists(self::DIR_PLUGINS_SUPPL . self::PAQUET_TEST),
			sprintf('Le fichier "%s" aurait du être créé', self::DIR_PLUGINS_SUPPL . self::PAQUET_TEST)
		);
		// le rep outside existe
		$this->assertTrue(
			is_dir(self::DIR_PLUGINS_OUTSIDE),
			sprintf('Le répertoire "%s" aurait du être créé', self::DIR_PLUGINS_OUTSIDE)
		);
		$this->assertTrue(
			file_exists(self::DIR_PLUGINS_OUTSIDE . self::PAQUET_TEST),
			sprintf('Le fichier "%s" aurait du être créé', self::DIR_PLUGINS_OUTSIDE . self::PAQUET_TEST)
		);
	}

	#[Depends('testDirectory')]
	public function testListePluginsSuppl() {
		$plugins = liste_plugin_files(self::DIR_PLUGINS_SUPPL);
		// verifier qu'on retrouve bien tous les rep suppl de _DIR_PLUGINS_SUPPL
		$this->assertContains(
			'toto',
			$plugins,
			sprintf('Le répertoire "%s" non trouvé dans "%s"', 'toto', self::DIR_PLUGINS_SUPPL)
		);
		// Mais pas des plugins en trop !
		$this->assertCount(1, $plugins, sprintf('Il y a plus qu’un plugin trouvé dans "%s"', self::DIR_PLUGINS_SUPPL));
	}
}
