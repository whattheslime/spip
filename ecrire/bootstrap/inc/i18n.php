<?php

/**
 * Traduction des textes de SPIP
 *
 * Traduit une clé de traduction en l'obtenant dans les fichiers de langues.
 *
 * @api
 * @uses inc_traduire_dist()
 * @uses _L()
 * @example
 *     ```
 *     _T('bouton_enregistrer')
 *     _T('medias:image_tourner_droite')
 *     _T('medias:erreurs', array('nb'=>3))
 *     _T("email_sujet", array('spip_lang'=>$lang_usager))
 *     ```
 *
 * @param string $texte
 *     Clé de traduction
 * @param array $args
 *     Couples (variable => valeur) pour passer des variables à la chaîne traduite. la variable spip_lang permet de forcer la langue
 * @param array $options
 *     - string class : nom d'une classe a ajouter sur un span pour encapsuler la chaine
 *     - bool force : forcer un retour meme si la chaine n'a pas de traduction
 *     - bool sanitize : nettoyer le html suspect dans les arguments
 * @return string
 *     texte
 */
function _T($texte, $args = [], $options = []) {
	static $traduire = false;
	$o = ['class' => '', 'force' => true, 'sanitize' => true];
	if ($options) {
		// support de l'ancien argument $class
		if (is_string($options)) {
			$options = ['class' => $options];
		}
		$o = array_merge($o, $options);
	}

	if (!$traduire) {
		$traduire = charger_fonction('traduire', 'inc');
		include_spip('inc/lang');
	}

	// On peut passer explicitement la langue dans le tableau
	// On utilise le même nom de variable que la globale
	if (isset($args['spip_lang'])) {
		$lang = $args['spip_lang'];
		// On l'enleve pour ne pas le passer au remplacement
		unset($args['spip_lang']);
	} // Sinon on prend la langue du contexte
	else {
		$lang = $GLOBALS['spip_lang'];
	}
	$text = $traduire($texte, $lang);

	if ($text === null || !strlen($text)) {
		if (!$o['force']) {
			return '';
		}

		$text = $texte;

		// pour les chaines non traduites, assurer un service minimum
		if (!$GLOBALS['test_i18n'] && _request('var_mode') != 'traduction') {
			$n = strpos($text, ':');
			if ($n !== false) {
				$text = substr($text, $n + 1);
			}
			$text = str_replace('_', ' ', $text);
		}
		$o['class'] = null;
	}

	return _L($text, $args, $o);
}


/**
 * Remplace les variables `@...@` par leur valeur dans une chaîne de langue.
 *
 * Cette fonction est également appelée dans le code source de SPIP quand une
 * chaîne n'est pas encore dans les fichiers de langue.
 *
 * @see _T()
 * @example
 *     ```
 *     _L('Texte avec @nb@ ...', array('nb'=>3)
 *     ```
 *
 * @param string $text
 *     texte
 * @param array $args
 *     Couples (variable => valeur) à transformer dans le texte
 * @param array $options
 *     - string class : nom d'une classe a ajouter sur un span pour encapsuler la chaine
 *     - bool sanitize : nettoyer le html suspect dans les arguments
 * @return string
 *     texte
 */
function _L($text, $args = [], $options = []) {
	$f = $text;
	$defaut_options = [
		'class' => null,
		'sanitize' => true,
	];
	// support de l'ancien argument $class
	if ($options && is_string($options)) {
		$options = ['class' => $options];
	}
	if (is_array($options)) {
		$options += $defaut_options;
	} else {
		$options = $defaut_options;
	}

	if (is_array($args) && count($args)) {
		if (!function_exists('interdire_scripts')) {
			include_spip('inc/texte');
		}
		if (!function_exists('echapper_html_suspect')) {
			include_spip('inc/texte_mini');
		}
		foreach ($args as $name => $value) {
			if (str_contains($text, (string) "@$name@")) {
				if ($options['sanitize']) {
					$value = echapper_html_suspect($value);
					$value = interdire_scripts($value, -1);
				}
				if (!empty($options['class'])) {
					$value = "<span class='" . $options['class'] . "'>$value</span>";
				}
				$text = str_replace("@$name@", (string) $value, (string) $text);
				unset($args[$name]);
			}
		}
		// Si des variables n'ont pas ete inserees, le signaler
		// (chaines de langues pas a jour)
		if ($args) {
			spip_log("$f:  variables inutilisees " . join(', ', array_keys($args)), _LOG_DEBUG);
		}
	}

	if (($GLOBALS['test_i18n'] || _request('var_mode') == 'traduction') && is_null($options['class'])) {
		return "<span class='debug-traduction-erreur'>$text</span>";
	} else {
		return $text;
	}
}


/**
 * Sélectionne la langue donnée en argument et mémorise la courante
 *
 * Restaure l'ancienne langue si appellée sans argument.
 *
 * @note
 *     On pourrait économiser l'empilement en cas de non changemnt
 *     et lui faire retourner `False` pour prevenir l'appelant
 *     Le noyau de Spip sait le faire, mais pour assurer la compatibilité
 *     cette fonction retourne toujours non `False`
 *
 * @uses changer_langue()
 * @param null|string $lang
 *     - string : Langue à appliquer,
 *     - null : Pour restituer la dernière langue mémorisée.
 * @return string
 *     - string Langue utilisée.
 **/
function lang_select($lang = null) {
	static $pile_langues = [];
	if (!function_exists('changer_langue')) {
		include_spip('inc/lang');
	}
	if ($lang === null) {
		$lang = array_pop($pile_langues);
	} else {
		array_push($pile_langues, $GLOBALS['spip_lang']);
	}
	if (isset($GLOBALS['spip_lang']) && $lang == $GLOBALS['spip_lang']) {
		return $lang;
	}
	changer_langue($lang);

	return $lang;
}
