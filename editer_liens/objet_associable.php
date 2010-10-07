<?php
/**
 * Test unitaire de la fonction edier_liens
 * du fichier inc/filtres.php
 *
 * genere automatiquement par testbuilder
 * le
 */

	$test = 'objet_associable';
	require '../test.inc';
	find_in_path("action/editer_liens.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('objet_associable', essais_objet_associable());

	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";


	function essais_objet_associable(){
		$essais = array (
  array (
    0 => false,
    1 => 'article',
  ),
  array (
    0 => array('id_auteur','spip_auteurs_liens'),
    1 => 'auteur',
  ),
  array (
    0 => array('id_mot','spip_mots_liens'),
    1 => 'mot',
  ),
  array (
    0 => array('id_document','spip_documents_liens'),
    1 => 'document',
  ),
  array (
    0 => false,
    1 => 'mot\' OR 1=1\'',
  ),
);
		return $essais;
	}





?>