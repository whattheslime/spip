<?php

declare(strict_types=1);

use cogpowered\FineDiff\Render\Text;
use cogpowered\FineDiff\Diff;
use cogpowered\FineDiff\Granularity\Paragraph;
use cogpowered\FineDiff\Render\Html;

// pour FineDiff
#include_once _SPIP_TEST_INC . '/vendor/autoload.php';

function tests_init_dossier_squelettes() {
	$GLOBALS['dossier_squelettes'] = _DIR_TESTS . 'tests/legacy/squelettes';
}

function tests_loger_webmestre() {
	// il faut charger une session webmestre
	include_spip('base/abstract_sql');
	$webmestre = sql_fetsel('*', 'spip_auteurs', "statut='0minirezo' AND webmestre='oui'", '', 'id_auteur', '0,1');
	include_spip('inc/auth');
	auth_loger($webmestre);
}

/**
 * fonction pas obligatoire a utiliser mais qui simplifie la vie du testeur $fun: le nom de la fonction a tester
 * $essais: un tableau d'items array(résultat, arg1, arg2 ...) a tester descriptif dans l'index "je teste
 * ca"=>array(...) si pas d'index, "test {numero}" sera utilise retourne un tableau de textes d'erreur dont le but est
 * d'etre vide :)
 */
function tester_fun($fun, $essais, $opts = []) {
	// pas d'erreur au depart
	$err = [];

	// let's go !
	foreach ($essais as $titre => $ess) {
		switch (is_countable($ess) ? count($ess) : 0) {
			case 0:
				$res = null;
				break;
			case 1:
				$res = $fun();
				break;
			case 2:
				$res = $fun($ess[1]);
				break;
			case 3:
				$res = $fun($ess[1], $ess[2]);
				break;
			case 4:
				$res = $fun($ess[1], $ess[2], $ess[3]);
				break;
			case 5:
				$res = $fun($ess[1], $ess[2], $ess[3], $ess[4]);
				break;
			default:
				$copy = $ess;
				array_shift($copy);
				$res = call_user_func_array($fun, $copy);
		}

		$ok = false;
		$expected = null;
		$affdiff = true;
		if (
			is_array($ess) && is_array($ess[0]) && (isset($ess[0][0])
			&& is_string($ess[0][0]) && function_exists($ess[0][0]) && isset($ess[0][1]) && isset($ess[0][2]))
		) {
			$ok = ($ess[0][0]($ess[0][1], $res) === $ess[0][2]);
			$expected = $ess[0][0] . '(' . sql_quote($ess[0][1]) . ', $res) == ' . sql_quote($ess[0][2]);
			$affdiff = false;
		} else {
			$ok = test_equality($res, $ess[0]);
		}

		spip_log(
			'test ' . $GLOBALS['test'] . ' : Essai ' . $GLOBALS['compteur_essai']++ . ($ok ? ' ok' : ' ECHEC'),
			'testrunner'
		);
		if (! $ok) {
			$erritem_args = [];
			$essCount = count($ess);
			for ($iarg = 1; $iarg < $essCount; ++$iarg) {
				$erritem_args[] = htmlspecialchars(var_export($ess[$iarg], true));
			}
			$opts['affdiff'] = $affdiff;
			$err[] = display_error($titre, "{$fun}(" . implode(', ', $erritem_args) . ')', $res, $expected ?: $ess[0], $opts);
		}
	}

	if (defined('_IS_CLI') && _IS_CLI && count($err)) {
		exit;
	}

	return $err;
}

class SpipTestFineDiffRenderer extends Text
{
	public function callback($opcode, $from, $offset, $length): string {
		$content = substr($from, $offset, $length);
		switch ($opcode) {
			case 'c':
				return '  ' . $content . PHP_EOL;
			case 'd':
				return '- ' . $content . PHP_EOL;
			case 'i':
				return '+ ' . $content . PHP_EOL;
		}
	}
}

function display_error($titre, $call, $result, $expected, $opts = []) {
	$out = null;
	static $bef, $mid, $end;
	static $style;
	if (defined('_IS_CLI') && _IS_CLI) {
		echo "\n/!\ FAIL test `{$titre}`\n--- Expected\n+++ Actual\n@@ @@\n";

		$from = var_export($expected, true);

		$FineDiff = new Diff();
		$FineDiff->setRenderer(new SpipTestFineDiffRenderer());
		$FineDiff->setGranularity(new Paragraph());
		echo $FineDiff->render($from, var_export($result, true));
	} else {
		if (! isset($bef)) {
			// options
			foreach (
				[
				'out' => '<dt>@</dt><dd class="ei">@</dd>',
				] as $opt => $def
			) {
				${$opt} = $opts[$opt] ?? $def;
			}

			// l'enrobage de sortie
			[$bef, $mid, $end] = explode('@', $out ?? '');
		}

		$affdiff = true;
		if (isset($opts['affdiff'])) {
			$affdiff = $opts['affdiff'];
		}

		if ($style === null) {
			$style = '<style>.ei del {background: none repeat scroll 0 0 #FFDDDD;color: #FF0000;text-decoration: none;}
		.ei ins {background: none repeat scroll 0 0 #DDFFDD;color: #008000;text-decoration: none;}
		.ei pre {word-wrap: break-word}
		.ei table {border-collapse: collapse;border:1px solid #BBB;}
		.ei td,.ei th{border-collapse: collapse;border:1px solid #BBB;padding:5px;text-align: left}
		.ei dt {font-weight: bold;font-size: 1.2em;}
		.ei dd {margin-bottom: 1em;}
		</style>';
		} else {
			$style = '';
		}

		$FineDiff = new Diff();
		$FineDiff->setRenderer(new Html());
		$diff = $FineDiff->render(var_export($expected, true), var_export($result, true));

		return $style
			. $bef
			. (is_numeric($titre) ? "test {$titre}" : htmlspecialchars($titre))
			. $mid
			. "<pre>{$call}</pre>"
			. "<table style='width:100%;'><tr><th>diff</th><th>attendu</th><th>resultat</th></tr><tr>"
			. '<td><pre>' . ($affdiff ? $diff : $affdiff) . '</pre></td>'
			. '<td><pre>' . htmlspecialchars(var_export($expected, true)) . '</pre></td>'
			. '<td><pre>' . htmlspecialchars(var_export($result, true)) . '</pre></td>'
			. '</tr></table>'
			. $end . "\n";
	}
}

if (! function_exists('array_diff_assoc_recursive')) {
	// http://www.php.net/manual/fr/function.array-diff-assoc.php#73972
	function array_diff_assoc_recursive($array1, $array2) {
		foreach ($array1 as $key => $value) {
			if (is_array($value)) {
				if (! isset($array2[$key])) {
					$difference[$key] = $value;
				} elseif (! is_array($array2[$key])) {
					$difference[$key] = $value;
				} else {
					$new_diff = array_diff_assoc_recursive($value, $array2[$key]);
					if ($new_diff !== []) {
						$difference[$key] = $new_diff;
					}
				}
			} elseif (! array_key_exists($key, $array2) || ! test_equality($array2[$key], $value)) {
				$difference[$key] = $value;
			}
		}

		return $difference ?? [];
	}
}

function test_equality($val1, $val2) {
	if (is_array($val1) && is_array($val2)) {
		return ! (is_countable(array_diff_assoc_recursive($val1, $val2)) ? count(
			array_diff_assoc_recursive($val1, $val2)
		) : 0) && ! (is_countable(
			array_diff_assoc_recursive($val2, $val1)
		) ? count(array_diff_assoc_recursive($val2, $val1)) : 0)
		;
	} elseif (is_array($val1) || is_array($val2)) {
		return false;
	} elseif (is_float($val1) || is_float($val2)) {
		return abs($val1 - $val2) <= 1e-10 * abs($val1);
	}
	return $val1 === $val2;
}

function tests_legacy_lister($extension = null) {
	// chercher les bases de tests
	$bases = [_DIR_TESTS . 'tests/legacy/unit'];
	foreach (creer_chemin() as $d) {
		if ($d === 'ecrire/') {
			continue;
		}
		if ($d && @is_dir("{$d}tests")) {
			$bases[] = "{$d}tests";
		}
	}

	if (! $extension) {
		$extension = 'php|html';
	}

	$liste_fichiers = [];

	foreach ($bases as $base) {
		// regarder tous les tests
		$tests = preg_files($base .= '/', '/\w+/.*\.(' . $extension . ')$');

		foreach ($tests as $test) {
			$t = (string) _request('rech');
			if (strlen($t) && (!str_contains($test, $t))) {
				continue;
			}

			//ignorer le contenu du jeu de squelettes dédié aux tests
			if (stristr($test, 'squelettes/')) {
				continue;
			}

			//ignorer le contenu des donnees de test
			if (stristr($test, 'data/')) {
				continue;
			}

			//ignorer les tests todo
			if (stristr($test, '/_todo_')) {
				continue;
			}

			if (stristr($test, 'bootstrap.php')) {
				continue;
			}

			$testbasename = basename($test);
			// ignorer les vrais tests PHPUnit
			if (strlen($testbasename) > 8 && str_ends_with($testbasename, 'Test.php')) {
				continue;
			}

			if (!str_starts_with($testbasename, 'inclus_') && !str_ends_with($testbasename, '_fonctions.php') && (!str_starts_with($testbasename, 'NA_') || _request('var_mode') === 'dev')) {
				$joli = preg_replace('#\.(php|html)$#', '', basename($test));
				$section = dirname($test);
				if (str_starts_with($base, _DIR_TESTS)) {
					$section = substr($section, strlen(_DIR_TESTS . '/tests'));
				}

				$titre = "{$section}/{$joli}";
				if (isset($liste_fichiers[$titre])) {
					$nb = 0;
					do {
						++$nb;
						$suffixe = '_' . str_pad(strval($nb), 2, '0', STR_PAD_LEFT);
					} while (isset($liste_fichiers[$titre . $suffixe]));

					$titre .= $suffixe;
				}

				$liste_fichiers[$titre] = $test;
			}
		}
	}

	return $liste_fichiers;
}
