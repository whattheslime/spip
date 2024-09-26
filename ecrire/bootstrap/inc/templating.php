<?php

/**
 * Génère une erreur de squelette
 *
 * Génère une erreur de squelette qui sera bien visible par un
 * administrateur authentifié lors d'une visite de la page en erreur
 *
 * @param bool|string|array $message
 *     - Message d'erreur (string|array)
 *     - false pour retourner le texte des messages d'erreurs
 *     - vide pour afficher les messages d'erreurs
 * @param string|array|object $lieu
 *     Lieu d'origine de l'erreur
 * @return null|string
 *     - Rien dans la plupart des cas
 *     - string si $message à false.
 */
function erreur_squelette($message = '', $lieu = '') {
	$debusquer = charger_fonction('debusquer', 'public');
	if (is_array($lieu)) {
		include_spip('public/compiler');
		$lieu = reconstruire_contexte_compil($lieu);
	}

	return $debusquer($message, $lieu);
}

/**
 * Calcule un squelette avec un contexte et retourne son contenu
 *
 * La fonction de base de SPIP : un squelette + un contexte => une page.
 * $fond peut etre un nom de squelette, ou une liste de squelette au format array.
 * Dans ce dernier cas, les squelettes sont tous evalues et mis bout a bout
 * $options permet de selectionner les options suivantes :
 *
 * - trim => true (valeur par defaut) permet de ne rien renvoyer si le fond ne produit que des espaces ;
 * - raw  => true permet de recuperer la strucure $page complete avec entetes et invalideurs
 *          pour chaque $fond fourni.
 *
 * @api
 * @param string /array $fond
 *     - Le ou les squelettes à utiliser, sans l'extension, {@example prive/liste/auteurs}
 *     - Le fichier sera retrouvé dans la liste des chemins connus de SPIP (squelettes, plugins, spip)
 * @param array $contexte
 *     - Informations de contexte envoyées au squelette, {@example array('id_rubrique' => 8)}
 *     - La langue est transmise automatiquement (sauf option étoile).
 * @param array $options
 *     Options complémentaires :
 *
 *     - trim   : applique un trim sur le résultat (true par défaut)
 *     - raw    : retourne un tableau d'information sur le squelette (false par défaut)
 *     - etoile : ne pas transmettre la langue au contexte automatiquement (false par défaut),
 *                équivalent de INCLURE*
 *     - ajax   : gere les liens internes du squelette en ajax (équivalent du paramètre {ajax})
 * @param string $connect
 *     Non du connecteur de bdd a utiliser
 * @return string|array
 *     - Contenu du squelette calculé
 *     - ou tableau d'information sur le squelette.
 */
function recuperer_fond($fond, $contexte = [], $options = [], string $connect = '') {
	if (!function_exists('evaluer_fond')) {
		include_spip('public/assembler');
	}
	// assurer la compat avec l'ancienne syntaxe
	// (trim etait le 3eme argument, par defaut a true)
	if (!is_array($options)) {
		$options = ['trim' => $options];
	}
	if (!isset($options['trim'])) {
		$options['trim'] = true;
	}

	if (isset($contexte['connect'])) {
		$connect = $contexte['connect'];
		unset($contexte['connect']);
	}

	$texte = '';
	$pages = [];
	$lang_select = '';
	if (!isset($options['etoile']) || !$options['etoile']) {
		// Si on a inclus sans fixer le critere de lang, on prend la langue courante
		if (!isset($contexte['lang'])) {
			$contexte['lang'] = $GLOBALS['spip_lang'];
		}

		if ($contexte['lang'] != $GLOBALS['meta']['langue_site']) {
			$lang_select = lang_select($contexte['lang']);
		}
	}

	if (!isset($GLOBALS['_INC_PUBLIC'])) {
		$GLOBALS['_INC_PUBLIC'] = 0;
	}

	$GLOBALS['_INC_PUBLIC']++;

	// fix #4235
	$cache_utilise_session_appelant = ($GLOBALS['cache_utilise_session'] ?? null);

	foreach (is_array($fond) ? $fond : [$fond] as $f) {
		unset($GLOBALS['cache_utilise_session']);	// fix #4235

		$page = evaluer_fond($f, $contexte, $connect);
		if ($page === '') {
			$c = $options['compil'] ?? '';
			$a = ['fichier' => $f];
			$erreur = _T('info_erreur_squelette2', $a); // squelette introuvable
			erreur_squelette($erreur, $c);
			// eviter des erreurs strictes ensuite sur $page['cle'] en PHP >= 5.4
			$page = ['texte' => '', 'erreur' => $erreur];
		}

		$page = pipeline('recuperer_fond', [
			'args' => ['fond' => $f, 'contexte' => $contexte, 'options' => $options, 'connect' => $connect],
			'data' => $page,
		]);
		if (isset($options['ajax']) && $options['ajax']) {
			if (!function_exists('encoder_contexte_ajax')) {
				include_spip('inc/filtres');
			}
			$page['texte'] = encoder_contexte_ajax(
				array_merge($contexte, ['fond' => $f], ($connect ? ['connect' => $connect] : [])),
				'',
				$page['texte'],
				$options['ajax']
			);
		}

		if (isset($options['raw']) && $options['raw']) {
			$pages[] = $page;
		} else {
			$texte .= $options['trim'] ? rtrim($page['texte'] ?? '') : $page['texte'];
		}

		// contamination de la session appelante, pour les inclusions statiques
		if (isset($page['invalideurs']['session'])) {
			$cache_utilise_session_appelant = $page['invalideurs']['session'];
		}
	}

	// restaurer le sessionnement du contexte appelant,
	// éventuellement contaminé si on vient de récupérer une inclusion statique sessionnée
	if (isset($cache_utilise_session_appelant)) {
		$GLOBALS['cache_utilise_session'] = $cache_utilise_session_appelant;
	}

	$GLOBALS['_INC_PUBLIC']--;

	if ($lang_select) {
		lang_select();
	}
	if (isset($options['raw']) && $options['raw']) {
		return is_array($fond) ? $pages : reset($pages);
	}
	return $options['trim'] ? ltrim($texte) : $texte;

}
