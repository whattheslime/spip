<?php
/*
	Creation article de test pour doublons_notes.html
	On cherche un document, on le met dans la note d'un texte,
*/

function creer_article_a_doublons_notes() {
	$res = spip_query("SELECT id_document from spip_documents order by rand() limit 1");
	list($doc) = array_values(sql_fetch($res));
	spip_query("REPLACE spip_articles (id_article, titre, statut, texte) VALUES (-1, 'test pour doublons_notes.html', 'prepa', 'hello [[ xx <doc$doc> ]].')");
}

?>
