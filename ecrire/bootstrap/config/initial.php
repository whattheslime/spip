<?php

use function SpipLeague\Component\Kernel\{app, param};

/**
 * Constantes de démarrage de SPIP
 */

$ecrire = param('spip.dirs.core');

/**
 * Indique que SPIP est chargé
 *
 * Cela permet des tests de sécurités pour les fichiers PHP
 * de SPIP et des plugins qui peuvent vérifier que SPIP est chargé
 * et donc que les fichiers ne sont pas appelés en dehors de l'usage de SPIP
 */
define('_ECRIRE_INC_VERSION', '1');

/**
 * Chemin relatif pour aller dans ecrire
 * vide si on est dans ecrire, 'ecrire/' sinon
 */
define('_DIR_RESTREINT', (is_dir($ecrire) ? $ecrire : ''));

/** Chemin relatif pour aller à la racine */
define('_DIR_RACINE', _DIR_RESTREINT ? '' : '../');

/** chemin absolu vers la racine */
define('_ROOT_RACINE', dirname(__DIR__, 3) . DIRECTORY_SEPARATOR);
/** chemin absolu vers ecrire */
define('_ROOT_RESTREINT', app()->getCoreDir());

# Le nom des 4 repertoires modifiables par les scripts lances par httpd
# Par defaut ces 4 noms seront suffixes par _DIR_RACINE (cf plus bas)
# mais on peut les mettre ailleurs et changer completement les noms
if (!defined('_NOM_TEMPORAIRES_INACCESSIBLES')) {
	/** Nom du repertoire des fichiers Temporaires Inaccessibles par http:// */
	define('_NOM_TEMPORAIRES_INACCESSIBLES', 'tmp/');
}
if (!defined('_NOM_TEMPORAIRES_ACCESSIBLES')) {
	/** Nom du repertoire des fichiers Temporaires Accessibles par http:// */
	define('_NOM_TEMPORAIRES_ACCESSIBLES', 'local/');
}
if (!defined('_NOM_PERMANENTS_INACCESSIBLES')) {
	/** Nom du repertoire des fichiers Permanents Inaccessibles par http:// */
	define('_NOM_PERMANENTS_INACCESSIBLES', 'config/');
}
if (!defined('_NOM_PERMANENTS_ACCESSIBLES')) {
	/** Nom du repertoire des fichiers Permanents Accessibles par http:// */
	define('_NOM_PERMANENTS_ACCESSIBLES', 'IMG/');
}

// Icones
if (!defined('_NOM_IMG_PACK')) {
	/** Nom du dossier images */
	define('_NOM_IMG_PACK', 'images/');
}

/** le chemin php (absolu) vers les images standard (pour hebergement centralise) */
define('_ROOT_IMG_PACK', dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'prive' . DIRECTORY_SEPARATOR . _NOM_IMG_PACK);

if (!defined('_JAVASCRIPT')) {
	/** Nom du repertoire des  bibliotheques JavaScript */
	// utilisable avec #CHEMIN et find_in_path
	define('_JAVASCRIPT', 'javascript/');
}

/** le nom du repertoire des  bibliotheques JavaScript du prive */
define('_DIR_JAVASCRIPT', (_DIR_RACINE . 'prive/' . _JAVASCRIPT));

/** Le nom du fichier de personnalisation */
if (!defined('_NOM_CONFIG')) {
	define('_NOM_CONFIG', 'mes_options');
}

// Son emplacement absolu si on le trouve
if (@file_exists($f = _ROOT_RACINE . _NOM_PERMANENTS_INACCESSIBLES . _NOM_CONFIG . '.php')) {
	/** Emplacement absolu du fichier d'option */
	define('_FILE_OPTIONS', $f);
} else {
	define('_FILE_OPTIONS', '');
}

if (!defined('MODULES_IDIOMES')) {
	/**
	 * Modules par défaut pour la traduction.
	 *
	 * Constante utilisée par le compilateur et le décompilateur
	 * sa valeur etant traitée par inc_traduire_dist
	 */
	define('MODULES_IDIOMES', 'public|spip|ecrire');
}

if (!defined('_IS_CLI')) {
	define(
		'_IS_CLI',
		!isset($_SERVER['HTTP_HOST'])
		&& !strlen((string) $_SERVER['DOCUMENT_ROOT'])
		&& !empty($_SERVER['argv'])
		&& empty($_SERVER['REQUEST_METHOD'])
	);
}

// Definir les niveaux de log
if (!defined('_LOG_HS')) {
	/** @deprecated 5.0 Utiliser spip_logger()->emergency() */
	define('_LOG_HS', 0);
}
if (!defined('_LOG_ALERTE_ROUGE')) {
	/** @deprecated 5.0 Utiliser spip_logger()->alert() */
	define('_LOG_ALERTE_ROUGE', 1);
}
if (!defined('_LOG_CRITIQUE')) {
	/** @deprecated 5.0 Utiliser spip_logger()->critical() */
	define('_LOG_CRITIQUE', 2);
}
if (!defined('_LOG_ERREUR')) {
	/** @deprecated 5.0 Utiliser spip_logger()->error() */
	define('_LOG_ERREUR', 3);
}
if (!defined('_LOG_AVERTISSEMENT')) {
	/** @deprecated 5.0 Utiliser spip_logger()->warning() */
	define('_LOG_AVERTISSEMENT', 4);
}
if (!defined('_LOG_INFO_IMPORTANTE')) {
	/** @deprecated 5.0 Utiliser spip_logger()->notice() */
	define('_LOG_INFO_IMPORTANTE', 5);
}
if (!defined('_LOG_INFO')) {
	/** @deprecated 5.0 Utiliser spip_logger()->info() */
	define('_LOG_INFO', 6);
}
if (!defined('_LOG_DEBUG')) {
	/** @deprecated 5.0 Utiliser spip_logger()->debug() */
	define('_LOG_DEBUG', 7);
}
