<?php
/**
 * Test unitaire de la fonction filtre_balise_img_dist
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
function test_filtres_filtre_balise_img_dist(...$args) {
	static $f = null;
	if (is_null($f)){
		// chercher la fonction si elle n'existe pas
		if (!function_exists($f = 'filtre_balise_img_dist')){
			find_in_path("inc/filtres.php", '', true);
			$f = chercher_filtre($f);
		}
	}
	$res = $f(...$args);
	$res = preg_replace(",\?\d+,", '', $res);
	return $res;
}

/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_filtres_filtre_balise_img_dist(){
		$essais =  [
	   [
	    0 => '<img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'\' width=\'300\' height=\'223\' />',
	    1 => 'https://www.spip.net/IMG/logo/siteon0.png',
	  ],
	   [
	    0 => '<img src=\'prive/images/logo-spip.png\' alt=\'\' width=\'231\' height=\'172\' />',
	    1 => 'prive/images/logo-spip.png',
	  ],
	   [
	    0 => '',
	    1 => 'prive/aide_body.css',
	  ],
	   [
	    0 => '<img src=\'prive/images/searching.gif\' alt=\'\' width=\'16\' height=\'16\' />',
	    1 => 'prive/images/searching.gif',
	  ],
	   [
	    0 => '<img src=\'prive/images/searching.gif\' alt=\'attendez\' class=\'loading\' width=\'16\' height=\'16\' />',
	    1 => 'prive/images/searching.gif',
	    2 => 'attendez',
	    3 => 'loading',
	  ],

   [
    0 => '<img src=\'spip.png\' alt=\'\' width=\'60\' height=\'40\' />',
    1 => 'spip.png',
  ],
  1 => 
   [
    0 => '<img src=\'spip.png\' alt=\'This is SPIP\' width=\'60\' height=\'40\' />',
    1 => 'spip.png',
    2 => 'This is SPIP',
  ],
  2 => 
   [
    0 => '<img src=\'spip.png\' alt=\'This is SPIP\' class=\'spip_logo\' width=\'60\' height=\'40\' />',
    1 => 'spip.png',
    2 => 'This is SPIP',
    3 => 'spip_logo',
  ],
   [
    0 => '<img src=\'spip.png\' alt=\'This is SPIP\' class=\'spip_logo\' width=\'30\' height=\'20\' />',
    1 => 'spip.png',
    2 => 'This is SPIP',
    3 => 'spip_logo',
    4 => '@2x',
  ],
   [
    0 => '<img src=\'spip.png\' alt=\'This is SPIP\' class=\'spip_logo\' width=\'20\' height=\'20\' />',
    1 => 'spip.png',
    2 => 'This is SPIP',
    3 => 'spip_logo',
    4 => '20',
  ],
   [
    0 => '<img src=\'spip.png\' alt=\'This is SPIP\' class=\'spip_logo\' width=\'90\' height=\'60\' />',
    1 => 'spip.png',
    2 => 'This is SPIP',
    3 => 'spip_logo',
    4 => '90x*',
  ],
   [
    0 => '<img src=\'spip.png\' alt=\'This is SPIP\' class=\'spip_logo\' width=\'50\' height=\'30\' />',
    1 => 'spip.png',
    2 => 'This is SPIP',
    3 => 'spip_logo',
    4 => '50x30',
  ],
   [
    0 => '<img src=\'spip.png\' alt=\'This is SPIP\' width=\'30\' height=\'20\' />',
    1 => 'spip.png',
    2 => 'This is SPIP',
    3 => '@2x',
  ],
   [
    0 => '<img src=\'spip.png\' alt=\'This is SPIP\' width=\'20\' height=\'20\' />',
    1 => 'spip.png',
    2 => 'This is SPIP',
    3 => '20',
  ],
   [
    0 => '<img src=\'spip.png\' alt=\'This is SPIP\' width=\'90\' height=\'60\' />',
    1 => 'spip.png',
    2 => 'This is SPIP',
    3 => '90x*',
  ],
   [
    0 => '<img src=\'spip.png\' alt=\'This is SPIP\' width=\'50\' height=\'30\' />',
    1 => 'spip.png',
    2 => 'This is SPIP',
    3 => '50x30',
  ],
   [
    0 => '<img src=\'spip.png\' width=\'30\' height=\'20\' />',
    1 => 'spip.png',
    2 => '@2x',
  ],
   [
    0 => '<img src=\'spip.png\' width=\'20\' height=\'20\' />',
    1 => 'spip.png',
    2 => '20',
  ],
   [
    0 => '<img src=\'spip.png\' width=\'90\' height=\'60\' />',
    1 => 'spip.png',
    2 => '90x*',
  ],
   [
    0 => '<img src=\'spip.png\' width=\'50\' height=\'30\' />',
    1 => 'spip.png',
    2 => '50x30',
  ],

   [
    0 => '<img src=\'spip.svg\' alt=\'\' width=\'60\' height=\'40\' />',
    1 => 'spip.svg',
  ],
   [
    0 => '<img src=\'spip.svg\' alt=\'This is SPIP\' width=\'60\' height=\'40\' />',
    1 => 'spip.svg',
    2 => 'This is SPIP',
  ],
   [
    0 => '<img src=\'spip.svg\' alt=\'This is SPIP\' class=\'spip_logo\' width=\'60\' height=\'40\' />',
    1 => 'spip.svg',
    2 => 'This is SPIP',
    3 => 'spip_logo',
  ],
   [
    0 => '<img src=\'spip.svg\' alt=\'This is SPIP\' class=\'spip_logo\' width=\'30\' height=\'20\' />',
    1 => 'spip.svg',
    2 => 'This is SPIP',
    3 => 'spip_logo',
    4 => '@2x',
  ],
   [
    0 => '<img src=\'spip.svg\' alt=\'This is SPIP\' class=\'spip_logo\' width=\'20\' height=\'20\' />',
    1 => 'spip.svg',
    2 => 'This is SPIP',
    3 => 'spip_logo',
    4 => '20',
  ],
  25 =>
   [
    0 => '<img src=\'spip.svg\' alt=\'This is SPIP\' class=\'spip_logo\' width=\'90\' height=\'60\' />',
    1 => 'spip.svg',
    2 => 'This is SPIP',
    3 => 'spip_logo',
    4 => '90x*',
  ],
  26 =>
   [
    0 => '<img src=\'spip.svg\' alt=\'This is SPIP\' class=\'spip_logo\' width=\'50\' height=\'30\' />',
    1 => 'spip.svg',
    2 => 'This is SPIP',
    3 => 'spip_logo',
    4 => '50x30',
  ],
   [
    0 => '<img src=\'spip.svg\' alt=\'This is SPIP\' width=\'30\' height=\'20\' />',
    1 => 'spip.svg',
    2 => 'This is SPIP',
    3 => '@2x',
  ],
   [
    0 => '<img src=\'spip.svg\' alt=\'This is SPIP\' width=\'20\' height=\'20\' />',
    1 => 'spip.svg',
    2 => 'This is SPIP',
    3 => '20',
  ],
   [
    0 => '<img src=\'spip.svg\' alt=\'This is SPIP\' width=\'90\' height=\'60\' />',
    1 => 'spip.svg',
    2 => 'This is SPIP',
    3 => '90x*',
  ],
   [
    0 => '<img src=\'spip.svg\' alt=\'This is SPIP\' width=\'50\' height=\'30\' />',
    1 => 'spip.svg',
    2 => 'This is SPIP',
    3 => '50x30',
  ],
   [
    0 => '<img src=\'spip.svg\' width=\'30\' height=\'20\' />',
    1 => 'spip.svg',
    2 => '@2x',
  ],
   [
    0 => '<img src=\'spip.svg\' width=\'20\' height=\'20\' />',
    1 => 'spip.svg',
    2 => '20',
  ],
   [
    0 => '<img src=\'spip.svg\' width=\'90\' height=\'60\' />',
    1 => 'spip.svg',
    2 => '90x*',
  ],
   [
    0 => '<img src=\'spip.svg\' width=\'50\' height=\'30\' />',
    1 => 'spip.svg',
    2 => '50x30',
  ],
];
		return $essais;
	}

?>