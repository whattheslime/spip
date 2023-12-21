<?php

use Spip\Component\Cache\Adapter\FlatFilesystem;
use Spip\Component\Path\AggregatorInterface;
use Spip\Component\Path\Enum\Group;
use Spip\Component\Path\GroupAggregator;
use Spip\Component\Path\Loader;
use Symfony\Component\Filesystem\Path;

/**
 * Return unique Aggregator class
 *
 * @param null|array $add List of «plugins» directories to add
 */
function spip_paths(
	null|array $add = null,
): AggregatorInterface {
	static $paths = null;
	static $last_dossier_squelettes = null;

	$dossier_squelettes = $GLOBALS['dossier_squelettes'] ?? null;

	if ($paths === null) {
		$paths = new GroupAggregator(Group::cases(), _ROOT_CWD);
		$paths = $paths->with(Group::App, [
			_DIR_RACINE,
			_DIR_RACINE . 'squelettes-dist/',
			_DIR_RACINE . 'prive/',
			_DIR_RESTREINT,
		]);

		if (@is_dir(_DIR_RACINE . 'squelettes')) {
			$paths = $paths->with(Group::Templates, [_DIR_RACINE . 'squelettes']);
		}
	}

	if ($add !== null) {
		$paths = $paths->prepend(Group::Plugins, $add);
	}

	if ($last_dossier_squelettes !== $dossier_squelettes) {
		// Et le(s) dossier(s) des squelettes nommes
		if ($dossier_squelettes !== '') {
			$ds = explode(':', $dossier_squelettes);
			foreach ($ds as $key => $directory) {
				if (!str_starts_with($directory, '/')) {
					$ds[$key] = _DIR_RACINE . $directory;
				}
			}
			$paths = $paths->with(Group::ExtraTemplates, $ds);
		}
	}

	return $paths;
}

function spip_paths_loader(): Loader {
	static $loaders = [];
	static $cache = null;

	if ($cache === null) {
		$cache = new FlatFilesystem('paths', Path::makeAbsolute(_DIR_CACHE, _ROOT_CWD));
		if (_request('var_mode')) {
			$cache->clear();
		}
	}

	$paths = spip_paths();

	return $loaders[$paths->getHash()] ??= new Loader($paths, $cache);
}

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
 * @param string|array|null $dir_path
 *     - Répertoire(s) à empiler au path
 * @return array
 *     Liste des chemins, par ordre de priorité.
 **/
function _chemin(string|array|null $dir_path = null): array {
	if (is_array($dir_path) || strlen($dir_path)) {
		spip_paths(add: is_array($dir_path) ? $dir_path : explode(':', $dir_path));
	}

	return creer_chemin();
}

/**
 * Retourne la liste des chemins connus de SPIP, dans l'ordre de priorité
 *
 * @return array Liste de chemins
 **/
function creer_chemin(): array {
	$dirs = spip_paths()->getDirectories();
	// canal historique: avec / sauf si ''
	return array_map(fn ($dir) => $dir === '' ? $dir : $dir . DIRECTORY_SEPARATOR, $dirs);
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
function find_in_path(string $file, string $dirname = '', bool|string $include = false): ?string {

	$loader = spip_paths_loader();

	if ($dirname) {
		$file = rtrim($dirname, '/') . '/' . $file;
	}

	$path = $loader->get($file);
	// find in path retourne des chemins relatif, si possible
	if ($path !== null && str_starts_with($path, _ROOT_RACINE)) {
		$path = _DIR_RACINE . substr($path, strlen(_ROOT_RACINE));
	}

	if ($include === false) {
		return $path;
	}

	if ($include === true) {
		if ($path === null) {
			return null;
		}
		return $loader->include($file) ? $path : null;
	}

	if ($include === 'required') {
		return $loader->require($file) ? $path : null;
	}

	throw new \InvalidArgumentException(sprintf('$include argument with "%s" value is incorrect.', $include));
}

function clear_path_cache() {
	spip_paths_loader()->getCache()->clear();
}

function load_path_cache() {

}

function save_path_cache() {

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
