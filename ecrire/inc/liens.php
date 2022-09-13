<?php

/***************************************************************************\
 *  SPIP, Système de publication pour l'internet                           *
 *                                                                         *
 *  Copyright © avec tendresse depuis 2001                                 *
 *  Arnaud Martin, Antoine Pitrou, Philippe Rivière, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribué sous licence GNU/GPL.     *
 *  Pour plus de détails voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}


// Regexp des raccourcis, aussi utilisee pour la fusion de sauvegarde Spip
// Laisser passer des paires de crochets pour la balise multi
// mais refuser plus d'imbrications ou de mauvaises imbrications
// sinon les crochets ne peuvent plus servir qu'a ce type de raccourci
define('_RACCOURCI_LIEN', '/\[([^][]*?([[][^]>-]*[]][^][]*)*)->(>?)([^]]*)\]/msS');

/**
 * Detecter et collecter les raccourcis lien d'un texte dans un tableau descriptif
 * qui pourra servir a leurs traitements ou echappement selon le besoin
 * @param string $texte
 * @return array
 */
function liens_collecter($texte) {

	$liens = [];
	$pos = 0;

	if (strpos($texte, '->') !== false) {

		$desechappe_crochets = false;
		// si il y a un crochet ouvrant échappé ou un crochet fermant échappé, les substituer pour les ignorer
		if (strpos($texte, '\[') !== false or strpos($texte, '\]') !== false) {
			$texte = str_replace(['\[', '\]'], ["\x1\x5", "\x1\x6"], $texte);
			$desechappe_crochets = true;
		}

		while (strpos($texte, '->', $pos) !== false
		  and preg_match(_RACCOURCI_LIEN, $texte, $match, PREG_OFFSET_CAPTURE, $pos)) {

			$href = end($match);
			$href = $href[0];
			$lien = [
				'lien' => $match[0][0],
				'pos' => $match[0][1],
				'length' => strlen($match[0][0]),
				'texte' => $match[1][0],
				'href' => $href,
			];

			// la mise en lien automatique est passee par la a tort !
			// corrigeons pour eviter d'avoir un <a...> dans un href...
			if (strncmp($href, '<a', 2) == 0) {
				$href = extraire_attribut($href, 'href');
				// remplacons dans la source qui peut etre reinjectee dans les arguments
				// d'un modele
				$lien['lien'] = str_replace($lien['href'], $href, $lien['lien']);
				// et prenons le href comme la vraie url a linker
				$lien['href'] = $href;
			}

			if ($desechappe_crochets and strpos($lien['lien'], "\x1") !== false) {
				$lien['lien'] = str_replace(["\x1\x5", "\x1\x6"], ['[', ']'], $lien['lien']);
				$lien['texte'] = str_replace(["\x1\x5", "\x1\x6"], ['[', ']'], $lien['texte']);
				$lien['href'] = str_replace(["\x1\x5", "\x1\x6"], ['[', ']'], $lien['href']);
			}

			$liens[] = $lien;

			$pos = $lien['pos'] + $lien['length'];
		}

	}

	return $liens;
}

/**
 * Echapper les raccourcis liens pour ne pas les casser via safehtml par exemple
 *
 * @see liens_retablir_raccourcis_echappes()
 * @param string $texte
 * @param bool $collecter_liens
 * @return array
 *   texte, marqueur utilise pour echapper les modeles
 */
function liens_echapper_raccourcis($texte) {
	if (!function_exists('creer_uniqid')) {
		include_spip('inc/acces');
	}

	$liens = liens_collecter($texte);
	$markid = '';
	if (!empty($liens)) {
		// generer un marqueur qui n'est pas dans le texte
		do {
			$markid = substr(md5(creer_uniqid()), 0, 7);
			$markid = "@|LIEN$markid|";
		} while (strpos($texte, $markid) !== false);

		$offset_pos = 0;
		foreach ($liens as $l) {
			$rempl = $markid . base64_encode($l['lien']) . '|@';
			$texte = substr_replace($texte, $rempl, $l['pos'] + $offset_pos, $l['length']);
			$offset_pos += strlen($rempl) - $l['length'];
		}
	}

	return [$texte, $markid];
}

/**
 * Retablir les liens echappés par la fonction liens_retablir_raccourcis_echappes()
 *
 * @see liens_echapper_raccourcis()
 * @param string $texte
 * @param string $markid
 * @return string
 */
function liens_retablir_raccourcis_echappes(string $texte, string $markid) {

	if ($markid) {
		$lm = strlen($markid);
		$pos = 0;
		while (
			($p = strpos($texte, $markid, $pos)) !== false
			and $end = strpos($texte, '|@', $p + $lm)
		) {
			$base64 = substr($texte, $p + $lm, $end - ($p + $lm));
			if ($c = base64_decode($base64, true)) {
				$texte = substr_replace($texte, $c, $p, $end + 2 - $p);
				$pos = $p + strlen($c);
			}
			else {
				$pos = $end;
			}
		}
	}

	return $texte;
}
