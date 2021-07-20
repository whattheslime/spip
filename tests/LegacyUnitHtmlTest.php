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
 * LegacyUnitHtmlTest test - runs all the unit/ php tests and check the ouput is 'OK'
 *
 */
class LegacyUnitHtmlTest extends TestCase {

	/**
	 * @dataProvider legacyHtmlfileNameProvider
	 */
	public function testLegacyUnitHtml($inFname, $output){
		$result = $this->legacyHtmlRun($inFname);
		$this->assertEquals($output, $result);
	}

	public function legacyHtmlfileNameProvider(){
		require_once(__DIR__ . '/../test.inc');

		$liste_fichiers = tests_legacy_lister('html');
		$tests = [];
		foreach ($liste_fichiers as $k => $fichier) {
			$tests[$k] = [$fichier, 'OK'];
		}

		return $tests;
	}

	protected function legacyHtmlRun($inFname){
		chdir(_SPIP_TEST_INC);
		if (!is_file('../'.$inFname)){
			$this->fail("$inFname is missing" . json_encode([getcwd(), _SPIP_TEST_INC, _SPIP_TEST_CHDIR]));
		}

		$output = [];
		$returnCode = 0;
		$realPath = realpath("tests/legacy/squel.php");
		exec("/usr/bin/env php \"$realPath\" test=$inFname mode=test_general", $output, $returnCode);

		if ($returnCode) {
			array_unshift($output, 'ReturnCode: '.$returnCode);
		}

		$result = rtrim(implode("\n", $output));
		if (preg_match(",^OK \(?\d+\)?$,", $result)) {
			$result = 'OK';
		}
		return $result;
	}
}
