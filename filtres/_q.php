<?php


	$test = '_q';
	require '../test.inc';
	include_spip("inc/utils");

	// un nombre donne un nombre
	$essais[] =
	 array('12345',12345);

	// une chaine reprensentant un nombre donne la chaine
	$essais[] =
	 array("'0x8488'",'0x8488');

	// une chaine reprensentant un nombre donne la chaine
	$essais[] =
	 array("'12345'",'12345');

	// une chaine donne la chaine
	$essais[] =
	 array("'zorglub'",'zorglub');
	 
	// une chaine donne la chaine
	$essais[] =
	 array("'010. Zorglub'",'010. Zorglub');

	// les ' et " sont echapees
	$essais[] =
	 array("'1\\\"2\\'3'",'1"2\'3');


//
// hop ! on y va
//
	$err = tester_fun('_q', $essais);
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";

?>
