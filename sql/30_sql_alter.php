<?php

	require '../test.inc';
	include 'inc-sql_datas.inc';
	
	include_spip('base/abstract_sql');

	/* 
	 * alter de tables dans la base de donnee 
	 */


	/*
	 * Alter colonne
	 */
	function test_alter_colonne() {	
		$err = $essais = array();
		$table = "spip_test_tintin";

		// supprimer une colonne
		sql_alter("TABLE $table DROP COLUMN un_bigint");
		$desc = sql_showtable($table);
		if ($f = $desc['field']['un_bigint'])
			$err[] = "sql_alter rate DROP COLUMN";
		
		// supprimer une colonne (sans COLUMN)
		sql_alter("TABLE $table DROP un_smallint");
		$desc = sql_showtable($table);
		if ($f = $desc['field']['un_smallint'])
			$err[] = "sql_alter rate DROP sans COLUMN";		
		
		// renommer une colonne
		sql_alter("TABLE $table CHANGE un_varchar deux_varchars VARCHAR(30) NOT NULL DEFAULT ''");
		$desc = sql_showtable($table);
		if (($desc['field']['un_varchar'] OR !$desc['field']['deux_varchars']))
			$err[] = "sql_alter rate CHANGE";	
			
		// changer le type d'une colonne
		$table = "spip_test_milou";
		sql_alter("TABLE $table MODIFY schtroumf TEXT NOT NULL DEFAULT ''");
		$desc = sql_showtable($table);
		$s=$desc['field']['schtroumf'];
		if (!$s OR (false===stripos($s,'TEXT')))
			$err[] = "sql_alter rate MODIFY varchar en text : $s";	
	
		// ajouter des colonnes
		sql_alter("TABLE $table ADD COLUMN houba BIGINT(21) NOT NULL DEFAULT '0'");
		$desc = sql_showtable($table);
		if (!$s=$desc['field']['houba'])
			$err[] = "sql_alter rate ADD COLUMN houba : $s";
			
		// ajouter des colonnes avec "AFTER"
		sql_alter("TABLE $table ADD COLUMN hop BIGINT(21) NOT NULL DEFAULT '0' AFTER id_tintin");
		$desc = sql_showtable($table);
		if (!$s=$desc['field']['hop'])
			$err[] = "sql_alter rate ADD COLUMN hop AFTER ... : $s";					
				
		// affichage
		if ($err) {
			return '<b>Alter : drop column</b><dl><dd>' . join('</dd><dd>', $err) . '</dd></dl>';
		}			
	}

	/*
	 * Renomme table
	 */
	function test_alter_renomme_table() {	
		$err = $essais = array();
		$table = "spip_test_tintin";
		
		// renommer une table
		sql_alter("TABLE $table RENAME spip_test_castafiore");
		$desc = sql_showtable($table);
		$desc2 = sql_showtable('spip_test_castafiore');
		if ($desc OR !$desc2)
			$err[] = "sql_alter rate RENAME table";	
			
					
		// affichage
		if ($err) {
			return '<b>Alter : renomme table</b><dl><dd>' . join('</dd><dd>', $err) . '</dd></dl>';
		}			
	}


	/*
	 * pointer l'index
	 */
	function test_alter_index() {	
		$err = $essais = array();
		$table = "spip_test_milou";
		
		// supprimer un index
		sql_alter("TABLE $table DROP INDEX sons");
		$desc = sql_showtable($table);
		if ($s = $desc['key']['KEY sons'])
			$err[] = "sql_alter rate DROP INDEX sons";
			
		// ajouter un index simple
		sql_alter("TABLE $table ADD INDEX (wouaf)");
		$desc = sql_showtable($table);
		if (!($s = $desc['key']['KEY wouaf']))	
			$err[] = "sql_alter rate ADD INDEX (wouaf)";
			
		// ajouter un index nomme
		sql_alter("TABLE $table ADD INDEX pluie (grrrr)");
		$desc = sql_showtable($table);
		if (!($s = $desc['key']['KEY pluie']))	
			$err[] = "sql_alter rate ADD INDEX pluie (grrrr)";
			
		// supprimer un index
		sql_alter("TABLE $table DROP INDEX pluie");
		$desc = sql_showtable($table);
		if ($s = $desc['key']['KEY pluie'])
			$err[] = "sql_alter rate DROP INDEX pluie";
			
		// ajouter un index nomme double
		sql_alter("TABLE $table ADD INDEX dring (grrrr, wouaf)");
		$desc = sql_showtable($table);
		if (!($s = $desc['key']['KEY dring']))	
			$err[] = "sql_alter rate ADD INDEX dring (grrrr, wouaf)";
												
		// affichage
		if ($err) {
			return '<b>Alter : index</b><dl><dd>' . join('</dd><dd>', $err) . '</dd></dl>';
		}			
	}


	/*
	 * dezinguer la primary
	 */
	function test_alter_primary() {	
		$err = $essais = array();
		$table = "spip_test_kirikou";
		
		// creer une table pour jouer
		sql_create($table,array(
			"un"=>"INTEGER NOT NULL",
			"deux"=>"INTEGER NOT NULL",
			"trois"=>"INTEGER NOT NULL"),
			array('PRIMARY KEY'=>"un"));
			
		// supprimer une primary
		$desc = sql_showtable($table);
		sql_alter("TABLE $table DROP PRIMARY KEY");
		$desc = sql_showtable($table);
		if ($s = $desc['key']['PRIMARY KEY'])
			$err[] = "sql_alter rate DROP PRIMARY KEY";
			
		// ajouter une primary
		sql_alter("TABLE $table ADD PRIMARY KEY (deux, trois)");
		$desc = sql_showtable($table);
		if (!($s = $desc['key']['PRIMARY KEY']))
			$err[] = "sql_alter rate ADD PRIMARY KEY (deux, trois)";		
						
		// affichage
		if ($err) {
			return '<b>Alter : primary key</b><dl><dd>' . join('</dd><dd>', $err) . '</dd></dl>';
		}			
	}
	
	/*
	 * Alter colonne
	 */
	function test_alter_multiple() {	
		$err = $essais = array();
		$table = "spip_test_milou";

		// supprimer des colonnes
		sql_alter("TABLE $table DROP INDEX dring, DROP COLUMN wouaf, DROP COLUMN grrrr");
		$desc = sql_showtable($table);
		if (
			$desc['field']['waouf'] 
		 OR $desc['field']['grrrr']
		 OR $desc['key']['KEY dring']
		 )
			$err[] = "sql_alter rate DROP INDEX dring, DROP COLUMN wouaf, DROP COLUMN grrrr";
			
		// ajouter des colonnes
		sql_alter("TABLE $table ADD COLUMN a INT, ADD COLUMN b INT, ADD COLUMN c INT, ADD INDEX abc (a,b,c)");
		$desc = sql_showtable($table);
		if (
			!$desc['field']['a'] 
		 OR !$desc['field']['b']
		 OR !$desc['field']['c']
		 OR !$desc['key']['KEY abc']
		 )
			$err[] = "sql_alter rate ADD COLUMN a INT, ADD COLUMN b INT, ADD COLUMN c INT, ADD INDEX abc (a,b,c)";
		
		// affichage
		if ($err) {
			return '<b>Alter : multiples</b><dl><dd>' . join('</dd><dd>', $err) . '</dd></dl>';
		}					
	}
	
	$err = "";			
	// supprimer les eventuelles tables
	$err .= test_drop_table();
	sql_drop_table("spip_test_castafiore",true);
	sql_drop_table("spip_test_kirikou",true);

	// creer les eventuelles tables
	$err .= test_create_table();
	// inserer les donnees dans la table
	$err .= test_insert_data();	
	// series d'alter
	$err .= test_alter_colonne();
	$err .= test_alter_renomme_table();
	$err .= test_alter_index();
	$err .= test_alter_primary();
	$err .= test_alter_multiple();
	
	// supprimer les tables
	$err .= test_drop_table();
	sql_drop_table("spip_test_castafiore",true);
	sql_drop_table("spip_test_kirikou",true);
	
	if ($err) 
		die($err);	
		
	echo "OK";

?>
