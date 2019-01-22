<?php

	// nom du test
	$test = 'cache/sessions';
	define('_VAR_MODE','recalcul');

	// recherche test.inc qui nous ouvre au monde spip
	$deep = 1;
	$include = '../tests/test.inc';
	while (!defined('_SPIP_TEST_INC') && $deep++ < 6) {
		$include = '../' . $include;
		@include $include;
	}
	if (!defined('_SPIP_TEST_INC')) {
		die("Pas de $include");
	}

	$GLOBALS['dossier_squelettes'] = 'tests/squelettes';

	// commencer par verifier que les assertions fonctionnent
	$GLOBALS['erreurs_test'] = array();
	test_cache_squelette($f = "inclure/A_session_wo", false);
	if (count($GLOBALS['erreurs_test'])) {
		die("Echec Assertion $f assert_session=0\n");
	}
	$GLOBALS['erreurs_test'] = array();
	test_cache_squelette($f = "inclure/A_session_wo", true);
	if (!count($GLOBALS['erreurs_test'])) {
		die("Echec Assertion $f assert_session=1\n");
	}
	$GLOBALS['erreurs_test'] = array();
	test_cache_squelette($f = "inclure/A_session_w", false);
	if (!count($GLOBALS['erreurs_test'])) {
		die("Echec Assertion $f assert_session=0\n");
	}
	$GLOBALS['erreurs_test'] = array();
	test_cache_squelette($f = "inclure/A_session_w", true);
	if (count($GLOBALS['erreurs_test'])) {
		die("Echec Assertion $f assert_session=1\n");
	}

	// now let's start the tests !
	$GLOBALS['erreurs_test'] = array();
	test_cache_squelette($f = "cache_session_wo_1", false);
	test_cache_squelette($f = "cache_session_wo_2", false);
	test_cache_squelette($f = "cache_session_wo_3", false);
	test_cache_squelette($f = "cache_session_wo_4", false);
	test_cache_squelette($f = "cache_session_wo_5", false);
	test_cache_squelette($f = "cache_session_wo_6", false);
	test_cache_squelette($f = "cache_session_wo_7", false);
	test_cache_squelette($f = "cache_session_w_1", true);
	test_cache_squelette($f = "cache_session_w_2", true);
	test_cache_squelette($f = "cache_session_w_3", true);


	if (count($GLOBALS['erreurs_test'])) {
		echo "<ul><li>"
			. implode("</li><li>", $GLOBALS['erreurs_test'])
			."</li></ul>";
	}
	else {
		echo "OK";
	}

	function test_cache_squelette($fond, $session_attendue) {
		unset($GLOBALS['cache_utilise_session']);
		recuperer_fond($fond, array('assert_session' => ($session_attendue ? true  : false), 'caller'=>'none', 'salt'=>salt_contexte()));
		unset($GLOBALS['cache_utilise_session']);
		recuperer_fond('root', array('sousfond' => $fond, 'inc_assert_session' => ($session_attendue ? true  : false), 'salt'=>salt_contexte()));
	}

/**
 * Fonction chargee de faire les assertions d'erreur si l'invalideur session n'est pas comme on l'attend
 * @param $chemin_cache
 * @param $page
 */
function inc_maj_invalideurs($chemin_cache, $page) {
	if (isset($page['contexte']) and isset($page['contexte']['assert_session'])) {
		$has_session = false;
		if (isset($page['invalideurs'])
			and isset($page['invalideurs']['session'])){
			$has_session = $page['invalideurs']['session'];
		}
		if (($page['contexte']['assert_session'] and $page['contexte']['assert_session']!=='non') or $page['contexte']['assert_session']==='oui'){
			if (!$has_session) {
				$GLOBALS['erreurs_test'][] = "ERREUR : PAS de session pour " . $page['source'] . ' ' . trace_contexte($page['contexte']);
			}
		}
		else {
			if ($has_session) {
				$GLOBALS['erreurs_test'][] = "ERREUR : SESSION $has_session pour " . $page['source'] . ' ' . trace_contexte($page['contexte']);
			}
		}
	}
}

function salt_contexte() {
	static $deja = array();

	do {
		$salt = time() . ':' . md5( time(). ':' . rand(0,65536));
	}
	while (isset($deja[$salt]));
	$deja[$salt] = true;
	return $salt;
}

function trace_contexte($contexte) {
	foreach ($contexte as $k=>$v) {
		if (strpos($k, 'date_')===0
		  or $k=='salt') {
			unset($contexte[$k]);
		}
	}
	if (isset($contexte['caller'])
	  and strpos($contexte['caller'],'tests/squelettes/') === 0) {
		$contexte['caller'] = substr($contexte['caller'], 17);
	}
	return json_encode($contexte);
}

