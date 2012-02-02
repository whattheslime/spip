<?php
/**
 * Test unitaire de la fonction taille_en_octets
 * du fichier inc/filtres.php
 *
 * genere automatiquement par TestBuilder
 * le 
 */

	$test = 'taille_en_octets';
	require '../test.inc';
	find_in_path("inc/filtres.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('taille_en_octets', essais_taille_en_octets());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_taille_en_octets(){
		$essais = array (
  0 => 
  array (
    0 => '0 octets',
    1 => 0,
  ),
  1 => 
  array (
    0 => '-1 octets',
    1 => -1,
  ),
  2 => 
  array (
    0 => '1 octets',
    1 => 1,
  ),
  3 => 
  array (
    0 => '2 octets',
    1 => 2,
  ),
  4 => 
  array (
    0 => '3 octets',
    1 => 3,
  ),
  5 => 
  array (
    0 => '4 octets',
    1 => 4,
  ),
  6 => 
  array (
    0 => '5 octets',
    1 => 5,
  ),
  7 => 
  array (
    0 => '6 octets',
    1 => 6,
  ),
  8 => 
  array (
    0 => '7 octets',
    1 => 7,
  ),
  9 => 
  array (
    0 => '10 octets',
    1 => 10,
  ),
  10 => 
  array (
    0 => '20 octets',
    1 => 20,
  ),
  11 => 
  array (
    0 => '30 octets',
    1 => 30,
  ),
  12 => 
  array (
    0 => '50 octets',
    1 => 50,
  ),
  13 => 
  array (
    0 => '100 octets',
    1 => 100,
  ),
  14 => 
  array (
    0 => '1000 octets',
    1 => 1000,
  ),
  15 => 
  array (
    0 => '9.8 ko',
    1 => 10000,
  ),
	16 =>
  array (
    0 => '97.7 ko',
    1 => 100000,
  ),
	17 =>
  array (
    0 => '976.6 ko',
    1 => 1000000,
  ),
	18 =>
  array (
    0 => '9.5 Mo',
    1 => 10000000,
  ),
	19 =>
  array (
    0 => '95.4 Mo',
    1 => 100000000,
  ),
	20 =>
  array (
    0 => '953.7 Mo',
    1 => 1000000000,
  ),
	21 =>
  array (
    0 => '9.31 Go',
    1 => 10000000000,
  ),
);
		return $essais;
	}



?>