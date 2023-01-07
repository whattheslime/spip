<?php

declare(strict_types=1);

/***************************************************************************\
 *  SPIP, Système de publication pour l'internet                           *
 *                                                                         *
 *  Copyright © avec tendresse depuis 2001                                 *
 *  Arnaud Martin, Antoine Pitrou, Philippe Rivière, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribué sous licence GNU/GPL.     *
 *  Pour plus de détails voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

namespace Spip\Core\Tests;

use PHPUnit\Framework\TestCase;

/**
 * LegacyUnitPhpTest test - runs all the unit/ php tests and check the ouput is 'OK'
 */
class LegacyUnitPhpTest extends TestCase
{
	/**
	 * @dataProvider legacyPhpfileNameProvider
	 */
	public function testLegacyUnitPHP($inFname, $output)
	{
		$result = $this->legacyPhpRun($inFname);
		if ($result === $output) {
			$this->assertEquals($output, $result, $result);
		} else {
			$this->fail($result);
		}
	}

	public function legacyPhpfileNameProvider()
	{
		require_once(__DIR__ . '/legacy/test.inc');

		$liste_fichiers = tests_legacy_lister('php');
		$tests = [];
		foreach ($liste_fichiers as $k => $fichier) {
			$tests[$k] = [$fichier, 'OK'];
		}

		return $tests;
	}

	protected function legacyPhpRun($inFname)
	{
		chdir(_SPIP_TEST_INC);
		if (! is_file('../' . $inFname) || ! $realPath = realpath('../' . $inFname)) {
			$this->fail(
				"{$inFname} is missing" . json_encode([getcwd(), _SPIP_TEST_INC, _SPIP_TEST_CHDIR], JSON_THROW_ON_ERROR)
			);
		}

		$output = [];
		$returnCode = 0;
		chdir(__DIR__ . '/legacy');
		$php = PHP_BINARY;
		exec("{$php} \"{$realPath}\" mode=test_general", $output, $returnCode);

		if ($returnCode) {
			array_unshift($output, 'ReturnCode: ' . $returnCode);
		}

		$result = rtrim(implode("\n", $output));
		if (substr($result, 0, 2) === 'NA') {
			$this->markTestSkipped($result);
		} elseif (preg_match("#^OK \(?\d+\)?$#", $result)) {
			$result = 'OK';
		}

		return $result;
	}
}
