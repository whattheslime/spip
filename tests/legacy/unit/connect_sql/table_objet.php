<?php
/**
 * Test unitaire de la fonction heures
 * du fichier inc/filtres.php
 *
 * genere automatiquement par TestBuilder
 * le 
 */

	$test = 'table_objet';
	$remonte = "../";
	while (!is_dir($remonte."ecrire"))
		$remonte = "../$remonte";
	require $remonte.'tests/test.inc';
	find_in_path("base/connect_sql.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('table_objet', essais_table_objet());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_table_objet(){
		$essais = array (
  array (
    0 => 'articles',
    1 => 'articles',
  ),
  array (
    0 => 'articles',
    1 => 'article',
  ),
  array (
    0 => 'articles',
    1 => 'spip_articles',
  ),
  array (
    0 => 'articles',
    1 => 'id_article',
  ),
  array (
    0 => 'rubriques',
    1 => 'rubrique',
  ),
  array (
    0 => 'rubriques',
    1 => 'spip_rubriques',
  ),
  array (
    0 => 'rubriques',
    1 => 'id_rubrique',
  ),
  array (
    0 => 'mots',
    1 => 'mot',
  ),
  array (
    0 => 'mots',
    1 => 'spip_mots',
  ),
  array (
    0 => 'mots',
    1 => 'id_mot',
  ),
  array (
    0 => 'groupes_mots',
    1 => 'groupe_mots',
  ),
  array (
    0 => 'groupes_mots',
    1 => 'spip_groupes_mots',
  ),
  array (
    0 => 'groupes_mots',
    1 => 'id_groupe',
  ),
  array (
    0 => 'groupes_mots',
    1 => 'groupes_mot',
  ),
  array (
    0 => 'syndic',
    1 => 'syndic',
  ),
  array (
    0 => 'syndic',
    1 => 'site',
  ),
  array (
    0 => 'syndic',
    1 => 'spip_syndic',
  ),
  array (
    0 => 'syndic',
    1 => 'id_syndic',
  ),
  array (
    0 => 'syndic_articles',
    1 => 'syndic_article',
  ),
  array (
    0 => 'syndic_articles',
    1 => 'spip_syndic_articles',
  ),
  array (
    0 => 'syndic_articles',
    1 => 'id_syndic_article',
  ),
  array (
    0 => 'syndic_articles',
    1 => 'syndic_article',
  ),
array('articles','article'),
array('auteurs','auteur'),
array('documents','document'),
array('documents','doc'),
array('documents','img'),
array('documents','img'),
array('forums','forum'),
array('groupes_mots','groupe_mots'),
array('groupes_mots','groupe_mot'),
array('groupes_mots','groupe'),
array('mots','mot'),
array('rubriques','rubrique'),
array('syndic','syndic'),
array('syndic','site'),
array('syndic_articles','syndic_article'),
array('types_documents','type_document'),
);
		return $essais;
	}
