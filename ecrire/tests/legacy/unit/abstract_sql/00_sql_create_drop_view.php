<?php

declare(strict_types=1);

// nom du test

$test = 'sql/sql_create_drop_view';

$remonte = __DIR__ . '/';

while (! is_file($remonte . 'test.inc')) {
	$remonte .= '../';
}

require $remonte . 'test.inc';

include __DIR__ . '/inc-sql_datas.inc';

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
	$essais = [];
	// lire la structure de la table
	// la structure doit avoir le meme nombre de champs et de cle
	// attention : la primary key DOIT etre dans les cle aussi
	foreach ($tables as $t => $d) {
		$desc = sql_showtable($t);
		$essais["Compter field {$t}"] = [is_countable($d['desc']['field']) ? count($d['desc']['field']) : 0, $desc['field']];
		$essais["Compter key {$t}"] = [$d['desc']['nb_key_attendues'], $desc['key']];
	}

	$err = tester_fun('count', $essais);
	if ($err) {
		return '<b>Lecture des structures de table en echec</b><dl>' . implode('', $err) . '</dl>';
	}
}

$err = '';

// supprimer les eventuelles tables

$err .= test_drop_table();

// creer les eventuelles tables

$err .= test_create_table();

// lire les structures des tables

$err .= test_show_table();

// supprimer les tables

$err .= test_drop_table();

if ($err !== '' && $err !== '0') {
	die($err);
}

echo 'OK';
