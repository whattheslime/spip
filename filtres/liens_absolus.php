<?php

	(isset($test) && $test) || ($test = 'liens_absolus');
	require '../test.inc';
	include_spip('inc/filtres');

	$essais["lien prive"] =
	 array("bla bla <a href='".generer_url_ecrire('toto','truc=machin&chose=bidule',false,false)."'>lien prive</a>",
	 "bla bla <a href='".generer_url_ecrire('toto','truc=machin&chose=bidule',false,true)."'>lien prive</a>");

	$essais["lien public"] =
	 array("bla bla <a href='".generer_url_public('toto','truc=machin&chose=bidule',false,false)."'>lien public</a>",
	 "bla bla <a href='"._DIR_RACINE.generer_url_public('toto','truc=machin&chose=bidule',false,true)."'>lien public</a>");
	 
	$essais["mailto"] =
	 array("bla bla <a href='mailto:toto'>email</a>",
	 "bla bla <a href='mailto:toto'>email</a>");
	 
	$essais["javascript"] =
	 array("bla bla <a href='javascript:open()'>javascript</a>",
	 "bla bla <a href='javascript:open()'>javascript</a>");

	//
	// hop ! on y va
	//

	# tests invalides si _SPIP_SCRIPT vaut ''
	if (_SPIP_SCRIPT === '')
		die ('NA _SPIP_SCRIPT=""'); # non applicable

	$err = tester_fun('liens_absolus', $essais);

	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";

?>
