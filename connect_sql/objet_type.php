<?php
/**
 * Test unitaire de la fonction heures
 * du fichier inc/filtres.php
 *
 * genere automatiquement par TestBuilder
 * le 
 */

	$test = 'objet_type';
	require '../test.inc';
	find_in_path("base/connect_sql.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('objet_type', essais_objet_type());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_objet_type(){
		$essais = array (
  array (
    0 => 'article',
    1 => 'articles',
  ),
  array (
    0 => 'article',
    1 => 'article',
  ),
  array (
    0 => 'article',
    1 => 'spip_articles',
  ),
  array (
    0 => 'article',
    1 => 'id_article',
  ),
  array (
    0 => 'rubrique',
    1 => 'rubriques',
  ),
  array (
    0 => 'rubrique',
    1 => 'spip_rubriques',
  ),
  array (
    0 => 'rubrique',
    1 => 'id_rubrique',
  ),
  array (
    0 => 'breve',
    1 => 'breves',
  ),
  array (
    0 => 'breve',
    1 => 'spip_breves',
  ),
  array (
    0 => 'breve',
    1 => 'id_breve',
  ),
  array (
    0 => 'mot',
    1 => 'mots',
  ),
  array (
    0 => 'mot',
    1 => 'spip_mots',
  ),
  array (
    0 => 'mot',
    1 => 'id_mot',
  ),
  array (
    0 => 'groupe_mots',
    1 => 'groupes_mots',
  ),
  array (
    0 => 'groupe_mots',
    1 => 'spip_groupes_mots',
  ),
  array (
    0 => 'groupe_mots',
    1 => 'id_groupe',
  ),
  array (
    0 => 'groupe_mots',
    1 => 'groupes_mot',
  ),
  array (
    0 => 'site',
    1 => 'syndic',
  ),
  array (
    0 => 'site',
    1 => 'site',
  ),
  array (
    0 => 'site',
    1 => 'spip_syndic',
  ),
  array (
    0 => 'site',
    1 => 'id_syndic',
  ),
  array (
    0 => 'syndic_article',
    1 => 'syndic_articles',
  ),
  array (
    0 => 'syndic_article',
    1 => 'spip_syndic_articles',
  ),
  array (
    0 => 'syndic_article',
    1 => 'id_syndic_article',
  ),
  array (
    0 => 'syndic_article',
    1 => 'syndic_article',
  ),
  array (
    0 => 'petition',
    1 => 'petitions',
  ),
  array (
    0 => 'petition',
    1 => 'petition',
  ),
  array (
    0 => 'petition',
    1 => 'spip_petitions',
  ),
  array (
    0 => 'signature',
    1 => 'signatures',
  ),
  array (
    0 => 'signature',
    1 => 'signature',
  ),
  array (
    0 => 'signature',
    1 => 'spip_signatures',
  ),
  array (
    0 => 'signature',
    1 => 'id_signature',
  ),
  array (
    0 => 'site',
    1 => 'racine-site',
  ),
  array (
    0 => 'mot',
    1 => 'mot-cle',
  ),
  array (
    0 => 'truc_pas_connu',
    1 => 'truc_pas_connu',
  ),
  array (
    0 => 'truc_pas_connu',
    1 => 'truc_pas_connus',
  ),
array('article','articles'),
array('auteur','auteurs'),
array('breve','breves'),
array('document','documents'),
array('forum','forums'),
array('forum','forum'),
array('groupe_mots','groupes_mots'),
array('message','messages'),
array('mot','mots'),
array('petition','petitions'),
array('rubrique','rubriques'),
array('signature','signatures'),
array('site','syndic'),
array('syndic_article','syndic_articles'),
array('types_document','types_documents'),
);
		return $essais;
	}



?>