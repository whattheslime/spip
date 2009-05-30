<?php

	$test = 'extraire_date';
	require '../test.inc';

	include_spip('inc/filtres');

	$essais["2000/01"] = array('2000-01-01', "2000/01");
	$essais["2000/12"] = array('2000-12-01', "2000/12");

	$err = tester_fun('extraire_date', $essais);

	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";

?>
