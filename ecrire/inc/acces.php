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
 * Gestion des nombres aléatoires et de certains accès au site
 *
 * @package SPIP\Core\Authentification
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

/**
 * Créer un mot de passe
 *
 * @param int $longueur
 *     Longueur du password créé
 * @param string $sel
 *     Clé pour un salage supplémentaire
 * @return string
 *     Mot de passe
 */
function creer_pass_aleatoire($longueur = 16, $sel = '') {
	$seed = (int) round(((float) microtime() + 1) * time());

	mt_srand($seed);
	$s = '';
	$pass = '';
	for ($i = 0; $i < $longueur; $i++) {
		if (!$s) {
			$s = random_int(0, mt_getrandmax());
			if (!$s) {
				$s = random_int(0, mt_getrandmax());
			}
			$s = substr(md5(uniqid($s) . $sel), 0, 16);
		}
		$r = unpack('Cr', pack('H2', $s . $s));
		$x = $r['r'] & 63;
		if ($x < 10) {
			$x = chr($x + 48);
		} else {
			if ($x < 36) {
				$x = chr($x + 55);
			} else {
				if ($x < 62) {
					$x = chr($x + 61);
				} else {
					$x = $x == 63 ? '/' : '.';
				}
			}
		}
		$pass .= $x;
		$s = substr($s, 2);
	}
	$pass = preg_replace('@[./]@', 'a', $pass);
	$pass = preg_replace('@[I1l]@', 'L', $pass);

	return preg_replace('@[0O]@', 'o', $pass);
}

/**
 * Créer un identifiant aléatoire
 *
 * @return string Identifiant
 */
function creer_uniqid() {
	static $seeded;

	if (!$seeded) {
		$seed = (int) round(((float) microtime() + 1) * time());
		mt_srand($seed);
		$seeded = true;
	}

	$s = random_int(0, mt_getrandmax());
	if (!$s) {
		$s = random_int(0, mt_getrandmax());
	}

	return uniqid((string) $s, true);
}

/**
 * Charge les aléas ehpémères s'il ne sont pas encore dans la globale
 *
 * Si les métas 'alea_ephemere' et 'alea_ephemere_ancien' se sont pas encore chargées
 * en méta (car elles ne sont pas stockées, pour sécurité, dans le fichier cache des métas),
 * alors on les récupère en base. Et on les ajoute à nos métas globales.
 *
 * @see touch_meta()
 * @return string Retourne l'alea éphemère actuel au passage
 */
function charger_aleas() {
	if (!isset($GLOBALS['meta']['alea_ephemere'])) {
		include_spip('base/abstract_sql');
		$aleas = sql_allfetsel(
			['nom', 'valeur'],
			'spip_meta',
			sql_in('nom', ['alea_ephemere', 'alea_ephemere_ancien']),
			'',
			'',
			'',
			'',
			'',
			'continue'
		);
		if ($aleas) {
			foreach ($aleas as $a) {
				$GLOBALS['meta'][$a['nom']] = $a['valeur'];
			}
			return $GLOBALS['meta']['alea_ephemere'];
		}
		spip_logger('session')
			->info('aleas indisponibles');
		return '';

	}
	return $GLOBALS['meta']['alea_ephemere'];
}

/**
 * Renouveller l'alea (utilisé pour sécuriser les scripts du répertoire `action/`)
 */
function renouvelle_alea() {
	charger_aleas();
	ecrire_meta('alea_ephemere_ancien', @$GLOBALS['meta']['alea_ephemere'], 'non');
	$GLOBALS['meta']['alea_ephemere'] = md5(creer_uniqid());
	ecrire_meta('alea_ephemere', $GLOBALS['meta']['alea_ephemere'], 'non');
	ecrire_meta('alea_ephemere_date', time(), 'non');
	spip_logger()
		->info("renouvellement de l'alea_ephemere");
}

/**
 * Retourne une clé de sécurité faible (low_sec) pour l'auteur indiqué
 *
 * low-security est un ensemble de fonctions pour gérer de l'identification
 * faible via les URLs (suivi RSS, iCal...)
 *
 * Retourne la clé de sécurité low_sec de l'auteur (la génère si elle n'exite pas)
 * ou la clé de sécurité low_sec du site (si auteur invalide)(la génère si elle
 * n'existe pas).
 *
 * @param int $id_auteur
 *     Identifiant de l'auteur
 * @return string
 *     Clé de sécurité.
 */
function low_sec($id_auteur) {
	// Pas d'id_auteur : low_sec
	if (!$id_auteur = (int) $id_auteur) {
		include_spip('inc/config');
		if (!$low_sec = lire_config('low_sec')) {
			ecrire_meta('low_sec', $low_sec = creer_pass_aleatoire());
		}
	} else {
		$low_sec = sql_getfetsel('low_sec', 'spip_auteurs', 'id_auteur = ' . (int) $id_auteur);
		if (!$low_sec) {
			$low_sec = creer_pass_aleatoire();
			sql_updateq('spip_auteurs', ['low_sec' => $low_sec], 'id_auteur = ' . (int) $id_auteur);
		}
	}

	return $low_sec;
}

/**
 * Vérifie un accès à faible sécurité
 *
 * Vérifie qu'un visiteur peut accéder à la page demandée,
 * qui est protégée par une clé, calculée à partir du low_sec de l'auteur,
 * et des paramètres le composant l'appel (op, args)
 *
 * @param int $id_auteur
 *     L'auteur qui demande la page
 * @param string $cle
 *     La clé à tester
 * @param string $dir
 *     Un type d'accès (nom du répertoire dans lequel sont rangés les squelettes demandés, tel que 'rss')
 * @param string $op
 *     Nom de l'opération éventuelle
 * @param string $args
 *     Nom de l'argument calculé
 * @return bool
 *     True si on a le droit d'accès, false sinon.
 **@example
 *     `[(#ID_AUTEUR|securiser_acces{#ENV{cle}, rss, #ENV{op}, #ENV{args}}|sinon_interdire_acces)]`
 *
 * @see  generer_url_api_low_sec() pour generer une url api low sec
 * @see  afficher_low_sec() pour calculer une clé valide
 * @uses verifier_low_sec()
 *
 * @filtre
 */
function securiser_acces_low_sec($id_auteur, #[\SensitiveParameter] $cle, $dir, $op = '', $args = '') {
	if ($op) {
		$dir .= " $op $args";
	}

	return verifier_low_sec($id_auteur, $cle, $dir);
}

/**
 * Generer une url xxx.api/$id_auteur/$cle/$format/$fond?$args
 * @return string
 */
function generer_url_api_low_sec(
	string $script,
	string $format,
	string $fond,
	string $path,
	string $args,
	bool $no_entities = false,
	?bool $public = null
) {
	$id_auteur = $GLOBALS['visiteur_session']['id_auteur'] ?? 0;
	$cle = afficher_low_sec($id_auteur, "$script/$format $fond $args");
	$path = "$id_auteur/$cle/$format/$fond" . ($path ? "/$path" : '');

	return generer_url_api($script, $path, $args, $no_entities, $public);
}

/**
 * Retourne une clé basée sur le low_sec de l'auteur et l'action demandé
 *
 * @uses low_sec()
 *
 * @param int $id_auteur
 *     Identifiant de l'auteur
 * @param string $action
 *     Action désirée
 * @return string
 *     Clé
 */
function afficher_low_sec($id_auteur, $action = '') {
	return substr(md5($action . low_sec($id_auteur)), 0, 8);
}

/**
 * Vérifie une clé basée sur le low_sec de l'auteur et l'action demandé
 *
 * @uses afficher_low_sec()
 *
 * @param int $id_auteur
 *     Identifiant de l'auteur
 * @param string $cle
 *     Clé à comparer
 * @param string $action
 *     Action désirée
 * @return bool
 *     true si les clés corresponde, false sinon
 */
function verifier_low_sec($id_auteur, #[\SensitiveParameter] $cle, $action = '') {
	return $cle == afficher_low_sec($id_auteur, $action);
}

/**
 * Efface la clé de sécurité faible (low_sec) d'un auteur
 *
 * @param int $id_auteur
 *     Identifiant de l'auteur
 */
function effacer_low_sec($id_auteur) {
	if (!$id_auteur = (int) $id_auteur) {
		return;
	} // jamais trop prudent ;)
	sql_updateq('spip_auteurs', ['low_sec' => ''], 'id_auteur = ' . (int) $id_auteur);
}

/**
 * Créer un fichier htpasswd
 *
 * Cette fonction ne sert qu'à la connexion en mode http_auth.non LDAP.
 * Voir le plugin «Accès Restreint»
 *
 * S'appuie sur la meta `creer_htpasswd` pour savoir s'il faut créer
 * le `.htpasswd`.
 *
 * @return null|void
 *     - null si pas de htpasswd à créer, ou si LDAP
 *     - void sinon.
 */
function ecrire_acces() {
	$htaccess = _DIR_RESTREINT . _ACCESS_FILE_NAME;
	$htpasswd = _DIR_TMP . _AUTH_USER_FILE;

	// Cette variable de configuration peut etre posee par un plugin
	// par exemple acces_restreint ;
	// si .htaccess existe, outrepasser spip_meta
	if (
		(!isset($GLOBALS['meta']['creer_htpasswd']) || $GLOBALS['meta']['creer_htpasswd'] != 'oui') && !@file_exists(
			$htaccess
		)
	) {
		spip_unlink($htpasswd);
		spip_unlink($htpasswd . '-admin');
		return;
	}

	# remarque : ici on laisse passer les "nouveau" de maniere a leur permettre
	# de devenir redacteur le cas echeant (auth http)... a nettoyer
	// attention, il faut au prealable se connecter a la base (necessaire car utilise par install)
	// TODO: factoriser avec auth/spip qui fait deja ce job et generaliser le test auth_ldap_connect()
	if (include_spip('auth/ldap') && auth_ldap_connect()) {
		return;
	}

	generer_htpasswd_files($htpasswd, "$htpasswd-admin");
}

/**
 * Generer le fichier de htpasswd contenant les htpass
 * @param string $htpasswd
 * @param string $htpasswd_admin
 */
function generer_htpasswd_files($htpasswd, $htpasswd_admin) {
	if ($generer_htpasswd = charger_fonction('generer_htpasswd_files', 'inc', true)) {
		$generer_htpasswd($htpasswd, $htpasswd_admin);
	}

	$pwd_all = ''; // login:htpass pour tous
	$pwd_admin = ''; // login:htpass pour les admins

	$res = sql_select(
		'login, htpass, statut',
		'spip_auteurs',
		"htpass!='' AND login!='' AND " . sql_in('statut', ['1comite', '0minirezo', 'nouveau'])
	);
	while ($row = sql_fetch($res)) {
		if (strlen((string) $row['login']) && strlen((string) $row['htpass'])) {
			$ligne = $row['login'] . ':' . $row['htpass'] . "\n";
			$pwd_all .= $ligne;
			if ($row['statut'] == '0minirezo') {
				$pwd_admin .= $ligne;
			}
		}
	}

	if ($pwd_all) {
		ecrire_fichier($htpasswd, $pwd_all);
		ecrire_fichier($htpasswd_admin, $pwd_admin);
		spip_logger('htpass')
			->info("Ecriture de $htpasswd et $htpasswd_admin");
	}
}

/**
 * Créer un password htaccess
 *
 * @link http://docs.php.net/manual/fr/function.crypt.php Documentation de `crypt()`
 *
 * @param string $pass
 *   Le mot de passe
 * @return void|string
 *  La chaîne hachée si fonction crypt présente, rien sinon.
 */
function generer_htpass(#[\SensitiveParameter] $pass) {
	if ($generer_htpass = charger_fonction('generer_htpass', 'inc', true)) {
		return $generer_htpass($pass);
	}

	return '';
}

/**
 * Installe ou vérifie un fichier .htaccess, y compris sa prise en compte par Apache
 *
 * @uses recuperer_url()
 * @param string $rep
 *     Nom du répertoire où SPIP doit vérifier l'existence d'un fichier .htaccess
 * @param bool $force
 * @return boolean
 */
function verifier_htaccess($rep, $force = false) {
	$htaccess = rtrim($rep, '/') . '/' . _ACCESS_FILE_NAME;
	if ((@file_exists($htaccess) || defined('_TEST_DIRS')) && !$force) {
		return true;
	}

	// directive deny compatible Apache 2.0+
	$deny =
		'# Deny all requests from Apache 2.4+.
<IfModule mod_authz_core.c>
  Require all denied
</IfModule>
# Deny all requests from Apache 2.0-2.2.
<IfModule !mod_authz_core.c>
  Deny from all
</IfModule>
';
	// support des vieilles versions Apache 1.x mais uniquement si elles l'annoncent (pas en mode PROD)
	if (
		function_exists('apache_get_version') && ($v = apache_get_version()) && str_starts_with($v, 'Apache/1.')
	) {
		$deny = "deny from all\n";
	}

	if ($ht = @fopen($htaccess, 'w')) {
		fwrite($ht, $deny);
		fclose($ht);
		@chmod($htaccess, _SPIP_CHMOD & 0666);
		$t = rtrim($rep, '/') . '/.ok';
		if ($ht = @fopen($t, 'w')) {
			@fclose($ht);
			include_spip('inc/distant');
			$t = substr($t, strlen(_DIR_RACINE));
			$t = url_de_base() . $t;
			$ht = recuperer_url($t, ['methode' => 'HEAD', 'taille_max' => 0, 'follow_location' => false]);
			$ht = ($ht['status'] ?? null) === 403;
		}
	}
	spip_logger()
		->info("Creation de $htaccess " . ($ht ? ' reussie' : ' manquee'));

	return $ht;
}

/**
 * Créer un fichier .htaccess pour chaque répertoire d'extension
 * dans `_DIR_IMG` si la configuration le demande
 *
 * @note
 *     La variable de configuration `creer_htaccess` peut être posée
 *     par un plugin tel acces_restreint.
 *
 * @uses _DIR_IMG
 * @uses verifier_htaccess()
 *
 * @return string
 *         Valeur de la configuration `creer_htaccess`
 */
function gerer_htaccess() {
	// Cette variable de configuration peut etre posee par un plugin
	// par exemple acces_restreint
	$f = (isset($GLOBALS['meta']['creer_htaccess']) && $GLOBALS['meta']['creer_htaccess'] === 'oui');
	$dirs = sql_allfetsel('extension', 'spip_types_documents');
	$dirs[] = ['extension' => 'distant'];
	foreach ($dirs as $e) {
		if (is_dir($dir = _DIR_IMG . $e['extension'])) {
			if ($f) {
				verifier_htaccess($dir);
			} else {
				spip_unlink($dir . '/' . _ACCESS_FILE_NAME);
			}
		}
	}

	return $GLOBALS['meta']['creer_htaccess'] ?? '';
}
