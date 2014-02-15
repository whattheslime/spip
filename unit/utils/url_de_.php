<?php
/**
 * Test unitaire de la fonction url_de_
 * du fichier ./inc/utils.php
 *
 * genere automatiquement par TestBuilder
 * le 2010-03-28 18:18
 */

	$test = 'url_de_';
	$remonte = "../";
	while (!is_dir($remonte."ecrire"))
		$remonte = "../$remonte";
	require $remonte.'tests/test.inc';
	find_in_path("./inc/utils.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('url_de_', essais_url_de_());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_url_de_(){
		$essais = array (
  0 => 
  array (
    0 => 'http://www.example.org/',
    1 => 'http',
    2 => 'www.example.org',
    3 => '',
    4 => 0,
  ),
  1 => 
  array (
    0 => 'http://www.example.org/',
    1 => 'http',
    2 => 'www.example.org',
    3 => '/spip.php',
    4 => 0,
  ),
  2 => 
  array (
    0 => 'http://www.example.org/',
    1 => 'http',
    2 => 'www.example.org',
    3 => '/spip.php?page=demo',
    4 => 0,
  ),
  3 => 
  array (
    0 => 'http://www.example.org/sousrep/',
    1 => 'http',
    2 => 'www.example.org',
    3 => '/sousrep/spip.php?page=demo',
    4 => 0,
  ),
  4 => 
  array (
    0 => 'http://www.example.org/sousrep/url/arbo/',
    1 => 'http',
    2 => 'www.example.org',
    3 => '/sousrep/url/arbo/page.html',
    4 => 0,
  ),
  5 => 
  array (
    0 => 'http://www.example.org/sousrep/url/',
    1 => 'http',
    2 => 'www.example.org',
    3 => '/sousrep/url/arbo/page.html',
    4 => 1,
  ),
  6 => 
  array (
    0 => 'http://www.example.org/sousrep/',
    1 => 'http',
    2 => 'www.example.org',
    3 => '/sousrep/url/arbo/page.html',
    4 => 2,
  ),
  7 => 
  array (
    0 => 'http://www.example.org/',
    1 => 'http',
    2 => 'www.example.org',
    3 => '/sousrep/url/arbo/page.html',
    4 => 3,
  ),
  8 => 
  array (
    0 => 'http://www.example.org/',
    1 => 'http',
    2 => 'www.example.org',
    3 => '/sousrep/url/arbo/page.html',
    4 => 4,
  ),
  9 => 
  array (
    0 => 'http:///',
    1 => 'http',
    2 => '',
    3 => '',
    4 => 0,
  ),
);
		return $essais;
	}












?>