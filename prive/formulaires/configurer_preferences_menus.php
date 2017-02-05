<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2016                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

/**
 * Formulaire de configuration des préférences auteurs dans l'espace privé
 *
 * Ces préférences sont stockées dans la clé `prefs` dans la session de l'auteur
 * en tant que tableau, ainsi que dans la colonne SQL `prefs` de spip_auteurs
 * sous forme sérialisée.
 *
 * @package SPIP\Core\Formulaires
 **/

include_spip('inc/bandeau');


/**
 * Chargement du formulaire de préférence des menus d'un auteur dans l'espace privé
 *
 * @return array
 *     Environnement du formulaire
 **/
function formulaires_configurer_preferences_menus_charger_dist() {
	// travailler sur des meta fraîches
	include_spip('inc/meta');
	lire_metas();
	$valeurs = array();
	$valeurs['menus_favoris'] = obtenir_menus_favoris();
	return $valeurs;
}

/**
 * Traitements du formulaire de préférence des menus d'un auteur dans l'espace privé
 *
 * @return array
 *     Retours des traitements
 **/
function formulaires_configurer_preferences_menus_traiter_dist() {

	$menus_favoris = _request('menus_favoris');

	// si le menu change, on recharge toute la page.
	if ($menus_favoris != obtenir_menus_favoris()) {
		refuser_traiter_formulaire_ajax();

		$GLOBALS['visiteur_session']['prefs']['menus_favoris'] = $menus_favoris;

		if (intval($GLOBALS['visiteur_session']['id_auteur'])) {
			include_spip('action/editer_auteur');
			$c = array('prefs' => serialize($GLOBALS['visiteur_session']['prefs']));
			auteur_modifier($GLOBALS['visiteur_session']['id_auteur'], $c);

		}
	}

	return array('message_ok' => _T('config_info_enregistree'), 'editable' => true);
}
