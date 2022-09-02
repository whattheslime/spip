<?php
/**
 * Test unitaire de la fonction tester_url_absolue
 * du fichier ./inc/utils.php
 *
 */
namespace Spip\Core\Tests;

find_in_path("./inc/utils.php",'',true);

/**
 * La fonction appelee pour chaque jeu de test
 * Nommage conventionnel : test_[[dossier1_][[dossier2_]...]]fichier
 * @param ...$args
 * @return mixed
 */
function test_utils_tester_url_absolue(...$args) {
	return tester_url_absolue(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_utils_tester_url_absolue(){
		$essais =  [
  0 => 
   [
    0 => true,
    1 => 'http://www.spip.net/',
  ],
  1 => 
   [
    0 => true,
    1 => 'https://www.spip.net/',
  ],
  2 => 
   [
    0 => true,
    1 => 'http://www.spip.net/sousrep/fr/',
  ],
  3 => 
   [
    0 => true,
    1 => 'ftp://www.spip.net/',
  ],
  4 => 
   [
    0 => true,
    1 => '//www.spip.net/',
  ],
  5 => 
   [
    0 => false,
    1 => '/spip/?page=sommaire',
  ],
  6 => 
   [
    0 => false,
    1 => 'spip/?page=sommaire',
  ],
];
		return $essais;
	}

