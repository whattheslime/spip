<?php
/**
 * Test unitaire de la fonction commuter_class
 * du fichier ./inc/filtres.php
 *
 */
namespace Spip\Core\Tests;

find_in_path("./inc/filtres.php",'',true);

/**
 * La fonction appelee pour chaque jeu de test
 * Nommage conventionnel : test_[[dossier1_][[dossier2_]...]]fichier
 * @param ...$args
 * @return mixed
 */
function test_filtres_commuter_class(...$args) {
	return commuter_class(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_filtres_commuter_class(){
		$essais =  [
  0 => 
   [
    0 => '<span class=\'maclasse-prefixe suffixe-maclasse maclasse--bem\'>toto</span>',
    1 => '<span class="maclasse maclasse-prefixe suffixe-maclasse maclasse--bem">toto</span>',
    2 => 'maclasse',
  ],
  1 => 
   [
    0 => '<span class=\'maclasse maclasse-prefixe suffixe-maclasse maclasse--bem autreclass\'>toto</span>',
    1 => '<span class="maclasse maclasse-prefixe suffixe-maclasse maclasse--bem">toto</span>',
    2 => 'autreclass',
  ],
  2 => 
   [
    0 => '<span class=\'maclasse-prefixe suffixe-maclasse maclasse--bem maclasse1 maclasse2\'>toto</span>',
    1 => '<span class="maclasse maclasse-prefixe suffixe-maclasse maclasse--bem">toto</span>',
    2 => 'maclasse1 maclasse maclasse2',
  ],
  3 => 
   [
    0 => '<span class="maclasse maclasse-prefixe suffixe-maclasse maclasse--bem">toto</span>',
    1 => '<span class="maclasse maclasse-prefixe suffixe-maclasse maclasse--bem">toto</span>',
    2 => '<span class="maclasse maclasse-prefixe suffixe-maclasse maclasse--bem">toto</span>',
  ],
];
		return $essais;
	}





?>