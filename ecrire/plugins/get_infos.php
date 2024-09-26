<?php

/**
 * SPIP, Système de publication pour l'internet
 *
 * Copyright © avec tendresse depuis 2001
 * Arnaud Martin, Antoine Pitrou, Philippe Rivière, Emmanuel Saint-James
 *
 * Ce programme est un logiciel libre distribué sous licence GNU/GPL.
 */

/**
 * Obtention des description des plugins locaux
 *
 * @package SPIP\Core\Plugins
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

/**
 * Lecture du fichier de configuration d'un plugin
 *
 * @staticvar string $filecache
 * @staticvar array $cache
 *
 * @param string|array|bool $plug
 * @param bool $reload
 * @param string $dir
 * @param bool $clean_old
 * @return array
 */
function plugins_get_infos_dist($plug = false, $reload = false, $dir = _DIR_PLUGINS, $clean_old = false) {
	$contenu = null;
	$res = null;
	static $cache = '';
	static $filecache = '';

	if ($cache === '') {
		$filecache = _DIR_TMP . 'plugin_xml_cache.gz';
		if (is_file($filecache)) {
			lire_fichier($filecache, $contenu);
			$cache = unserialize($contenu);
		}
		if (!is_array($cache)) {
			$cache = [];
		}
	}

	if (defined('_VAR_MODE') && _VAR_MODE == 'recalcul') {
		$reload = true;
	}

	if ($plug === false) {
		ecrire_fichier($filecache, serialize($cache));

		return $cache;
	} elseif (is_string($plug)) {
		$res = plugins_get_infos_un($plug, $reload, $dir, $cache);
	} elseif (is_array($plug)) {
		$res = false;
		if (!$reload) {
			$reload = -1;
		}
		foreach ($plug as $nom) {
			$res |= plugins_get_infos_un($nom, $reload, $dir, $cache);
		}

		// Nettoyer le cache des vieux plugins qui ne sont plus la
		if ($clean_old && isset($cache[$dir]) && (is_countable($cache[$dir]) ? count($cache[$dir]) : 0)) {
			foreach (array_keys($cache[$dir]) as $p) {
				if (!in_array($p, $plug)) {
					unset($cache[$dir][$p]);
				}
			}
		}
	}
	if ($res) {
		ecrire_fichier($filecache, serialize($cache));
	}
	if (!isset($cache[$dir])) {
		return [];
	}
	if (is_string($plug)) {
		return $cache[$dir][$plug] ?? [];
	}
	return $cache[$dir];

}

function plugins_get_infos_un($plug, $reload, $dir, &$cache) {
	if (!is_readable($file = "$dir$plug/paquet.xml")) {
		return false;
	}
	$time = (int) @filemtime($file);
	if ($time < 0) {
		return false;
	}
	$md5 = md5_file($file);

	$pcache = $cache[$dir][$plug] ?? ['filemtime' => 0, 'md5_file' => ''];

	// si le cache est valide
	if (
		(int) $reload <= 0
		&& $time > 0
		&& $time <= $pcache['filemtime']
		&& $md5 == $pcache['md5_file']
	) {
		return false;
	}

	// si on arrive pas a lire le fichier, se contenter du cache
	if (!($texte = spip_file_get_contents($file))) {
		return false;
	}

	$f = charger_fonction('infos_paquet', 'plugins');
	$ret = $f($texte, $plug, $dir);
	$ret['filemtime'] = $time;
	$ret['md5_file'] = $md5;
	// Si on lit le paquet.xml de SPIP, on rajoute un procure php afin que les plugins puissent
	// utiliser un necessite php. SPIP procure donc la version php courante du serveur.
	// chaque librairie php est aussi procurée, par exemple 'php:curl'.
	if (isset($ret['prefix']) && $ret['prefix'] == 'spip') {
		$ret['procure']['php'] = ['nom' => 'php', 'version' => PHP_VERSION];
		foreach (get_loaded_extensions() as $ext) {
			$ret['procure']['php:' . $ext] = ['nom' => 'php:' . $ext, 'version' => phpversion($ext)];
		}
	}
	$diff = ($ret != $pcache);

	if ($diff) {
		$cache[$dir][$plug] = $ret;
		#       echo count($cache[$dir]), $dir,$plug, " $reloadc<br>";
	}

	return $diff;
}
