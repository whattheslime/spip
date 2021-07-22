<?php
/**
 * Test unitaire de la fonction objet_type
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
function test_connect_sql_objet_type(...$args) {
	return objet_type(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_connect_sql_objet_type(){
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
array('document','documents'),
array('forum','forums'),
array('forum','forum'),
array('groupe_mots','groupes_mots'),
array('mot','mots'),
array('rubrique','rubriques'),
array('site','syndic'),
array('syndic_article','syndic_articles'),
array('types_document','types_documents'),
);
		return $essais;
	}

