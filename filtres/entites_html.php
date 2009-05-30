<?php


	$test = 'entites_html';
	require '../test.inc';
	include_spip("inc/filtres");
	

	$essais[] =
	 array("&lt;code&gt;&amp;#233;&lt;/code&gt;&#233;","<code>&#233;</code>&#233;");

//
// hop ! on y va
//
	$err = tester_fun('entites_html', $essais);
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";

?>
