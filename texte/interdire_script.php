<?php


	$test = 'attribut_html';
	require '../test.inc';
	include_spip("inc/texte");
	
	$GLOBALS['filtrer_javascript'] = 1;
	$essais[] =
	 array("<script type='text/javascript' src='toto.js'></script>","<script type='text/javascript' src='toto.js'></script>");
	 
	$essais[] =
	 array("<script type='text/javascript' src='spip.php?page=toto'></script>","<script type='text/javascript' src='spip.php?page=toto'></script>");

	$essais[] =
	 array("<script type='text/javascript'>var php=5;</script>","<script type='text/javascript'>var php=5;</script>");
	 
	$essais[] =
	 array("<script language='javascript' src='spip.php?page=toto'></script>","<script language='javascript' src='spip.php?page=toto'></script>");
	 
 	$essais[] =
	 array("&lt;script language='php'>die();</script>","<script language='php'>die();</script>");

 	$essais[] =
	 array("&lt;script language=php>die();</script>","<script language=php>die();</script>");
	 
 	$essais[] =
	 array("&lt;script language = php >die();</script>","<script language = php >die();</script>");

//
// hop ! on y va
//
	$err = tester_fun('interdire_scripts', $essais);

	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('MODE LAXISTE : <dl>' . join('', $err) . '</dl>');
	}
	
	$essais = array();
	$GLOBALS['filtrer_javascript'] = -1;
	$essais[] =
	 array("<code>&lt;script type='text/javascript' src='toto.js'&gt;&lt;/script&gt;</code>","<script type='text/javascript' src='toto.js'></script>");
	 
	$essais[] =
	 array("<code>&lt;script type='text/javascript' src='spip.php?page=toto'&gt;&lt;/script&gt;</code>","<script type='text/javascript' src='spip.php?page=toto'></script>");

	$essais[] =
	 array("<code>&lt;script type='text/javascript'&gt;var php=5;&lt;/script&gt;</code>","<script type='text/javascript'>var php=5;</script>");
	 
	$essais[] =
	 array("<code>&lt;script language='javascript' src='spip.php?page=toto'&gt;&lt;/script&gt;</code>","<script language='javascript' src='spip.php?page=toto'></script>");
	 
 	$essais[] =
	 array("&lt;script language='php'>die();</script>","<script language='php'>die();</script>");

 	$essais[] =
	 array("&lt;script language=php>die();</script>","<script language=php>die();</script>");
	 
 	$essais[] =
	 array("&lt;script language = php >die();</script>","<script language = php >die();</script>");

//
// hop ! on y va
//
	$err = tester_fun('interdire_scripts', $essais);

	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('MODE PARANO : <dl>' . join('', $err) . '</dl>');
	}
	echo "OK";

?>
