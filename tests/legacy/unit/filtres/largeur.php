<?php
/**
 * Test unitaire de la fonction largeur
 * du fichier inc/filtres.php
 *
 * genere automatiquement par TestBuilder
 * le 
 */

	$test = 'largeur';
	$remonte = "../";
	while (!is_file($remonte."test.inc"))
		$remonte = "../$remonte";
	require $remonte.'test.inc';
	find_in_path("inc/filtres.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('largeur', essais_largeur());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_largeur(){
		$essais = array (
  0 => 
  array (
    0 => 300,
    1 => 'https://www.spip.net/IMG/logo/siteon0.png',
  ),
  2 =>
  array (
    0 => 231,
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
