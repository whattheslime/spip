<?php
/**
 * Test unitaire de la fonction table_objet
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
function test_connect_sql_table_objet(...$args) {
	return table_objet(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_connect_sql_table_objet(){
		$essais =  [
   [
    0 => 'articles',
    1 => 'articles',
  ],
   [
    0 => 'articles',
    1 => 'article',
  ],
   [
    0 => 'articles',
    1 => 'spip_articles',
  ],
   [
    0 => 'articles',
    1 => 'id_article',
  ],
   [
    0 => 'rubriques',
    1 => 'rubrique',
  ],
   [
    0 => 'rubriques',
    1 => 'spip_rubriques',
  ],
   [
    0 => 'rubriques',
    1 => 'id_rubrique',
  ],
   [
    0 => 'mots',
    1 => 'mot',
  ],
   [
    0 => 'mots',
    1 => 'spip_mots',
  ],
   [
    0 => 'mots',
    1 => 'id_mot',
  ],
   [
    0 => 'groupes_mots',
    1 => 'groupe_mots',
  ],
   [
    0 => 'groupes_mots',
    1 => 'spip_groupes_mots',
  ],
   [
    0 => 'groupes_mots',
    1 => 'id_groupe',
  ],
   [
    0 => 'groupes_mots',
    1 => 'groupes_mot',
  ],
   [
    0 => 'syndic',
    1 => 'syndic',
  ],
   [
    0 => 'syndic',
    1 => 'site',
  ],
   [
    0 => 'syndic',
    1 => 'spip_syndic',
  ],
   [
    0 => 'syndic',
    1 => 'id_syndic',
  ],
   [
    0 => 'syndic_articles',
    1 => 'syndic_article',
  ],
   [
    0 => 'syndic_articles',
    1 => 'spip_syndic_articles',
  ],
   [
    0 => 'syndic_articles',
    1 => 'id_syndic_article',
  ],
   [
    0 => 'syndic_articles',
    1 => 'syndic_article',
  ],
['articles','article'],
['auteurs','auteur'],
['documents','document'],
['documents','doc'],
['documents','img'],
['documents','img'],
['forums','forum'],
['groupes_mots','groupe_mots'],
['groupes_mots','groupe_mot'],
['groupes_mots','groupe'],
['mots','mot'],
['rubriques','rubrique'],
['syndic','syndic'],
['syndic','site'],
['syndic_articles','syndic_article'],
['types_documents','type_document'],
];
		return $essais;
	}
