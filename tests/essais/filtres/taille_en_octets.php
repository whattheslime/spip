<?php
/**
 * Test unitaire de la fonction taille_en_octets
 * du fichier inc/filtres.php
 *
 */
namespace Spip\Core\Tests;

find_in_path("inc/filtres.php",'',true);

function pretest_filtres_taille_en_octets(){
	changer_langue('fr'); // ce test est en fr
}

/**
 * La fonction appelee pour chaque jeu de test
 * Nommage conventionnel : test_[[dossier1_][[dossier2_]...]]fichier
 * @param ...$args
 * @return mixed
 */
function test_filtres_taille_en_octets(...$args) {
	return taille_en_octets(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_filtres_taille_en_octets(){
		$essais = array (
  0 => 
  array (
    0 => '',
    1 => 0,
  ),
  1 => 
  array (
    0 => '',
    1 => -1,
  ),
  2 => 
  array (
    0 => '1 octets',
    1 => 1,
  ),
  3 => 
  array (
    0 => '2 octets',
    1 => 2,
  ),
  4 => 
  array (
    0 => '3 octets',
    1 => 3,
  ),
  5 => 
  array (
    0 => '4 octets',
    1 => 4,
  ),
  6 => 
  array (
    0 => '5 octets',
    1 => 5,
  ),
  7 => 
  array (
    0 => '6 octets',
    1 => 6,
  ),
  8 => 
  array (
    0 => '7 octets',
    1 => 7,
  ),
  9 => 
  array (
    0 => '10 octets',
    1 => 10,
  ),
  10 => 
  array (
    0 => '20 octets',
    1 => 20,
  ),
  11 => 
  array (
    0 => '30 octets',
    1 => 30,
  ),
  12 => 
  array (
    0 => '50 octets',
    1 => 50,
  ),
  13 => 
  array (
    0 => '100 octets',
    1 => 100,
  ),
  14 => 
  array (
    0 => '1000 octets',
    1 => 1000,
  ),
  15 => 
  array (
    0 => '9.8 ko',
    1 => 10000,
  ),
	16 =>
  array (
    0 => '97.7 ko',
    1 => 100000,
  ),
	17 =>
  array (
    0 => '976.6 ko',
    1 => 1000000,
  ),
	18 =>
  array (
    0 => '9.5 Mo',
    1 => 10000000,
  ),
	19 =>
  array (
    0 => '95.4 Mo',
    1 => 100000000,
  ),
	20 =>
  array (
    0 => '953.7 Mo',
    1 => 1000000000,
  ),
	21 =>
  array (
    0 => '9.31 Go',
    1 => 10000000000,
  ),
);
		return $essais;
	}
