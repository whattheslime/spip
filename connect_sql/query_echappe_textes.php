<?php

	$test = 'query_echappe_textes';
	require '../test.inc';
	find_in_path("base/connect_sql.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('query_echappe_textes', essais_query_echappe_textes());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_query_echappe_textes(){
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
    0 => array('%1$s', array ("'guillemets simples \x2@##@\x2\x3@##@\x3 echappements'")),
    1 => "'guillemets simples \' avec un echappement'",
  ),
  array (
    0 => array('%1$s', array ("\"guillemets doubles \x2@##@\x2\x3@##@\x3 echappements\"")),
    1 => "\"guillemets doubles \\\" avec un echappement\"",
  ),
  array (
    0 => array('%1$s', array ("'guillemets simples \x2@##@\x2\x3@##@\x3 echappements'")),
    1 => "'guillemets simples \'\\\" avec deux echappements'",
  ),
  array (
    0 => array('%1$s', array ("\"guillemets doubles \x2@##@\x2\x3@##@\x3 echappements\"")),
    1 => "\"guillemets doubles \'\\\" avec deux echappements\"",
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



?>
