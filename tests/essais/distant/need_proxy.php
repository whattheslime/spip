<?php
/**
 * Test unitaire de la fonction need_proxy
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
function test_distant_need_proxy(...$args) {
	return need_proxy(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_distant_need_proxy(){
		$essais =  [
  0 => 
   [
    0 => 'http://monproxy.example.org',
    1 => 'sous.domaine.spip.net',
    2 => 'http://monproxy.example.org',
    3 => 'spip.net',
  ],
  1 => 
   [
    0 => '',
    1 => 'sous.domaine.spip.net',
    2 => 'http://monproxy.example.org',
    3 => '.spip.net',
  ],
  2 => 
   [
    0 => '',
    1 => 'sous.domaine.spip.net',
    2 => 'http://monproxy.example.org',
    3 => '.spip.net
.net',
  ],
  3 => 
   [
    0 => '',
    1 => 'sous.domaine.spip.net',
    2 => 'http://monproxy.example.org',
    3 => 'sous.domaine.spip.net',
  ],
  4 => 
   [
    0 => 'http://monproxy.example.org',
    1 => 'sous.domaine.spip.net',
    2 => 'http://monproxy.example.org',
    3 => '.sous.domaine.spip.net',
  ],
];
		return $essais;
	}






?>