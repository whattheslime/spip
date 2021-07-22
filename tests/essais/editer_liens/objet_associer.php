<?php
/**
 * Test unitaire de la fonction objet_associer
 * du fichier action/editer_liens.php
 *
 */
namespace Spip\Core\Tests;

find_in_path("action/editer_liens.php",'',true);

/**
 * La fonction appelee pour chaque jeu de test
 * Nommage conventionnel : test_[[dossier1_][[dossier2_]...]]fichier
 * @param ...$args
 * @return mixed
 */
function test_editer_liens_objet_associer(...$args) {
	return objet_associer(...$args);
}

function posttest_editer_liens_objet_associer() {
	// nettoyer
	objet_dissocier(array('auteur'=>1), array('spirou'=>'*'));
}

/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_editer_liens_objet_associer(){
		$essais = array (
  array (
    0 => false,
    1 => array('article'=>1),
    2 => array('spirou'=>1),
  ),
  array (
    0 => 1,
    1 => array('auteur'=>1),
    2 => array('spirou'=>1),
  ),
  array (
    0 => 0,
    1 => array('auteur'=>1),
    2 => array('spirou'=>1),
  ),
  array (
    0 => 2,
    1 => array('auteur'=>1),
    2 => array('spirou'=>array(2,3)),
  ),
  array (
    0 => 1,
    1 => array('auteur'=>1),
    2 => array('spirou'=>array(2,3,4)),
  ),
);
		return $essais;
	}

