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
 * Fonctions pour l'affichage privé des pages exec PHP
 *
 * @package SPIP\Core\Presentation
 */
if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

include_spip('inc/presentation_mini');
include_spip('inc/layer');
include_spip('inc/texte');
include_spip('inc/filtres');
include_spip('inc/boutons');
include_spip('inc/actions');
include_spip('inc/puce_statut');
include_spip('inc/filtres_ecrire');
include_spip('inc/filtres_boites');
include_spip('inc/filtres_alertes');

/**
 * Affiche le titre d’une page de l’interface privée. Utilisée par la plupart des fichiers `exec/xx.php`.
 *
 * @param string $titre Le titre en question
 * @param string $ze_logo Une image de logo
 * @return string Code PHP.
 */
function gros_titre($titre, $ze_logo = '') {
	return "<h1 class = 'grostitre'>" . $ze_logo . ' ' . typo($titre) . "</h1>\n";
}

//
// Fonctions d'affichage
//

// Fonctions onglets
// @param string $sous_classe	prend la valeur second pour definir les onglet de deuxieme niveau
function debut_onglet($classe = 'barre_onglet') {
	return "<div class = '$classe clearfix'><ul>\n";
}

function fin_onglet() {
	return "</ul></div>\n";
}

function onglet($texte, $lien, $onglet_ref, $onglet, $icone = '') {
	return '<li>'
	. ($icone ? http_img_pack($icone, '', " class='cadre-icone'") : '')
	. lien_ou_expose($lien, $texte, $onglet == $onglet_ref)
	. '</li>';
}

/**
 * Crée un lien précédé d'une icone au dessus du texte
 *
 * @uses icone_base()
 * @see  filtre_icone_verticale_dist() Pour l'usage en tant que filtre
 *
 * @example
 *     ```
 *     $icone = icone_verticale(_T('sites:info_sites_referencer'),
 *         generer_url_ecrire('site_edit', "id_rubrique=$id_rubrique"),
 *         "site-24.png", "new", 'right')
 *     ```
 *
 * @param string $texte
 *     texte du lien
 * @param string $lien
 *     URL du lien
 * @param string $fond
 *     Objet avec ou sans son extension et sa taille (article, article-24, article-24.png)
 * @param string $fonction
 *     Fonction du lien (`edit`, `new`, `del`)
 * @param string $align
 *     Classe CSS, tel que `left`, `right` pour définir un alignement
 * @param string $javascript
 *     Javascript ajouté sur le lien
 * @return string
 *     Code HTML du lien
 */
function icone_verticale($texte, $lien, $fond, $fonction = '', $align = '', $javascript = '') {
	// cas d'ajax_action_auteur: faut defaire le boulot
	// (il faudrait fusionner avec le cas $javascript)
	if (preg_match(",^<a\shref='([^']*)'([^>]*)>(.*)</a>$,i", $lien, $r)) {
		[$x, $lien, $atts, $texte] = $r;
		$javascript .= $atts;
	}

	return icone_base($lien, $texte, $fond, $fonction, "verticale $align", $javascript);
}

/**
 * Crée un lien précédé d'une icone horizontale
 *
 * @uses icone_base()
 * @see  filtre_icone_horizontale_dist() Pour l'usage en tant que filtre
 *
 * @param string $texte
 *     texte du lien
 * @param string $lien
 *     URL du lien
 * @param string $fond
 *     Objet avec ou sans son extension et sa taille (article, article-24, article-24.png)
 * @param string $fonction
 *     Fonction du lien (`edit`, `new`, `del`)
 * @param string $dummy
 *     Inutilisé
 * @param string $javascript
 *     Javascript ajouté sur le lien
 * @return string
 *     Code HTML du lien
 */
function icone_horizontale($texte, $lien, $fond, $fonction = '', $dummy = '', $javascript = '') {
	$retour = '';
	// cas d'ajax_action_auteur: faut defaire le boulot
	// (il faudrait fusionner avec le cas $javascript)
	if (preg_match(",^<a\shref='([^']*)'([^>]*)>(.*)</a>$,i", $lien, $r)) {
		[$x, $lien, $atts, $texte] = $r;
		$javascript .= $atts;
	}

	$retour = icone_base($lien, $texte, $fond, $fonction, 'horizontale', $javascript);

	return $retour;
}
