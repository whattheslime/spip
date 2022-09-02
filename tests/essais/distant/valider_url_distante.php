<?php
/**
 * Test unitaire de la fonction valider_url_distante
 * du fichier ./inc/distant.php
 *
 */
namespace Spip\Core\Tests;

find_in_path("./inc/distant.php",'',true);

/**
 * La fonction appelee pour chaque jeu de test
 * Nommage conventionnel : test_[[dossier1_][[dossier2_]...]]fichier
 * @param ...$args
 * @return mixed
 */
function test_distant_valider_url_distante(...$args) {
	return valider_url_distante(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_distant_valider_url_distante(){
		$essais =  [
  0 => 
   [
    0 => 'http://www.spip.net',
    1 => 'http://www.spip.net',
  ],
  1 => 
   [
    0 => 'https://www.spip.net',
    1 => 'https://www.spip.net',
  ],
  2 => 
   [
    0 => false,
    1 => 'ftp://www.spip.net',
  ],
  3 => 
   [
    0 => false,
    1 => 'http://user@www.spip.net',
  ],
  4 => 
   [
    0 => false,
    1 => 'https://user:password@www.spip.net',
  ],
  5 => 
   [
    0 => false,
    1 => 'http://127.0.0.1/munin/graph.png',
  ],
  6 => 
   [
    0 => false,
    1 => 'http://localhost:8765',
  ],
  7 => 
   [
    0 => 'http://localhost:8765/test.png',
    1 => 'http://localhost:8765/test.png',
    2 => 
     [
      0 => 'localhost:8765',
    ],
  ],
  8 => 
   [
    0 => false,
    1 => 'http://localhost:9100/test.png',
  ],
  9 => 
   [
    0 => false,
    1 => 'http://user@password:localhost:8765/test.png',
    2 => 
     [
      0 => 'localhost:8765',
    ],
  ],
  10 => 
   [
    0 => false,
    1 => 'http://user@password:localhost:8765/test.png',
    2 => 
     [
      0 => 'http://user@password:localhost:8765',
    ],
  ],
];
		return $essais;
	}












?>