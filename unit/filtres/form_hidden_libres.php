<?php
/**
 * Test unitaire de la fonction form_hidden
 * du fichier ./inc/filtres.php
 *
 * genere automatiquement par TestBuilder
 * le 2010-03-13 21:35
 */

	$test = 'form_hidden';
	$remonte = "../";
	while (!is_dir($remonte."ecrire"))
		$remonte = "../$remonte";
	require $remonte.'tests/test.inc';
	find_in_path("./inc/filtres.php",'',true);
	$type_urls='libres';
	$GLOBALS['profondeur_url'] = 0;

	//
	// hop ! on y va
	//
	$err = tester_fun('form_hidden', essais_form_hidden());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_form_hidden(){
		$essais = array (
  0 => 
  array (
    0 => '<input name="id_rubrique" value="12" type="hidden"
/><input name="page" value="rubrique" type="hidden"
/>',
    1 => './?rubrique12',
  ),
  1 => 
  array (
    0 => '<input name="calendrier" value="1" type="hidden"
/><input name="id_rubrique" value="12" type="hidden"
/><input name="page" value="rubrique" type="hidden"
/>',
    1 => './?rubrique12&calendrier=1',
  ),
  2 => 
  array (
    0 => '<input name="id_rubrique" value="12" type="hidden"
/><input name="page" value="rubrique" type="hidden"
/>',
    1 => './rubrique12.html',
  ),
  3 => 
  array (
    0 => '<input name="calendrier" value="1" type="hidden"
/><input name="id_rubrique" value="12" type="hidden"
/><input name="page" value="rubrique" type="hidden"
/>',
    1 => './rubrique12.html?calendrier=1',
  ),
  4 => 
  array (
    0 => '<input name="calendrier" value="1" type="hidden"
/><input name="id_rubrique" value="12" type="hidden"
/><input name="page" value="rubrique" type="hidden"
/>',
    1 => './?rubrique12&amp;calendrier=1',
  ),
  5 => 
  array (
    0 => '<input name="calendrier" value="1" type="hidden"
/><input name="toto" value="2" type="hidden"
/><input name="id_rubrique" value="12" type="hidden"
/><input name="page" value="rubrique" type="hidden"
/>',
    1 => './rubrique12.html?calendrier=1&amp;toto=2',
  ),
);
		return $essais;
	}










































?>