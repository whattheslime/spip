<?php
/**
 * Test unitaire de la fonction wrap
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
function test_filtres_wrap(...$args) {
	return wrap(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_filtres_wrap(){
		$essais = array (
  0 => 
  array (
    0 => '<h3>un mot</h3>',
    1 => 'un mot',
    2 => '<h3>',
  ),
  1 => 
  array (
    0 => '<h3><b>un mot</b></h3>',
    1 => 'un mot',
    2 => '<h3><b>',
  ),
  2 => 
  array (
    0 => '<h3 class="spip"><b>un mot</b></h3>',
    1 => 'un mot',
    2 => '<h3 class="spip"><b>',
  ),

);
		return $essais;
	}

