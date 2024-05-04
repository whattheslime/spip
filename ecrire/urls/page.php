<?php

/**
 * SPIP, Système de publication pour l'internet
 *
 * Copyright © avec tendresse depuis 2001
 * Arnaud Martin, Antoine Pitrou, Philippe Rivière, Emmanuel Saint-James
 *
 * Ce programme est un logiciel libre distribué sous licence GNU/GPL.
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

defined('URLS_PAGE_EXEMPLE') || define('URLS_PAGE_EXEMPLE', 'spip.php?article12');

####### modifications possibles dans ecrire/mes_options
# on peut indiquer '.html' pour faire joli
define('_terminaison_urls_page', '');
# ci-dessous, ce qu'on veut ou presque (de preference pas de '/')
# attention toutefois seuls '' et '=' figurent dans les modes de compatibilite
define('_separateur_urls_page', '');
# on peut indiquer '' si on a installe le .htaccess
define('_debut_urls_page', get_spip_script('./') . '?');
#######
/**
 * Generer l'url d'un objet SPIP
 */
function urls_page_generer_url_objet_dist(int $id, string $objet, string $args = '', string $ancre = ''): string {

	if ($generer_url_externe = charger_fonction_url($objet, 'defaut')) {
		$url = $generer_url_externe($id, $args, $ancre);
		// une url === null indique "je ne traite pas cette url, appliquez le calcul standard"
		// une url vide est une url vide, ne rien faire de plus
		if (!is_null($url)) {
			return $url;
		}
	}

	$url = \_debut_urls_page . $objet . \_separateur_urls_page
		. $id . \_terminaison_urls_page;

	if ($args) {
		$args = strpos($url, '?') ? "&$args" : "?$args";
	}

	return _DIR_RACINE . $url . $args . ($ancre ? "#$ancre" : '');
}

/**
 * Decoder une url page
 * retrouve le fond et les parametres d'une URL abregee
 * le contexte deja existant est fourni dans args sous forme de tableau ou query string
 *
 * @param string $url
 * @param string $entite
 * @param array $contexte
 * @return array
 *   [$contexte_decode, $type, $url_redirect, $fond]
 */
function urls_page_decoder_url_dist(string $url, string $entite, array $contexte = []): array {

	// traiter les injections du type domaine.org/spip.php/cestnimportequoi/ou/encore/plus/rubrique23
	if ($GLOBALS['profondeur_url'] > 0 && $entite == 'sommaire') {
		return [[], '404'];
	}

	include_spip('inc/urls');
	$r = nettoyer_url_page($url, $contexte);
	if ($r) {
		array_pop($r); // nettoyer_url_page renvoie un argument de plus inutile ici
		return $r;
	}

	/*
	 * Le bloc qui suit sert a faciliter les transitions depuis
	 * le mode 'urls-propres' vers les modes 'urls-standard' et 'url-html'
	 * Il est inutile de le recopier si vous personnalisez vos URLs
	 * et votre .htaccess
	 */
	// Si on est revenu en mode html, mais c'est une ancienne url_propre
	// on ne redirige pas, on assume le nouveau contexte (si possible)
	$url_propre = $url ?? $_SERVER['REDIRECT_url_propre'] ?? $_ENV['url_propre'] ?? '';
	return urls_transition_retrouver_anciennes_url_propres($url_propre, $entite, $contexte);
	/* Fin du bloc compatibilite url-propres */
}
