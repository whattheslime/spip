<?php
/**
 * Test unitaire de la fonction edier_liens
 * du fichier inc/filtres.php
 *
 * genere automatiquement par testbuilder
 * le
 */

	$test = 'objet_qualifier_liens';
	require '../test.inc';
	find_in_path("action/editer_liens.php",'',true);

	// creer les donnees de depart
	objet_associer(array('auteur'=>1), array('zorglub'=>array(1,2,3,4,5,6,7,8,9,10)));
	
	//
	// hop ! on y va
	//
	$err = tester_fun('objet_qualifier_liens', essais_objet_qualifier_liens());

	// nettoyer
	objet_dissocier(array('auteur'=>1), array('zorglub'=>'*'));
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";


	function essais_objet_objet_qualifier_liens(){
		$essais = array (
  array (
    0 => false,
    1 => array('article'=>1),
    2 => array('zorglub'=>1),
		3 => array('vu'=>'oui'),
  ),
  array (
    0 => 1,
    1 => array('auteur'=>1),
    2 => array('zorglub'=>1),
		3 => array('vu'=>'oui'),
  ),
  array (
    0 => 1,
    1 => array('auteur'=>1),
    2 => array('zorglub'=>1),
		3 => array('vu'=>'oui'),
  ),
  array (
    0 => false,
    1 => array('auteur'=>1),
    2 => array('zorglub'=>1),
		3 => array('veraer'=>'oui'),
  ),
  array (
    0 => 1,
    1 => array('auteur'=>1),
    2 => array('zorglub'=>array(2,3)),
		3 => array('vu'=>'oui'),
  ),
);
		return $essais;
	}





?>