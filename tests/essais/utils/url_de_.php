<?php
/**
 * Test unitaire de la fonction url_de_
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
function test_utils_url_de_(...$args) {
	return url_de_(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_utils_url_de_(){
		$essais =  [
  0 => 
   [
    0 => 'http://www.example.org/',
    1 => 'http',
    2 => 'www.example.org',
    3 => '',
    4 => 0,
  ],
  1 => 
   [
    0 => 'http://www.example.org/',
    1 => 'http',
    2 => 'www.example.org',
    3 => '/spip.php',
    4 => 0,
  ],
  2 => 
   [
    0 => 'http://www.example.org/',
    1 => 'http',
    2 => 'www.example.org',
    3 => '/spip.php?page=demo',
    4 => 0,
  ],
  3 => 
   [
    0 => 'http://www.example.org/sousrep/',
    1 => 'http',
    2 => 'www.example.org',
    3 => '/sousrep/spip.php?page=demo',
    4 => 0,
  ],
  4 => 
   [
    0 => 'http://www.example.org/sousrep/url/arbo/',
    1 => 'http',
    2 => 'www.example.org',
    3 => '/sousrep/url/arbo/page.html',
    4 => 0,
  ],
  5 => 
   [
    0 => 'http://www.example.org/sousrep/url/',
    1 => 'http',
    2 => 'www.example.org',
    3 => '/sousrep/url/arbo/page.html',
    4 => 1,
  ],
  6 => 
   [
    0 => 'http://www.example.org/sousrep/',
    1 => 'http',
    2 => 'www.example.org',
    3 => '/sousrep/url/arbo/page.html',
    4 => 2,
  ],
  7 => 
   [
    0 => 'http://www.example.org/',
    1 => 'http',
    2 => 'www.example.org',
    3 => '/sousrep/url/arbo/page.html',
    4 => 3,
  ],
  8 => 
   [
    0 => 'http://www.example.org/',
    1 => 'http',
    2 => 'www.example.org',
    3 => '/sousrep/url/arbo/page.html',
    4 => 4,
  ],
  9 =>
   [
    0 => 'http://www.example.org/',
    1 => 'http',
    2 => 'www.example.org',
    3 => 'http://www.example.org/sousrep/url/arbo/page.html',
    4 => 3,
  ],
  10 =>
   [
    0 => 'http://www.example.org/',
    1 => 'http',
    2 => 'www.example.org',
    3 => '/?param=http://domain.tld/autre/piege/tordu',
    4 => 3,
  ],
  11 =>
   [
    0 => 'http:///',
    1 => 'http',
    2 => '',
    3 => '',
    4 => 0,
  ],
];
		return $essais;
	}


