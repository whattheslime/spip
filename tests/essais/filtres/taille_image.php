<?php
/**
 * Test unitaire de la fonction taille_image
 * du fichier inc/filtres.php
 *
 */
namespace Spip\Core\Tests;

find_in_path("inc/filtres.php",'',true);

/**
 * La fonction appelee pour chaque jeu de test
 * Nommage conventionnel : test_[[dossier1_][[dossier2_]...]]fichier
 * @param ...$args
 * @return mixed
 */
function test_filtres_taille_image(...$args) {
	return taille_image(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_filtres_taille_image(){
		$essais = array (
  0 => 
  array (
    0 => 
    array (
      0 => 223,
      1 => 300,
    ),
    1 => 'https://www.spip.net/IMG/logo/siteon0.png',
  ),
  2 =>
  array (
    0 => 
    array (
      0 => 172,
      1 => 231,
    ),
    1 => 'prive/images/logo-spip.png',
  ),
  3 => 
  array (
    0 => 
    array (
      0 => 0,
      1 => 0,
    ),
    1 => 'prive/aide_body.css',
  ),
  4 => 
  array (
    0 => 
    array (
      0 => 16,
      1 => 16,
    ),
    1 => 'prive/images/searching.gif',
  ),
);
		return $essais;
	}


