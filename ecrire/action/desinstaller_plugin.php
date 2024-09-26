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
 * Gestion de l'action desinstaller_plugin
 *
 * @package SPIP\Core\Plugins
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

/**
 * Action de désinstallation d'un plugin
 *
 * L'argument attendu est le préfixe du plugin à désinstaller.
 *
 * @uses plugins_installer_dist()
 *
 * @global array visiteur_session
 */
function action_desinstaller_plugin_dist() {

	$securiser_action = charger_fonction('securiser_action', 'inc');
	$arg = $securiser_action();
	[$dir_plugins, $plugin] = explode('::', (string) $arg);
	$dir_type = '_DIR_PLUGINS';
	if (defined('_DIR_PLUGINS_SUPPL') && $dir_plugins == _DIR_PLUGINS_SUPPL) {
		$dir_type = '_DIR_PLUGINS_SUPPL';
	}
	$installer_plugins = charger_fonction('installer', 'plugins');
	$infos = $installer_plugins($plugin, 'uninstall', $dir_type);
	if ($infos && !$infos['install_test'][0]) {
		include_spip('inc/plugin');
		ecrire_plugin_actifs([$plugin], false, 'enleve');
		$erreur = '';
	} else {
		$erreur = 'erreur_plugin_desinstalation_echouee';
	}
	if ($redirect = _request('redirect')) {
		include_spip('inc/headers');
		if ($erreur) {
			$redirect = parametre_url($redirect, 'erreur', $erreur);
		}
		$redirect = str_replace('&amp;', '&', (string) $redirect);
		redirige_par_entete($redirect);
	}
}
