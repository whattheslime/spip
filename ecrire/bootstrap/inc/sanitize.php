<?php

/**
 * Supprimer les éventuels caracteres nuls %00, qui peuvent tromper
 * la commande is_readable('chemin/vers/fichier/interdit%00truc_normal').
 *
 * Cette fonction est appliquée par SPIP à son initialisation sur GET/POST/COOKIES/GLOBALS
 * @param array $t le tableau ou la chaine à desinfecter (passage par référence)
 * @param bool $deep = true : appliquer récursivement
**/
function spip_desinfecte(&$t, $deep = true) {
	foreach ($t as $key => $val) {
		if (is_string($t[$key])) {
			$t[$key] = str_replace(chr(0), '-', $t[$key]);
		} // traiter aussi les "texte_plus" de article_edit
		else {
			if ($deep && is_array($t[$key]) && $key !== 'GLOBALS') {
				spip_desinfecte($t[$key], $deep);
			}
		}
	}
}

/**
 * Nettoie une chaine pour servir comme classes CSS.
 *
 * @note
 *     les classes CSS acceptent théoriquement tous les caractères sauf NUL.
 *     Ici, on limite (enlève) les caractères autres qu’alphanumérique, espace, - + _ @
 *
 * @param string|string[] $classes
 * @return string|string[]
 */
function spip_sanitize_classname($classes) {
	if (is_array($classes)) {
		return array_map('spip_sanitize_classname', $classes);
	}
	return preg_replace('/[^ 0-9a-z_\-+@]/i', '', $classes);
}
