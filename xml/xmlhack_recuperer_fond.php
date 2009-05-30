<?php

	$test = 'xmlhack_recuperer_fond';
	require '../test.inc';
	
	include_spip('public/assembler');
	$out = recuperer_fond(basename(_SPIP_TEST_INC).'/xml/xmlhack');
	// regarder si le hack a marche
	include_spip('inc/xml');
	$tree = spip_xml_parse($out);
	$ok = reset($tree);
	$ok = reset($ok);
	if ($ok!=='OK') {
		echo ('<dl> Erreur sur le xml produit (xmlhack) : ' . serialize($tree) . '</dl>');
	}
	$out = recuperer_fond(basename(_SPIP_TEST_INC).'/xml/xmlhack_php');
	// regarder si le hack a marche
	include_spip('inc/xml');
	$tree = spip_xml_parse($out);
	$ok1 = reset($tree);
	$ok1 = reset($ok1);
	if ($ok1!=='OK') {
		echo ('<dl> Erreur sur le xml produit (xmlhack_php) : ' . serialize($tree) . '</dl>');
	}

	if ($ok&&$ok1){
		echo "OK";
	}
	
?>