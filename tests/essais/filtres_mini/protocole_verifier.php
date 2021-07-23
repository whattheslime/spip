<?php
/**
 * Test unitaire de la fonction protocole_verifier
 * du fichier ./inc/filtres_mini.php
 *
 */
namespace Spip\Core\Tests;

find_in_path("./inc/filtres_mini.php",'',true);

/**
 * La fonction appelee pour chaque jeu de test
 * Nommage conventionnel : test_[[dossier1_][[dossier2_]...]]fichier
 * @param ...$args
 * @return mixed
 */
function test_filtres_mini_protocole_verifier(...$args) {
	return protocole_verifier(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_filtres_mini_protocole_verifier(){
		$essais = array (
  0 => 
  array (
    0 => true,
    1 => 'http://www.spip.net',
  ),
  1 => 
  array (
    0 => true,
    1 => 'https://www.spip.net',
  ),
  2 => 
  array (
    0 => false,
    1 => 'ftp://www.spip.net',
  ),
  3 => 
  array (
    0 => true,
    1 => 'ftp://www.spip.net',
    2 => 
    array (
      0 => 'http',
      1 => 'https',
      2 => 'ftp',
    ),
  ),
  4 => 
  array (
    0 => false,
    1 => '/etc/password',
  ),
  5 => 
  array (
    0 => false,
    1 => 'squelettes/img/recherche.png',
  ),
  6 => 
  array (
    0 => true,
    1 => 'HTTP://WWW.SPIP.NET',
  ),
  7 => 
  array (
    0 => true,
    1 => 'http://www.spip.net',
    2 => 
    array (
      0 => 'HTTP',
      1 => 'HTTPS',
    ),
  ),
);
		return $essais;
	}









?>