<?php

/*
 * Jeu de donnees pour les differents fichiers de tests sql
 * 
 * Quelques fonctions utilises souvent :
 * - test_create_table
 * - test_drop_table
 */

/* 
 * tableaux des donnees 
 * 
 */
function test_sql_datas(){
	$table_tintin = array(
		'field'=> array(
			"id_tintin" => "INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY",
			"un_bigint" => "BIGINT(21) NOT NULL DEFAULT '0'",
			"un_int" => "BIGINT(21) NOT NULL DEFAULT '0'",
			"un_smallint" => "SMALLINT(3) NOT NULL DEFAULT '0'",
			"un_double" => "DOUBLE NOT NULL DEFAULT '0'",
			"un_tinyint" => "TINYINT(2) NOT NULL DEFAULT '0'",
			"un_varchar" => "VARCHAR(30) NOT NULL DEFAULT ''",
			"un_texte" => "TEXT NOT NULL DEFAULT ''",
			"maj" => "TIMESTAMP"
		),
		'key'=>array(
		
		),
		'nb_key_attendues'=>1 // attention : la primary key DOIT etre dans les cle aussi		
	);
	$data_tintin = array(
		array(
			"id_tintin" => 1,
			"un_bigint" => 30000,
			"un_int" => 2000,
			"un_smallint" => 40,
			"un_double" => 2.58,
			"un_tinyint" => 8,
			"un_varchar" => "Premier varchar",
			"un_texte" => "Premier texte",
			//"maj" => "" // doit se remplir automatiquement
		),
		array(
			"id_tintin" => 2,
			"un_bigint" => 40000,
			"un_int" => 3000,
			"un_smallint" => 50,
			"un_double" => 3.58,
			"un_tinyint" => 9,
			"un_varchar" => "Deuxieme varchar",
			"un_texte" => "Second texte",
			//"maj" => "" // doit se remplir automatiquement
		),
		array(
			"id_tintin" => 3,
			"un_bigint" => 60000,
			"un_int" => 4000,
			"un_smallint" => 70,
			"un_double" => 8.58,
			"un_tinyint" => 3,
			"un_varchar" => "Troisieme varchar",
			"un_texte" => "Troisieme texte",
			//"maj" => "" // doit se remplir automatiquement
		)
	);
	
	$table_milou = array(
		'field'=> array(
			"id_milou" => "INTEGER NOT NULL AUTO_INCREMENT",
			"id_tintin" => "INTEGER NOT NULL",
			"un_enum" => "ENUM('blanc','noir') NOT NULL DEFAULT 'blanc'",
			"wouaf" => "VARCHAR(80) NOT NULL DEFAULT ''",
			"grrrr" => "VARCHAR(80) NOT NULL DEFAULT ''",
			"schtroumf" => "VARCHAR(80) NOT NULL DEFAULT ''",
			"maj" => "TIMESTAMP"
		),
		'key'=>array(
			"PRIMARY KEY" => "id_milou",
			"KEY id_tintin" => "id_tintin",
			"KEY sons" => "wouaf, grrrr",
		),
		'nb_key_attendues'=>3 // attention : la primary key DOIT etre dans les cle aussi
	);
	$data_milou = array(
		array(
			"id_milou" => 1,
			"id_tintin" => 1,
			"un_enum" => "blanc",
			"wouaf" => "Warf !!",
			"grrrr" => "Grogne !",
			// "maj" => "" // doit se remplir automatiquement
		),
		array(
			"id_milou" => 2,
			"id_tintin" => 1,
			"un_enum" => "noir",
			"wouaf" => "Wouf",
			"grrrr" => "<multi>[fr]Crac[en]Krack</multi>",
			// "maj" => "" // doit se remplir automatiquement
		),
		array(
			"id_milou" => 3,
			"id_tintin" => 2,
			"un_enum" => "blanc",
			"wouaf" => "Wif",
			"grrrr" => "Ahrg",
			// "maj" => "" // doit se remplir automatiquement
		),
	);
	
	$table_haddock = array(
		'field'=> array(
			"id_haddock" => "INTEGER NOT NULL AUTO_INCREMENT",
			"alcool" => "VARCHAR(80) NOT NULL DEFAULT ''",

		),
		'key'=>array(
			"PRIMARY KEY" => "id_haddock",
		),
		'nb_key_attendues'=>1 // attention : la primary key DOIT etre dans les cle aussi
	);
	$data_haddock = array(
		array(
			"id_haddock" => 1,
			"alcool" => "<multi>[fr]Agile[en]Agily</multi>",
		),
		array(
			"id_haddock" => 2,
			"alcool" => "<multi>[fr]Aérien[en]Aérieny</multi>",
		),
		array(
			"id_haddock" => 3,
			"alcool" => "<multi>[fr]Vinasse[en]Vinassy</multi>",
		),
	);
			
	return array(
		'spip_test_tintin'=>array(
			'desc'=>$table_tintin,
			'data'=>$data_tintin
			),
		'spip_test_milou'=>array(
			'desc'=>$table_milou,
			'data'=>$data_milou
			),				
		'spip_test_haddock'=>array(
			'desc'=>$table_haddock,
			'data'=>$data_haddock
			),				
	);
}

/*
 * Suppression de tables 
 */
function test_drop_table(){
	$tables = test_sql_datas();
	$essais = array();
	foreach ($tables as $t=>$v){
		$essais["Suppression table $t si existe"] = array(true, $t, true); // reponse, arguments
	}
	$err = tester_fun('sql_drop_table', $essais); // DROP IF EXISTS
	if ($err) {
		return '<b>Suppression de table en echec</b><dl>' . join('', $err) . '</dl>';
	}
}

/*
 * Creation des tables
 */
function test_create_table(){
	$tables = test_sql_datas();
	$essais = array();
	foreach ($tables as $t=>$v){
		if (!sql_create($t, $v['desc']['field'], $v['desc']['key']))
			$err[] = "sql_create $t en echec"; // reponse, arguments
	}		
	if ($err) {
		return '<b>Creation de table en echec</b><dl>' . join('', $err) . '</dl>';
	}
}


	
/*
 * Insertion de champs multiples sql_insertq_multi
 * et comptage avec sql_countsel
 */
function test_insert_data() {
	$tables = test_sql_datas();
	$essais = array();
	// inserer les donnees dans la table
	foreach ($tables as $t=>$d){
		sql_insertq_multi($t, $d['data']);
		$essais[] = array((string)count($d['data']),$t);
	}
	$err = tester_fun('sql_countsel', $essais);	
	if ($err) {
		return '<b>Insertion multiple puis countsel dans table</b><dl>' . join('', $err) . '</dl>';
	}	
}
		
?>
