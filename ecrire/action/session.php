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
 * Gestion d'une action ajoutant une variable dans une session SPIP
 *
 * @package SPIP\Core\Sessions
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

/**
 * Action pour poser une variable de session SPIP
 *
 * Poster sur cette action en indiquant les clés `var` et `val`
 *
 * Utilisé par exemple par le script javascript 'autosave' pour sauvegarder
 * les formulaires en cours d'édition
 *
 * @todo
 *   Envoyer en réponse : json contenant toutes les variables publiques de la session
 */
function action_session_dist() {
	if (
		($var = _request('var'))
		&& preg_match(',^[a-z_0-9-]+$,i', (string) $var)
		&& $_SERVER['REQUEST_METHOD'] == 'POST'
	) {
		include_spip('inc/session');
		session_set('session_' . $var, $val = _request('val'));
		#spip_logger('autosave')->info("autosave:$var:$val");
	}

	# TODO: mode lecture de session ; n'afficher que ce qu'il faut
	#echo json_encode($GLOBALS['visiteur_session']);
}
