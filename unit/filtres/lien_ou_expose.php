<?php
/**
 * Test unitaire de la fonction lien_ou_expose
 * du fichier ./inc/filtres.php
 *
 * genere automatiquement par TestBuilder
 * le 2011-01-07 10:18
 */

	$test = 'lien_ou_expose';
	$remonte = "../";
	while (!is_dir($remonte."ecrire"))
		$remonte = "../$remonte";
	require $remonte.'tests/test.inc';
	find_in_path("./inc/filtres.php",'',true);

	// chercher la fonction si elle n'existe pas
	if (!function_exists($f='lien_ou_expose')){
		find_in_path("inc/filtres.php",'',true);
		$f = chercher_filtre($f);
	}

	//
	// hop ! on y va
	//
	$err = tester_fun($f, essais_lien_ou_expose());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_lien_ou_expose(){
		$essais = array (
  0 => 
  array (
    0 => '<strong class=\'on\'>libelle</strong>',
    1 => 'http://www.spip.net/',
    2 => 'libelle',
    3 => true,
  ),
  1 => 
  array (
    0 => '<a href=\'http://www.spip.net/\'>libelle</a>',
    1 => 'http://www.spip.net/',
    2 => 'libelle',
    3 => false,
  ),
  2 => 
  array (
    0 => '<strong class=\'on\'>0</strong>',
    1 => 'http://www.spip.net/',
    2 => 0,
    3 => true,
  ),
  3 => 
  array (
    0 => '<strong class=\'on\'>-1</strong>',
    1 => 'http://www.spip.net/',
    2 => -1,
    3 => true,
  ),
  4 => 
  array (
    0 => '<strong class=\'on\'>1</strong>',
    1 => 'http://www.spip.net/',
    2 => 1,
    3 => true,
  ),
  5 => 
  array (
    0 => '<strong class=\'on\'>2</strong>',
    1 => 'http://www.spip.net/',
    2 => 2,
    3 => true,
  ),
  6 => 
  array (
    0 => '<strong class=\'on\'>3</strong>',
    1 => 'http://www.spip.net/',
    2 => 3,
    3 => true,
  ),
  7 => 
  array (
    0 => '<strong class=\'on\'>4</strong>',
    1 => 'http://www.spip.net/',
    2 => 4,
    3 => true,
  ),
  8 => 
  array (
    0 => '<strong class=\'on\'>5</strong>',
    1 => 'http://www.spip.net/',
    2 => 5,
    3 => true,
  ),
  9 => 
  array (
    0 => '<strong class=\'on\'>6</strong>',
    1 => 'http://www.spip.net/',
    2 => 6,
    3 => true,
  ),
  10 => 
  array (
    0 => '<strong class=\'on\'>7</strong>',
    1 => 'http://www.spip.net/',
    2 => 7,
    3 => true,
  ),
  11 => 
  array (
    0 => '<strong class=\'on\'>10</strong>',
    1 => 'http://www.spip.net/',
    2 => 10,
    3 => true,
  ),
  12 => 
  array (
    0 => '<strong class=\'on\'>20</strong>',
    1 => 'http://www.spip.net/',
    2 => 20,
    3 => true,
  ),
  13 => 
  array (
    0 => '<strong class=\'on\'>30</strong>',
    1 => 'http://www.spip.net/',
    2 => 30,
    3 => true,
  ),
  14 => 
  array (
    0 => '<strong class=\'on\'>50</strong>',
    1 => 'http://www.spip.net/',
    2 => 50,
    3 => true,
  ),
  15 => 
  array (
    0 => '<strong class=\'on\'>100</strong>',
    1 => 'http://www.spip.net/',
    2 => 100,
    3 => true,
  ),
  16 => 
  array (
    0 => '<strong class=\'on\'>1000</strong>',
    1 => 'http://www.spip.net/',
    2 => 1000,
    3 => true,
  ),
  17 => 
  array (
    0 => '<strong class=\'on\'>10000</strong>',
    1 => 'http://www.spip.net/',
    2 => 10000,
    3 => true,
  ),
  18 => 
  array (
    0 => '<strong class=\'on\'>0</strong>',
    1 => 'http://www.spip.net/',
    2 => '0',
    3 => true,
  ),
  19 => 
  array (
    0 => '<strong class=\'on\'>SPIP</strong>',
    1 => 'http://www.spip.net/',
    2 => 'SPIP',
    3 => true,
    4 => 'lien',
  ),
  20 => 
  array (
    0 => '<a href=\'http://www.spip.net/\' class=\'lien\'>SPIP</a>',
    1 => 'http://www.spip.net/',
    2 => 'SPIP',
    3 => false,
    4 => 'lien',
  ),
  21 => 
  array (
    0 => '<strong class=\'on\'>SPIP</strong>',
    1 => 'http://www.spip.net/',
    2 => 'SPIP',
    3 => true,
    4 => '',
    5 => 'titre',
  ),
  22 => 
  array (
    0 => '<a href=\'http://www.spip.net/\' title=\'titre\'>SPIP</a>',
    1 => 'http://www.spip.net/',
    2 => 'SPIP',
    3 => false,
    4 => '',
    5 => 'titre',
  ),
  23 => 
  array (
    0 => '<strong class=\'on\'>SPIP</strong>',
    1 => 'http://www.spip.net/',
    2 => 'SPIP',
    3 => true,
    4 => '',
    5 => '',
    6 => 'prev',
  ),
  24 => 
  array (
    0 => '<a href=\'http://www.spip.net/\' rel=\'prev\'>SPIP</a>',
    1 => 'http://www.spip.net/',
    2 => 'SPIP',
    3 => false,
    4 => '',
    5 => '',
    6 => 'prev',
  ),
  25 => 
  array (
    0 => '<strong class=\'on\'>SPIP</strong>',
    1 => 'http://www.spip.net/',
    2 => 'SPIP',
    3 => true,
    4 => '',
    5 => '',
    6 => '',
    7 => ' onclick="alert(\'toto\');"',
  ),
  26 => 
  array (
    0 => '<a href=\'http://www.spip.net/\' onclick="alert(\'toto\');">SPIP</a>',
    1 => 'http://www.spip.net/',
    2 => 'SPIP',
    3 => false,
    4 => '',
    5 => '',
    6 => '',
    7 => ' onclick="alert(\'toto\');"',
  ),
);
		return $essais;
	}





































?>