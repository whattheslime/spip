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
 * Fonctions d'aide à l'édition d'objets éditoriaux.
 *
 * @package SPIP\Core\Edition
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}
include_spip('base/abstract_sql');

/**
 * Effectue les traitements d'un formulaire d'édition d'objet éditorial
 *
 * Exécute une action d'édition spécifique au type d'objet s'il elle existe
 * (fonction action_editer_$type), sinon exécute l'action générique
 * d'édition d'objet (action_editer_objet_dist())
 *
 * Si une traduction était demandée, crée le lien avec l'objet qui est
 * traduit.
 *
 * @api
 * @see action_editer_objet_dist()
 *
 * @param string $type
 *     Type d'objet
 * @param int|string $id
 *     Identifiant de l'objet à éditer, 'new' pour un nouvel objet
 * @param int $id_parent
 *     Identifiant de l'objet parent
 * @param int $lier_trad
 *     Identifiant de l'objet servant de source à une nouvelle traduction
 * @param string $retour
 *     URL de redirection après les traitements
 * @param string $config_fonc
 *     Nom de fonction appelée au chargement permettant d'ajouter des
 *     valeurs de configurations dans l'environnement du formulaire
 * @param array $row
 *     Ligne SQL de l'objet édité, si connu.
 *     En absence, les données sont chargées depuis l'objet en base s'il existe
 *     ou depuis l'objet source d'une traduction si c'est un nouvel objet
 *     (et une traduction).
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés (input hidden)
 *     du formulaire.
 * @return array
 *     Retour des traitements.
 */
function formulaires_editer_objet_traiter(
	$type,
	$id = 'new',
	$id_parent = 0,
	$lier_trad = 0,
	$retour = '',
	$config_fonc = 'articles_edit_config',
	$row = [],
	$hidden = ''
) {

	$res = [];
	// eviter la redirection forcee par l'action...
	set_request('redirect');
	if ($action_editer = charger_fonction("editer_$type", 'action', true)) {
		[$id, $err] = $action_editer($id);
	} else {
		$action_editer = charger_fonction('editer_objet', 'action');
		[$id, $err] = $action_editer($id, $type);
	}
	$id_table_objet = id_table_objet($type);
	$res[$id_table_objet] = $id;
	if ($err || !$id) {
		$res['message_erreur'] = ($err ?: _T('erreur'));
	} else {
		// Un lien de trad a prendre en compte
		if ($lier_trad) {
			// referencer la traduction
			$referencer_traduction = charger_fonction('referencer_traduction', 'action');
			$referencer_traduction($type, $id, $lier_trad);
			// actions de recopie de champs / liens sur le nouvel objet créé
			$completer_traduction = charger_fonction('completer_traduction', 'inc');
			$err = $completer_traduction($type, $id, $lier_trad);
			if ($err) {
				$res['message_erreur'] = $err;
				return $res;
			}
		}

		$res['message_ok'] = _T('info_modification_enregistree');
		if ($retour) {
			if (str_starts_with($retour, 'javascript:')) {
				$res['message_ok'] .= '<script>' . substr($retour, 11) . '</script>';
				$res['editable'] = true;
			} else {
				$res['redirect'] = parametre_url($retour, $id_table_objet, $id);
			}
		}
	}

	return $res;
}

/**
 * Teste les erreurs de validation d'un formulaire d'édition d'objet éditorial
 *
 * La fonction teste que :
 * - il n'y a pas de conflit d'édition sur un ou plusieurs champs (c'est à
 *   dire que personne d'autre n'a modifié le champ entre le moment où on
 *   a saisi et le moment où on a validé le formulaire
 * - tous les champs obligatoires (listés dans $oblis) sont remplis.
 *
 * @api
 *
 * @param string $type
 *     Type d'objet
 * @param int|string $id
 *     Identifiant de l'objet à éditer, 'new' pour un nouvel objet
 * @param array $oblis
 *     Liste de champs obligatoires : ils doivent avoir un contenu posté.
 * @return array
 *     Tableau des erreurs
 */
function formulaires_editer_objet_verifier($type, $id = 'new', $oblis = []) {
	$erreurs = [];
	if ((int) $id) {
		$conflits = controler_contenu($type, $id);
		if ($conflits && (is_countable($conflits) ? count($conflits) : 0)) {
			foreach ($conflits as $champ => $conflit) {
				if (!isset($erreurs[$champ])) {
					$erreurs[$champ] = '';
				}
				$erreurs[$champ] .= _T('alerte_modif_info_concourante') . "<br><textarea readonly='readonly' class='forml'>" . entites_html(
					$conflit['base']
				) . '</textarea>';
			}
		}
	}
	foreach ($oblis as $obli) {
		$value = _request($obli);
		if ($value === null || !(is_array($value) ? count($value) : strlen((string) $value))) {
			if (!isset($erreurs[$obli])) {
				$erreurs[$obli] = '';
			}
			$erreurs[$obli] .= _T('info_obligatoire');
		}
	}

	return $erreurs;
}

/**
 * Construit les valeurs de chargement d'un formulaire d'édition d'objet éditorial
 *
 * La fonction calcule les valeurs qui seront transmises à l'environnement
 * du formulaire pour son affichage. Ces valeurs sont les champs de l'objet
 * éditorial d'une part, mais aussi d'autres calculant la clé d'action,
 * les pipelines devant faire transiter le contenu HTML du formulaire,
 * ainsi que différents champs cachés utilisés ensuite dans les traitements.
 *
 * Lorsqu'une création d'objet est demandée, ou lorsqu'on demande une traduction
 * d'un autre, la fonction tente de précharger le contenu de l'objet en
 * utilisant une fonction inc_precharger_{type}_dist permettant par exemple
 * de remplir le contenu avec du texte, notamment avec la traduction source.
 *
 * @api
 *
 * @param string $type
 *     Type d'objet
 * @param int|string $id
 *     Identifiant de l'objet à éditer, 'new' pour un nouvel objet
 * @param int|null $id_parent
 *     Identifiant de l'objet parent
 *     Si null, le calcule d'après le résultat de la fonction `precharger_objet()`.
 * @param int $lier_trad
 *     Identifiant de l'objet servant de source à une nouvelle traduction
 * @param string $retour
 *     URL de redirection après les traitements
 * @param string $config_fonc
 *     Nom de fonction appelée au chargement permettant d'ajouter des
 *     valeurs de configurations dans l'environnement du formulaire
 * @param array $row
 *     Ligne SQL de l'objet édité, si connu.
 *     En absence, les données sont chargées depuis l'objet en base s'il existe
 *     ou depuis l'objet source d'une traduction si c'est un nouvel objet
 *     (et une traduction).
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés (input hidden)
 *     du formulaire.
 * @return array
 *     Environnement du formulaire.
 */
function formulaires_editer_objet_charger(
	$type,
	$id = 'new',
	$id_parent = 0,
	$lier_trad = 0,
	$retour = '',
	$config_fonc = 'articles_edit_config',
	$row = [],
	$hidden = ''
) {

	$table_objet = table_objet($type);
	$table_objet_sql = table_objet_sql($type);
	$id_table_objet = id_table_objet($type);
	if (!is_array($row)) {
		$row = [];
	}

	// on accepte pas une fonction de config inconnue si elle vient d'un modele
	if (
		$config_fonc
		&& !in_array($config_fonc, ['articles_edit_config', 'rubriques_edit_config', 'auteurs_edit_config'])
		&& $config_fonc !== $table_objet . '_edit_config'
		&& ($args = test_formulaire_inclus_par_modele())
		&& in_array($config_fonc, $args)
	) {
		$config_fonc = '';
	}

	$new = !is_numeric($id);
	$lang_default = '';
	// Appel direct dans un squelette
	if (!$row) {
		if (!$new || $lier_trad) {
			if ($select = charger_fonction('precharger_' . $type, 'inc', true)) {
				$row = $select($id, $id_parent, $lier_trad);
				// si on a une fonction precharger, elle pu faire un reglage de langue
				$lang_default = (empty($row['lang']) ? null : $row['lang']);
			} else {
				$row = sql_fetsel('*', $table_objet_sql, $id_table_objet . '=' . (int) $id);
			}
			if (!$new) {
				$md5 = controles_md5($row ?: []);
			}
		}
		if (!$row) {
			$row = [];
			$trouver_table = charger_fonction('trouver_table', 'base');
			if ($desc = $trouver_table($table_objet)) {
				foreach ($desc['field'] as $k => $v) {
					$row[$k] = '';
				}
			}
		}
	}

	// Gaffe: sans ceci, on ecrase systematiquement l'article d'origine
	// (et donc: pas de lien de traduction)
	$id = ($new || $lier_trad)
		? 'oui'
		: $row[$id_table_objet];
	$row[$id_table_objet] = $id;

	$contexte = $row;
	if (is_numeric($id_parent) && strlen($id_parent) && (!isset($contexte['id_parent']) || $new)) {
		if (!isset($contexte['id_parent'])) {
			unset($contexte['id_rubrique']);
		}
		$contexte['id_parent'] = $id_parent;
	} elseif (!isset($contexte['id_parent'])) {
		// id_rubrique dans id_parent si possible
		if (isset($contexte['id_rubrique'])) {
			$contexte['id_parent'] = $contexte['id_rubrique'];
			unset($contexte['id_rubrique']);
		} else {
			$contexte['id_parent'] = '';
		}
		if (
			!$contexte['id_parent']
			&& ($preselectionner_parent_nouvel_objet = charger_fonction('preselectionner_parent_nouvel_objet', 'inc', true))
		) {
			$contexte['id_parent'] = $preselectionner_parent_nouvel_objet($type, $row);
		}
	}

	$config = [];
	if ($config_fonc) {
		$contexte['config'] = $config = $config_fonc($contexte);
		if (!$lang_default) {
			include_spip('inc/session');
			$lang_default = $config['langue'] ?? session_get('lang');
		}
	}
	$config += [
		'lignes' => 0,
		'langue' => '',
	];

	$att_text = " class='textarea' "
		. " rows='"
		. ($config['lignes'] + 15)
		. "' cols='40'";

	// on veut conserver la langue de l'interface ;
	// on passe cette donnee sous un autre nom, au cas ou le squelette
	// voudrait l'exploiter
	if (isset($contexte['lang'])) {
		$contexte['langue'] = $contexte['lang'];
		unset($contexte['lang']);
	}

	$contexte['_hidden'] = "<input type='hidden' name='editer_$type' value='oui'>\n" .
		($lier_trad
			 ? "\n<input type='hidden' name='lier_trad' value='" .
				$lier_trad .
				"'>" .
				"\n<input type='hidden' name='changer_lang' value='" .
				$lang_default .
				"'>"
			: '')
		. $hidden
		. ($md5 ?? '');

	// preciser que le formulaire doit passer dans un pipeline
	$contexte['_pipeline'] = ['editer_contenu_objet', ['type' => $type, 'id' => $id]];

	// preciser que le formulaire doit etre securise auteur/action
	// n'est plus utile lorsque l'action accepte l'id en argument direct
	// on le garde pour compat
	$contexte['_action'] = ["editer_$type", $id];

	// et in fine placer l'autorisation
	include_spip('inc/autoriser');
	if ((int) $id) {
		if (!autoriser('modifier', $type, (int) $id)) {
			$contexte['editable'] = '';
		}
	} else {
		if (!autoriser('creer', $type, 0, null, ['id_parent' => $id_parent])) {
			$contexte['editable'] = '';
		}
	}

	return $contexte;
}

/**
 * Gestion des textes trop longs (limitation brouteurs)
 * utile pour les textes > 32ko
 *
 * @param  string $texte
 * @return array
 */
function coupe_trop_long($texte) {
	$aider = charger_fonction('aider', 'inc');
	if (strlen($texte) > 28 * 1024) {
		$texte = str_replace("\r\n", "\n", $texte);
		$pos = strpos($texte, "\n\n", 28 * 1024);  // coupe para > 28 ko
		if ($pos > 0 && $pos < 32 * 1024) {
			$debut = substr($texte, 0, $pos) . "\n\n<!--SPIP-->\n";
			$suite = substr($texte, $pos + 2);
		} else {
			$pos = strpos($texte, ' ', 28 * 1024);  // sinon coupe espace
			if (!($pos > 0 && $pos < 32 * 1024)) {
				$pos = 28 * 1024;  // au pire (pas d'espace trouv'e)
				$decalage = 0; // si y'a pas d'espace, il ne faut pas perdre le caract`ere
			} else {
				$decalage = 1;
			}
			$debut = substr($texte, 0, $pos + $decalage); // Il faut conserver l'espace s'il y en a un
			$suite = substr($texte, $pos + $decalage);
		}

		return [$debut, $suite];
	}
	return [$texte, ''];

}

/**
 * auto-renseigner le titre si il n'existe pas
 *
 * @param string $champ_titre
 * @param array $champs_contenu
 * @param int $longueur
 */
function titre_automatique($champ_titre, $champs_contenu, $longueur = null) {
	if (!_request($champ_titre)) {
		$titrer_contenu = charger_fonction('titrer_contenu', 'inc');
		$t = $longueur === null ? $titrer_contenu($champs_contenu) : $titrer_contenu($champs_contenu, null, $longueur);
		if ($t) {
			set_request($champ_titre, $t);
		}
	}
}

/**
 * Déterminer un titre automatique,
 * à partir des champs textes de contenu
 *
 * Les textes et le titre sont pris dans les champs postés (via `_request()`)
 * et le titre calculé est de même affecté en tant que champ posté.
 *
 * @param array $champs_contenu
 *     Liste des champs contenu textuels
 * @param array|null $c
 *   tableau qui contient les valeurs des champs de contenu
 *   si `null` on utilise les valeurs du POST
 * @param int $longueur
 *     Longueur de coupe du texte
 * @return string
 */
function inc_titrer_contenu_dist($champs_contenu, $c = null, $longueur = 50) {
	// trouver un champ texte non vide
	$t = '';
	foreach ($champs_contenu as $champ) {
		if ($t = _request($champ, $c)) {
			break;
		}
	}

	if ($t) {
		include_spip('inc/texte_mini');
		$t = couper($t, $longueur, '...');
	}

	return $t;
}

/**
 * Calcule des clés de contrôles md5 d'un tableau de données.
 *
 * Produit la liste des md5 d'un tableau de données, normalement un
 * tableau des colonnes/valeurs d'un objet éditorial.
 *
 * @param array $data
 *      Couples (colonne => valeur). La valeur est un entier ou un texte.
 * @param string $prefixe
 *      Préfixe à appliquer sur les noms des clés de contrôles, devant le
 *      nom de la colonne
 * @param string $format
 *      - html : Retourne les contrôles sous forme de input hidden pour un formulaire
 *      - autre : Retourne le tableau ('$prefixe$colonne => md5)
 * @return string|array
 *      - string (avec format html) : contrôles dans des input hidden
 *      - array sinon couples ('$prefixe$colonne => md5)
 */
function controles_md5(array $data, string $prefixe = 'ctr_', string $format = 'html') {
	$ctr = [];
	foreach ($data as $key => $val) {
		$m = md5($val ?? '');
		$k = $prefixe . $key;

		$ctr[$k] = match ($format) {
			'html' => "<input type='hidden' value='$m' name='$k'>",
			default => $m,
		};
	}

	if ($format === 'html') {
		return "\n\n<!-- controles md5 -->\n" . implode("\n", $ctr) . "\n\n";
	}
	return $ctr;

}

/**
 * Contrôle les contenus postés d'un objet en vérifiant qu'il n'y a pas
 * de conflit d'édition
 *
 * Repère les conflits d'édition sur un ou plusieurs champs. C'est à
 * dire lorsqu'une autre personne a modifié le champ entre le moment où on
 * a édité notre formulaire et le moment où on a validé le formulaire
 *
 * @param string $type
 *     Type d'objet
 * @param int $id
 *     Identifiant de l'objet
 * @param array $options
 *     Tableau d'options. Accèpte les index :
 *     - nonvide : Couples (colonne => valeur par défaut). Tous les champs
 *       postés qui sont vides, s'il y en a dans cette option, sont remplacés
 *       par la valeur indiquée
 *     - prefix : Préfixe des clés de contrôles ('ctr_' par défaut). Une clé
 *       de controle tel que 'ctr_titre' contient le md5 du titre au moment
 *       de l'édition.
 * @param array|bool $c
 *     Tableau de couples (colonne=>valeur) à tester.
 *     Non renseigné, la fonction prend toutes les colonne de l'objet via
 *     _request()
 * @param string $serveur
 *     Nom du connecteur de base de données
 * @return bool|null|array
 *     False si aucun champ posté.
 *     Null si aucune modification sur les champs.
 *     Tableau vide si aucun de conflit d'édition.
 *     Tableau (clé => tableau du conflit). L'index est la colonne en conflit,
 *     la valeur un tableau avec 2 index :
 *     - base : le contenu du champ en base
 *     - post : le contenu posté
 */
function controler_contenu($type, $id, $options = [], $c = false, $serveur = '') {
	include_spip('inc/filtres');

	$table_objet = table_objet($type);
	$spip_table_objet = table_objet_sql($type);
	$trouver_table = charger_fonction('trouver_table', 'base');
	$desc = $trouver_table($table_objet, $serveur);

	// Appels incomplets (sans $c)
	if (!is_array($c)) {
		$c = [];
		foreach ($desc['field'] as $champ => $ignore) {
			if (_request($champ)) {
				$c[$champ] = _request($champ);
			}
		}
	}

	// Securite : certaines variables ne sont jamais acceptees ici
	// car elles ne relevent pas de autoriser(article, modifier) ;
	// il faut passer par instituer_XX()
	// TODO: faut-il passer ces variables interdites
	// dans un fichier de description separe ?
	unset($c['statut']);
	unset($c['id_parent']);
	unset($c['id_rubrique']);
	unset($c['id_secteur']);

	// Gerer les champs non vides
	if (isset($options['nonvide']) && is_array($options['nonvide'])) {
		foreach ($options['nonvide'] as $champ => $sinon) {
			if ($c[$champ] === '') {
				$c[$champ] = $sinon;
			}
		}
	}

	// N'accepter que les champs qui existent
	// [TODO] ici aussi on peut valider les contenus en fonction du type
	$champs = [];
	foreach ($desc['field'] as $champ => $ignore) {
		if (isset($c[$champ])) {
			$champs[$champ] = $c[$champ];
		}
	}

	// Nettoyer les valeurs
	$champs = array_map('corriger_caracteres', $champs);

	// Envoyer aux plugins
	$champs = pipeline(
		'pre_edition',
		[
			'args' => [
				'table' => $spip_table_objet, // compatibilite
				'table_objet' => $table_objet,
				'spip_table_objet' => $spip_table_objet,
				'type' => $type, // @deprecated 5.0
				'objet' => $type,
				'id_objet' => $id,
				'champs' => $options['champs'] ?? [], // [doc] c'est quoi ?
				'action' => 'controler',
				'serveur' => $serveur,
			],
			'data' => $champs,
		]
	);

	if (!$champs) {
		return false;
	}

	// Verifier si les mises a jour sont pertinentes, datees, en conflit etc
	$conflits = controler_md5($champs, $_POST, $type, $id, $serveur, $options['prefix'] ?? 'ctr_');

	return $conflits;
}

/**
 * Contrôle la liste des md5 envoyés, supprime les inchangés,
 * signale les modifiés depuis telle date
 *
 * @param array $champs
 *     Couples des champs saisis dans le formulaire (colonne => valeur postée)
 * @param array $ctr
 *     Tableau contenant les clés de contrôles. Couples (clé => md5)
 * @param string $type
 *     Type d'objet
 * @param int $id
 *     Identifiant de l'objet
 * @param string $serveur
 *     Nom du connecteur de base de données
 * @param string $prefix
 *     Préfixe des clés de contrôles : le nom du champ est préfixé de cette valeur
 *     dans le tableau $ctr pour retrouver son md5.
 * @return null|array
 *     Null si aucun champ ou aucune modification sur les champs
 *     Tableau vide si aucune erreur de contrôle.
 *     Tableau (clé => tableau du conflit). L'index est la colonne en conflit,
 *     la valeur un tableau avec 2 index :
 *     - base : le contenu du champ en base
 *     - post : le contenu posté
 */
function controler_md5(&$champs, $ctr, $type, $id, $serveur, $prefix = 'ctr_') {
	$spip_table_objet = table_objet_sql($type);
	$id_table_objet = id_table_objet($type);

	// Controle des MD5 envoyes
	// On elimine les donnees non modifiees par le formulaire (mais
	// potentiellement modifiees entre temps par un autre utilisateur)
	foreach ($champs as $key => $val) {
		if (
			isset($ctr[$prefix . $key])
			&& ($m = $ctr[$prefix . $key])
			&& (is_scalar($val) && $m == md5($val))
		) {
			unset($champs[$key]);
		}
	}
	if (!$champs) {
		return;
	}

	// On veut savoir si notre modif va avoir un impact
	// par rapport aux donnees contenues dans la base
	// (qui peuvent etre differentes de celles ayant servi a calculer le ctr)
	$s = sql_fetsel(array_keys($champs), $spip_table_objet, "$id_table_objet=$id", $serveur);
	$intact = true;
	foreach ($champs as $ch => $val) {
		$intact &= ($s[$ch] == $val);
	}
	if ($intact) {
		return;
	}

	// Detection de conflits :
	// On verifie si notre modif ne provient pas d'un formulaire
	// genere a partir de donnees modifiees dans l'intervalle ; ici
	// on compare a ce qui est dans la base, et on bloque en cas
	// de conflit.
	$ctrh = $ctrq = $conflits = [];
	foreach (array_keys($champs) as $key) {
		if (isset($ctr[$prefix . $key]) && ($m = $ctr[$prefix . $key])) {
			$ctrh[$key] = $m;
			$ctrq[] = $key;
		}
	}
	if ($ctrq) {
		$ctrq = sql_fetsel($ctrq, $spip_table_objet, "$id_table_objet=$id", $serveur);
		foreach ($ctrh as $key => $m) {
			if (
				$m != md5((string) $ctrq[$key])
				&& $champs[$key] !== $ctrq[$key]
			) {
				$conflits[$key] = [
					'base' => $ctrq[$key],
					'post' => $champs[$key],
				];
				unset($champs[$key]); # stocker quand meme les modifs ?
			}
		}
	}

	return $conflits;
}

/**
 * Afficher le contenu d'un champ selon sa longueur
 * soit dans un `textarea`, soit dans un `input`
 *
 * @param string $x
 *         texte à afficher
 * @return string
 */
function display_conflit_champ($x) {
	if (strstr($x, "\n") || strlen($x) > 80) {
		return "<textarea style='width:99%; height:10em;'>" . entites_html($x) . "</textarea>\n";
	}
	return "<input type='text' size='40' style='width:99%' value=\"" . entites_html($x) . "\">\n";

}
