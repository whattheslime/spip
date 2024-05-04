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
 * Gestion des cookies
 *
 * @package SPIP\Core\Cookies
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}


/**
 * Place un cookie (préfixé) sur le poste client
 *
 * @global string cookie_prefix Préfixe de cookie défini
 * @link http://fr.php.net/setcookie
 *
 * @param string $name
 *     Nom du cookie
 * @param string $value
 *     Valeur à stocker
 * @param int|array{expires: int, path: string, domain: string, secure: bool, samesite: string} $expires_or_options
 *     int: Date d'expiration du cookie (timestamp)
 *     Tableau clé => valeur de l’option
 *     - expires = 0 : Date d'expiration du cookie (timestamp)
 *     - path = 'AUTO' : Chemin sur lequel le cookie sera disponible
 *     - domain = '' : Domaine à partir duquel le cookie est disponible
 *     - secure = false : cookie sécurisé ou non ?
 *     - samesite = 'Lax' : valeur samesite (Lax, Strict ou None)
 * @param string $path
 *     Chemin sur lequel le cookie sera disponible (SPIP < 4.0: $path = 'AUTO')
 * @param string $domain
 *     Domaine à partir duquel le cookie est disponible
 * @param bool $secure
 *     Indique si le cookie doit être envoyé par le navigateur uniquement en connexion HTTPS (true) ou systématiquement (false)
 * @param bool $httponly
 *     Indique si le cookie doit être accessible en Javascript (false) ou non (true)
 * @return bool
 *     true si le cookie a été posé, false sinon.
 */
function spip_setcookie(
	string $name = '',
	string $value = '',
	int|array $expires_or_options = 0,
	string $path = '',
	string $domain = '',
	bool $secure = false,
	bool $httponly = false
) {
	if (!is_array($expires_or_options)) {
		# anciens paramètres : spip_setcookie($name = '', $value = '', $expire = 0, $path = 'AUTO', $domain = '', $secure = '')
		$options = [
			'expires' => (int) $expires_or_options,
			'path' => $path,
			'domain' => $domain,
			'secure' => $secure,
			'httponly' => $httponly,
		];
	} else {
		$options = $expires_or_options;
	}

	// expires
	$options['expires'] ??= 0;
	if (!isset($options['path']) || $options['path'] === 'AUTO') {
		$options['path'] = defined('_COOKIE_PATH') ? constant('_COOKIE_PATH') : preg_replace(',^\w+://[^/]*,', '', url_de_base());
	}
	if (empty($options['domain']) && defined('_COOKIE_DOMAIN') && constant('_COOKIE_DOMAIN')) {
		$options['domain'] = constant('_COOKIE_DOMAIN');
	}
	$options['secure'] ??= false;
	$options['secure'] = ($options['secure'] ?: ($_SERVER['HTTPS'] ?? false));
	if (defined('_COOKIE_SECURE') && constant('_COOKIE_SECURE')) {
		trigger_deprecation('spip', '5.0', 'Using "%s" constant is deprecated, use option "%s" when call "%s" instead (automatic in HTTPS).', '_COOKIE_SECURE', 'secure: true', __FUNCTION__);
		$options['secure'] = true;
	}
	$options['httponly'] ??= false;
	$options['samesite'] = ($options['samesite'] ?? 'Lax') ?: 'Lax';

	/** @deprecated 5.0 Use option `'httponly' => true` */
	if (defined('_COOKIE_SECURE_LIST')) {
		trigger_deprecation('spip', '5.0', 'Using "%s" constant is deprecated, use option "%s" when call "%s" instead.', '_COOKIE_SECURE_LIST', 'httponly: true', __FUNCTION__);
		if (
			is_array(constant('_COOKIE_SECURE_LIST'))
			&& in_array($name, constant('_COOKIE_SECURE_LIST'))
		) {
			$options['httponly'] = true;
		}
	}

	// in fine renommer le prefixe si besoin
	if (str_starts_with($name, 'spip_')) {
		$name = $GLOBALS['cookie_prefix'] . '_' . substr($name, 5);
	}

	#spip_logger('cookies')->info("cookie('$name', '$value', " . json_encode($options, true) . ")");
	$a = @setcookie($name, $value, $options);

	spip_cookie_envoye(true);

	return $a;
}

/**
 * Teste si un cookie a déjà été envoyé ou pas
 *
 * Permet par exemple à `redirige_par_entete()` de savoir le type de
 * redirection à appliquer (serveur ou navigateur)
 *
 * @see redirige_par_entete()
 *
 * @param bool|string $set
 *     true pour déclarer les cookies comme envoyés
 * @return bool
 */
function spip_cookie_envoye($set = '') {
	static $envoye = false;
	if ($set) {
		$envoye = true;
	}

	return $envoye;
}

/**
 * Adapte le tableau PHP `$_COOKIE` pour prendre en compte le préfixe
 * des cookies de SPIP
 *
 * Si le préfixe des cookies de SPIP est différent de `spip_` alors
 * la fonction modifie les `$_COOKIE` ayant le préfixe spécifique
 * pour remettre le préfixe `spip_` à la place.
 *
 * Ainsi les appels dans le code n'ont pas besoin de gérer le préfixe,
 * ils appellent simplement `$_COOKIE['spip_xx']` qui sera forcément
 * la bonne donnée.
 *
 * @param string $cookie_prefix
 *     Préfixe des cookies de SPIP
 */
function recuperer_cookies_spip($cookie_prefix) {
	$prefix_long = strlen($cookie_prefix);

	foreach (array_keys($_COOKIE) as $name) {
		if (str_starts_with($name, 'spip_') && substr($name, 0, $prefix_long) != $cookie_prefix) {
			unset($_COOKIE[$name]);
			unset($GLOBALS[$name]);
		}
	}
	foreach ($_COOKIE as $name => $value) {
		if (substr($name, 0, $prefix_long) == $cookie_prefix) {
			$spipname = preg_replace('/^' . $cookie_prefix . '_/', 'spip_', $name);
			$_COOKIE[$spipname] = $value;
			$GLOBALS[$spipname] = $value;
		}
	}
}


/**
 * Teste si javascript est supporté par le navigateur et pose un cookie en conséquence
 *
 * Si la valeur d'environnement `js` arrive avec la valeur
 *
 * - `-1` c'est un appel via une balise `<noscript>`.
 * - `1` c'est un appel via javascript
 *
 * Inscrit le résultat dans le cookie `spip_accepte_ajax`
 *
 * @see  html_tests_js()
 * @uses spip_setcookie()
 *
 */
function exec_test_ajax_dist() {
	switch (_request('js')) {
		// on est appele par <noscript>
		case -1:
			spip_setcookie('spip_accepte_ajax', -1);
			include_spip('inc/headers');
			redirige_par_entete(chemin_image('erreur-xx.svg'));
			break;

		// ou par ajax
		case 1:
		default:
			spip_setcookie('spip_accepte_ajax', 1);
			break;
	}
}
