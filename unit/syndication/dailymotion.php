<?php

/*
 * Syndiquer les <media:content> de dailymotion / yahoo.rss
 */

	$test = 'dailymotion.rss';
	$remonte = "../";
	while (!is_dir($remonte."ecrire"))
		$remonte = "../$remonte";
	require $remonte.'tests/test.inc';

	include_spip('inc/syndic');
	$GLOBALS['controler_dates_rss'] = false;

	$rss = analyser_backend(
		file_get_contents(dirname(__FILE__).'/data/dailymotion.rss')
//		file_get_contents(dirname(__FILE__).'/data/test-atom1-1.xml') 
	);

	$err = array();

	if (4 != count(extraire_balises($rss[0]['enclosures'], 'a')))
		$err[] = "mauvais compte d'enclosures sur le premier item";

	if ($err)
		var_dump($err);
	else
		echo "OK";

?>
