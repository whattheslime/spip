<?php

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
 *
 */
class EssaisTest extends TestCase {

	/**
	 * @dataProvider EssaisProvider
	 */
	public function testEssai($test_function, $input, $output){
		$result = $test_function(...$input);
		$this->assertEquals($output, $result);
	}

	public function EssaisProvider(){


		$dir_base = __DIR__. '/essais';
		$essais_files = glob("{{$dir_base}/*.php,{$dir_base}/*/*.php,{$dir_base}/*/*/*.php}",GLOB_BRACE);

		include_once __DIR__ . "/spip.inc";
		$tests = [
		];
		foreach ($essais_files as $essai_file) {
			include_once($essai_file);

			$joli_file = substr($essai_file, strlen($dir_base) + 1, -4);

			$function_base = str_replace('/', '_', $joli_file);
			$essais_function = '\\Spip\\Core\\Tests\\essais_'.$function_base;
			$test_function = '\\Spip\\Core\\Tests\\test_'.$function_base;

			$essais = $essais_function();
			$i = 0;
			foreach ($essais as $k => $essai) {
				$output = array_shift($essai);
				$input = $essai;
				$tests[$joli_file.'_'.str_pad($i,2,0,STR_PAD_LEFT)] = [$test_function, $input, $output];
				$i++;
			}
		}

		return $tests;
	}

}
