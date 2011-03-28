<?php
/**
 * Test unitaire de la fonction heures
 * du fichier inc/filtres.php
 *
 * genere automatiquement par TestBuilder
 * le 
 */

	$test = 'table_objet_sql';
	require '../test.inc';
	find_in_path("base/connect_sql.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('table_objet_sql', essais_table_objet_sql());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_table_objet_sql(){
		$essais = array (
  array (
    0 => 'spip_articles',
    1 => 'articles',
  ),
  array (
    0 => 'spip_articles',
    1 => 'article',
  ),
  array (
    0 => 'spip_articles',
    1 => 'spip_articles',
  ),
  array (
    0 => 'spip_articles',
    1 => 'id_article',
  ),
  array (
    0 => 'spip_rubriques',
    1 => 'rubrique',
  ),
  array (
    0 => 'spip_rubriques',
    1 => 'spip_rubriques',
  ),
  array (
    0 => 'spip_rubriques',
    1 => 'id_rubrique',
  ),
  array (
    0 => 'spip_breves',
    1 => 'breve',
  ),
  array (
    0 => 'spip_breves',
    1 => 'spip_breve',
  ),
  array (
    0 => 'spip_breves',
    1 => 'id_breve',
  ),
  array (
    0 => 'spip_mots',
    1 => 'mot',
  ),
  array (
    0 => 'spip_mots',
    1 => 'spip_mots',
  ),
  array (
    0 => 'spip_mots',
    1 => 'id_mot',
  ),
  array (
    0 => 'spip_groupes_mots',
    1 => 'groupe_mots',
  ),
  array (
    0 => 'spip_groupes_mots',
    1 => 'spip_groupes_mots',
  ),
  array (
    0 => 'spip_groupes_mots',
    1 => 'id_groupe',
  ),
  array (
    0 => 'spip_groupes_mots',
    1 => 'groupes_mot',
  ),
  array (
    0 => 'spip_syndic',
    1 => 'syndic',
  ),
  array (
    0 => 'spip_syndic',
    1 => 'site',
  ),
  array (
    0 => 'spip_syndic',
    1 => 'spip_syndic',
  ),
  array (
    0 => 'spip_syndic',
    1 => 'id_syndic',
  ),
  array (
    0 => 'spip_syndic_articles',
    1 => 'syndic_article',
  ),
  array (
    0 => 'spip_syndic_articles',
    1 => 'spip_syndic_articles',
  ),
  array (
    0 => 'spip_syndic_articles',
    1 => 'id_syndic_article',
  ),
  array (
    0 => 'spip_syndic_articles',
    1 => 'syndic_article',
  ),
  array (
    0 => 'spip_petitions',
    1 => 'petition',
  ),
  array (
    0 => 'spip_petitions',
    1 => 'petitions',
  ),
  array (
    0 => 'spip_petitions',
    1 => 'spip_petitions',
  ),
  array (
    0 => 'spip_signatures',
    1 => 'signature',
  ),
  array (
    0 => 'spip_signatures',
    1 => 'signatures',
  ),
  array (
    0 => 'spip_signatures',
    1 => 'spip_signatures',
  ),
  array (
    0 => 'spip_signatures',
    1 => 'id_signature',
  ),
array('spip_articles','article'),
array('spip_auteurs','auteur'),
array('spip_breves','breve'),
array('spip_documents','document'),
array('spip_documents','doc'),
array('spip_documents','img'),
array('spip_documents','img'),
array('spip_forum','forum'),
array('spip_groupes_mots','groupes_mots'),
array('spip_groupes_mots','groupe_mots'),
array('spip_groupes_mots','groupe_mot'),
array('spip_groupes_mots','groupe'),
array('spip_messages','message'),
array('spip_mots','mot'),
array('spip_petitions','petition'),
array('spip_rubriques','rubrique'),
array('spip_signatures','signature'),
array('spip_syndic','syndic'),
array('spip_syndic','site'),
array('spip_syndic_articles','syndic_article'),
array('spip_types_documents','type_document'),
);
		return $essais;
	}

?>