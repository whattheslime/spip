<?php
/**
 * Test unitaire de la fonction protocole_verifier
 * du fichier ./inc/filtres_mini.php
 *
 * genere automatiquement par TestBuilder
 * le 2018-09-26 10:24
 */

	$test = 'protocole_verifier';
	$remonte = "../";
	while (!is_dir($remonte."ecrire"))
		$remonte = "../$remonte";
	require $remonte.'tests/test.inc';
	find_in_path("./inc/filtres_mini.php",'',true);

	// chercher la fonction si elle n'existe pas
	if (!function_exists($f='protocole_verifier')){
		find_in_path("inc/filtres.php",'',true);
		$f = chercher_filtre($f);
	}

	//
	// hop ! on y va
	//
	$err = tester_fun($f, essais_protocole_verifier());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_protocole_verifier(){
		$essais = array (
  0 => 
  array (
    0 => true,
    1 => 'http://www.spip.net',
  ),
  1 => 
  array (
    0 => true,
    1 => 'https://www.spip.net',
  ),
  2 => 
  array (
    0 => false,
    1 => 'ftp://www.spip.net',
  ),
  3 => 
  array (
    0 => true,
    1 => 'ftp://www.spip.net',
    2 => 
    array (
      0 => 'http',
      1 => 'https',
      2 => 'ftp',
    ),
  ),
  4 => 
  array (
    0 => false,
    1 => '/etc/password',
  ),
  5 => 
  array (
    0 => false,
    1 => 'squelettes/img/recherche.png',
  ),
  6 => 
  array (
    0 => true,
    1 => 'HTTP://WWW.SPIP.NET',
  ),
  7 => 
  array (
    0 => true,
    1 => 'http://www.spip.net',
    2 => 
    array (
      0 => 'HTTP',
      1 => 'HTTPS',
    ),
  ),
);
		return $essais;
	}









?>