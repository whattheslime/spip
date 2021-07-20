<?php
/**
 * Test unitaire de la fonction url_to_ascii
 * du fichier ./inc/distant.php
 *
 * genere automatiquement par TestBuilder
 * le 2016-11-04 08:30
 */

	$test = 'url_to_ascii';
	$remonte = "../";
	while (!is_dir($remonte."ecrire"))
		$remonte = "../$remonte";
	require $remonte.'tests/test.inc';
	find_in_path("./inc/distant.php",'',true);

	// chercher la fonction si elle n'existe pas
	if (!function_exists($f='url_to_ascii')){
		find_in_path("inc/filtres.php",'',true);
		$f = chercher_filtre($f);
	}

	//
	// hop ! on y va
	//
	$err = tester_fun($f, essais_url_to_ascii());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_url_to_ascii(){
		$essais = array (
  0 => 
  array (
    0 => 'http://www.spip.net/',
    1 => 'http://www.spip.net/',
  ),
  1 => 
  array (
    0 => 'http://www.spip.net/fr_article879.html#BOUCLE-ARTICLES-',
    1 => 'http://www.spip.net/fr_article879.html#BOUCLE-ARTICLES-',
  ),
  2 => 
  array (
    0 => 'http://user:pass@www.spip.net:80/fr_article879.html#BOUCLE-ARTICLES-',
    1 => 'http://user:pass@www.spip.net:80/fr_article879.html#BOUCLE-ARTICLES-',
  ),
  3 => 
  array (
    0 => 'http://www.xn--spap-7pa.net/',
    1 => 'http://www.spaïp.net/',
  ),
  4 => 
  array (
    0 => 'http://www.xn--spap-7pa.net/fr_article879.html#BOUCLE-ARTICLES-',
    1 => 'http://www.spaïp.net/fr_article879.html#BOUCLE-ARTICLES-',
  ),
  5 => 
  array (
    0 => 'http://user:pass@www.xn--spap-7pa.net:80/fr_article879.html#BOUCLE-ARTICLES-',
    1 => 'http://user:pass@www.spaïp.net:80/fr_article879.html#BOUCLE-ARTICLES-',
  ),
);
		return $essais;
	}











?>