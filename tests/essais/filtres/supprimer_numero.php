<?php
/**
 * Test unitaire de la fonction supprimer_numero
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
function test_filtres_supprimer_numero(...$args) {
	return supprimer_numero(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_filtres_supprimer_numero(){
		return [
  0 => 
   [
    0 => '1.titre',
    1 => '1.titre',
  ],
  1 => 
   [
    0 => 'titre',
    1 => '1. titre',
  ],
  2 => 
   [
    0 => '1 .titre',
    1 => '1 .titre',
  ],
  3 => 
   [
    0 => '1 . titre',
    1 => '1 . titre',
  ],
  5 => 
   [
    0 => 'titre',
    1 => '0. titre',
  ],
  6 => 
   [
    0 => 'titre',
    1 => ' 0. titre',
  ],
  7 => 
   [
    0 => '-1. titre',
    1 => '-1. titre',
  ],
];
	}

