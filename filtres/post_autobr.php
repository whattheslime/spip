<?php
/**
 * Test unitaire de la fonction post_autobr
 * du fichier ./inc/filtres.php
 *
 * genere automatiquement par TestBuilder
 * le 2011-05-27 12:10
 */

	$test = 'post_autobr';
	$remonte = "../";
	while (!is_dir($remonte."ecrire"))
		$remonte = "../$remonte";
	require $remonte.'tests/test.inc';
	find_in_path("./inc/filtres.php",'',true);

	// chercher la fonction si elle n'existe pas
	if (!function_exists($f='post_autobr')){
		find_in_path("inc/filtres.php",'',true);
		$f = chercher_filtre($f);
	}

	//
	// hop ! on y va
	//
	$err = tester_fun($f, essais_post_autobr());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_post_autobr(){
		$essais = array (
  0 => 
  array (
    0 => 'Texte avec un 
_ un retour simple à la ligne.',
    1 => 'Texte avec un 
un retour simple à la ligne.',
    2 => '
_ ',
  ),
  1 => 
  array (
    0 => '<cadre>cadre contenant un
retour simple (doit rester inchangé)</cadre>',
    1 => '<cadre>cadre contenant un
retour simple (doit rester inchangé)</cadre>',
    2 => '
_ ',
  ),
  2 => 
  array (
    0 => 'Un double saut de ligne

 ne doit pas être modifié par post_autobr.',
    1 => 'Un double saut de ligne

 ne doit pas être modifié par post_autobr.',
    2 => '
_ ',
  ),
  3 => 
  array (
    0 => '<modele123|param1=un appel de modèle
_   |param2=avec retour à la ligne
_   ne doit pas être modifié>',
    1 => '<modele123|param1=un appel de modèle
  |param2=avec retour à la ligne
  ne doit pas être modifié>',
    2 => '
_ ',
  ),
);
		return $essais;
	}







?>