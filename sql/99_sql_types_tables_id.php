<?php

	$test = 'table_objet';
	require '../test.inc';

	include_spip('base/connect_sql');

// Des tests
$essais['table_objet'] = array(
array('articles','article'),
array('auteurs','auteur'),
array('breves','breve'),
array('documents','document'),
array('documents','doc'),
array('documents','img'),
array('documents','img'),
array('forums','forum'),
array('groupes_mots','groupe_mots'),
array('groupes_mots','groupe_mot'),
array('groupes_mots','groupe'),
array('messages','message'),
array('mots','mot'),
array('petitions','petition'),
array('rubriques','rubrique'),
array('signatures','signature'),
array('syndic','syndic'),
array('syndic','site'),
array('syndic_articles','syndic_article'),
array('types_documents','type_document'),
array('types_documents','extension'),
);

$essais['table_objet_sql'] = array(
array('spip_articles','article'),
array('spip_auteurs','auteur'),
array('spip_breves','breve'),
array('spip_documents','document'),
array('spip_documents','doc'),
array('spip_documents','img'),
array('spip_documents','img'),
array('spip_forum','forum'),
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
array('spip_types_documents','extension'),
);

$essais['id_table_objet'] = array(
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
array('id_groupe','groupe'),
array('id_message','message'),
array('id_mot','mot'),
array('id_article','petition'),
array('id_rubrique','rubrique'),
array('id_signature','signature'),
array('id_syndic','syndic'),
array('id_syndic','site'),
array('id_syndic_article','syndic_article'),
array('extension','type_document'),
array('extension','extension'),
);


$essais['objet_type'] = array(
array('article','articles'),
array('auteur','auteurs'),
array('breve','breves'),
array('document','documents'),
array('forum','forums'),
array('forum','forum'),
array('groupes_mot','groupes_mots'),
array('message','messages'),
array('mot','mots'),
array('petition','petitions'),
array('rubrique','rubriques'),
array('signature','signatures'),
array('syndic','syndic'),
array('syndic_article','syndic_articles'),
array('types_document','types_documents'),
);

	// hop ! on y va
	$err = array();
	foreach($essais as $f=>$essai)
		$err = array_merge(tester_fun($f, $essai),$err);
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		echo ('<dl>' . join('', $err) . '</dl>');
	} else {
		echo "OK";
	}

?>
