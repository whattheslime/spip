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
 * Outils pour lecture/manipulation simple de SVG
 *
 * @package SPIP\Core\SVG
 **/

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

if (!defined('IMG_SVG')) {
	// complete 	IMG_BMP | IMG_GIF | IMG_JPG | IMG_PNG | IMG_WBMP | IMG_XPM | IMG_WEBP
	define('IMG_SVG',128);
	define('IMAGETYPE_SVG', 19);
}

function svg_lire_attributs($fichier) {

	if (!file_exists($fichier)) {
		$fichier  = supprimer_timestamp($fichier);
	}
	if (!file_exists($fichier)) {
		return false;
	}

	$debut_fichier = file_get_contents($fichier,false,null,0, 4096);

	if (($ps = stripos($debut_fichier, "<svg")) !== false) {

		$pe = stripos($debut_fichier, ">", $ps);
		$balise_svg = substr($debut_fichier, $ps, $pe - $ps +1);

		if (preg_match_all(",([\w\-]+)=,Uims", $balise_svg, $matches)) {
			if (!function_exists('extraire_attribut')) {
				include_spip('inc/filtres');
			}
			$attributs = [];
			foreach ($matches[1] as $att) {
				$attributs[$att] = extraire_attribut($balise_svg, $att);
			}

			return $attributs;
		}
	}

	return false;
}
