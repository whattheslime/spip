<?php

/**
 * Transformation XML des `&` en `&amp;`
 *
 * @pipeline post_typo
 * @param string $u
 * @return string
 */
function quote_amp($u) {
	return preg_replace(
		'/&(?![a-z]{0,4}\w{2,3};|#x?[0-9a-f]{2,6};)/i',
		'&amp;',
		$u
	);
}

/**
 * Tester si une URL est absolue
 *
 * On est sur le web, on exclut certains protocoles,
 * notamment 'file://', 'php://' et d'autres…

 * @param string $url
 * @return bool
 */
function tester_url_absolue($url) {
	$url = trim($url ?? '');
	if ($url && preg_match(';^([a-z]{3,7}:)?//;Uims', $url, $m)) {
		if (
			isset($m[1])
			&& ($p = strtolower(rtrim($m[1], ':')))
			&& in_array($p, ['file', 'php', 'zlib', 'glob', 'phar', 'ssh2', 'rar', 'ogg', 'expect', 'zip'])
		) {
			return false;
		}
		return true;
	}
	return false;
}

/**
 * Prend une URL et lui ajoute/retire un paramètre
 *
 * @filtre
 * @link https://www.spip.net/4255
 * @example
 *     ```
 *     [(#SELF|parametre_url{suite,18})] (ajout)
 *     [(#SELF|parametre_url{suite,''})] (supprime)
 *     [(#SELF|parametre_url{suite[],1})] (tableaux valeurs multiples)
 *     ```
 *
 * @param string $url URL
 * @param string $c Nom du paramètre
 * @param string|array|null $v Valeur du paramètre
 * @param string $sep Séparateur entre les paramètres
 * @return string URL
 */
function parametre_url($url, $c, $v = null, $sep = '&amp;') {
	// requete erronnee : plusieurs variable dans $c et aucun $v
	if (str_contains($c, '|') && is_null($v)) {
		return null;
	}

	// lever l'#ancre
	if (preg_match(',^([^#]*)(#.*)$,', $url, $r)) {
		$url = $r[1];
		$ancre = $r[2];
	} else {
		$ancre = '';
	}

	// eclater
	$url = preg_split(',[?]|&amp;|&,', $url);

	// recuperer la base
	$a = array_shift($url);
	if (!$a) {
		$a = './';
	}

	// preparer la regexp de maniere securisee
	$regexp = explode('|', $c);
	foreach ($regexp as $r => $e) {
		$regexp[$r] = str_replace('[]', '\[\]', preg_replace(',[^\w\[\]-],', '', $e));
	}
	$regexp = ',^(' . implode('|', $regexp) . '[[]?[]]?)(=.*)?$,';
	$ajouts = array_flip(explode('|', $c));
	$u = is_array($v) ? $v : rawurlencode((string) $v);
	$testv = (is_array($v) ? count($v) : strlen((string) $v));
	$v_read = null;
	// lire les variables et agir
	foreach ($url as $n => $val) {
		if (preg_match($regexp, urldecode($val), $r)) {
			$r = array_pad($r, 3, null);
			if ($v === null) {
				// c'est un tableau, on memorise les valeurs
				if (str_ends_with($r[1], '[]')) {
					if (!$v_read) {
						$v_read = [];
					}
					$v_read[] = $r[2] ? substr($r[2], 1) : '';
				} // c'est un scalaire, on retourne direct
				else {
					return $r[2] ? substr($r[2], 1) : '';
				}
			} // suppression
			elseif (!$testv) {
				unset($url[$n]);
			}
			// Ajout. Pour une variable, remplacer au meme endroit,
			// pour un tableau ce sera fait dans la prochaine boucle
			elseif (!str_ends_with($r[1], '[]')) {
				$url[$n] = $r[1] . '=' . $u;
				unset($ajouts[$r[1]]);
			}
			// Pour les tableaux on laisse tomber les valeurs de
			// départ, on remplira à l'étape suivante
			else {
				unset($url[$n]);
			}
		}
	}

	// traiter les parametres pas encore trouves
	if (
		$v === null
		&& ($args = func_get_args())
		&& count($args) == 2
	) {
		return $v_read; // rien trouve ou un tableau
	} elseif ($testv) {
		foreach ($ajouts as $k => $n) {
			if (!is_array($v)) {
				$url[] = $k . '=' . $u;
			} else {
				$id = (str_ends_with($k, '[]')) ? $k : ($k . '[]');
				foreach ($v as $w) {
					$url[] = $id . '=' . (is_array($w) ? 'Array' : rawurlencode($w));
				}
			}
		}
	}

	// eliminer les vides
	$url = array_filter($url);

	// recomposer l'adresse
	if ($url) {
		$a .= '?' . join($sep, $url);
	}

	return $a . $ancre;
}

/**
 * Ajoute (ou retire) une ancre sur une URL
 *
 * L’ancre est nettoyée : on translitère, vire les non alphanum du début,
 * et on remplace ceux à l'interieur ou au bout par `-`
 *
 * @example
 *     - `$url = ancre_url($url, 'navigation'); // => mettra l’ancre #navigation
 *     - `$url = ancre_url($url, ''); // => enlèvera une éventuelle ancre
 * @uses translitteration()
 */
function ancre_url(string $url, ?string $ancre = ''): string {
	$ancre ??= '';
	// lever l'#ancre
	if (preg_match(',^([^#]*)(#.*)$,', $url, $r)) {
		$url = $r[1];
	}
	if (preg_match('/[^-_a-zA-Z0-9]+/S', $ancre)) {
		if (!function_exists('translitteration')) {
			include_spip('inc/charsets');
		}
		$ancre = preg_replace(
			['/^[^-_a-zA-Z0-9]+/', '/[^-_a-zA-Z0-9]/'],
			['', '-'],
			translitteration($ancre)
		);
	}
	return $url . (strlen($ancre) ? '#' . $ancre : '');
}

/**
 * Pour le nom du cache, les `types_urls` et `self`
 *
 * @param string|null $reset
 * @return string
 */
function nettoyer_uri($reset = null) {
	static $done = false;
	static $propre = '';
	if (!is_null($reset)) {
		return $propre = $reset;
	}
	if ($done) {
		return $propre;
	}
	$done = true;
	return $propre = nettoyer_uri_var($GLOBALS['REQUEST_URI']);
}

/**
 * Nettoie une URI de certains paramètres (var_xxx, utm_xxx, etc.)
 *
 * La regexp des paramètres nettoyés est calculée à partir de la constante `_CONTEXTE_IGNORE_LISTE_VARIABLES`
 * (qui peut être redéfinie dans mes_options.php)
 *
 * @uses _CONTEXTE_IGNORE_LISTE_VARIABLES
 *
 * @param string $request_uri
 * @return string
 */
function nettoyer_uri_var($request_uri) {
	static $preg_nettoyer;
	if (!defined('_CONTEXTE_IGNORE_LISTE_VARIABLES')) {
		/** @var array<string> Liste (regexp) de noms de variables à ignorer d’une URI */
		define('_CONTEXTE_IGNORE_LISTE_VARIABLES', ['^var_', '^PHPSESSID$', '^fbclid$', '^utm_']);
	}
	if (empty($preg_nettoyer)) {
		$preg_nettoyer_vars = _CONTEXTE_IGNORE_LISTE_VARIABLES;
		foreach ($preg_nettoyer_vars as &$var) {
			if (str_starts_with($var, '^')) {
				$var = substr($var, 1);
			} else {
				$var = '[^=&]*' . $var;
			}
			if (str_ends_with($var, '$')) {
				$var = substr($var, 0, -1);
			} else {
				$var .= '[^=&]*';
			}
		}
		$preg_nettoyer = ',([?&])(' . implode('|', $preg_nettoyer_vars) . ')=[^&]*(&|$),i';
	}
	if (empty($request_uri)) {
		return $request_uri;
	}
	$uri1 = $request_uri;
	do {
		$uri = $uri1;
		$uri1 = preg_replace($preg_nettoyer, '\1', $uri);
	} while ($uri <> $uri1);
	return rtrim($uri1, '?&');
}


/**
 * Donner l'URL de base d'un lien vers "soi-meme", modulo les trucs inutiles
 *
 * @param string $amp
 *    Style des esperluettes
 * @param bool $root
 * @return string
 *    URL vers soi-même
 */
function self($amp = '&amp;', $root = false) {
	$url = nettoyer_uri();
	if (
		!$root
		&& (
			// si pas de profondeur on peut tronquer
			$GLOBALS['profondeur_url'] < (_DIR_RESTREINT ? 1 : 2)
			// sinon c'est OK si _SET_HTML_BASE a ete force a false
			|| defined('_SET_HTML_BASE') && !_SET_HTML_BASE
		)
	) {
		$url = preg_replace(',^[^?]*/,', '', $url);
	}
	// ajouter le cas echeant les variables _POST['id_...']
	foreach ($_POST as $v => $c) {
		if (str_starts_with($v, 'id_')) {
			$url = parametre_url($url, $v, $c, '&');
		}
	}

	// supprimer les variables sans interet
	if (test_espace_prive()) {
		$url = preg_replace(',([?&])('
			. 'lang|show_docs|'
			. 'changer_lang|var_lang|action)=[^&]*,i', '\1', $url);
		$url = preg_replace(',([?&])[&]+,', '\1', $url);
		$url = preg_replace(',[&]$,', '\1', $url);
	}

	// eviter les hacks
	include_spip('inc/filtres_mini');
	$url = spip_htmlspecialchars($url);

	$url = str_replace(["'", '"', '<', '[', ']', ':'], ['%27', '%22', '%3C', '%5B', '%5D', '%3A'], $url);

	// &amp; ?
	if ($amp != '&amp;') {
		$url = str_replace('&amp;', $amp, $url);
	}

	// Si ca demarre par ? ou vide, donner './'
	$url = preg_replace(',^([?].*)?$,', './\1', $url);

	return $url;
}

/**
 * Fonction codant  les URLs des objets SQL mis en page par SPIP
 *
 * @api
 * @param int|string|null $id
 *   numero de la cle primaire si nombre
 * @param string $entite
 *   surnom de la table SQL (donne acces au nom de cle primaire)
 * @param string $args
 *   query_string a placer apres cle=$id&....
 * @param string $ancre
 *   ancre a mettre a la fin de l'URL a produire
 * @param ?bool $public
 *   produire l'URL publique ou privee (par defaut: selon espace)
 * @param string $type
 *   fichier dans le repertoire ecrire/urls determinant l'apparence
 * @param string $connect
 *   serveur de base de donnee (nom du connect)
 * @return string
 *   url codee ou fonction de decodage
 */
function generer_objet_url($id, string $entite, string $args = '', string $ancre = '', ?bool $public = null, string $type = '', string $connect = ''): string {
	if ($public === null) {
		$public = !test_espace_prive();
	}
	$id = intval($id);
	$entite = objet_type($entite); // cas particulier d'appels sur objet/id_objet...

	if (!$public) {
		if (!$entite) {
			return '';
		}
		if (!function_exists('generer_objet_url_ecrire')) {
			include_spip('inc/urls');
		}
		$res = generer_objet_url_ecrire($id, $entite, $args, $ancre, false, $connect);
	} else {
		$f = charger_fonction_url('objet', $type ?? '');

		// @deprecated si $entite='', on veut la fonction de passage URL ==> id
		// @see charger_fonction_url
		if (!$entite) {
			return $f;
		}

		// mais d'abord il faut tester le cas des urls sur une
		// base distante
		if (
			$connect
			&& ($g = charger_fonction('connect', 'urls', true))
		) {
			$f = $g;
		}

		$res = $f(intval($id), $entite, $args ?: '', $ancre ?: '', $connect);
	}
	if ($res) {
		return $res;
	}

	// On a ete gentil mais la ....
	spip_logger()->error("generer_objet_url: entite $entite " . ($public ? "($f)" : '') . " inconnue $type $public $connect");

	return '';
}

/**
 * @deprecated 4.1
 * @see generer_objet_url
 */
function generer_url_entite($id = 0, $entite = '', $args = '', $ancre = '', $public = null, $type = null) {
	trigger_deprecation('spip', '4.1', 'Using "%s" is deprecated, use "%s" instead', __FUNCTION__, 'generer_objet_url');
	if ($public && is_string($public)) {
		return generer_objet_url(intval($id), $entite, $args ?: '', $ancre ?: '', true, $type ?? '', $public);
	}
	return generer_objet_url(intval($id), $entite, $args ?: '', $ancre ?: '', $public, $type ?? '');
}

/**
 * Generer l'url vers la page d'edition dans ecrire/
 * @param int|string|null $id
 */
function generer_objet_url_ecrire_edit($id, string $entite, string $args = '', string $ancre = ''): string {
	$id = intval($id);
	$exec = objet_info($entite, 'url_edit');
	$url = generer_url_ecrire($exec, $args);
	if (intval($id)) {
		$url = parametre_url($url, id_table_objet($entite), $id);
	} else {
		$url = parametre_url($url, 'new', 'oui');
	}
	if ($ancre) {
		$url = ancre_url($url, $ancre);
	}

	return $url;
}

/**
 * @deprecated 4.1
 * @see generer_objet_url_ecrire_edit
 */
function generer_url_ecrire_entite_edit($id, $entite, $args = '', $ancre = '') {
	trigger_deprecation('spip', '4.1', 'Using "%s" is deprecated, use "%s" instead', __FUNCTION__, 'generer_objet_url_ecrire_edit');
	return generer_objet_url_ecrire_edit(intval($id), $entite, $args, $ancre);
}


function urls_connect_dist($i, &$entite, $args = '', $ancre = '', $public = null) {
	include_spip('base/connect_sql');
	$id_type = id_table_objet($entite, $public);

	return _DIR_RACINE . get_spip_script('./')
	. '?' . _SPIP_PAGE . "=$entite&$id_type=$i&connect=$public"
	. (!$args ? '' : "&$args")
	. (!$ancre ? '' : "#$ancre");
}


/**
 * Transformer les caractères utf8 d'une URL (farsi par exemple) selon la RFC 1738
 *
 * @param string $url
 * @return string
 */
function urlencode_1738($url) {
	if (preg_match(',[^\x00-\x7E],sS', $url)) {
		$uri = '';
		for ($i = 0; $i < strlen($url); $i++) {
			if (ord($a = $url[$i]) > 127) {
				$a = rawurlencode($a);
			}
			$uri .= $a;
		}
		$url = $uri;
	}

	return quote_amp($url);
}

/**
 * Generer l'url absolue vers un objet
 *
 * @param int|string|null $id
 */
function generer_objet_url_absolue($id = 0, string $entite = '', string $args = '', string $ancre = '', ?bool $public = null, string $type = '', string $connect = ''): string {
	$id = intval($id);
	$h = generer_objet_url($id, $entite, $args, $ancre, $public, $type, $connect);
	if (!preg_match(',^\w+:,', $h)) {
		include_spip('inc/filtres_mini');
		$h = url_absolue($h);
	}

	return $h;
}

/**
 * @deprecated 4.1
 * @see  generer_objet_url_absolue
 */
function generer_url_entite_absolue($id = 0, $entite = '', $args = '', $ancre = '', $connect = null) {
	trigger_deprecation('spip', '4.1', 'Using "%s" is deprecated, use "%s" instead', __FUNCTION__, 'generer_objet_url_absolue');
	return generer_objet_url_absolue(intval($id), $entite, $args, $ancre, true, '', $connect ?? '');
}


//
// Fonctions de fabrication des URL des scripts de Spip
//
/**
 * Calcule l'url de base du site
 *
 * Calcule l'URL de base du site, en priorité sans se fier à la méta (adresse_site) qui
 * peut être fausse (sites avec plusieurs noms d’hôtes, déplacements, erreurs).
 * En dernier recours, lorsqu'on ne trouve rien, on utilise adresse_site comme fallback.
 *
 * @note
 *     La globale `$profondeur_url` doit être initialisée de manière à
 *     indiquer le nombre de sous-répertoires de l'url courante par rapport à la
 *     racine de SPIP : par exemple, sur ecrire/ elle vaut 1, sur sedna/ 1, et à
 *     la racine 0. Sur url/perso/ elle vaut 2
 *
 * @param int|bool|array $profondeur
 *    - si non renseignée : retourne l'url pour la profondeur $GLOBALS['profondeur_url']
 *    - si int : indique que l'on veut l'url pour la profondeur indiquée
 *    - si bool : retourne le tableau static complet
 *    - si array : réinitialise le tableau static complet avec la valeur fournie
 * @return string|array
 */
function url_de_base($profondeur = null) {

	static $url = [];
	if (is_array($profondeur)) {
		return $url = $profondeur;
	}
	if ($profondeur === false) {
		return $url;
	}

	if (is_null($profondeur)) {
		$profondeur = $GLOBALS['profondeur_url'] ?? (_DIR_RESTREINT ? 0 : 1);
	}

	if (isset($url[$profondeur])) {
		return $url[$profondeur];
	}

	$http = 'http';

	if (
		isset($_SERVER['SCRIPT_URI'])
		&& str_starts_with($_SERVER['SCRIPT_URI'], 'https')
	) {
		$http = 'https';
	} elseif (
		isset($_SERVER['HTTPS'])
		&& test_valeur_serveur($_SERVER['HTTPS'])
	) {
		$http = 'https';
	}

	// note : HTTP_HOST contient le :port si necessaire
	if ($host = $_SERVER['HTTP_HOST'] ?? null) {
		// Filtrer $host pour proteger d'attaques d'entete HTTP
		$host = (filter_var($host, FILTER_SANITIZE_URL) ?: null);
	}

	// si on n'a pas trouvé d'hôte du tout, en dernier recours on utilise adresse_site comme fallback
	if (is_null($host) && isset($GLOBALS['meta']['adresse_site'])) {
		$host = $GLOBALS['meta']['adresse_site'];
		if ($scheme = parse_url($host, PHP_URL_SCHEME)) {
			$http = $scheme;
			$host = str_replace("{$scheme}://", '', $host);
		}
	}
	if (
		isset($_SERVER['SERVER_PORT'])
		&& ($port = $_SERVER['SERVER_PORT'])
		&& !str_contains($host, ':')
	) {
		if (!defined('_PORT_HTTP_STANDARD')) {
			define('_PORT_HTTP_STANDARD', '80');
		}
		if (!defined('_PORT_HTTPS_STANDARD')) {
			define('_PORT_HTTPS_STANDARD', '443');
		}
		if ($http == 'http' && !in_array($port, explode(',', _PORT_HTTP_STANDARD))) {
			$host .= ":$port";
		}
		if ($http == 'https' && !in_array($port, explode(',', _PORT_HTTPS_STANDARD))) {
			$host .= ":$port";
		}
	}

	if (!$GLOBALS['REQUEST_URI']) {
		if (isset($_SERVER['REQUEST_URI'])) {
			$GLOBALS['REQUEST_URI'] = $_SERVER['REQUEST_URI'];
		} else {
			$GLOBALS['REQUEST_URI'] = (php_sapi_name() !== 'cli') ? $_SERVER['PHP_SELF'] : '';
			if (
				!empty($_SERVER['QUERY_STRING'])
				&& !str_contains($_SERVER['REQUEST_URI'], '?')
			) {
				$GLOBALS['REQUEST_URI'] .= '?' . $_SERVER['QUERY_STRING'];
			}
		}
	}

	// Et nettoyer l'url
	$GLOBALS['REQUEST_URI'] = (filter_var($GLOBALS['REQUEST_URI'], FILTER_SANITIZE_URL) ?: '');

	$url[$profondeur] = url_de_($http, $host, $GLOBALS['REQUEST_URI'], $profondeur);

	return $url[$profondeur];
}

/**
 * fonction testable de construction d'une url appelee par url_de_base()
 *
 * @param string $http
 * @param string $host
 * @param string $request
 * @param int $prof
 * @return string
 */
function url_de_($http, $host, $request, $prof = 0) {
	$prof = max($prof, 0);

	$myself = ltrim($request, '/');
	# supprimer la chaine de GET
	[$myself] = explode('?', $myself);
	// vieux mode HTTP qui envoie après le nom de la methode l'URL compléte
	// protocole, "://", nom du serveur avant le path dans _SERVER["REQUEST_URI"]
	if (str_contains($myself, '://')) {
		$myself = explode('://', $myself);
		array_shift($myself);
		$myself = implode('://', $myself);
		$myself = explode('/', $myself);
		array_shift($myself);
		$myself = implode('/', $myself);
	}
	$url = join('/', array_slice(explode('/', $myself), 0, -1 - $prof)) . '/';

	$url = $http . '://' . rtrim($host, '/') . '/' . ltrim($url, '/');

	return $url;
}


// Pour une redirection, la liste des arguments doit etre separee par "&"
// Pour du code XHTML, ca doit etre &amp;
// Bravo au W3C qui n'a pas ete capable de nous eviter ca
// faute de separer proprement langage et meta-langage

// Attention, X?y=z et "X/?y=z" sont completement differents!
// http://httpd.apache.org/docs/2.0/mod/mod_dir.html

/**
 * Crée une URL vers un script de l'espace privé
 *
 * @example
 *     ```
 *     generer_url_ecrire('admin_plugin')
 *     ```
 *
 * @param string $script
 *     Nom de la page privée (xx dans exec=xx)
 * @param string $args
 *     Arguments à transmettre, tel que `arg1=yy&arg2=zz`
 * @param bool $no_entities
 *     Si false : transforme les `&` en `&amp;`
 * @param bool|string $rel
 *     URL relative ?
 *
 *     - false : l’URL sera complète et contiendra l’URL du site
 *     - true : l’URL sera relavive.
 *     - string : on transmet l'url à la fonction
 * @return string URL
 */
function generer_url_ecrire(?string $script = '', $args = '', $no_entities = false, $rel = false) {
	$script ??= '';
	if (!$rel) {
		$rel = url_de_base() . _DIR_RESTREINT_ABS . _SPIP_ECRIRE_SCRIPT;
	} else {
		if (!is_string($rel)) {
			$rel = _DIR_RESTREINT ?: './' . _SPIP_ECRIRE_SCRIPT;
		}
	}

	[$script, $ancre] = array_pad(explode('#', $script), 2, null);
	if ($script && ($script <> 'accueil' || $rel)) {
		$args = "?exec=$script" . (!$args ? '' : "&$args");
	} elseif ($args) {
		$args = "?$args";
	}
	if ($ancre) {
		$args .= "#$ancre";
	}

	return $rel . ($no_entities ? $args : str_replace('&', '&amp;', $args));
}

//
// Adresse des scripts publics (a passer dans inc-urls...)
//


/**
 * Retourne le nom du fichier d'exécution de SPIP
 *
 * @see _SPIP_SCRIPT
 * @note
 *   Detecter le fichier de base, a la racine, comme etant spip.php ou ''
 *   dans le cas de '', un $default = './' peut servir (comme dans urls/page.php)
 *
 * @param string $default
 *     Script par défaut
 * @return string
 *     Nom du fichier (constante _SPIP_SCRIPT), sinon nom par défaut
 */
function get_spip_script($default = '') {
	if (!defined('_SPIP_SCRIPT')) {
		return 'spip.php';
	}
	# cas define('_SPIP_SCRIPT', '');
	if (_SPIP_SCRIPT) {
		return _SPIP_SCRIPT;
	} else {
		return $default;
	}
}

/**
 * Crée une URL vers une page publique de SPIP
 *
 * @example
 *     ```
 *     generer_url_public("rubrique","id_rubrique=$id_rubrique")
 *     ```
 *
 * @param string $script
 *     Nom de la page
 * @param string|array $args
 *     Arguments à transmettre a l'URL,
 *      soit sous la forme d'un string tel que `arg1=yy&arg2=zz`
 *      soit sous la forme d'un array tel que array( `arg1` => `yy`, `arg2` => `zz` )
 * @param bool $no_entities
 *     Si false : transforme les `&` en `&amp;`
 * @param bool $rel
 *     URL relative ?
 *
 *     - false : l’URL sera complète et contiendra l’URL du site
 *     - true : l’URL sera relavive.
 * @param string $action
 *     - Fichier d'exécution public (spip.php par défaut)
 * @return string URL
 */
function generer_url_public($script = '', $args = '', $no_entities = false, $rel = true, $action = '') {
	// si le script est une action (spip_pass, spip_inscription),
	// standardiser vers la nouvelle API

	if (is_array($args)) {
		$args = http_build_query($args);
	}

	$url = '';
	if ($f = charger_fonction_url('page')) {
		$url = $f($script, $args);
		if ($url && !$rel) {
			include_spip('inc/filtres_mini');
			$url = url_absolue($url);
		}
	}
	if (!$url) {
		if (!$action) {
			$action = get_spip_script();
		}
		if ($script) {
			$action = parametre_url($action, _SPIP_PAGE, $script, '&');
		}
		if ($args) {
			$action .= (str_contains($action, '?') ? '&' : '?') . $args;
		}
		// ne pas generer une url avec /./?page= en cas d'url absolue et de _SPIP_SCRIPT vide
		$url = ($rel ? _DIR_RACINE . $action : rtrim(url_de_base(), '/') . preg_replace(',^/[.]/,', '/', "/$action"));
	}

	if (!$no_entities) {
		$url = quote_amp($url);
	}

	return $url;
}

function generer_url_prive($script, $args = '', $no_entities = false) {

	return generer_url_public($script, $args, $no_entities, false, _DIR_RESTREINT_ABS . 'prive.php');
}


/**
 * Créer une URL
 *
 * @param  string $script
 *     Nom du script à exécuter
 * @param  string $args
 *     Arguments à transmettre a l'URL sous la forme `arg1=yy&arg2=zz`
 * @param bool $no_entities
 *     Si false : transforme les & en &amp;
 * @param boolean $public
 *     URL relative ? false : l’URL sera complète et contiendra l’URL du site.
 *     true : l’URL sera relative.
 * @return string
 *     URL
 */
function generer_url_action($script, $args = '', $no_entities = false, $public = false) {
	// si l'on est dans l'espace prive, on garde dans l'url
	// l'exec a l'origine de l'action, qui permet de savoir si il est necessaire
	// ou non de proceder a l'authentification (cas typique de l'install par exemple)
	$url = (_DIR_RACINE && !$public)
		? generer_url_ecrire(_request('exec'))
		: generer_url_public('', '', false, false);
	$url = parametre_url($url, 'action', $script);
	if ($args) {
		$url .= quote_amp('&' . $args);
	}

	if ($no_entities) {
		$url = str_replace('&amp;', '&', $url);
	}

	return $url;
}


/**
 * Créer une URL
 *
 * @param  string $script
 *     Nom du script à exécuter
 * @param  string $args
 *     Arguments à transmettre a l'URL sous la forme `arg1=yy&arg2=zz`
 * @param bool $no_entities
 *     Si false : transforme les & en &amp;
 * @param boolean $public
 *     URL public ou relative a l'espace ou l'on est ?
 * @return string
 *     URL
 */
function generer_url_api(string $script, string $path, string $args, bool $no_entities = false, ?bool $public = null) {
	if (is_null($public)) {
		$public = (_DIR_RACINE ? false : true);
	}
	if (!str_ends_with($script, '.api')) {
		$script .= '.api';
	}
	$url =
		(($public ? _DIR_RACINE : _DIR_RESTREINT) ?: './')
	. $script . '/'
	. ($path ? trim($path, '/') : '')
	. ($args ? '?' . quote_amp($args) : '');

	if ($no_entities) {
		$url = str_replace('&amp;', '&', $url);
	}

	return $url;
}
