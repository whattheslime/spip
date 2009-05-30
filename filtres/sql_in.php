<?php

	require '../test.inc';
	
	include_spip('base/abstract_sql');
	if (function_exists('sql_in'))
		$test = 'sql_in';
	else
		$test = 'calcul_mysql_in';
		


	$essais[] =
	 array('((i  IN (1,2,3)))','i','1,2,3');

	$essais[] =
	 array('((i  IN ("a","b","c")))','i','"a","b","c"');

	$essais[] =
	 array("((i  IN (1,2,4)))",'i',array(1,2,4));

	$essais[] =
	 array("((i  IN ('a','b','c')))",'i',array('a','b','c'));


	// ce test ne peut pas marcher avec _q(), il faut eviter le hex
	// dans toute cette histoire
#	$essais[] =
#	 array('((referer_md5 IN (0x8488c20259e2c09)))','referer_md5','0x8488c20259e2c09');

//
// hop ! on y va
//
	$err = tester_fun($test, $essais);
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";

?>
