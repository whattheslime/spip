<?php

	require '../test.inc';
	include 'inc-sql_datas.inc';
	
	include_spip('base/abstract_sql');

	/* 
	 * Creation/suppression/analyse de tables dans la base de donnee 
	 * 
	 * Permet de verifier que
	 * - tous les champs sont correctement ajoutes
	 * - que les PRIMARY sont pris en compte
	 * - que les KEY sont prises en compte
	 * 
	 */

	
	/*
	 * Lecture de la description des tables
	 */
	function test_show_table() {
		$tables = test_sql_datas();
		$essais = array();
		// lire la structure de la table
		// la structure doit avoir le meme nombre de champs et de cle
		// attention : la primary key DOIT etre dans les cle aussi
		foreach ($tables as $t=>$d){
			$desc = sql_showtable($t);
			$essais["Compter field $t"] = array(count($d['desc']['field']),$desc['field']);
			$essais["Compter key $t"] = array($d['desc']['nb_key_attendues'],$desc['key']);
		}
		$err = tester_fun('count', $essais);	
		if ($err) {
			return '<b>Lecture des structures de table en echec</b><dl>' . join('', $err) . '</dl>';
		}	
	}
	
	$err = "";
	// supprimer les eventuelles tables
	$err .= test_drop_table();
	// creer les eventuelles tables
	$err .= test_create_table();
	// lire les structures des tables
	$err .= test_show_table();
	// supprimer les tables
	$err .= test_drop_table();
	
	if ($err) 
		die($err);
	
	echo "OK";

?>
