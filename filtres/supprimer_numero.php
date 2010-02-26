<?php
/**
 * Test unitaire de la fonction supprimer_numero
 * du fichier inc/filtres.php
 *
 * genere automatiquement par TestBuilder
 * le 
 */

	$test = 'supprimer_numero';
	require '../test.inc';
	find_in_path("inc/filtres.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('supprimer_numero', essais_supprimer_numero());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_supprimer_numero(){
		$essais = array (
  0 => 
  array (
    0 => '1.titre',
    1 => '1.titre',
  ),
  1 => 
  array (
    0 => 'titre',
    1 => '1. titre',
  ),
  2 => 
  array (
    0 => '1 .titre',
    1 => '1 .titre',
  ),
  3 => 
  array (
    0 => '1 . titre',
    1 => '1 . titre',
  ),
  5 => 
  array (
    0 => 'titre',
    1 => '0. titre',
  ),
  6 => 
  array (
    0 => 'titre',
    1 => ' 0. titre',
  ),
  7 => 
  array (
    0 => '-1. titre',
    1 => '-1. titre',
  ),
);
		return $essais;
	}
























?>