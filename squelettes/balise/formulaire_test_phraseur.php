<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2010                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

if (!defined("_ECRIRE_INC_VERSION")) return;	#securite

function balise_FORMULAIRE_TEST_PHRASEUR ($p) {

	$p = calculer_balise_dynamique($p,'FORMULAIRE_TEST_PHRASEUR', array('id_rubrique'));
	return $p;
}

function balise_FORMULAIRE_TEST_PHRASEUR_stat($args, $context_compil) {

	// le denier arg peut contenir l'url sur lequel faire le retour
	// exemple dans un squelette article.html : [(#FORMULAIRE_FORUM{#SELF})]

	// recuperer les donnees du forum auquel on repond.
	list ($idr) = $args;

	return
		array($idr);
}

function balise_FORMULAIRE_TEST_PHRASEUR_dyn($id_rubrique,$url) {
	$res = "OK";

	if (!preg_match(",^[0-9]+$,", $id_rubrique))
		$res = "Erreur id_rubrique non numerique : ".var_export($id_rubrique,1);

	return array("formulaires/test_phraseur",
		0,
		array(
			'result' => $res,
		)
	);
}
?>
