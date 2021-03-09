<?php
/**
 * Test unitaire de la fonction balise_img
 * du fichier inc/filtres.php
 *
 * genere automatiquement par TestBuilder
 * le 
 */

	$test = 'balise_img';
	$remonte = "../";
	while (!is_dir($remonte."ecrire"))
		$remonte = "../$remonte";
	require $remonte.'tests/test.inc';
	find_in_path("inc/filtres.php",'',true);

	//
	// hop ! on y va
	//
  if (!function_exists($f='balise_img')){
	  find_in_path("inc/filtres.php",'',true);
    $f = chercher_filtre($f);
  }
	$err = tester_fun($f, essais_balise_img());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_balise_img(){
		$essais = array (
  0 => 
  array (
    0 => '<img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'\' width=\'300\' height=\'223\' />',
    1 => 'https://www.spip.net/IMG/logo/siteon0.png',
  ),
  2 =>
  array (
    0 => '<img src=\'prive/images/logo-spip.png\' alt=\'\' width=\'231\' height=\'172\' />',
    1 => 'prive/images/logo-spip.png',
  ),
  3 => 
  array (
    0 => '',
    1 => 'prive/aide_body.css',
  ),
  4 => 
  array (
    0 => '<img src=\'prive/images/searching.gif\' alt=\'\' width=\'16\' height=\'16\' />',
    1 => 'prive/images/searching.gif',
  ),
  6 => 
  array (
    0 => '<img src=\'prive/images/searching.gif\' alt=\'attendez\' class=\'loading\' width=\'16\' height=\'16\' />',
    1 => 'prive/images/searching.gif',
    2 => 'attendez',
    3 => 'loading',
  ),
);
		return $essais;
	}

