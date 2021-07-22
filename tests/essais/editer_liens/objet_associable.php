<?php
/**
 * Test unitaire de la fonction objet_associable
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
function test_editer_liens_objet_associable(...$args) {
	return objet_associable(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_editer_liens_objet_associable(){
		$essais = array (
  array (
    0 => false,
    1 => 'article',
  ),
  array (
    0 => array('id_auteur','spip_auteurs_liens'),
    1 => 'auteur',
  ),
  array (
    0 => array('id_mot','spip_mots_liens'),
    1 => 'mot',
  ),
  array (
    0 => array('id_document','spip_documents_liens'),
    1 => 'document',
  ),
  array (
    0 => false,
    1 => 'mot\' OR 1=1\'',
  ),
);
		return $essais;
	}

