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
		$this->assertEquals($result, $output);
	}

	public function legacyPhpfileNameProvider(){
		require(__DIR__ . '/../test.inc');

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
		exec("/usr/bin/env php $realPath", $output, $returnCode);

		if ($returnCode) {
			array_unshift($output, 'ReturnCode: '.$returnCode);
		}

		$result = rtrim(implode("\n", $output));
		return $result;
	}
}
