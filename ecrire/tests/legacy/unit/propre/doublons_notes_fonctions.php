<?php

declare(strict_types=1);

/*
	Creation article de test pour doublons_notes.html
	On cherche un document, on le met dans la note d'un texte,
*/

function creer_article_a_doublons_notes()
{
	$res = sql_query(
		"SELECT id_document FROM spip_documents WHERE mode NOT IN ('logoon','logooff','vignette') ORDER BY rand() LIMIT 1"
	);
	if ($a = sql_fetch($res)) {
		[$doc] = array_values($a);
		sql_query(
			"REPLACE INTO spip_articles (id_article, titre, statut, texte) VALUES (-1, 'test pour doublons_notes.html', 'prepa', 'hello [[ xx <doc{$doc}> ]].')"
		);
	} else {
		die('NA il faut un document');
	}
}
