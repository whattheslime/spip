<?php

/**
 * SPIP, Système de publication pour l'internet
 *
 * Copyright © avec tendresse depuis 2001
 * Arnaud Martin, Antoine Pitrou, Philippe Rivière, Emmanuel Saint-James
 *
 * Ce programme est un logiciel libre distribué sous licence GNU/GPL.
 */

/**
 * Gestion du formulaire de d'édition de rubrique
 *
 * @package SPIP\Core\Rubriques\Formulaires
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

include_spip('inc/actions');
include_spip('inc/editer');


/**
 * Chargement du formulaire d'édition d'une rubrique
 *
 * @see formulaires_editer_objet_charger()
 *
 * @param int|string $id_rubrique
 *     Identifiant de la rubrique. 'new' pour une nouvelle rubrique
 * @param int $id_parent
 *     Identifiant de la rubrique parente
 * @param string $retour
 *     URL de redirection après le traitement
 * @param int $lier_trad
 *     Identifiant éventuel d'une rubrique source de traduction
 * @param string $config_fonc
 *     Nom de la fonction ajoutant des configurations particulières au formulaire
 * @param array $row
 *     Valeurs de la ligne SQL de la rubrique, si connue
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés du formulaire.
 * @return array
 *     Environnement du formulaire
 */
function formulaires_editer_rubrique_charger_dist(
	$id_rubrique = 'new',
	$id_parent = 0,
	$retour = '',
	$lier_trad = 0,
	$config_fonc = 'rubriques_edit_config',
	$row = [],
	$hidden = ''
) {
	$valeurs = formulaires_editer_objet_charger(
		'rubrique',
		$id_rubrique,
		$id_parent,
		$lier_trad,
		$retour,
		$config_fonc,
		$row,
		$hidden
	);

	if ((int) $id_rubrique && !autoriser('modifier', 'rubrique', (int) $id_rubrique)) {
		$valeurs['editable'] = '';
	}

	return $valeurs;
}

/**
 * Choix par défaut des options de présentation
 *
 * @param array $row
 *     Valeurs de la ligne SQL d'une rubrique, si connue
 * return array
 *     Configuration pour le formulaire
 */
function rubriques_edit_config(array $row): array {
	return [
		'lignes' => 8,
		'langue' => $GLOBALS['spip_lang'],
		'restreint' => !$GLOBALS['connect_toutes_rubriques']
	];
}

/**
 * Identifier le formulaire en faisant abstraction des paramètres qui
 * ne représentent pas l'objet édité
 *
 * @param int|string $id_rubrique
 *     Identifiant de la rubrique. 'new' pour une nouvelle rubrique
 * @param int $id_parent
 *     Identifiant de la rubrique parente
 * @param string $retour
 *     URL de redirection après le traitement
 * @param int $lier_trad
 *     Identifiant éventuel d'une rubrique source de traduction
 * @param string $config_fonc
 *     Nom de la fonction ajoutant des configurations particulières au formulaire
 * @param array $row
 *     Valeurs de la ligne SQL de la rubrique, si connue
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés du formulaire.
 * @return string
 *     Hash du formulaire
 */
function formulaires_editer_rubrique_identifier_dist(
	$id_rubrique = 'new',
	$id_parent = 0,
	$retour = '',
	$lier_trad = 0,
	$config_fonc = 'rubriques_edit_config',
	$row = [],
	$hidden = ''
) {
	return serialize([(int) $id_rubrique, $lier_trad]);
}

/**
 * Vérifications du formulaire d'édition d'une rubrique
 *
 * @see formulaires_editer_objet_verifier()
 *
 * @param int|string $id_rubrique
 *     Identifiant de la rubrique. 'new' pour une nouvelle rubrique
 * @param int $id_parent
 *     Identifiant de la rubrique parente
 * @param string $retour
 *     URL de redirection après le traitement
 * @param int $lier_trad
 *     Identifiant éventuel d'une rubrique source de traduction
 * @param string $config_fonc
 *     Nom de la fonction ajoutant des configurations particulières au formulaire
 * @param array $row
 *     Valeurs de la ligne SQL de la rubrique, si connue
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés du formulaire.
 * @return array
 *     Erreurs du formulaire
 */
function formulaires_editer_rubrique_verifier_dist(
	$id_rubrique = 'new',
	$id_parent = 0,
	$retour = '',
	$lier_trad = 0,
	$config_fonc = 'rubriques_edit_config',
	$row = [],
	$hidden = ''
) {
	// auto-renseigner le titre si il n'existe pas
	titre_automatique('titre', ['descriptif', 'texte']);
	// on ne demande pas le titre obligatoire : il sera rempli a la volee dans editer_rubrique si vide
	$erreurs = formulaires_editer_objet_verifier('rubrique', $id_rubrique, []);

	// s'assurer qu'on ne s'auto-designe pas comme parent !
	if (
		(int) $id_rubrique
		&& empty($erreurs['id_parent'])
		&& ($id_parent = _request('id_parent'))
	) {
		include_spip('inc/rubriques');
		$branche = calcul_branche_in($id_rubrique);
		$branche = explode(',', (string) $branche);
		if (in_array($id_parent, $branche)) {
			$erreurs['id_parent'] = _L('Impossible de déplacer une rubrique dans sa propre branche, on tourne en rond !');
		}
	}

	return $erreurs;
}

/**
 * Traitements du formulaire d'édition d'une rubrique
 *
 * @see formulaires_editer_objet_traiter()
 *
 * @param int|string $id_rubrique
 *     Identifiant de la rubrique. 'new' pour une nouvelle rubrique
 * @param int $id_parent
 *     Identifiant de la rubrique parente
 * @param string $retour
 *     URL de redirection après le traitement
 * @param int $lier_trad
 *     Identifiant éventuel d'une rubrique source de traduction
 * @param string $config_fonc
 *     Nom de la fonction ajoutant des configurations particulières au formulaire
 * @param array $row
 *     Valeurs de la ligne SQL de la rubrique, si connue
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés du formulaire.
 * @return array
 *     Retour des traitements
 */
function formulaires_editer_rubrique_traiter_dist(
	$id_rubrique = 'new',
	$id_parent = 0,
	$retour = '',
	$lier_trad = 0,
	$config_fonc = 'rubriques_edit_config',
	$row = [],
	$hidden = ''
) {
	return formulaires_editer_objet_traiter(
		'rubrique',
		$id_rubrique,
		$id_parent,
		$lier_trad,
		$retour,
		$config_fonc,
		$row,
		$hidden
	);
}
