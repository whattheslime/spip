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
 * Gestion de l'action auth
 *
 * @package SPIP\Core\Authentification
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

/**
 * Retour d'authentification pour les SSO
 */
function action_auth_dist() {

	$securiser_action = charger_fonction('securiser_action', 'inc');
	$arg = $securiser_action();

	if (!preg_match(',^(\w+)[/](.+)$,', (string) $arg, $r)) {
		spip_logger()->info("action_auth_dist $arg pas compris");
	} else {
		$auth_methode = $r[1];
		$login = $r[2];
		include_spip('inc/auth');
		$res = auth_terminer_identifier_login($auth_methode, $login);

		if (is_string($res)) { // Erreur
			$redirect = _request('redirect');
			$redirect = parametre_url($redirect, 'var_erreur', $res, '&');
			include_spip('inc/headers');
			redirige_par_entete($redirect);
		}

		// sinon on loge l'auteur identifie, et on finit (redirection automatique)
		auth_loger($res);
	}
}
