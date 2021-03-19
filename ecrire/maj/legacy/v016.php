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

/**
 * Gestion des mises à jour de SPIP, versions 1.6*
 *
 * @package SPIP\Core\SQL\Upgrade
 **/
if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

/**
 * Mises à jour de SPIP n°016
 *
 * @param float $version_installee Version actuelle
 * @param float $version_cible Version de destination
 **/
function maj_legacy_v016_dist($version_installee, $version_cible) {

	if (upgrade_vers(1.600, $version_installee, $version_cible)) {
#8/08/07  plus d'indexation dans le core
#		include_spip('inc/indexation');
#		purger_index();
#		creer_liste_indexation();
		maj_version(1.600);
	}

	if (upgrade_vers(1.601, $version_installee, $version_cible)) {
		sql_query("ALTER TABLE spip_forum ADD INDEX id_syndic (id_syndic)");
		maj_version(1.601);
	}

	if (upgrade_vers(1.603, $version_installee, $version_cible)) {
		// supprimer les fichiers deplaces
		spip_unlink('inc_meta_cache.php');
		spip_unlink('inc_meta_cache.php3');
		spip_unlink('data/engines-list.ini');
		maj_version(1.603);
	}

	if (upgrade_vers(1.604, $version_installee, $version_cible)) {
		sql_query("ALTER TABLE spip_auteurs ADD lang VARCHAR(10) DEFAULT '' NOT NULL");
		$u = sql_query("SELECT * FROM spip_auteurs WHERE prefs LIKE '%spip_lang%'");
		while ($row = sql_fetch($u)) {
			$prefs = unserialize($row['prefs']);
			$l = $prefs['spip_lang'];
			unset($prefs['spip_lang']);
			sql_query("UPDATE spip_auteurs SET lang=" . sql_quote($l) . ", prefs='" . sql_quote(serialize($prefs)) . "' WHERE id_auteur=" . $row['id_auteur']);
		}
		$u = sql_query("SELECT lang FROM spip_auteurs");
		maj_version(1.604, $u);
	}
}