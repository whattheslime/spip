<?php
/**
 * Test unitaire de la fonction hauteur
 * du fichier inc/filtres.php
 *
 * genere automatiquement par TestBuilder
 * le 
 */

	$test = 'hauteur';
	require '../test.inc';
	find_in_path("inc/filtres.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('hauteur', essais_hauteur());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_hauteur(){
		$essais = array (
  0 => 
  array (
    0 => 137,
    1 => 'http://www.spip.net/squelettes/img/spip.png',
  ),
  1 => 
  array (
    0 => 92,
    1 => 'prive/images/logo_spip.jpg',
  ),
  2 => 
  array (
    0 => 170,
    1 => 'prive/images/logo-spip.gif',
  ),
  3 => 
  array (
    0 => 0,
    1 => 'prive/aide_body.css',
  ),
  4 => 
  array (
    0 => 16,
    1 => 'prive/images/searching.gif',
  ),
);
		return $essais;
	}



?>