<?php

declare(strict_types=1);

// nom du test

$test = 'cache/sessions';

define('_VAR_MODE', 'recalcul');

// recherche test.inc qui nous ouvre au monde spip

$remonte = __DIR__ . '/';

while (! is_file($remonte . 'test.inc')) {
	$remonte .= '../';
}

require $remonte . 'test.inc';

tests_init_dossier_squelettes();

// commencer par verifier que les assertions fonctionnent

$GLOBALS['erreurs_test'] = [];

test_cache_squelette($f = 'inclure/A_session_wo', false);

if ($GLOBALS['erreurs_test'] !== []) {
	die("Echec Assertion {$f} assert_session=0\n");
}

$GLOBALS['erreurs_test'] = [];

test_cache_squelette($f = 'inclure/A_session_wo', true);

if ($GLOBALS['erreurs_test'] === []) {
	die("Echec Assertion {$f} assert_session=1\n");
}

$GLOBALS['erreurs_test'] = [];

test_cache_squelette($f = 'inclure/A_session_w', false);

if (count($GLOBALS['erreurs_test']) === 0) {
	die("Echec Assertion {$f} assert_session=0\n");
}

$GLOBALS['erreurs_test'] = [];

test_cache_squelette($f = 'inclure/A_session_w', true);

if (count($GLOBALS['erreurs_test']) > 0) {
	die("Echec Assertion {$f} assert_session=1\n");
}

// now let's start the tests !

$GLOBALS['erreurs_test'] = [];

test_cache_squelette($f = 'cache_session_wo_1', false);

test_cache_squelette($f = 'cache_session_wo_2', false);

test_cache_squelette($f = 'cache_session_wo_3', false);

test_cache_squelette($f = 'cache_session_wo_4', false);

test_cache_squelette($f = 'cache_session_wo_5', false);

test_cache_squelette($f = 'cache_session_wo_6', false);

test_cache_squelette($f = 'cache_session_wo_7', false);

test_cache_squelette($f = 'cache_session_w_1', true);

test_cache_squelette($f = 'cache_session_w_2', true);

test_cache_squelette($f = 'cache_session_w_3', true);

if (count($GLOBALS['erreurs_test']) > 0) {
	echo '<ul><li>'
		. implode('</li><li>', $GLOBALS['erreurs_test'])
		. '</li></ul>';
} else {
	echo 'OK';
}

function test_cache_squelette($fond, $session_attendue)
{
	unset($GLOBALS['cache_utilise_session']);
	recuperer_fond($fond, [
		'assert_session' => ((bool) $session_attendue),
		'caller' => 'none',
		'salt' => salt_contexte(),
	]);
	unset($GLOBALS['cache_utilise_session']);
	recuperer_fond('root', [
		'sousfond' => $fond,
		'inc_assert_session' => ((bool) $session_attendue),
		'salt' => salt_contexte(),
	]);
}

/**
 * Fonction chargee de faire les assertions d'erreur si l'invalideur session n'est pas comme on l'attend
 *
 * @param string $chemin_cache
 * @param array $page
 */

function inc_maj_invalideurs($chemin_cache, $page)
{
	if (isset($page['contexte']) && isset($page['contexte']['assert_session'])) {
		$has_session = false;
		if (isset($page['invalideurs']) && isset($page['invalideurs']['session'])) {
			$has_session = $page['invalideurs']['session'];
		}

		if ($page['contexte']['assert_session'] && $page['contexte']['assert_session'] !== 'non' || $page['contexte']['assert_session'] === 'oui') {
			if (! $has_session) {
				$GLOBALS['erreurs_test'][] = 'ERREUR : PAS de session pour ' . $page['source'] . ' ' . trace_contexte(
					$page['contexte']
				);
			}
		} elseif ($has_session) {
			$GLOBALS['erreurs_test'][] = "ERREUR : SESSION {$has_session} pour " . $page['source'] . ' ' . trace_contexte(
				$page['contexte']
			);
		}
	}
}

function salt_contexte()
{
	static $deja = [];

	do {
		$salt = time() . ':' . md5(time() . ':' . random_int(0, 65536));
	} while (isset($deja[$salt]));

	$deja[$salt] = true;
	return $salt;
}

function trace_contexte($contexte)
{
	foreach ($contexte as $k => $v) {
		if (str_starts_with($k, 'date_') || $k === 'salt') {
			unset($contexte[$k]);
		}
	}

	if (isset($contexte['caller']) && str_starts_with($contexte['caller'], 'tests/squelettes/')) {
		$contexte['caller'] = substr($contexte['caller'], 17);
	}

	return json_encode($contexte, JSON_THROW_ON_ERROR);
}
