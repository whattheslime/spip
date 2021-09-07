<?php
/**
 * Test unitaire de la fonction query_echappe_textes
 * du fichier base/connect_sql.php
 *
 */
namespace Spip\Core\Tests;

find_in_path("base/connect_sql.php",'',true);

function pretest_connect_sql_query_echappe_textes() {
	query_echappe_textes('', 'uniqid');
}

/**
 * La fonction appelee pour chaque jeu de test
 * Nommage conventionnel : test_[[dossier1_][[dossier2_]...]]fichier
 * @param ...$args
 * @return mixed
 */
function test_connect_sql_query_echappe_textes(...$args) {
	return query_echappe_textes(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_connect_sql_query_echappe_textes(){
	  $md5 = substr(md5('uniqid'), 0, 4);
		$essais = array (
  array (
    0 => array('%1$s', array ("'guillemets simples'")),
    1 => "'guillemets simples'",
  ),
  array (
    0 => array('%1$s', array ("\"guillemets doubles\"")),
    1 => "\"guillemets doubles\"",
  ),
  array (
    0 => array('%1$s,%2$s', array ("'guillemets simples 1/2'", "'guillemets simples 2/2'")),
    1 => "'guillemets simples 1/2','guillemets simples 2/2'",
  ),
  array (
    0 => array('%1$s,%2$s', array ("\"guillemets doubles 1/2\"", "\"guillemets doubles 2/2\"")),
    1 => "\"guillemets doubles 1/2\",\"guillemets doubles 2/2\"",
  ),
  array (
    0 => array('%1$s', array ("'guillemets simples \x2@#{$md5}#@\x2 avec un echappement'")),
    1 => "'guillemets simples \' avec un echappement'",
  ),
  array (
    0 => array('%1$s', array ("\"guillemets doubles \x3@#{$md5}#@\x3 avec un echappement\"")),
    1 => "\"guillemets doubles \\\" avec un echappement\"",
  ),
  array (
    0 => array('%1$s', array ("'guillemets simples \x2@#{$md5}#@\x2\x3@#{$md5}#@\x3 avec deux echappements'")),
    1 => "'guillemets simples \'\\\" avec deux echappements'",
  ),
  array (
    0 => array('%1$s', array ("\"guillemets doubles \x2@#{$md5}#@\x2\x3@#{$md5}#@\x3 avec deux echappements\"")),
    1 => "\"guillemets doubles \'\\\" avec deux echappements\"",
  ),
  array (
    0 => array('%1$s', array ("'guillemet double \" dans guillemets simples'")),
    1 => "'guillemet double \" dans guillemets simples'",
  ),
  array (
    0 => array('%1$s', array ("\"guillemet simple ' dans guillemets doubles\"")),
    1 => "\"guillemet simple ' dans guillemets doubles\"",
  ),

  // sortie de sqlitemanager firefox
  // (description de table suite a import d'une table au format xml/phpmyadmin v5)
  array (
    0 => array('%1$s INTEGER,%2$s VARCHAR', array ("\"id_objet\"","\"objet\"")),
    1 => "\"id_objet\" INTEGER,\"objet\" VARCHAR",
  ),
);
		return $essais;
	}


