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
 * Gestion de l'action ajouter_lien
 *
 * @package SPIP\Core\Liens
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

/**
 * Action pour lier 2 objets entre eux
 *
 * L'argument attendu est `objet1-id1-objet2-id2` (type d'objet, identifiant)
 * tel que `mot-7-rubrique-3`.
 *
 * @uses objet_associer()
 *
 * @param null|string $arg
 *     Clé des arguments. En absence utilise l'argument
 *     de l'action sécurisée.
 */
function action_ajouter_lien_dist($arg = null) {
	if ($arg === null) {
		$securiser_action = charger_fonction('securiser_action', 'inc');
		$arg = $securiser_action();
	}

	$arg = explode('-', (string) $arg);
	[$objet_source, $ids, $objet_lie, $idl] = $arg;

	include_spip('action/editer_liens');
	objet_associer([$objet_source => $ids], [$objet_lie => $idl]);
}
