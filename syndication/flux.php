<?php

	$test = 'flux';
	require '../test.inc';

	include_spip('inc/syndic');

	$err = array();


	// Test 1 : la date dans un <dc:date>
	$GLOBALS['controler_dates_rss'] = false; // pour que ce test soit valide dans un an :-)
	$rss = analyser_backend(
		file_get_contents(dirname(__FILE__).'/data/libre-en-fete.rdf')
	);
	if ($rss[0]['date'] != strtotime('2007-03-20T14:00+01:00'))
		$err[] = "erreur de date item 0 sur libre-en-fete.rdf";




	//
	// Resultats
	//
	if ($err)
		var_dump($err);
	else
		echo "OK";

?>
