<?php

// Pour les formulaires en methode POST,
// mettre le nom du script a la fois en input-hidden et dans le champ action:
// 1) on peut ainsi memoriser le signet comme si c'etait un GET
// 2) ca suit http://en.wikipedia.org/wiki/Representational_State_Transfer

/**
 * Retourne un formulaire (POST par défaut) vers un script exec
 * de l’interface privée
 *
 * @param string $script
 *     Nom de la page exec
 * @param string $corps
 *     Contenu du formulaire
 * @param string $atts
 *     Si présent, remplace les arguments par défaut (method=post) par ceux indiqués
 * @param string $submit
 *     Si indiqué, un bouton de soumission est créé avec texte sa valeur.
 * @return string
 *     Code HTML du formulaire
 */
function generer_form_ecrire($script, $corps, $atts = '', $submit = '') {

	$script1 = explode('&', $script);
	$script1 = reset($script1);

	return "<form action='"
	. ($script ? generer_url_ecrire($script) : '')
	. "' "
	. ($atts ?: " method='post'")
	. "><div>\n"
	. "<input type='hidden' name='exec' value='$script1' />"
	. $corps
	. (!$submit ? '' :
		("<div style='text-align: " . $GLOBALS['spip_lang_right'] . "'><input class='fondo submit btn' type='submit' value=\"" . entites_html($submit) . '" /></div>'))
	. "</div></form>\n";
}

/**
 * Générer un formulaire pour lancer une action vers $script
 *
 * Attention, JS/Ajax n'aime pas le melange de param GET/POST
 * On n'applique pas la recommandation ci-dessus pour les scripts publics
 * qui ne sont pas destines a etre mis en signets
 *
 * @param string $script
 * @param string $corps
 * @param string $atts
 * @param bool $public
 * @return string
 */
function generer_form_action($script, $corps, $atts = '', $public = false) {
	// si l'on est dans l'espace prive, on garde dans l'url
	// l'exec a l'origine de l'action, qui permet de savoir si il est necessaire
	// ou non de proceder a l'authentification (cas typique de l'install par exemple)
	$h = (_DIR_RACINE && !$public)
		? generer_url_ecrire(_request('exec'))
		: generer_url_public();

	return "\n<form action='" .
	$h .
	"'" .
	$atts .
	">\n" .
	'<div>' .
	"\n<input type='hidden' name='action' value='$script' />" .
	$corps .
	'</div></form>';
}
