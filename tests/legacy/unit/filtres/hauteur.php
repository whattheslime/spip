<?php
/**
 * Test unitaire de la fonction hauteur
 * du fichier inc/filtres.php
 *
 * genere automatiquement par TestBuilder
 * le 
 */

	$test = 'hauteur';
	$remonte = "../";
	while (!is_file($remonte."test.inc"))
		$remonte = "../$remonte";
	require $remonte.'test.inc';
	find_in_path("inc/filtres.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('hauteur', essais_hauteur());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_hauteur(){
		$essais = array (
  0 => 
  array (
    0 => 223,
    1 => 'https://www.spip.net/IMG/logo/siteon0.png',
  ),
  2 =>
  array (
    0 => 172,
    1 => 'prive/images/logo-spip.png',
  ),
  3 => 
  array (
    0 => 0,
    1 => 'prive/aide_body.css',
  ),
  4 => 
  array (
    0 => 16,
    1 => 'prive/images/searching.gif',
  ),
);
		return $essais;
	}
