<?php
/**
 * Test unitaire de la fonction lien_ou_expose
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
function test_filtres_lien_ou_expose(...$args) {
	return lien_ou_expose(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_filtres_lien_ou_expose(){
		$essais = array (
  0 => 
  array (
    0 => '<strong class="on">libelle</strong>',
    1 => 'http://www.spip.net/',
    2 => 'libelle',
    3 => true,
  ),
  1 => 
  array (
    0 => '<a href=\'http://www.spip.net/\'>libelle</a>',
    1 => 'http://www.spip.net/',
    2 => 'libelle',
    3 => false,
  ),
  2 => 
  array (
    0 => '<strong class="on">0</strong>',
    1 => 'http://www.spip.net/',
    2 => 0,
    3 => true,
  ),
  3 => 
  array (
    0 => '<strong class="on">-1</strong>',
    1 => 'http://www.spip.net/',
    2 => -1,
    3 => true,
  ),
  4 => 
  array (
    0 => '<strong class="on">1</strong>',
    1 => 'http://www.spip.net/',
    2 => 1,
    3 => true,
  ),
  5 => 
  array (
    0 => '<strong class="on">2</strong>',
    1 => 'http://www.spip.net/',
    2 => 2,
    3 => true,
  ),
  6 => 
  array (
    0 => '<strong class="on">3</strong>',
    1 => 'http://www.spip.net/',
    2 => 3,
    3 => true,
  ),
  7 => 
  array (
    0 => '<strong class="on">4</strong>',
    1 => 'http://www.spip.net/',
    2 => 4,
    3 => true,
  ),
  8 => 
  array (
    0 => '<strong class="on">5</strong>',
    1 => 'http://www.spip.net/',
    2 => 5,
    3 => true,
  ),
  9 => 
  array (
    0 => '<strong class="on">6</strong>',
    1 => 'http://www.spip.net/',
    2 => 6,
    3 => true,
  ),
  10 => 
  array (
    0 => '<strong class="on">7</strong>',
    1 => 'http://www.spip.net/',
    2 => 7,
    3 => true,
  ),
  11 => 
  array (
    0 => '<strong class="on">10</strong>',
    1 => 'http://www.spip.net/',
    2 => 10,
    3 => true,
  ),
  12 => 
  array (
    0 => '<strong class="on">20</strong>',
    1 => 'http://www.spip.net/',
    2 => 20,
    3 => true,
  ),
  13 => 
  array (
    0 => '<strong class="on">30</strong>',
    1 => 'http://www.spip.net/',
    2 => 30,
    3 => true,
  ),
  14 => 
  array (
    0 => '<strong class="on">50</strong>',
    1 => 'http://www.spip.net/',
    2 => 50,
    3 => true,
  ),
  15 => 
  array (
    0 => '<strong class="on">100</strong>',
    1 => 'http://www.spip.net/',
    2 => 100,
    3 => true,
  ),
  16 => 
  array (
    0 => '<strong class="on">1000</strong>',
    1 => 'http://www.spip.net/',
    2 => 1000,
    3 => true,
  ),
  17 => 
  array (
    0 => '<strong class="on">10000</strong>',
    1 => 'http://www.spip.net/',
    2 => 10000,
    3 => true,
  ),
  18 => 
  array (
    0 => '<strong class="on">0</strong>',
    1 => 'http://www.spip.net/',
    2 => '0',
    3 => true,
  ),
  19 => 
  array (
    0 => '<strong class="on">SPIP</strong>',
    1 => 'http://www.spip.net/',
    2 => 'SPIP',
    3 => true,
    4 => 'lien',
  ),
  20 => 
  array (
    0 => '<a href=\'http://www.spip.net/\' class=\'lien\'>SPIP</a>',
    1 => 'http://www.spip.net/',
    2 => 'SPIP',
    3 => false,
    4 => 'lien',
  ),
  21 => 
  array (
    0 => '<strong class="on">SPIP</strong>',
    1 => 'http://www.spip.net/',
    2 => 'SPIP',
    3 => true,
    4 => '',
    5 => 'titre',
  ),
  22 => 
  array (
    0 => '<a href=\'http://www.spip.net/\' title=\'titre\'>SPIP</a>',
    1 => 'http://www.spip.net/',
    2 => 'SPIP',
    3 => false,
    4 => '',
    5 => 'titre',
  ),
  23 => 
  array (
    0 => '<strong class="on">SPIP</strong>',
    1 => 'http://www.spip.net/',
    2 => 'SPIP',
    3 => true,
    4 => '',
    5 => '',
    6 => 'prev',
  ),
  24 => 
  array (
    0 => '<a href=\'http://www.spip.net/\' rel=\'prev\'>SPIP</a>',
    1 => 'http://www.spip.net/',
    2 => 'SPIP',
    3 => false,
    4 => '',
    5 => '',
    6 => 'prev',
  ),
  25 => 
  array (
    0 => '<strong class="on">SPIP</strong>',
    1 => 'http://www.spip.net/',
    2 => 'SPIP',
    3 => true,
    4 => '',
    5 => '',
    6 => '',
    7 => ' onclick="alert(\'toto\');"',
  ),
  26 => 
  array (
    0 => '<a href=\'http://www.spip.net/\' onclick="alert(\'toto\');">SPIP</a>',
    1 => 'http://www.spip.net/',
    2 => 'SPIP',
    3 => false,
    4 => '',
    5 => '',
    6 => '',
    7 => ' onclick="alert(\'toto\');"',
  ),
);
		return $essais;
	}

