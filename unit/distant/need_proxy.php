<?php
/**
 * Test unitaire de la fonction need_proxy
 * du fichier ./inc/distant.php
 *
 * genere automatiquement par TestBuilder
 * le 2018-09-28 15:12
 */

	$test = 'need_proxy';
	$remonte = "../";
	while (!is_dir($remonte."ecrire"))
		$remonte = "../$remonte";
	require $remonte.'tests/test.inc';
	find_in_path("./inc/distant.php",'',true);

	// chercher la fonction si elle n'existe pas
	if (!function_exists($f='need_proxy')){
		find_in_path("inc/filtres.php",'',true);
		$f = chercher_filtre($f);
	}

	//
	// hop ! on y va
	//
	$err = tester_fun($f, essais_need_proxy());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_need_proxy(){
		$essais = array (
  0 => 
  array (
    0 => 'http://monproxy.example.org',
    1 => 'sous.domaine.spip.net',
    2 => 'http://monproxy.example.org',
    3 => 'spip.net',
  ),
  1 => 
  array (
    0 => '',
    1 => 'sous.domaine.spip.net',
    2 => 'http://monproxy.example.org',
    3 => '.spip.net',
  ),
  2 => 
  array (
    0 => '',
    1 => 'sous.domaine.spip.net',
    2 => 'http://monproxy.example.org',
    3 => '.spip.net
.net',
  ),
  3 => 
  array (
    0 => '',
    1 => 'sous.domaine.spip.net',
    2 => 'http://monproxy.example.org',
    3 => 'sous.domaine.spip.net',
  ),
  4 => 
  array (
    0 => 'http://monproxy.example.org',
    1 => 'sous.domaine.spip.net',
    2 => 'http://monproxy.example.org',
    3 => '.sous.domaine.spip.net',
  ),
);
		return $essais;
	}






?>