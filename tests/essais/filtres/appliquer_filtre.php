<?php
/**
 * Test unitaire de la fonction appliquer_filtre
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
function test_filtres_appliquer_filtre(...$args) {
	return appliquer_filtre(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_filtres_appliquer_filtre(){
		$essais = array (
  0 => 
  array (
    0 => '&lt;&gt;&quot;&#039;&amp;',
    1 => '<>"\'&',
    2 => 'entites_html',
  ),
  1 => 
  array (
    0 => '&amp;',
    1 => '&amp;',
    2 => 'entites_html',
  ),
);
		return $essais;
	}

