<?php

/**
 * Renvoie le `$_GET` ou le `$_POST` émis par l'utilisateur
 * ou pioché dans un tableau transmis
 *
 * @api
 * @param string $var
 *     Clé souhaitée
 * @param bool|array $c
 *     Tableau transmis (sinon cherche dans GET ou POST)
 * @return mixed|null
 *     - null si la clé n'a pas été trouvée
 *     - la valeur de la clé sinon.
 */
function _request($var, $c = false) {

	if (is_array($c)) {
		return $c[$var] ?? null;
	}

	if (isset($_GET[$var])) {
		$a = $_GET[$var];
	} elseif (isset($_POST[$var])) {
		$a = $_POST[$var];
	} else {
		return null;
	}

	// Si on est en ajax et en POST tout a ete encode
	// via encodeURIComponent, il faut donc repasser
	// dans le charset local...
	if (
		defined('_AJAX')
		&& _AJAX
		&& isset($GLOBALS['meta']['charset'])
		&& $GLOBALS['meta']['charset'] != 'utf-8'
		// check rapide mais pas fiable
		&& is_string($a)
		&& preg_match(',[\x80-\xFF],', $a)
		// check fiable
		&& include_spip('inc/charsets')
		&& is_utf8($a)
	) {
		return importer_charset($a, 'utf-8');
	}

	return $a;
}

/**
 * Affecte une valeur à une clé (pour usage avec `_request()`)
 *
 * @see _request() Pour obtenir la valeur
 * @note Attention au cas ou l'on fait `set_request('truc', NULL);`
 *
 * @param string $var Nom de la clé
 * @param string $val Valeur à affecter
 * @param bool|array $c Tableau de données (sinon utilise `$_GET` et `$_POST`)
 * @return array|bool
 *     - array $c complété si un $c est transmis,
 *     - false sinon
 */
function set_request($var, $val = null, $c = false) {
	if (is_array($c)) {
		unset($c[$var]);
		if ($val !== null) {
			$c[$var] = $val;
		}

		return $c;
	}

	unset($_GET[$var]);
	unset($_POST[$var]);
	if ($val !== null) {
		$_GET[$var] = $val;
	}

	return false; # n'affecte pas $c
}

/**
 * Sanitizer une valeur *SI* elle provient du GET ou POST
 * Utile dans les squelettes pour les valeurs qu'on attrape dans le env,
 * dont on veut permettre à un squelette de confiance appelant de fournir une valeur complexe
 * mais qui doit etre nettoyee si elle provient de l'URL
 *
 * On peut sanitizer
 * - une valeur simple : `$where = spip_sanitize_from_request($value, 'where')`
 * - un tableau en partie : `$env = spip_sanitize_from_request($env, ['key1','key2'])`
 * - un tableau complet : `$env = spip_sanitize_from_request($env, '*')`
 *
 * @param string|array $value
 * @param string|array $key
 * @param string $sanitize_function
 * @return array|mixed|string
 */
function spip_sanitize_from_request($value, $key, $sanitize_function = 'entites_html') {
	if (is_array($value)) {
		if ($key == '*') {
			$key = array_keys($value);
		}
		if (!is_array($key)) {
			$key = [$key];
		}
		foreach ($key as $k) {
			if (!empty($value[$k])) {
				$value[$k] = spip_sanitize_from_request($value[$k], $k, $sanitize_function);
			}
		}
		return $value;
	}
	// si la valeur vient des GET ou POST on la sanitize
	if (!empty($value) && $value == _request($key)) {
		$value = $sanitize_function($value);
	}
	return $value;
}
