<?php

/**
 * Gestion des chemins (ou path) de recherche de fichiers par SPIP
 *
 * Empile de nouveaux chemins (à la suite de ceux déjà présents, mais avant
 * le répertoire `squelettes` ou les dossiers squelettes), si un répertoire
 * (ou liste de répertoires séparés par `:`) lui est passé en paramètre.
 *
 * Ainsi, si l'argument est de la forme `dir1:dir2:dir3`, ces 3 chemins sont placés
 * en tête du path, dans cet ordre (hormis `squelettes` & la globale
 * `$dossier_squelette` si définie qui resteront devant)
 *
 * Retourne dans tous les cas la liste des chemins.
 *
 * @note
 *     Cette fonction est appelée à plusieurs endroits et crée une liste
 *     de chemins finale à peu près de la sorte :
 *
 *     - dossiers squelettes (si globale précisée)
 *     - squelettes/
 *     - plugins (en fonction de leurs dépendances) : ceux qui dépendent
 *       d'un plugin sont devant eux (ils peuvent surcharger leurs fichiers)
 *     - racine du site
 *     - squelettes-dist/
 *     - prive/
 *     - ecrire/
 *
 * @param string|array $dir_path
 *     - Répertoire(s) à empiler au path
 *     - '' provoque un recalcul des chemins.
 * @return array
 *     Liste des chemins, par ordre de priorité.
 **/
function _chemin($dir_path = null) {
	static $path_base = null;
	static $path_full = null;
	if ($path_base == null) {
		// Chemin standard depuis l'espace public
		$path = defined('_SPIP_PATH') ? _SPIP_PATH :
			_DIR_RACINE . ':' .
			_DIR_RACINE . 'squelettes-dist/:' .
			_DIR_RACINE . 'prive/:' .
			_DIR_RESTREINT;
		// Ajouter squelettes/
		if (@is_dir(_DIR_RACINE . 'squelettes')) {
			$path = _DIR_RACINE . 'squelettes/:' . $path;
		}
		foreach (explode(':', $path) as $dir) {
			if (strlen($dir) && !str_ends_with($dir, '/')) {
				$dir .= '/';
			}
			$path_base[] = $dir;
		}
		$path_full = $path_base;
		// Et le(s) dossier(s) des squelettes nommes
		if (strlen($GLOBALS['dossier_squelettes'])) {
			foreach (array_reverse(explode(':', $GLOBALS['dossier_squelettes'])) as $d) {
				array_unshift($path_full, ($d[0] == '/' ? '' : _DIR_RACINE) . $d . '/');
			}
		}
		$GLOBALS['path_sig'] = md5(serialize($path_full));
	}
	if ($dir_path === null) {
		return $path_full;
	}

	if (is_array($dir_path) || strlen($dir_path)) {
		$tete = '';
		if (reset($path_base) == _DIR_RACINE . 'squelettes/') {
			$tete = array_shift($path_base);
		}
		$dirs = (is_array($dir_path) ? $dir_path : explode(':', $dir_path));
		$dirs = array_reverse($dirs);
		foreach ($dirs as $dir_path) {
			if (!str_ends_with($dir_path, '/')) {
				$dir_path .= '/';
			}
			if (!in_array($dir_path, $path_base)) {
				array_unshift($path_base, $dir_path);
			}
		}
		if (strlen($tete)) {
			array_unshift($path_base, $tete);
		}
	}
	$path_full = $path_base;
	// Et le(s) dossier(s) des squelettes nommes
	if (strlen($GLOBALS['dossier_squelettes'])) {
		foreach (array_reverse(explode(':', $GLOBALS['dossier_squelettes'])) as $d) {
			array_unshift($path_full, ((isset($d[0]) && $d[0] == '/') ? '' : _DIR_RACINE) . $d . '/');
		}
	}

	$GLOBALS['path_sig'] = md5(serialize($path_full));

	return $path_full;
}

/**
 * Retourne la liste des chemins connus de SPIP, dans l'ordre de priorité
 *
 * Recalcule la liste si le nom ou liste de dossier squelettes a changé.
 *
 * @uses _chemin()
 *
 * @return array Liste de chemins
 **/
function creer_chemin() {
	$path_a = _chemin();
	static $c = '';

	// on calcule le chemin si le dossier skel a change
	if ($c != $GLOBALS['dossier_squelettes']) {
		// assurer le non plantage lors de la montee de version :
		$c = $GLOBALS['dossier_squelettes'];
		$path_a = _chemin(''); // forcer un recalcul du chemin
	}

	return $path_a;
}


/**
 * Retourne la liste des thèmes du privé utilisables pour cette session
 *
 * @see inscription_nouveau() pour une particularité historique du champ 'prefs'
 *
 * @return string[] Nom des thèmes.
 */
function lister_themes_prives(): array {
	static $themes = null;
	if (is_null($themes)) {
		// si pas encore definie
		if (!defined('_SPIP_THEME_PRIVE')) {
			define('_SPIP_THEME_PRIVE', 'spip');
		}
		$themes = [_SPIP_THEME_PRIVE];
		// Lors d'une installation neuve, prefs n'est pas definie ; sinon, c'est un tableau sérialisé
		// FIXME: Aussitôt après une demande d'inscription, $prefs vaut une chaine statut_tmp;
		$prefs = $GLOBALS['visiteur_session']['prefs'] ?? [];
		if (is_string($prefs) && stripos($prefs, 'a:') === 0) {
			$prefs = unserialize($prefs);
		} else {
			$prefs = [];
		}

		$theme = $prefs['theme'] ?? $GLOBALS['theme_prive_defaut'] ?? null;
		if ($theme && $theme !== _SPIP_THEME_PRIVE) {
			// placer le theme choisi en tete
			array_unshift($themes, $theme);
		}
	}

	return $themes;
}

function find_in_theme($file, $subdir = '', $include = false) {
	static $themefiles = [];
	if (isset($themefiles["$subdir$file"])) {
		return $themefiles["$subdir$file"];
	}
	// on peut fournir une icone generique -xx.svg qui fera le job dans toutes les tailles, et qui est prioritaire sur le png
	// si il y a un .svg a la bonne taille (-16.svg) a cote, on l'utilise en remplacement du -16.png
	if (
		preg_match(',-(\d+)[.](png|gif|svg)$,', $file, $m)
		&& ($file_svg_generique = substr($file, 0, -strlen($m[0])) . '-xx.svg')
		&& ($f = find_in_theme("$file_svg_generique"))
	) {
		if (($fsize = substr($f, 0, -6) . $m[1] . '.svg') && file_exists($fsize)) {
			return $themefiles["$subdir$file"] = $fsize;
		}
		else {
			return $themefiles["$subdir$file"] = "$f?" . $m[1] . 'px';
		}
	}

	$themes = lister_themes_prives();
	foreach ($themes as $theme) {
		if ($f = find_in_path($file, "prive/themes/$theme/$subdir", $include)) {
			return $themefiles["$subdir$file"] = $f;
		}
	}
	spip_log("$file introuvable dans le theme prive " . reset($themes), 'theme');

	return $themefiles["$subdir$file"] = '';
}


/**
 * Cherche une image dans les dossiers d'images
 *
 * Cherche en priorité dans les thèmes d'image (prive/themes/X/images)
 * et si la fonction n'en trouve pas, gère le renommage des icones (ex: 'supprimer' => 'del')
 * de facon temporaire le temps de la migration, et cherche de nouveau.
 *
 * Si l'image n'est toujours pas trouvée, on la cherche dans les chemins,
 * dans le répertoire défini par la constante `_NOM_IMG_PACK`
 *
 * @see find_in_theme()
 * @see inc_icone_renommer_dist()
 *
 * @param string $icone
 *     Nom de l'icone cherchée
 * @return string
 *     Chemin complet de l'icone depuis la racine si l'icone est trouée,
 *     sinon chaîne vide.
 **/
function chemin_image($icone) {
	static $icone_renommer;
	if ($p = strpos($icone, '?')) {
		$icone = substr($icone, 0, $p);
	}
	// gerer le cas d'un double appel en evitant de refaire le travail inutilement
	if (str_contains($icone, '/') && file_exists($icone)) {
		return $icone;
	}

	// si c'est un nom d'image complet (article-24.png) essayer de le renvoyer direct
	if (preg_match(',[.](png|gif|jpg|webp|svg)$,', $icone) && ($f = find_in_theme("images/$icone"))) {
		return $f;
	}
	// sinon passer par le module de renommage
	if (is_null($icone_renommer)) {
		$icone_renommer = charger_fonction('icone_renommer', 'inc', true);
	}
	if ($icone_renommer) {
		[$icone, $fonction] = $icone_renommer($icone, '');
		if (file_exists($icone)) {
			return $icone;
		}
	}

	return find_in_path($icone, _NOM_IMG_PACK);
}

/**
 * Recherche un fichier dans les chemins de SPIP (squelettes, plugins, core)
 *
 * Retournera le premier fichier trouvé (ayant la plus haute priorité donc),
 * suivant l'ordre des chemins connus de SPIP.
 *
 * @api
 * @see  charger_fonction()
 * @uses creer_chemin() Pour la liste des chemins.
 * @example
 *     ```
 *     $f = find_in_path('css/perso.css');
 *     $f = find_in_path('perso.css', 'css');
 *     ```
 *
 * @param string $file
 *     Fichier recherché
 * @param string $dirname
 *     Répertoire éventuel de recherche (est aussi extrait automatiquement de $file)
 * @param bool|string $include
 *     - false : ne fait rien de plus
 *     - true : inclut le fichier (include_once)
 *     - 'require' : idem, mais tue le script avec une erreur si le fichier n'est pas trouvé.
 * @return string|bool
 *     - string : chemin du fichier trouvé
 *     - false : fichier introuvable
 **/
function find_in_path($file, $dirname = '', $include = false) {
	static $dirs = [];
	static $inc = []; # cf https://git.spip.net/spip/spip/commit/42e4e028e38c839121efaee84308d08aee307eec
	static $c = '';

	if (!$file && !strlen($file)) {
		return false;
	}

	// on calcule le chemin si le dossier skel a change
	if ($c != $GLOBALS['dossier_squelettes']) {
		// assurer le non plantage lors de la montee de version :
		$c = $GLOBALS['dossier_squelettes'];
		creer_chemin(); // forcer un recalcul du chemin et la mise a jour de path_sig
	}

	if (isset($GLOBALS['path_files'][$GLOBALS['path_sig']][$dirname][$file])) {
		if (!$GLOBALS['path_files'][$GLOBALS['path_sig']][$dirname][$file]) {
			return false;
		}
		if ($include && !isset($inc[$dirname][$file])) {
			include_once _ROOT_CWD . $GLOBALS['path_files'][$GLOBALS['path_sig']][$dirname][$file];
			$inc[$dirname][$file] = $inc[''][$dirname . $file] = true;
		}

		return $GLOBALS['path_files'][$GLOBALS['path_sig']][$dirname][$file];
	}

	$a = strrpos($file, '/');
	if ($a !== false) {
		$dirname .= substr($file, 0, ++$a);
		$file = substr($file, $a);
	}

	foreach (creer_chemin() as $dir) {
		if (!isset($dirs[$a = $dir . $dirname])) {
			$dirs[$a] = (is_dir(_ROOT_CWD . $a) || !$a);
		}
		if ($dirs[$a]) {
			if (file_exists(_ROOT_CWD . ($a .= $file))) {
				if ($include && !isset($inc[$dirname][$file])) {
					include_once _ROOT_CWD . $a;
					$inc[$dirname][$file] = $inc[''][$dirname . $file] = true;
				}
				if (!defined('_SAUVER_CHEMIN')) {
					// si le chemin n'a pas encore ete charge, ne pas lever le flag, ne pas cacher
					if (is_null($GLOBALS['path_files'])) {
						return $a;
					}
					define('_SAUVER_CHEMIN', true);
				}

				return $GLOBALS['path_files'][$GLOBALS['path_sig']][$dirname][$file] = $GLOBALS['path_files'][$GLOBALS['path_sig']][''][$dirname . $file] = $a;
			}
		}
	}

	if ($include) {
		spip_log("include_spip $dirname$file non trouve");
		if ($include === 'required') {
			echo '<pre>',
			'<strong>Erreur Fatale</strong><br />';
			if (function_exists('debug_print_backtrace')) {
				debug_print_backtrace();
			}
			echo '</pre>';
			die("Erreur interne: ne peut inclure $dirname$file");
		}
	}

	if (!defined('_SAUVER_CHEMIN')) {
		// si le chemin n'a pas encore ete charge, ne pas lever le flag, ne pas cacher
		if (is_null($GLOBALS['path_files'])) {
			return false;
		}
		define('_SAUVER_CHEMIN', true);
	}

	return $GLOBALS['path_files'][$GLOBALS['path_sig']][$dirname][$file] = $GLOBALS['path_files'][$GLOBALS['path_sig']][''][$dirname . $file] = false;
}

function clear_path_cache() {
	$GLOBALS['path_files'] = [];
	spip_unlink(_CACHE_CHEMIN);
}

function load_path_cache() {
	// charger le path des plugins
	if (@is_readable(_CACHE_PLUGINS_PATH)) {
		include_once(_CACHE_PLUGINS_PATH);
	}
	$GLOBALS['path_files'] = [];
	// si le visiteur est admin,
	// on ne recharge pas le cache pour forcer sa mise a jour
	if (
		// la session n'est pas encore chargee a ce moment, on ne peut donc pas s'y fier
		//AND (!isset($GLOBALS['visiteur_session']['statut']) OR $GLOBALS['visiteur_session']['statut']!='0minirezo')
		// utiliser le cookie est un pis aller qui marche 'en general'
		// on blinde par un second test au moment de la lecture de la session
		// !isset($_COOKIE[$GLOBALS['cookie_prefix'].'_admin'])
		// et en ignorant ce cache en cas de recalcul explicite
		!_request('var_mode')
	) {
		// on essaye de lire directement sans verrou pour aller plus vite
		if ($contenu = spip_file_get_contents(_CACHE_CHEMIN)) {
			// mais si semble corrompu on relit avec un verrou
			if (!$GLOBALS['path_files'] = unserialize($contenu)) {
				lire_fichier(_CACHE_CHEMIN, $contenu);
				if (!$GLOBALS['path_files'] = unserialize($contenu)) {
					$GLOBALS['path_files'] = [];
				}
			}
		}
	}
}

function save_path_cache() {
	if (
		defined('_SAUVER_CHEMIN')
		&& _SAUVER_CHEMIN
	) {
		ecrire_fichier(_CACHE_CHEMIN, serialize($GLOBALS['path_files']));
	}
}

/**
 * Trouve tous les fichiers du path correspondants à un pattern
 *
 * Pour un nom de fichier donné, ne retourne que le premier qui sera trouvé
 * par un `find_in_path()`
 *
 * @api
 * @uses creer_chemin()
 * @uses preg_files()
 *
 * @param string $dir
 * @param string $pattern
 * @param bool $recurs
 * @return array
 */
function find_all_in_path($dir, $pattern, $recurs = false) {
	$liste_fichiers = [];
	$maxfiles = 10000;

	// cas borderline si dans mes_options on appelle redirige_par_entete qui utilise _T et charge un fichier de langue
	// on a pas encore inclus flock.php
	if (!function_exists('preg_files')) {
		include_once _ROOT_RESTREINT . 'inc/flock.php';
	}

	// Parcourir le chemin
	foreach (creer_chemin() as $d) {
		$f = $d . $dir;
		if (@is_dir($f)) {
			$liste = preg_files($f, $pattern, $maxfiles - count($liste_fichiers), $recurs === true ? [] : $recurs);
			foreach ($liste as $chemin) {
				$nom = basename($chemin);
				// ne prendre que les fichiers pas deja trouves
				// car find_in_path prend le premier qu'il trouve,
				// les autres sont donc masques
				if (!isset($liste_fichiers[$nom])) {
					$liste_fichiers[$nom] = $chemin;
				}
			}
		}
	}

	return $liste_fichiers;
}
