<?php

	$test = 'typo';
	require '../test.inc';

	include_spip('inc/texte');

	lang_select('fr');

	// un ! mais pas deux
	$essais[] = array('Chat&nbsp;!!', "Chat!!");
	// et pas apres "(" -- http://trac.rezo.net/trac/spip/changeset/10177
	$essais[] = array('(!)', "(!)");

	$err = tester_fun('typo', $essais);

	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";

?>
