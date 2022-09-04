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
		return [
   [
    0 => 'article',
    1 => 'articles',
  ],
   [
    0 => 'article',
    1 => 'article',
  ],
   [
    0 => 'article',
    1 => 'spip_articles',
  ],
   [
    0 => 'article',
    1 => 'id_article',
  ],
   [
    0 => 'rubrique',
    1 => 'rubriques',
  ],
   [
    0 => 'rubrique',
    1 => 'spip_rubriques',
  ],
   [
    0 => 'rubrique',
    1 => 'id_rubrique',
  ],
   [
    0 => 'mot',
    1 => 'mots',
  ],
   [
    0 => 'mot',
    1 => 'spip_mots',
  ],
   [
    0 => 'mot',
    1 => 'id_mot',
  ],
   [
    0 => 'groupe_mots',
    1 => 'groupes_mots',
  ],
   [
    0 => 'groupe_mots',
    1 => 'spip_groupes_mots',
  ],
   [
    0 => 'groupe_mots',
    1 => 'id_groupe',
  ],
   [
    0 => 'groupe_mots',
    1 => 'groupes_mot',
  ],
   [
    0 => 'site',
    1 => 'syndic',
  ],
   [
    0 => 'site',
    1 => 'site',
  ],
   [
    0 => 'site',
    1 => 'spip_syndic',
  ],
   [
    0 => 'site',
    1 => 'id_syndic',
  ],
   [
    0 => 'syndic_article',
    1 => 'syndic_articles',
  ],
   [
    0 => 'syndic_article',
    1 => 'spip_syndic_articles',
  ],
   [
    0 => 'syndic_article',
    1 => 'id_syndic_article',
  ],
   [
    0 => 'syndic_article',
    1 => 'syndic_article',
  ],
   [
    0 => 'site',
    1 => 'racine-site',
  ],
   [
    0 => 'mot',
    1 => 'mot-cle',
  ],
   [
    0 => 'truc_pas_connu',
    1 => 'truc_pas_connu',
  ],
   [
    0 => 'truc_pas_connu',
    1 => 'truc_pas_connus',
  ],
['article','articles'],
['auteur','auteurs'],
['document','documents'],
['forum','forums'],
['forum','forum'],
['groupe_mots','groupes_mots'],
['mot','mots'],
['rubrique','rubriques'],
['site','syndic'],
['syndic_article','syndic_articles'],
['types_document','types_documents'],
];
	}

