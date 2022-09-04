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
		return [
   [
    0 => 'spip_articles',
    1 => 'articles',
  ],
   [
    0 => 'spip_articles',
    1 => 'article',
  ],
   [
    0 => 'spip_articles',
    1 => 'spip_articles',
  ],
   [
    0 => 'spip_articles',
    1 => 'id_article',
  ],
   [
    0 => 'spip_rubriques',
    1 => 'rubrique',
  ],
   [
    0 => 'spip_rubriques',
    1 => 'spip_rubriques',
  ],
   [
    0 => 'spip_rubriques',
    1 => 'id_rubrique',
  ],
   [
    0 => 'spip_mots',
    1 => 'mot',
  ],
   [
    0 => 'spip_mots',
    1 => 'spip_mots',
  ],
   [
    0 => 'spip_mots',
    1 => 'id_mot',
  ],
   [
    0 => 'spip_groupes_mots',
    1 => 'groupe_mots',
  ],
   [
    0 => 'spip_groupes_mots',
    1 => 'spip_groupes_mots',
  ],
   [
    0 => 'spip_groupes_mots',
    1 => 'id_groupe',
  ],
   [
    0 => 'spip_groupes_mots',
    1 => 'groupes_mot',
  ],
   [
    0 => 'spip_syndic',
    1 => 'syndic',
  ],
   [
    0 => 'spip_syndic',
    1 => 'site',
  ],
   [
    0 => 'spip_syndic',
    1 => 'spip_syndic',
  ],
   [
    0 => 'spip_syndic',
    1 => 'id_syndic',
  ],
   [
    0 => 'spip_syndic_articles',
    1 => 'syndic_article',
  ],
   [
    0 => 'spip_syndic_articles',
    1 => 'spip_syndic_articles',
  ],
   [
    0 => 'spip_syndic_articles',
    1 => 'id_syndic_article',
  ],
   [
    0 => 'spip_syndic_articles',
    1 => 'syndic_article',
  ],
['spip_articles','article'],
['spip_auteurs','auteur'],
['spip_documents','document'],
['spip_documents','doc'],
['spip_documents','img'],
['spip_documents','img'],
['spip_forum','forum'],
['spip_groupes_mots','groupes_mots'],
['spip_groupes_mots','groupe_mots'],
['spip_groupes_mots','groupe_mot'],
['spip_groupes_mots','groupe'],
['spip_mots','mot'],
['spip_rubriques','rubrique'],
['spip_syndic','syndic'],
['spip_syndic','site'],
['spip_syndic_articles','syndic_article'],
['spip_types_documents','type_document'],
];
	}
