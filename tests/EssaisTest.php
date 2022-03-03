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

	protected static $pretest_function_launched = [];
	protected static $posttest_function_tolaunch = [];

	/**
	 * @dataProvider EssaisProvider
	 */
	public function testEssai($test_function, $input, $output){

		$namespace = '\\Spip\\Core\\Tests\\';
		$pretest_function = $namespace . 'pre' . $test_function;
		$posttest_function = $namespace . 'post' . $test_function;
		$test_function = $namespace . $test_function;

		if (function_exists($pretest_function)
			and empty(self::$pretest_function_launched[$pretest_function])) {
			self::$pretest_function_launched[$pretest_function] = true;
			$pretest_function();
		}

		$result = $test_function(...$input);

		if (function_exists($posttest_function)) {
			self::$posttest_function_tolaunch[$posttest_function] = true;
		}

		if (is_array($output)
			and !empty($output[0])
		  and is_string($output[0])
			and function_exists($output[0])
			and !empty($output[1])
			and isset($output[2])
		) {
			list($fmatch, $match_string, $output) = $output;
			if ($fmatch === 'preg_match' and $output === true) {
				$this->assertMatchesRegularExpression($match_string, $result);
			}
			elseif ($fmatch === 'preg_match' and $output === false) {
				$this->assertDoesNotMatchRegularExpression($match_string, $result);
			}
			else {
				$this->assertEquals($fmatch($match_string, $result), $output);
			}
		}
		elseif (is_double($output) and is_double($result)){

				$this->assertTrue(abs($output-$result)<=1e-10*abs($output));
		}
		else {
			$this->assertSame($output, $result);
			$this->assertEquals($output, $result);
		}
	}

	protected function check_equality($val1,$val2){
		if (is_array($val1) AND is_array($val2)){
			return (
				    !count(array_diff_assoc_recursive($val1,$val2))
			  AND !count(array_diff_assoc_recursive($val2,$val1))
			);
		}
		elseif (is_array($val1) OR is_array($val2)){
			return false;
		}
		elseif (is_double($val1) OR is_double($val2)){
			return abs($val1-$val2)<=1e-10*abs($val1);
		}
		else
			return $val1===$val2;
	}


	public static function tearDownAfterClass():void {
		foreach (array_keys(self::$posttest_function_tolaunch) as $posttest_function) {
			$posttest_function();
		}
  }

	public function EssaisProvider(){


		$dir_base = __DIR__. '/essais';
		$essais_files = glob("{{$dir_base}/*.php,{$dir_base}/*/*.php,{$dir_base}/*/*/*.php}",GLOB_BRACE);

		include_once __DIR__ . "/bootstrap.php";
		$tests = [
		];
		foreach ($essais_files as $essai_file) {
			include_once($essai_file);

			$joli_file = substr($essai_file, strlen($dir_base) + 1, -4);

			$function_base = str_replace('/', '_', $joli_file);
			$essais_function = '\\Spip\\Core\\Tests\\essais_'.$function_base;
			$test_function = 'test_'.$function_base;

			$essais = $essais_function();
			$i = 0;
			foreach ($essais as $k => $essai) {
				$output = array_shift($essai);
				$input = $essai;
				$key = $joli_file.'_'.str_pad($i,2,0,STR_PAD_LEFT);
				if (!is_numeric($k)) {
					$key .= "_$k";
				}
				$tests[$key] = [$test_function, $input, $output];
				$i++;
			}
		}

		return $tests;
	}

}
