<?php
/**
 * Test unitaire de la fonction textebrut
 * du fichier inc/filtres.php
 *
 * genere automatiquement par TestBuilder
 * le 
 */

	$test = 'textebrut';
	require '../test.inc';
	find_in_path("inc/filtres.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('textebrut', essais_textebrut());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_textebrut(){
		$essais = array (
);
		return $essais;
	}




?>