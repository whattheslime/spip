<?php

declare(strict_types=1);

/*
 * Ce fichier s'appelle depuis un test PHPUnit
 * Il permet de démarrer SPIP
 *
 */

// let's go spip
if (! defined('_SPIP_TEST_INC')) {
	define('_SPIP_TEST_INC', dirname(__FILE__, 2));
}

// si rien defini on va dans le public

if (! defined('_SPIP_TEST_CHDIR')) {
	define('_SPIP_TEST_CHDIR', dirname(_SPIP_TEST_INC));
}

if (! defined('_DIR_TESTS')) {
	define('_DIR_TESTS', substr(_SPIP_TEST_INC, strlen(_SPIP_TEST_CHDIR) + 1) . '/');
}

// chdir pour charger SPIP
chdir(_SPIP_TEST_CHDIR);

require_once _SPIP_TEST_CHDIR . '/ecrire/inc_version.php';

// pour notice sur recuperer_fond()
if (! isset($GLOBALS['spip_lang'])) {
	include_spip('inc/lang');
	utiliser_langue_visiteur();
}

$GLOBALS['taille_des_logs'] = 1024;
$GLOBALS['delais'] = 0;

// pas admin ? passe ton chemin (ce script est un vilain trou de securite)
if (! _IS_CLI) {
	die("Ce test n'est executable qu'en cli");
}

// afficher toutes les erreurs
@ini_set('display_errors', 'On');
@error_reporting(E_ALL);

function spip_tests_loger_webmestre()
{
	// il faut charger une session webmestre
	include_spip('base/abstract_sql');
	$webmestre = sql_fetsel('*', 'spip_auteurs', "statut='0minirezo' AND webmestre='oui'", '', 'id_auteur', '0,1');
	include_spip('inc/auth');
	auth_loger($webmestre);
}

function spip_tests_deloger_webmestre() {
	if (!empty($GLOBALS['visiteur_session']['id_auteur'])) {
		supprimer_sessions($GLOBALS['visiteur_session']['id_auteur'], false);
	}
	$GLOBALS['visiteur_session'] = [];
}

// inclure les bootstrap.php de chaque suite
include_once __DIR__ . '/bootstrap_plugins.php';
