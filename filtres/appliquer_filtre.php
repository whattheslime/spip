<?php
/**
 * Test unitaire de la fonction appliquer_filtre
 * du fichier inc/filtres.php
 *
 * genere automatiquement par testbuilder
 * le 
 */

	$test = 'appliquer_filtre';
	require '../test.inc';
	find_in_path("inc/filtres.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('appliquer_filtre', essais_appliquer_filtre());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

					function essais_appliquer_filtre(){
		$essais = array (
  0 => 
  array (
    0 => '&lt;&gt;&quot;\'&amp;',
    1 => '<>"\'&',
    2 => 'entites_html',
  ),
  1 => 
  array (
    0 => '&amp;',
    1 => '&amp;',
    2 => 'entites_html',
  ),
);
		return $essais;
	}





?>