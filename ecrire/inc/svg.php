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

/**
 * Charger une image SVG a partir d'une source qui peut etre
 * - l'image svg deja chargee
 * - une data-url
 * - un nom de fichier
 *
 * @param string $fichier
 * @param null|int $maxlen
 *   pour limiter la taille chargee en memoire si on lit depuis le disque et qu'on a besoin que du debut du fichier
 * @return bool|string
 *   false si on a pas pu charger l'image
 */
function svg_charger($fichier, $maxlen=null) {
	if (strpos($fichier, "data:image/svg+xml") === 0) {
		$image = explode(";", $fichier, 2);
		$image = end($image);
		if (strpos($image, "base64,") === 0) {
			$image = base64_decode(substr($image, 7));
		}
		if (strpos($image, "<svg") !== false) {
			return $image;
		}
		var_dump('fail1');
		// encodage inconnu ou autre format d'image ?
		return false;
	}
	// c'est peut etre deja une image svg ?
	if (strpos($fichier, "<svg") !== false) {
		return $fichier;
	}
	if (!file_exists($fichier)) {
		$fichier  = supprimer_timestamp($fichier);
		if (!file_exists($fichier)) {
			var_dump('fail2');
			return false;
		}
	}
	if (is_null($maxlen)) {
		$image = file_get_contents($fichier);
	}
	else {
		$image = file_get_contents($fichier, false,null,0, $maxlen);
	}
	// est-ce bien une image svg ?
	if (strpos($image, "<svg") !== false) {
		return $image;
	}
	return false;
}

/**
 * Lire la balise <svg...> qui demarre le fichier et la parser pour renvoyer un tableau de ses attributs
 * @param string $fichier
 * @return array|bool
 */
function svg_lire_balise_svg($fichier) {
	if (!$debut_fichier = svg_charger($fichier, 4096)) {
		return false;
	}

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

			return [$balise_svg, $attributs];
		}
	}

	return false;
}

/**
 * Attributs de la balise SVG
 * @param string $img
 * @return array|bool
 */
function svg_lire_attributs($img) {

	if ($svg_infos = svg_lire_balise_svg($img)) {
		list($balise_svg, $attributs) = $svg_infos;
		return $attributs;
	}

	return false;
}

/**
 * Convertir l'attribut widht/height d'un SVG en pixels
 * (approximatif eventuellement, du moment qu'on respecte le ratio)
 * @param $dimension
 * @return bool|float|int
 */
function svg_dimension_to_pixels($dimension) {
	if (preg_match(',(\d+)([^\d]*),i', trim($dimension), $m)){
		switch (strtolower($m[2])) {
			case '%':
				// on ne sait pas faire :(
				return false;
				break;
			case 'em':
				return intval($m[1])*16; // 16px font-size par defaut
				break;
			case 'ex':
				return intval($m[1])*16; // 16px font-size par defaut
				break;
			case 'pc':
				return intval($m[1])*16; // 1/6 inch = 96px/6 in CSS
				break;
			case 'cm':
				return intval(round($m[1]*96/2.54)); // 96px / 2.54cm;
				break;
			case 'mm':
				return intval(round($m[1]*96/25.4)); // 96px / 25.4mm;
				break;
			case 'in':
				return intval($m[1])*96; // 1 inch = 96px in CSS
				break;
			case 'px':
			case 'pt':
			default:
				return intval($m[1]);
				break;
		}
	}
	return false;
}


/**
 * Redimensionner le SVG via le width/height de la balise
 * @param string $img
 * @param $new_width
 * @param $new_height
 * @return bool|string
 */
function svg_redimensionner($img, $new_width, $new_height) {
	if ($svg = svg_charger($img)
	  and $svg_infos = svg_lire_balise_svg($svg)) {

		list($balise_svg, $attributs) = $svg_infos;
		if (!isset($attributs['viewBox'])) {
			$attributs['viewBox'] = "0 0 " . $attributs['width'] . " " . $attributs['height'];
		}
		$attributs['width'] = strval($new_width);
		$attributs['height'] = strval($new_height);

		$new_balise_svg = "<svg";
		foreach ($attributs as $k=>$v) {
			$new_balise_svg .= " $k=\"".entites_html($v)."\"";
		}
		$new_balise_svg .= ">";

		$p = strpos($svg, $balise_svg);
		$svg = substr_replace($svg, $new_balise_svg, $p, strlen($balise_svg));
		return $svg;
	}

	return $img;
}