<?php
/**
 * Test unitaire de la fonction heures
 * du fichier inc/filtres.php
 *
 * genere automatiquement par TestBuilder
 * le 
 */

	$test = 'wrap';
	require '../test.inc';
	find_in_path("inc/filtres.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('wrap', essais_wrap());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_wrap(){
		$essais = array (
  0 => 
  array (
    0 => '<h3>un mot</h3>',
    1 => 'un mot',
    2 => '<h3>',
  ),
  1 => 
  array (
    0 => '<h3><b>un mot</b></h3>',
    1 => 'un mot',
    2 => '<h3><b>',
  ),
  2 => 
  array (
    0 => '<h3 class="spip"><b>un mot</b></h3>',
    1 => 'un mot',
    2 => '<h3 class="spip"><b>',
  ),

);
		return $essais;
	}



?>