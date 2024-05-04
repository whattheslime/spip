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
 * Gestion des mises à jour de SPIP, version >= 2021000000
 *
 * Gestion des mises à jour du cœur de SPIP par un tableau global `maj`
 * indexé par la date du changement YYYYMMDDXX
 *
 * @package SPIP\Core\SQL\Upgrade
 */
if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

$GLOBALS['maj'][2021_02_18_00] = [
	['sql_alter', "TABLE spip_auteurs CHANGE imessage imessage VARCHAR(3) DEFAULT '' NOT NULL" ],
	['sql_updateq', 'spip_auteurs', ['imessage' => 'oui'], "imessage != 'non' OR imessage IS NULL" ],
];

$GLOBALS['maj'][2022_02_23_02] = [
	['sql_alter', "TABLE spip_auteurs ADD backup_cles mediumtext DEFAULT '' NOT NULL" ],
	['sql_delete', 'spip_meta', "nom='secret_du_site'" ],
];

$GLOBALS['maj'][2022_02_23_03] = [
	['maj2021_supprimer_toutes_sessions_si_aucun_backup_cles'],
];

/**
 * Supprime toutes les sessions des auteurs si on a pas encore généré de config/cles.php avec son backup
 *
 * Obligera tous les auteurs à se reconnecter :
 * - le webmestre qui fait la mise a jour génèrera une cle avec un backup
 * - les autres auteurs vont tous regénérer un mot de passe plus sécure au premier login
 */
function maj2021_supprimer_toutes_sessions_si_aucun_backup_cles() {
	if (!sql_countsel('spip_auteurs', "webmestre='oui' AND backup_cles!=''")) {
		spip_logger('maj')->info('supprimer sessions auteur');
		if ($dir = opendir(_DIR_SESSIONS)) {
			while (($f = readdir($dir)) !== false) {
				spip_unlink(_DIR_SESSIONS . $f);
				if (time() >= _TIME_OUT) {
					return;
				}
			}
		}
	}
}
