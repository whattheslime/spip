<?php
/**
 * Test unitaire de la fonction chercher_filtre
 * du fichier inc/filtres.php
 *
 * genere automatiquement par testbuilder
 * le 
 */

	$test = 'chercher_filtre';
	require '../test.inc';
	find_in_path("inc/filtres.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('chercher_filtre', essais_chercher_filtre());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_chercher_filtre(){
		$essais = array (
  0 => 
  array (
    0 => 'filtre_identite',
    1 => 'identite',
  ),
  1 => 
  array (
    0 => 'identite',
    1 => 'zzhkezhkf',
    2 => 'identite',
  ),
  3 => 
  array (
    0 => 'identite',
    1 => NULL,
    2 => 'identite',
  ),
  4 => 
  array (
    0 => 'filtre_text_txt_dist',
    1 => 'text_txt',
  ),
  5 => 
  array (
    0 => 'filtre_implode_dist',
    1 => 'implode',
  ),
);
		return $essais;
	}







?>