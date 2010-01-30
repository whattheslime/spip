<?php

	$test = 'date_iso';
	require '../test.inc';

	include_spip('inc/filtres');

	$essais["01-01-2010"] = array(gmdate('Y-m-d\TH:i:s\Z', mktime(2, 5, 30, 1, 1, 2010)), "2010-01-01 02:05:30");
	$essais["nc-01-2010"] = array(gmdate('Y-m-d\TH:i:s\Z', mktime(3, 6, 40, 1, 1, 2010)), "2010-01-00 03:06:40");
	$essais["nc-nc-2010"] = array(gmdate('Y-m-d\TH:i:s\Z', mktime(4, 7, 50, 1, 1, 2010)), "2010-00-00 04:07:50");

	// si le tableau $err est pas vide ca va pas
	$err = tester_fun('date_iso', $essais);

	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";

?>
