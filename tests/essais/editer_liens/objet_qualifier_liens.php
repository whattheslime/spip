<?php
/**
 * Test unitaire de la fonction objet_qualifier_liens
 * du fichier action/editer_liens.php
 *
 */
namespace Spip\Core\Tests;

find_in_path("action/editer_liens.php",'',true);


/**
 * La fonction appelee avant de lancer les tests
 * Nommage conventionnel : pretest_[[dossier1_][[dossier2_]...]]fichier
 */
function pretest_editer_liens_objet_qualifier_liens() {
	// creer les donnees de depart
	objet_associer(array('auteur'=>1), array('zorglub'=>array(1,2,3,4,5,6,7,8,9,10)));
}


/**
 * La fonction appelee pour chaque jeu de test
 * Nommage conventionnel : test_[[dossier1_][[dossier2_]...]]fichier
 * @param ...$args
 * @return mixed
 */
function test_editer_liens_objet_qualifier_liens(...$args) {
	return objet_qualifier_liens(...$args);
}

/**
 * La fonction appelee apres les tests (pour nettoyer)
 * Nommage conventionnel : posttest_[[dossier1_][[dossier2_]...]]fichier
 */
function posttest_editer_liens_objet_qualifier_liens() {
	// nettoyer
	objet_dissocier(array('auteur'=>1), array('zorglub'=>'*'));
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_editer_liens_objet_qualifier_liens(){
		$essais = array (
  array (
    0 => false,
    1 => array('article'=>1),
    2 => array('zorglub'=>1),
		3 => array('vu'=>'oui'),
  ),
  array (
    0 => 1,
    1 => array('auteur'=>1),
    2 => array('zorglub'=>1),
		3 => array('vu'=>'oui'),
  ),
  array (
    0 => 1,
    1 => array('auteur'=>1),
    2 => array('zorglub'=>1),
		3 => array('vu'=>'oui'),
  ),
  array (
    0 => false,
    1 => array('auteur'=>1),
    2 => array('zorglub'=>1),
		3 => array('veraer'=>'oui'),
  ),
  array (
    0 => 2,
    1 => array('auteur'=>1),
    2 => array('zorglub'=>array(2,3)),
		3 => array('vu'=>'oui'),
  ),
);
		return $essais;
	}


