<?php
/**
 * Test unitaire de la fonction recuperer_numero
 * du fichier inc/filtres.php
 *
 * genere automatiquement par TestBuilder
 * le 
 */

	$test = 'recuperer_numero';
	require '../test.inc';
	find_in_path("inc/filtres.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('recuperer_numero', essais_recuperer_numero());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_recuperer_numero(){
		$essais = array (
  0 => 
  array (
    0 => 1,
    1 => '1. titre',
  ),
  1 => 
  array (
    0 => '',
    1 => '1.titre',
  ),
  2 => 
  array (
    0 => '',
    1 => '1 .titre',
  ),
  3 => 
  array (
    0 => '',
    1 => '1 . titre',
  ),
  4 => 
  array (
    0 => 0,
    1 => '0. titre',
  ),
  5 => 
  array (
    0 => '',
    1 => '-1. titre',
  ),
);
		return $essais;
	}


















?>