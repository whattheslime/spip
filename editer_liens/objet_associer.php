<?php
/**
 * Test unitaire de la fonction edier_liens
 * du fichier inc/filtres.php
 *
 * genere automatiquement par testbuilder
 * le
 */

	$test = 'objet_associer';
	require '../test.inc';
	find_in_path("action/editer_liens.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('objet_associer', essais_objet_associer());

	// nettoyer
	objet_dissocier(array('auteur'=>1), array('spirou'=>'*'));
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";


	function essais_objet_associer(){
		$essais = array (
  array (
    0 => false,
    1 => array('article'=>1),
    2 => array('spirou'=>1),
  ),
  array (
    0 => 1,
    1 => array('auteur'=>1),
    2 => array('spirou'=>1),
  ),
  array (
    0 => 0,
    1 => array('auteur'=>1),
    2 => array('spirou'=>1),
  ),
  array (
    0 => 2,
    1 => array('auteur'=>1),
    2 => array('spirou'=>array(2,3)),
  ),
  array (
    0 => 1,
    1 => array('auteur'=>1),
    2 => array('spirou'=>array(2,3,4)),
  ),
);
		return $essais;
	}





?>