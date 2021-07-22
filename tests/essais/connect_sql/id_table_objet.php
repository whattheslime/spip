<?php
/**
 * Test unitaire de la fonction id_table_objet
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
function test_connect_sql_id_table_objet(...$args) {
	return id_table_objet(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_connect_sql_id_table_objet(){
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
array('id_article','article'),
array('id_auteur','auteur'),
array('id_document','document'),
array('id_document','doc'),
array('id_document','img'),
array('id_document','img'),
array('id_forum','forum'),
array('id_groupe','groupe_mots'),
array('id_groupe','groupe_mot'),
array('id_groupe','groupes_mots'),
array('id_groupe','groupe'),
array('id_mot','mot'),
array('id_rubrique','rubrique'),
array('id_syndic','syndic'),
array('id_syndic','site'),
array('id_syndic_article','syndic_article'),
array('extension','type_document'),
);
		return $essais;
	}

