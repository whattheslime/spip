<?php

/**
 * SPIP, Système de publication pour l'internet
 *
 * Copyright © avec tendresse depuis 2001
 * Arnaud Martin, Antoine Pitrou, Philippe Rivière, Emmanuel Saint-James
 *
 * Ce programme est un logiciel libre distribué sous licence GNU/GPL.
 */

use Spip\Texte\Collecteur\HtmlTag as CollecteurHtmlTag;


//
if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

//
// Gestion du raccourci <math>...</math> en client-serveur
//

function produire_image_math($tex) {

	switch ($GLOBALS['traiter_math']) {
		// Attention: mathml desactiv'e pour l'instant
		case 'mathml':
			$ext = '.xhtml';
			$server = $GLOBALS['mathml_server'];
			break;
		case 'tex':
			$ext = '.png';
			$server = $GLOBALS['tex_server'];
			break;
		default:
			return $tex;
	}

	// Regarder dans le repertoire local des images TeX et blocs MathML
	if (!@is_dir($dir_tex = _DIR_VAR . 'cache-TeX/')) {
		@mkdir($dir_tex, _SPIP_CHMOD);
	}
	$fichier = $dir_tex . md5(trim((string) $tex)) . $ext;


	// Aller chercher l'image sur le serveur
	if (!@file_exists($fichier) && $server) {
		spip_logger()->info($url = $server . '?' . rawurlencode((string) $tex));
		include_spip('inc/distant');
		recuperer_url($url, ['file' => $fichier]);
	}


	// Composer la reponse selon presence ou non de l'image
	$tex = entites_html($tex);
	if (@file_exists($fichier)) {
		// MathML
		if ($GLOBALS['traiter_math'] == 'mathml') {
			return implode('', file($fichier));
		} // TeX
		else {
			[, , , $size] = @spip_getimagesize($fichier);
			$alt = "alt=\"$tex\" title=\"$tex\"";

			return "<img src=\"" . attribut_url($fichier) . "\" style=\"vertical-align:middle;\" $size $alt />";
		}
	} else // pas de fichier
	{
		return "<tt><span class='spip_code' dir='ltr'>$tex</span></tt>";
	}
}


/**
 * Active la recherche et l'affichage d'expressions mathématiques dans le texte
 * transmis, dans tous les textes à l'intérieur d'une balise `<math>`.
 *
 * Encadrer un texte de balises `<math> ... </math>` active la recherche
 * d'expressions mathématiques écrites entre caractères `$` au sein de ce texte :
 *
 * - `$$expression$$` traitera l'expression comme un paragraphe centré (p)
 * - `$expression$` traitera l'expression comme un texte en ligne (span)
 *
 * Un serveur distant calculera une image à partir de l'expression mathématique
 * donnée. Cette image est mise en cache localement (local/cache-Tex)
 *
 * @note
 *     Si cette fonction est appelée depuis `propre()` alors un échappement
 *     des caractères `&` en `&amp;` a été réalisé, qu'il faut redéfaire
 *     dans les expressions mathématiques trouvées (utiliser l'option
 *     `$defaire_amp` à true pour cela).
 *
 * @link https://www.spip.net/3016
 * @uses produire_image_math()
 * @uses code_echappement()
 *
 * @param string $letexte
 * @param string $source
 * @param bool $defaire_amp
 *     true pour passer les `&amp;` en `&` dans les expressions mathématiques.
 * @return string
 */
function traiter_math($letexte, $source = '', $defaire_amp = false) {

	$collecteurMath = new CollecteurHtmlTag('math', '@<math>(.*)(</math>|$)@iUsS', '');
	$collection = $collecteurMath->collecter($letexte);
	$collection = array_reverse($collection);

	foreach ($collection as $c) {
		$texte_milieu = $c['match'][1];

		$traitements = [
			// Les doubles $$x^2$$ en mode 'div'
			['str' => '$$', 'preg' => ',[$][$]([^$]+)[$][$],', 'pre' => "\n<p class=\"spip\" style=\"text-align: center;\">", 'post' => "</p>\n"],
			// Les simples $x^2$ en mode 'span'
			['str' => '$', 'preg' => ',[$]([^$]+)[$],'],
		];
		foreach ($traitements as $t) {
			while (
				str_contains($texte_milieu, $t['str'])
				&& preg_match($t['preg'], $texte_milieu, $regs)
			) {
				$expression = $regs[1];
				if ($defaire_amp) {
					$expression = str_replace('&amp;', '&', $expression);
				}
				$echap = produire_image_math($expression);
				$echap = ($t['pre'] ?? '') . $echap . ($t['post'] ?? '');
				$echap = CollecteurHtmlTag::echappementHtmlBase64($echap, $source);

				$pos = strpos($texte_milieu, (string) $regs[0]);
				$texte_milieu = substr_replace($texte_milieu, $echap, $pos, strlen($regs[0]));
			}
		}

		$letexte = substr_replace($letexte, $texte_milieu, $c['pos'], $c['length']);
	}

	return $letexte;
}
