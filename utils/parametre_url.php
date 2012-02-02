<?php
/**
 * Test unitaire de la fonction parametre_url
 * du fichier ./inc/utils.php
 *
 * genere automatiquement par TestBuilder
 * le 2012-02-02 09:22
 */

	$test = 'parametre_url';
	$remonte = "../";
	while (!is_dir($remonte."ecrire"))
		$remonte = "../$remonte";
	require $remonte.'tests/test.inc';
	find_in_path("./inc/utils.php",'',true);

	// chercher la fonction si elle n'existe pas
	if (!function_exists($f='parametre_url')){
		find_in_path("inc/filtres.php",'',true);
		$f = chercher_filtre($f);
	}

	//
	// hop ! on y va
	//
	$err = tester_fun($f, essais_parametre_url());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_parametre_url(){
		$essais = array (
  0 => 
  array (
    0 => '/ecrire/?exec=exec&amp;id_obj=id_obj&amp;no_val&amp;ajout=valajout',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'ajout',
    3 => 'valajout',
  ),
  1 => 
  array (
    0 => '/ecrire/?exec=exec&amp;no_val',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'id_obj',
    3 => '',
  ),
  2 => 
  array (
    0 => '/ecrire/?exec=exec&amp;id_obj=changobj&amp;no_val',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'id_obj',
    3 => 'changobj',
  ),
  3 => 
  array (
    0 => '/ecrire/?exec=exec&amp;id_obj=id_obj&amp;no_val=yes_val',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'no_val',
    3 => 'yes_val',
  ),
  4 => 
  array (
    0 => '/ecrire/?exec=exec&amp;id_obj=id_obj',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'no_val',
    3 => '',
  ),
  5 => 
  array (
    0 => '/ecrire/?exec=exec&no_val',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'id_obj',
    3 => '',
    4 => '&',
  ),
  6 => 
  array (
    0 => '/ecrire/?exec=exec&id_obj=id_obj',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'no_val',
    3 => '',
    4 => '&',
  ),
  7 => 
  array (
    0 => 'id_objv',
    1 => '/ecrire/?exec=exec&id_obj=id_objv&no_val',
    2 => 'id_obj',
  ),
  8 => 
  array (
    0 => '',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'no_val',
  ),
  9 => 
  array (
    0 => NULL,
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'toto',
  ),
);
		return $essais;
	}

























?>