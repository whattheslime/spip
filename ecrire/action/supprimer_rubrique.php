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
 * Action de suppression d'une rubrique
 *
 * @package SPIP\Core\Rubriques
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

include_spip('inc/charsets');  # pour le nom de fichier

/**
 * Effacer une rubrique
 *
 * @param null|int $id_rubrique
 */
function action_supprimer_rubrique_dist($id_rubrique = null) {

	if ($id_rubrique === null) {
		$securiser_action = charger_fonction('securiser_action', 'inc');
		$id_rubrique = $securiser_action();
	}

	if ((int) $id_rubrique) {
		sql_delete('spip_rubriques', 'id_rubrique=' . (int) $id_rubrique);
		// Les admin restreints qui n'administraient que cette rubrique
		// deviennent redacteurs
		// (il y a sans doute moyen de faire ca avec un having)

		$q = sql_select('id_auteur', 'spip_auteurs_liens', "objet='rubrique' AND id_objet=" . (int) $id_rubrique);
		while ($r = sql_fetch($q)) {
			$id_auteur = $r['id_auteur'];
			// degrader avant de supprimer la restriction d'admin
			// section critique sur les droits
			$n = sql_countsel(
				'spip_auteurs_liens',
				"objet='rubrique' AND id_objet!=" . (int) $id_rubrique . ' AND id_auteur=' . (int) $id_auteur
			);
			if (!$n) {
				include_spip('action/editer_auteur');
				auteur_modifier($id_auteur, ['statut' => '1comite']);
			}
			sql_delete(
				'spip_auteurs_liens',
				"objet='rubrique' AND id_objet=" . (int) $id_rubrique . ' AND id_auteur=' . (int) $id_auteur
			);
		}
		// menu_rubriques devra recalculer
		effacer_meta('date_calcul_rubriques');

		// Une rubrique supprimable n'avait pas le statut "publie"
		// donc rien de neuf pour la rubrique parente
		include_spip('inc/rubriques');
		calculer_langues_rubriques();

		// invalider les caches marques de cette rubrique
		include_spip('inc/invalideur');
		suivre_invalideur("id='rubrique/$id_rubrique'");
	}
}
