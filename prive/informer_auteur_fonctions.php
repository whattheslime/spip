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

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}


/**
 * Retrouve pour le formulaire de login les informations d'un login qui permettront de crypter le mot de passe saisi
 *
 * Si le login n'est pas trouvé, retourne de fausses informations,
 * sauf si la constante `_AUTORISER_AUTH_FAIBLE` est déclarée à true.
 *
 * @note
 *     Le parametre var_login n'est pas dans le contexte pour optimiser le cache
 *     il faut aller le chercher à la main
 *
 * @uses auth_informer_login()
 * @uses json_export()
 *
 * @param string $bof
 *     Date de la demande
 * @return string
 *     JSON des différentes informations
 */
function informer_auteur($bof) {
	include_spip('inc/json');
	include_spip('formulaires/login');
	include_spip('inc/auth');
	$login = strval(_request('var_login'));
	$row = auth_informer_login($login);
	if ($row and is_array($row)) {
		unset($row['id_auteur']);
	} else {
		// permettre d'autoriser l'envoi de password non crypte lorsque
		// l'auteur n'est pas (encore) declare dans SPIP, par exemple pour les cas
		// de premiere authentification via SPIP a une autre application.
		if (defined('_AUTORISER_AUTH_FAIBLE') and _AUTORISER_AUTH_FAIBLE) {
			$row = array();
		} else {
			// generer de fausses infos, mais credibles, pour eviter une attaque
			// http://core.spip.org/issues/1758
			include_spip('inc/securiser_action');
			$fauxalea1 = md5('fauxalea' . secret_du_site() . $login . floor(date('U') / 86400));
			$fauxalea2 = md5('fauxalea' . secret_du_site() . $login . ceil(date('U') / 86400));

			$row = array(
				'login' => $login,
				'cnx' => '0',
				'logo' => '',
				'alea_actuel' => substr_replace($fauxalea1, '.', 24, 0),
				'alea_futur' => substr_replace($fauxalea2, '.', 24, 0)
			);
		}
	}

	return json_export($row);
}
