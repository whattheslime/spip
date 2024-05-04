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
 * Gestion le l'affichage du sélecteur de rubrique AJAX
 *
 * @package SPIP\Core\Rubriques
 */
if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

include_spip('inc/actions');

/**
 * Affichage en ajax du sélecteur (mini-navigateur) de rubrique AJAX
 *
 * @uses inc_selectionner_dist()
 * @uses ajax_retour()
 */
function exec_selectionner_dist() {
	$id = (int) _request('id');
	$exclus = (int) _request('exclus');
	$type = _request('type');
	$rac = _request('racine');
	$do = _request('do');
	if (preg_match('/^\w*$/', (string) $do)) {
		if (!$do) {
			$do = 'aff';
		}

		$selectionner = charger_fonction('selectionner', 'inc');

		$r = $selectionner($id, 'choix_parent', $exclus, $rac, $type != 'breve', $do);
	} else {
		$r = '';
	}
	ajax_retour($r);
}
