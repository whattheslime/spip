<?php

/**
 * SPIP, Système de publication pour l'internet
 *
 * Copyright © avec tendresse depuis 2001
 * Arnaud Martin, Antoine Pitrou, Philippe Rivière, Emmanuel Saint-James
 *
 * Ce programme est un logiciel libre distribué sous licence GNU/GPL.
 */

use Spip\Compilateur\Noeud\Boucle;

/**
 * Gestion de l'itérateur CONDITION
 *
 * @package SPIP\Core\Iterateur\CONDITION
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

include_spip('iterateur/data');

/**
 * Créer une boucle sur un itérateur CONDITION
 *
 * Annonce au compilateur les "champs" disponibles,
 * c'est à dire aucun. Une boucle CONDITION n'a pas de données !
 *
 * @param Boucle $b
 *     Description de la boucle
 * @return Boucle
 *     Description de la boucle complétée des champs
 */
function iterateur_CONDITION_dist($b) {
	$b->iterateur = 'CONDITION'; # designe la classe d'iterateur
	$b->show = [
		'field' => [],
	];

	return $b;
}
