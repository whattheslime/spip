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
	if (preg_match(',^(-?\d+)([^\d]*),i', trim($dimension), $m)){
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
 * Modifier la balise SVG en entete du source
 * @param string $svg
 * @param string $old_balise_svg
 * @param array $attributs
 * @return string
 */
function svg_change_balise_svg($svg, $old_balise_svg, $attributs) {
	$new_balise_svg = "<svg";
	foreach ($attributs as $k=>$v) {
		$new_balise_svg .= " $k=\"".entites_html($v)."\"";
	}
	$new_balise_svg .= ">";

	$p = strpos($svg, $old_balise_svg);
	$svg = substr_replace($svg, $new_balise_svg, $p, strlen($old_balise_svg));
	return $svg;
}

/**
 * @param string $svg
 * @param string $shapes
 * @param bool $start
 *   inserer au debut (true) ou a la fin (false)
 * @return string
 */
function svg_insert_shapes($svg, $shapes, $start=true) {

	if (!$start) {
		$svg = str_replace("</svg>", $shapes . "</svg>", $svg);
	}
	else {
		$p = stripos($svg, "<svg");
		$p = strpos($svg, ">", $p);
		$svg = substr_replace($svg, $shapes, $p+1, 0);
	}
	return $svg;
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

		$svg = svg_change_balise_svg($svg, $balise_svg, $attributs);
		return $svg;
	}

	return $img;
}


function svg_couleur_to_hexa($couleur) {
	if (preg_match("/rgb\(\s*(\d+)\s*,\s*(\d+)\s*,\s*(\d+)\s*\)/,", $couleur, $m)) {
		$couleur = _couleur_dec_to_hex($m[1], $m[2], $m[3]);
	}
	else {
		$couleur = couleur_html_to_hex($couleur);
	}
	$couleur = '#'.ltrim($couleur,'#');
	return $couleur;
}

function svg_force_viewBox_px($img) {
	if ($svg = svg_charger($img)
	  and $svg_infos = svg_lire_balise_svg($svg)){

		list($balise_svg, $attributs) = $svg_infos;

		// il nous faut une viewBox
		if (!isset($attributs['viewBox'])) {
			$viewBox = "0 0 " . $attributs['width'] . " " . $attributs['height'];
		}
		else {
			$viewBox = $attributs['viewBox'];
		}
		// et on la convertit en px
		$viewBox = explode(' ', $viewBox);
		$viewBox = array_map('svg_dimension_to_pixels', $viewBox);
		$viewBox = array_map('intval', $viewBox);
		if (!$viewBox[2]) {
			$viewBox[2] = '300';
		}
		if (!$viewBox[3]) {
			$viewBox[3] = '150';
		}

		$attributs['viewBox'] = implode(' ', $viewBox);

		$svg = svg_change_balise_svg($svg, $balise_svg, $attributs);
		return $svg;
	}
	return $img;
}

/**
 * Extract all colors in SVG
 * @param $img
 * @return array|mixed
 */
function svg_extract_couleurs($img) {
	if ($svg = svg_charger($img)) {
		if (preg_match_all("/(#[0-9a-f][0-9a-f][0-9a-f][0-9a-f][0-9a-f][0-9a-f])|(rgb\([\s\d]+,[\s\d]+,[\s\d]+\))|(#[0-9a-f][0-9a-f][0-9a-f])/imS", $svg, $matches)) {
			return $matches[0];
		}
	}
	return [];
}

/**
 * Redimensionner le SVG via le width/height de la balise
 * @param string $img
 * @param $new_width
 * @param $new_height
 * @return bool|string
 */
function svg_recadrer($img, $new_width, $new_height, $offset_width, $offset_height, $background_color='') {
	if ($svg = svg_charger($img)
	  and $svg_infos = svg_lire_balise_svg($svg)) {

		list($balise_svg, $attributs) = $svg_infos;

		// il nous faut une viewBox
		if (!isset($attributs['viewBox'])) {
			$viewBox = "0 0 " . $attributs['width'] . " " . $attributs['height'];
		}
		else {
			$viewBox = $attributs['viewBox'];
		}
		// et on la convertit en px
		$viewBox = explode(' ', $viewBox);
		$viewBox = array_map('svg_dimension_to_pixels', $viewBox);
		$viewBox = array_map('intval', $viewBox);
		if (!$viewBox[2]) {
			$viewBox[2] = '300';
		}
		if (!$viewBox[3]) {
			$viewBox[3] = '150';
		}

		$viewport_w = $new_width;
		$viewport_h = $new_height;
		$viewport_ox = $offset_width;
		$viewport_oy = $offset_height;

		// si on a un width/height qui rescale, il faut rescaler
		if (isset ($attributs['width'])
		  and $w = svg_dimension_to_pixels($attributs['width'])
		  and isset ($attributs['height'])
		  and $h = svg_dimension_to_pixels($attributs['height'])) {

			$xscale = $viewBox[2] / $w;
			$viewport_w = intval(round($viewport_w * $xscale));
			$viewport_ox = intval(round($viewport_ox * $xscale));
			$yscale = $viewBox[3] / $h;
			$viewport_h = intval(round($viewport_h * $yscale));
			$viewport_oy = intval(round($viewport_oy * $yscale));
		}

		// maintenant on redefinit la viewBox
		$viewBox[0] += $viewport_ox;
		$viewBox[1] += $viewport_oy;
		$viewBox[2] = $viewport_w;
		$viewBox[3] = $viewport_h;

		$attributs['viewBox'] = implode(' ', $viewBox);
		$attributs['width'] = strval($new_width);
		$attributs['height'] = strval($new_height);

		$svg = svg_change_balise_svg($svg, $balise_svg, $attributs);

		// ajouter un background
		if ($background_color and $background_color!=='transparent') {
			$svg = svg_ajouter_background($svg, $background_color);
		}

		return $svg;
	}

	return $img;
}

/**
 * Ajouter un background au SVG : un rect pleine taille avec la bonne couleur
 * @param $img
 * @param $background_color
 * @return bool|string
 */
function svg_ajouter_background($img, $background_color) {
	if ($svg = svg_charger($img)
	  and $svg_infos = svg_lire_balise_svg($svg)){

		if ($background_color and $background_color!=='transparent') {
			list($balise_svg, $attributs) = $svg_infos;

			$background_color = svg_couleur_to_hexa($background_color);
			if (isset($attributs['viewBox'])) {
				$viewBox = explode(' ', $attributs['viewBox']);
				$rect = "<rect x=\"".$viewBox[0]."\" y=\"".$viewBox[1]."\" width=\"".$viewBox[2]."\" height=\"".$viewBox[3]."\" fill=\"$background_color\"/>";
			}
			else {
				$rect = "<rect width=\"100%\" height=\"100%\" fill=\"$background_color\"/>";
			}
			$svg = svg_insert_shapes($svg, $rect);
		}
		return $svg;
	}
	return $img;
}


/**
 * Ajouter un voile au SVG : un rect pleine taille avec la bonne couleur/opacite, en premier plan
 * @param $img
 * @param $background_color
 * @return bool|string
 */
function svg_ajouter_voile($img, $background_color, $opacity) {
	if ($svg = svg_charger($img)
	  and $svg_infos = svg_lire_balise_svg($svg)){

		if ($background_color and $background_color!=='transparent') {
			list($balise_svg, $attributs) = $svg_infos;

			$background_color = svg_couleur_to_hexa($background_color);
			if (isset($attributs['viewBox'])) {
				$viewBox = explode(' ', $attributs['viewBox']);
				$rect = "<rect x=\"".$viewBox[0]."\" y=\"".$viewBox[1]."\" width=\"".$viewBox[2]."\" height=\"".$viewBox[3]."\" fill=\"$background_color\" opacity=\"$opacity\"/>";
			}
			else {
				$rect = "<rect width=\"100%\" height=\"100%\" fill=\"$background_color\"/>";
			}
			$svg = svg_insert_shapes($svg, $rect, false);
		}
		return $svg;
	}
	return $img;
}


/**
 * Ajouter un background au SVG : un rect pleine taille avec la bonne couleur
 * @param $img
 * @array $attributs
 * @return bool|string
 */
function svg_transformer($img, $attributs) {
	if ($svg = svg_charger($img)
	  and $svg_infos = svg_lire_balise_svg($svg)){

		if ($attributs) {
			list($balise_svg, ) = $svg_infos;
			$g = "<g";
			foreach ($attributs as $k=>$v) {
				if (strlen($v)) {
					$g .= " $k=\"".attribut_html($v)."\"";
				}
			}
			if (strlen($g) > 2) {
				$g .= ">";
				$svg = svg_insert_shapes($svg, $g);
				$svg = svg_insert_shapes($svg, "</g>", false);
			}
		}
		return $svg;
	}
	return $img;
}


/**
 * Ajouter un background au SVG : un rect pleine taille avec la bonne couleur
 * @param $img
 * @array string $HorV
 * @return bool|string
 */
function svg_flip($img, $HorV) {
	if ($svg = svg_force_viewBox_px($img)
	  and $svg_infos = svg_lire_balise_svg($svg)){

		list($balise_svg, $atts) = $svg_infos;
		$viewBox = explode(' ', $atts['viewBox']);

		if (!in_array($HorV, ['h', 'H'])) {
			$transform = "scale(-1,1)";

			$x = intval($viewBox[0]) + intval($viewBox[2]/2);
			$mx = -$x;
			$transform = "translate($x, 0) $transform translate($mx, 0)";
		}
		else {
			$transform = "scale(1,-1)";

			$y = intval($viewBox[1]) + intval($viewBox[3]/2);
			$my = -$y;
			$transform = "translate(0, $y) $transform translate(0, $my)";
		}
		$svg = svg_transformer($svg, ['transform' => $transform]);
		return $svg;
	}
	return $img;
}

/**
 * Filtrer les couleurs d'un SVG avec une callback
 * (peut etre lent si beaucoup de couleurs)
 * 
 * @param $img
 * @param $callback_filter
 * @return bool|mixed|string
 */
function svg_filtrer_couleurs($img, $callback_filter) {
	if ($svg = svg_force_viewBox_px($img)
	  and $colors = svg_extract_couleurs($svg)) {

		$colors = array_unique($colors);

		$short = [];
		$long = [];
		while (count($colors)) {
			$c = array_shift($colors);
			if (strlen($c) == 4) {
				$short[] = $c;
			}
			else {
				$long[] = $c;
			}
		}

		$colors = array_merge($long, $short);
		$new_colors = [];
		$colors = array_flip($colors);
		foreach ($colors as $c => $k) {
			$colors[$c] = "@@@COLOR$$k$@@@";
		}


		foreach ($colors as $original => $replace) {
			$new = svg_couleur_to_hexa($original);
			$new_colors[$replace] = $callback_filter($new);
		}

		$svg = str_replace(array_keys($colors), array_values($colors), $svg);
		$svg = str_replace(array_keys($new_colors), array_values($new_colors), $svg);

		return $svg;
	}
	return $img;
}