<?php

/*
 * Ce fichier s'appelle depuis un test.php
 * qui doit definir auparavant $test, et faire
 * ensuite ses tests.
 *
 * Si tout est ok, le test doit afficher 'OK' et sortir
 * Sinon du debug ou toute indication de la nature de l'échec...
 *
 */
// let's go spip
if (!defined('_SPIP_TEST_INC')) {
	define('_SPIP_TEST_INC', dirname(dirname(dirname(__FILE__))));
}
if (!defined('_SPIP_TEST_CHDIR')){
	// si rien defini on va dans le public
	define('_SPIP_TEST_CHDIR', dirname(_SPIP_TEST_INC));
}
chdir(_SPIP_TEST_CHDIR);

if (!defined('_DIR_TESTS')){
	define('_DIR_TESTS', substr(_SPIP_TEST_INC, strlen(_SPIP_TEST_CHDIR)+1) . '/');
}

// pas de _VAR_MODE=recalcul par defaut, ca masque les eventuels problemes de cache
// cf
#if (!defined('_VAR_MODE')) {
#	define('_VAR_MODE', 'recalcul');
#}

if (!empty($GLOBALS['argv'])) {
	// passer les argv en set_request pour compat
	$args = $GLOBALS['argv'];
	array_shift($args);
	$_GET = [];
	foreach ($args as $arg) {
		$arg = explode('=', $arg, 2);
		if (count($arg) === 2) {
			$_GET[$arg[0]] = $arg[1];
		}
	}
}


require_once dirname(_SPIP_TEST_INC) . '/ecrire/inc_version.php';
include_once __DIR__ . '/test_fonctions.php';


// pour notice sur recuperer_fond()
if (!isset($GLOBALS['spip_lang'])) {
	include_spip('inc/lang');
	utiliser_langue_visiteur();
}


// vous devez theoriquement definir $test avant d'inclure ce script
#spip_log('test ' . $test,'testrunner');
$GLOBALS['taille_des_logs'] = 1024;
$GLOBALS['compteur_essai'] = 0;

// pas admin ? passe ton chemin (ce script est un vilain trou de securite)
if (!defined('_IS_CLI') or !_IS_CLI) {
	if ((!isset($GLOBALS['visiteur_session']['statut'])
		OR $GLOBALS['visiteur_session']['statut'] != '0minirezo')
		AND !in_array($_SERVER["REMOTE_ADDR"], array('127.0.0.1', '127.0.1.1', '::1')) ) {
		die('Administrateur local requis !');
	}
}
else {
	$_SERVER['REQUEST_METHOD'] = 'GET'; // eviter des notices dans les tests
	tests_loger_webmestre();
}

// afficher toutes les erreurs
@ini_set('display_errors', 'On');
@error_reporting(E_ALL);

// pour essayer de calculer/montrer le temps qu'on y met
if (!defined('_IS_CLI') or !_IS_CLI) {
	register_shutdown_function('afficher_timer', time() + (float)microtime());
}

function afficher_timer($depart) {
	if (!defined('_NO_TIMER'))
		echo sprintf(" %.2fs", time() + (float)microtime() - $depart);
}
