<?php

declare(strict_types=1);

// nom du test

$test = 'sql/sql_insert_select';

$remonte = __DIR__ . '/';

while (! is_file($remonte . 'test.inc')) {
	$remonte .= '../';
}

require $remonte . 'test.inc';

include __DIR__ . '/inc-sql_datas.inc';

include_spip('base/abstract_sql');

/*
 * Selection/insertion de tables dans la base de donnee
 *
 */

/*
 * Teste que le champ "maj" s'actualise bien sur les update
 * ainsi que les autres champs !
 *
 * utilise sql_quote, sql_getfetsel, sql_update et sql_updateq.
 */

function test_maj_timestamp() {
	$table = 'spip_test_tintin';
	$where = 'id_tintin=' . sql_quote(1);
	$err = [];
	$essais = [];

	// lecture du timestamp actuel
	$maj1 = sql_getfetsel('maj', $table, $where);
	if (! $maj1) {
		$err[] = "Le champ 'maj' ({$maj1}) n'a vraisemblablement pas recu de timestamp à l'insertion";
	}

	// update
	sleep(1); // sinon le timestamp ne change pas !
	$texte = 'nouveau texte';
	sql_update($table, [
		'un_texte' => sql_quote($texte),
	], $where);
	// comparaison timastamp
	$maj2 = sql_getfetsel('maj', $table, $where);
	if (! $maj2 || ! strtotime($maj2)) {
		$err[] = "Le champ 'maj' ({$maj2}) est incorrect suite à l'update";
	} elseif ($maj1 === $maj2) {
		$err[] = "Le champ 'maj' ({$maj2}) n'a vraisemblablement pas été mis a jour lors de l'update";
	}

	// comparaison texte
	$texte2 = sql_getfetsel('un_texte', $table, $where);
	if (! $texte2 || $texte2 !== $texte) {
		$err[] = "Le champ 'un_texte' ({$texte2}) n'est pas correctement rempli a l'update";
	}

	// idem avec updateq
	sleep(1); // sinon le timestamp ne change pas !
	$texte = 'encore un nouveau texte';
	sql_updateq($table, [
		'un_texte' => $texte,
	], $where);
	// comparaison timastamp
	$maj3 = sql_getfetsel('maj', $table, $where);
	if (! $maj3 || ! strtotime($maj3)) {
		$err[] = "Le champ 'maj' ({$maj3}) est incorrect suite à l'updateq";
	} elseif ($maj3 === $maj2) {
		$err[] = "Le champ 'maj' ({$maj3}) n'a vraisemblablement pas été mis a jour lors de l'updateq";
	}

	// comparaison texte
	$texte3 = sql_getfetsel('un_texte', $table, $where);
	if (! $texte3 || $texte3 !== $texte) {
		$err[] = "Le champ 'un_texte' ({$texte2}) n'est pas correctement rempli a l'update";
	}

	// affichage
	if ($err) {
		return "<b>Champ maj sur update</b><dl>\n<dd>" . implode("</dd>\n<dd>", $err) . '</dd></dl>';
	}
}

/*
 * Selections diverses selon criteres
 * -
 */

function test_selections() {
	$nb_data = null;
	$err = [];
	$essais = [];
	$desc = test_sql_datas();
	$nb_data = is_countable($desc['spip_test_tintin']['data']) ? count($desc['spip_test_tintin']['data']) : 0;
	// selection simple
	$res = sql_select('*', 'spip_test_tintin');
	if (($nb = sql_count($res)) !== $nb_data) {
		$err[] = "1.sql_count ({$nb}) ne renvoie pas : {$nb_data} elements";
	}

	// selection float
	$res = sql_select('*', 'spip_test_tintin', ['un_double>' . sql_quote(3)]);
	$elems = $desc['spip_test_tintin']['data'];
	$n = 0;
	foreach ($elems as $a => $b) {
		foreach ($b as $c => $d) {
			if ($c === 'un_double' && $d > 3) {
				++$n;
			}
		}
	}

	if (($nb = sql_count($res)) !== $n) {
		$err[] = "2.sql_count ({$nb}) ne renvoie pas : {$n} elements";
	}

	// selection REGEXP
	// ! chiffre en dur !
	$res = sql_select('*', 'spip_test_tintin', ['un_varchar REGEXP ' . sql_quote('^De')]);
	if (($nb = sql_count($res)) !== 1) {
		$err[] = "3.sql_select comprends mal REGEXP ({$nb} resultats au lieu de 1)";
	}

	// selection LIKE
	// ! chiffre en dur !
	$res = sql_select('*', 'spip_test_tintin', ['un_varchar LIKE ' . sql_quote('De%')]);
	if (($nb = sql_count($res)) !== 1) {
		$err[] = "4.sql_select comprends mal LIKE ({$nb} resultats au lieu de 1)";
	}

	// selection array(champs)
	$res = sql_fetsel(['id_tintin', 'un_varchar'], 'spip_test_tintin');
	if (! isset($res['id_tintin']) || ! isset($res['un_varchar'])) {
		$err[] = '5.sql_select comprends mal une selection : array(champ1, champ2)';
	}

	// selection array(champs=>alias)
	$res = sql_fetsel(['id_tintin AS id', 'un_varchar AS vchar'], 'spip_test_tintin');
	if (! isset($res['id']) || ! isset($res['vchar'])) {
		$err[] = '6.sql_select comprends mal une selection : array(champ1 AS alias1, champ2 AS alias2)';
	}

	// selection avec sql_multi
	$res = sql_select(['id_milou', sql_multi('grrrr', 'fr')], 'spip_test_milou', '', '', 'multi');
	if (sql_count($res) !== $nb_data) {
		$err[] = '7.sql_multi mal interprete';
	}

	$rs = sql_fetch($res);
	$id1 = intval($rs['id_milou']);
	$rs = sql_fetch($res);
	$id2 = intval($rs['id_milou']);
	$rs = sql_fetch($res);
	$id3 = intval($rs['id_milou']);
	if ($id1 !== 3 && $id2 !== 2 && $id3 !== 1) {
		$err[] = "8.sql_multi order by multi rate : ordre ({$id1}, {$id2}, {$id3}) - attendu : (3, 2, 1)";
	}

	// le bon texte avec multi
	foreach (
		[
		'fr' => 'Crac',
		'en' => 'Krack',
		] as $lg => $res
	) {
		$multi = sql_getfetsel(sql_multi('grrrr', $lg), 'spip_test_milou', 'id_milou=' . sql_quote(2));
		if ($multi !== $res) {
			$err[] = "9.sql_multi {$lg} mal rendu : retour : " . htmlentities($multi) . ', attendu : ' . htmlentities($res);
		}
	}

	// le bon texte avec multi et accents
	foreach (
		[
		'fr' => 'Aérien',
		'en' => 'Aérieny',
		] as $lg => $res
	) {
		$multi = sql_getfetsel(sql_multi('alcool', $lg), 'spip_test_haddock', 'id_haddock=' . sql_quote(2));
		if ($multi !== $res) {
			$err[] = "10.sql_multi {$lg} mal rendu : retour : " . htmlentities($multi) . ', attendu : ' . htmlentities($res);
		}
	}

	// le bon texte avec multi et debut et fin de chaine
	foreach (
		[
		'fr' => 'Un début de chaine : Vinasse, et [la fin]',
		'en' => 'Un début de chaine : Vinassy, et [la fin]',
		'de' => 'Un début de chaine : Vinasse, et [la fin]',
		] as $lg => $res
	) {
		$multi = sql_getfetsel(sql_multi('alcool', $lg), 'spip_test_haddock', 'id_haddock=' . sql_quote(4));
		if ($multi !== $res) {
			$err[] = "11.sql_multi [{$lg}] mal rendu : retour : " . htmlentities($multi) . ', attendu : ' . htmlentities($res);
		}
	}

	// affichage
	if ($err !== []) {
		return "<b>Selections</b><dl>\n<dd>" . implode("</dd>\n<dd>", $err) . '</dd></dl>';
	}
}

/*
 * Selections diverses entre plusieurs tables
 * -
 */

function test_selections_entre_table() {
	$err = [];
	$essais = [];
	// selection 2 tables
	// ! nombre en dur !
	$res = sql_select(
		['spip_test_tintin.id_tintin', 'spip_test_milou.id_milou'],
		['spip_test_tintin', 'spip_test_milou'],
		['spip_test_milou.id_tintin=spip_test_tintin.id_tintin']
	);
	if (! ($nb = sql_count($res) === 3)) {
		$err[] = "selection sur 2 tables avec where en echec : attendu 3 reponses, présentes : {$nb}";
	}

	// selection 2 tables avec alias =>
	// ! nombre en dur !
	$res = sql_select(
		['a.id_tintin AS x', 'b.id_milou AS y'],
		[
			'a' => 'spip_test_tintin',
			'b' => 'spip_test_milou',
		],
		['a.id_tintin=b.id_tintin']
	);
	if (! ($nb = sql_count($res) === 3)) {
		$err[] = "From avec alias en echec (3 reponses attendues) - présentes : {$nb}";
	}

	// selection 2 tables avec alias AS
	// ! nombre en dur !
	$res = sql_select(
		['a.id_tintin AS x', 'b.id_milou AS y'],
		['spip_test_tintin AS a', 'spip_test_milou AS b'],
		['a.id_tintin=b.id_tintin']
	);
	if (($nb = sql_count($res)) !== 3) {
		$err[] = "From avec alias AS en echec (3 reponses attendues) - présentes : {$nb}";
	}

	// selection 2 tables avec INNER JOIN + ON
	// ! nombre en dur !
	$res = sql_select(
		['a.id_tintin AS x', 'b.id_milou AS y'],
		['spip_test_tintin AS a INNER JOIN spip_test_milou AS b ON (a.id_tintin=b.id_tintin)']
	);
	if (($nb = sql_count($res)) !== 3) {
		$err[] = "Echec INNER JOIN + ON (3 reponses attendues, présentes : {$nb})";
	}

	// selection 2 tables avec LEFT JOIN + ON
	// ! nombre en dur !
	$res = sql_select(
		['a.id_tintin AS x', 'b.id_milou AS y'],
		['spip_test_tintin AS a LEFT JOIN spip_test_milou AS b ON (a.id_tintin=b.id_tintin)']
	);
	if (($nb = sql_count($res)) !== 4) {
		$err[] = "Echec LEFT JOIN + ON (4 reponses attendues, présentes : {$nb})";
	}

	// selection 2 tables avec jointure INNER JOIN + USING
	// ! nombre en dur !
	// SQLite 2 se plante : il ne connait pas USING (enleve de la requete,
	// et du coup ne fait pas correctement la jointure)
	$res = sql_select(
		['a.id_tintin AS x', 'b.id_milou AS y'],
		['spip_test_tintin AS a INNER JOIN spip_test_milou AS b USING (id_tintin)']
	);
	if (($nb = sql_count($res)) !== 3) {
		$err[] = "Echec INNER JOIN + USING (3 reponses attendues, présentes : {$nb})";
	}

	// affichage
	if ($err) {
		return "<b>Selections multi tables</b><dl>\n<dd>" . implode("</dd>\n<dd>", $err) . '</dd></dl>';
	}
}

$err = '';

// supprimer les eventuelles tables

$err .= test_drop_table();

// creer les eventuelles tables

$err .= test_create_table();

// inserer les donnees dans la table

$err .= test_insert_data();

// test maj timestamp automatique (select, update, comparaison)

// ! il prend 3 secondes volontairement !

$err .= test_maj_timestamp();

// tests de selections

$err .= test_selections();

// tests de selections entre 2 tables et jointures

$err .= test_selections_entre_table();

// supprimer les tables

$err .= test_drop_table();

if ($err !== '' && $err !== '0') {
	die($err);
}

echo 'OK';
