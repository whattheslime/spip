<?php
/**
 * Test unitaire de la fonction filtre_identite
 * du fichier inc/filtres.php
 *
 * genere automatiquement par testbuilder
 * le 
 */

	$test = 'filtre_identite';
	require '../test.inc';
	find_in_path("inc/filtres.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('filtre_identite', essais_filtre_identite());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";

	function essais_filtre_identite(){
		$essais = array (
  2 => 
  array (
    0 => NULL,
    1 => NULL,
  ),
  3 => 
  array (
    0 => 
    array (
    ),
    1 => 
    array (
    ),
  ),
  4 => 
  array (
    0 => 'test',
    1 => 'test',
  ),
  6 => 
  array (
    0 => '"',
    1 => '"',
  ),
  7 => 
  array (
    0 => '<>"\'&',
    1 => '<>"\'&',
  ),
);
		return $essais;
	}


















?>