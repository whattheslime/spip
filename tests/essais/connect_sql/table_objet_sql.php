<?php
/**
 * Test unitaire de la fonction table_objet_sql
 * du fichier base/connect_sql.php
 *
 */
namespace Spip\Core\Tests;

find_in_path("base/connect_sql.php",'',true);

/**
 * La fonction appelee pour chaque jeu de test
 * Nommage conventionnel : test_[[dossier1_][[dossier2_]...]]fichier
 * @param ...$args
 * @return mixed
 */
function test_connect_sql_table_objet_sql(...$args) {
	return table_objet_sql(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_connect_sql_table_objet_sql(){
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
array('spip_articles','article'),
array('spip_auteurs','auteur'),
array('spip_documents','document'),
array('spip_documents','doc'),
array('spip_documents','img'),
array('spip_documents','img'),
array('spip_forum','forum'),
array('spip_groupes_mots','groupes_mots'),
array('spip_groupes_mots','groupe_mots'),
array('spip_groupes_mots','groupe_mot'),
array('spip_groupes_mots','groupe'),
array('spip_mots','mot'),
array('spip_rubriques','rubrique'),
array('spip_syndic','syndic'),
array('spip_syndic','site'),
array('spip_syndic_articles','syndic_article'),
array('spip_types_documents','type_document'),
);
		return $essais;
	}
