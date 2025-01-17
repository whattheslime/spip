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
 * Gestion de l'action relancer_inscription
 *
 * @package SPIP\Core\Inscription
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

/**
 * Relancer une inscription
 */
function action_relancer_inscription_dist() {
	$securiser_action = charger_fonction('securiser_action', 'inc');
	$id_auteur = $securiser_action();

	if ((int) $id_auteur && autoriser('relancer', 'inscription')) {
		$auteur = sql_fetsel(
			'prefs, email, nom, statut',
			'spip_auteurs',
			"(id_auteur=$id_auteur) AND (email!='') AND (statut='nouveau')"
		);
		if ($auteur) {
			include_spip('action/inscrire_auteur');
			action_inscrire_auteur_dist($auteur['prefs'], $auteur['email'], $auteur['nom'], ['force_nouveau' => true]);
		}
	} elseif ($id_auteur === '*' && autoriser('relancer', 'inscription')) {
		$auteurs = sql_allfetsel('prefs, email, nom', 'spip_auteurs', "(statut='nouveau') AND (email!='')");
		if (is_array($auteurs)) {
			include_spip('action/inscrire_auteur');
			while ($row = array_pop($auteurs)) {
				action_inscrire_auteur_dist($row['prefs'], $row['email'], $row['nom'], ['force_nouveau' => true]);
			}
		}
	}
}
