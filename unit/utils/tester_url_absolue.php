<?php
/**
 * Test unitaire de la fonction tester_url_absolue
 * du fichier ./inc/utils.php
 *
 * genere automatiquement par TestBuilder
 * le 2011-01-07 09:11
 */

	$test = 'tester_url_absolue';
	$remonte = "../";
	while (!is_dir($remonte."ecrire"))
		$remonte = "../$remonte";
	require $remonte.'tests/test.inc';
	find_in_path("./inc/utils.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('tester_url_absolue', essais_tester_url_absolue());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_tester_url_absolue(){
		$essais = array (
  0 => 
  array (
    0 => true,
    1 => 'http://www.spip.net/',
  ),
  1 => 
  array (
    0 => true,
    1 => 'https://www.spip.net/',
  ),
  2 => 
  array (
    0 => true,
    1 => 'http://www.spip.net/sousrep/fr/',
  ),
  3 => 
  array (
    0 => true,
    1 => 'ftp://www.spip.net/',
  ),
  4 => 
  array (
    0 => true,
    1 => '//www.spip.net/',
  ),
  5 => 
  array (
    0 => false,
    1 => '/spip/?page=sommaire',
  ),
  6 => 
  array (
    0 => false,
    1 => 'spip/?page=sommaire',
  ),
);
		return $essais;
	}








?>