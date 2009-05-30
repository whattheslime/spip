<?php

	$test = 'flux';
	require '../test.inc';

	include_spip('inc/syndic');
	$GLOBALS['controler_dates_rss'] = false;

	$rss = analyser_backend(
		file_get_contents(dirname(__FILE__).'/data/libre-en-fete.rdf')
	);

	$err = array();

	if ($rss[0]['date'] != strtotime('2007-03-20T14:00+01:00'))
		$err[] = "erreur de date item 0 sur libre-en-fete.rdf";


	if ($err)
		var_dump($err);
	else
		echo "OK";

?>
