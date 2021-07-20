<?php

/**
 * SCSSPHP
 *
 * @copyright 2012-2020 Leaf Corcoran
 *
 * @license http://opensource.org/licenses/MIT MIT
 *
 * @link http://scssphp.github.io/scssphp
 */

namespace ScssPhp\ScssPhp\Tests;

use PHPUnit\Framework\TestCase;


/**
 * LegacyUnitPhpTest test - runs all the unit/ php tests and check the ouput is 'OK'
 *
 */
class LegacyUnitPhpTest extends TestCase {

	/**
	 * @dataProvider legacyPhpfileNameProvider
	 */
	public function testLegacyUnitPHP($inFname, $output){
		$result = $this->legacyPhpRun($inFname);
		$this->assertEquals($output, $result);
	}

	public function legacyPhpfileNameProvider(){
		require_once(__DIR__ . '/legacy/test.inc');

		$liste_fichiers = tests_legacy_lister('php');
		$tests = [];
		foreach ($liste_fichiers as $k => $fichier) {
			$tests[$k] = [$fichier, 'OK'];
		}

		return $tests;
	}

	protected function legacyPhpRun($inFname){
		chdir(_SPIP_TEST_INC);
		if (!is_file('../'.$inFname)
		  or !$realPath = realpath('../'.$inFname)){
			$this->fail("$inFname is missing" . json_encode([getcwd(), _SPIP_TEST_INC, _SPIP_TEST_CHDIR]));
		}

		$output = [];
		$returnCode = 0;
		chdir(__DIR__ . '/legacy');
		exec("/usr/bin/env php \"$realPath\" mode=test_general", $output, $returnCode);

		if ($returnCode) {
			array_unshift($output, 'ReturnCode: '.$returnCode);
		}

		$result = rtrim(implode("\n", $output));
		if (preg_match(",^OK \(\d+\)$,", $result)) {
			$result = 'OK';
		}
		return $result;
	}
}
