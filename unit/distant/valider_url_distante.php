<?php
/**
 * Test unitaire de la fonction valider_url_distante
 * du fichier ./inc/distant.php
 *
 * genere automatiquement par TestBuilder
 * le 2018-09-26 10:54
 */

	$test = 'valider_url_distante';
	$remonte = "../";
	while (!is_dir($remonte."ecrire"))
		$remonte = "../$remonte";
	require $remonte.'tests/test.inc';
	find_in_path("./inc/distant.php",'',true);

	// chercher la fonction si elle n'existe pas
	if (!function_exists($f='valider_url_distante')){
		find_in_path("inc/filtres.php",'',true);
		$f = chercher_filtre($f);
	}

	//
	// hop ! on y va
	//
	$err = tester_fun($f, essais_valider_url_distante());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_valider_url_distante(){
		$essais = array (
  0 => 
  array (
    0 => 'http://www.spip.net',
    1 => 'http://www.spip.net',
  ),
  1 => 
  array (
    0 => 'https://www.spip.net',
    1 => 'https://www.spip.net',
  ),
  2 => 
  array (
    0 => false,
    1 => 'ftp://www.spip.net',
  ),
  3 => 
  array (
    0 => false,
    1 => 'http://user@www.spip.net',
  ),
  4 => 
  array (
    0 => false,
    1 => 'https://user:password@www.spip.net',
  ),
  5 => 
  array (
    0 => false,
    1 => 'http://127.0.0.1/munin/graph.png',
  ),
  6 => 
  array (
    0 => false,
    1 => 'http://localhost:8765',
  ),
  7 => 
  array (
    0 => 'http://localhost:8765/test.png',
    1 => 'http://localhost:8765/test.png',
    2 => 
    array (
      0 => 'localhost:8765',
    ),
  ),
  8 => 
  array (
    0 => false,
    1 => 'http://localhost:9100/test.png',
  ),
  9 => 
  array (
    0 => false,
    1 => 'http://user@password:localhost:8765/test.png',
    2 => 
    array (
      0 => 'localhost:8765',
    ),
  ),
  10 => 
  array (
    0 => false,
    1 => 'http://user@password:localhost:8765/test.png',
    2 => 
    array (
      0 => 'http://user@password:localhost:8765',
    ),
  ),
);
		return $essais;
	}












?>