<?php
/**
 * Test unitaire de la fonction ajouter_class
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
function test_filtres_ajouter_class(...$args) {
	return ajouter_class(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_filtres_ajouter_class(){
		$essais = array (
  0 => 
  array (
    0 => '<span class=\'maclasse maclasse-prefixe suffixe-maclasse maclasse--bem autreclass\'>toto</span>',
    1 => '<span class="maclasse maclasse-prefixe suffixe-maclasse maclasse--bem">toto</span>',
    2 => 'autreclass',
  ),
  1 => 
  array (
    0 => '<span class="maclasse maclasse-prefixe suffixe-maclasse maclasse--bem">toto</span>',
    1 => '<span class="maclasse maclasse-prefixe suffixe-maclasse maclasse--bem">toto</span>',
    2 => 'maclasse',
  ),
  2 => 
  array (
    0 => '<span class=\'maclasse-prefixe suffixe-maclasse maclasse--bem maclasse\'>toto</span>',
    1 => '<span class="maclasse-prefixe suffixe-maclasse maclasse--bem">toto</span>',
    2 => 'maclasse',
  ),
  3 => 
  array (
    0 => '<span class=\'maclasse maclasse-prefixe suffixe-maclasse maclasse--bem maclasse1 maclasse2\'>toto</span>',
    1 => '<span class="maclasse maclasse-prefixe suffixe-maclasse maclasse--bem">toto</span>',
    2 => 'maclasse1 maclasse maclasse2',
  ),
);
		return $essais;
	}





?>