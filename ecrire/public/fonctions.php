<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2019                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

/**
 * Des fonctions diverses utilisees lors du calcul d'une page ; ces fonctions
 * bien pratiques n'ont guere de logique organisationnelle ; elles sont
 * appelees par certaines balises ou criteres au moment du calcul des pages. (Peut-on
 * trouver un modele de donnees qui les associe physiquement au fichier
 * definissant leur balise ???)
 *
 * Ce ne sont pas des filtres à part entière, il n'est donc pas logique de les retrouver dans inc/filtres
 *
 * @package SPIP\Core\Compilateur\Composer
 **/

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}


/**
 * Calcul d'une introduction
 *
 * L'introduction est prise dans le descriptif s'il est renseigné,
 * sinon elle est calculée depuis le texte : à ce moment là,
 * l'introduction est prise dans le contenu entre les balises
 * `<intro>` et `</intro>` si présentes, sinon en coupant le
 * texte à la taille indiquée.
 *
 * Cette fonction est utilisée par la balise #INTRODUCTION
 *
 * @param string $descriptif
 *     Descriptif de l'introduction
 * @param string $texte
 *     Texte à utiliser en absence de descriptif
 * @param string $longueur
 *     Longueur de l'introduction
 * @param string $connect
 *     Nom du connecteur à la base de données
 * @param string $suite
 *     points de suite si on coupe (par defaut _INTRODUCTION_SUITE et sinon &nbsp;(...)
 * @return string
 *     Introduction calculée
 **/
function filtre_introduction_dist($descriptif, $texte, $longueur, $connect, $suite = null) {
	// Si un descriptif est envoye, on l'utilise directement
	if (strlen($descriptif)) {
		return appliquer_traitement_champ($descriptif, 'introduction', '', array(), $connect);
	}

	// De preference ce qui est marque <intro>...</intro>
	$intro = '';
	$texte = preg_replace(",(</?)intro>,i", "\\1intro>", $texte); // minuscules
	while ($fin = strpos($texte, "</intro>")) {
		$zone = substr($texte, 0, $fin);
		$texte = substr($texte, $fin + strlen("</intro>"));
		if ($deb = strpos($zone, "<intro>") or substr($zone, 0, 7) == "<intro>") {
			$zone = substr($zone, $deb + 7);
		}
		$intro .= $zone;
	}

	// [12025] On ne *PEUT* pas couper simplement ici car c'est du texte brut,
	// qui inclus raccourcis et modeles
	// un simple <articlexx> peut etre ensuite transforme en 1000 lignes ...
	// par ailleurs le nettoyage des raccourcis ne tient pas compte
	// des surcharges et enrichissement de propre
	// couper doit se faire apres propre
	//$texte = nettoyer_raccourcis_typo($intro ? $intro : $texte, $connect);

	// Cependant pour des questions de perfs on coupe quand meme, en prenant
	// large et en se mefiant des tableaux #1323

	if (strlen($intro)) {
		$texte = $intro;
	} else {
		if (strpos("\n" . $texte, "\n|") === false
			and strlen($texte) > 2.5 * $longueur
		) {
			if (strpos($texte, "<multi") !== false) {
				$texte = extraire_multi($texte);
			}
			$texte = couper($texte, 2 * $longueur);
		}
	}

	// ne pas tenir compte des notes
	if ($notes = charger_fonction('notes', 'inc', true)) {
		$notes('', 'empiler');
	}
	// Supprimer les modèles avant le propre afin d'éviter qu'ils n'ajoutent du texte indésirable
	// dans l'introduction.
	$texte = supprime_img($texte, '');
	$texte = appliquer_traitement_champ($texte, 'introduction', '', array(), $connect);

	if ($notes) {
		$notes('', 'depiler');
	}

	if (is_null($suite) and defined('_INTRODUCTION_SUITE')) {
		$suite = _INTRODUCTION_SUITE;
	}
	$texte = couper($texte, $longueur, $suite);
	// comme on a coupe il faut repasser la typo (on a perdu les insecables)
	$texte = typo($texte, true, $connect, array());

	// et reparagrapher si necessaire (coherence avec le cas descriptif)
	// une introduction a tojours un <p>
	if ($GLOBALS['toujours_paragrapher']) // Fermer les paragraphes
	{
		$texte = paragrapher($texte, $GLOBALS['toujours_paragrapher']);
	}

	return $texte;
}


/**
 * Retourne pour une clé primaire d'objet donnée les identifiants ayant un logo
 *
 * @param string $type
 *     Nom de la clé primaire de l'objet
 * @return string
 *     Liste des identifiants ayant un logo (séparés par une virgule)
 **/
function lister_objets_avec_logos($type) {

	$objet = objet_type($type);
	$ids = sql_allfetsel("L.id_objet", "spip_documents AS D JOIN spip_documents_liens AS L ON L.id_document=D.id_document", "D.mode=".sql_quote('logoon')." AND L.objet=".sql_quote($objet));
	if ($ids) {
		$ids = array_column($ids, 'id_objet');
		return implode(',', $ids);
	}
	else {
		return "0";
	}
}


/**
 * Renvoie l'état courant des notes, le purge et en prépare un nouveau
 *
 * Fonction appelée par la balise `#NOTES`
 *
 * @see  balise_NOTES_dist()
 * @uses inc_notes_dist()
 *
 * @return string
 *     Code HTML des notes
 **/
function calculer_notes() {
	$r = '';
	if ($notes = charger_fonction('notes', 'inc', true)) {
		$r = $notes(array());
		$notes('', 'depiler');
		$notes('', 'empiler');
	}

	return $r;
}
