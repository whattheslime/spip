<?php
/**
 * Test unitaire de la fonction heures
 * du fichier inc/filtres.php
 *
 * genere automatiquement par TestBuilder
 * le 
 */

	$test = 'id_table_objet';
	require '../test.inc';
	find_in_path("base/connect_sql.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('id_table_objet', essais_id_table_objet());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_id_table_objet(){
		$essais = array (
  array (
    0 => 'id_article',
    1 => 'articles',
  ),
  array (
    0 => 'id_article',
    1 => 'article',
  ),
  array (
    0 => 'id_article',
    1 => 'spip_articles',
  ),
  array (
    0 => 'id_article',
    1 => 'id_article',
  ),
  array (
    0 => 'id_rubrique',
    1 => 'rubriques',
  ),
  array (
    0 => 'id_rubrique',
    1 => 'spip_rubriques',
  ),
  array (
    0 => 'id_rubrique',
    1 => 'id_rubrique',
  ),
  array (
    0 => 'id_breve',
    1 => 'breves',
  ),
  array (
    0 => 'id_breve',
    1 => 'spip_breves',
  ),
  array (
    0 => 'id_breve',
    1 => 'id_breve',
  ),
  array (
    0 => 'id_mot',
    1 => 'mots',
  ),
  array (
    0 => 'id_mot',
    1 => 'spip_mots',
  ),
  array (
    0 => 'id_mot',
    1 => 'id_mot',
  ),
  array (
    0 => 'id_groupe',
    1 => 'groupes_mots',
  ),
  array (
    0 => 'id_groupe',
    1 => 'spip_groupes_mots',
  ),
  array (
    0 => 'id_groupe',
    1 => 'id_groupe',
  ),
  array (
    0 => 'id_groupe',
    1 => 'groupes_mot',
  ),
  array (
    0 => 'id_syndic',
    1 => 'syndic',
  ),
  array (
    0 => 'id_syndic',
    1 => 'site',
  ),
  array (
    0 => 'id_syndic',
    1 => 'spip_syndic',
  ),
  array (
    0 => 'id_syndic',
    1 => 'id_syndic',
  ),
  array (
    0 => 'id_syndic_article',
    1 => 'syndic_articles',
  ),
  array (
    0 => 'id_syndic_article',
    1 => 'spip_syndic_articles',
  ),
  array (
    0 => 'id_syndic_article',
    1 => 'id_syndic_article',
  ),
  array (
    0 => 'id_syndic_article',
    1 => 'syndic_article',
  ),
  array (
    0 => 'id_petition',
    1 => 'petitions',
  ),
  array (
    0 => 'id_petition',
    1 => 'petition',
  ),
  array (
    0 => 'id_petition',
    1 => 'spip_petitions',
  ),
  array (
    0 => 'id_signature',
    1 => 'signatures',
  ),
  array (
    0 => 'id_signature',
    1 => 'signature',
  ),
  array (
    0 => 'id_signature',
    1 => 'spip_signatures',
  ),
  array (
    0 => 'id_signature',
    1 => 'id_signature',
  ),
array('id_article','article'),
array('id_auteur','auteur'),
array('id_breve','breve'),
array('id_document','document'),
array('id_document','doc'),
array('id_document','img'),
array('id_document','img'),
array('id_forum','forum'),
array('id_groupe','groupe_mots'),
array('id_groupe','groupe_mot'),
array('id_groupe','groupes_mots'),
array('id_groupe','groupe'),
array('id_message','message'),
array('id_mot','mot'),
array('id_petition','petition'),
array('id_rubrique','rubrique'),
array('id_signature','signature'),
array('id_syndic','syndic'),
array('id_syndic','site'),
array('id_syndic_article','syndic_article'),
array('extension','type_document'),
);
		return $essais;
	}



?>