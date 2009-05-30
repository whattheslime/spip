<?php


	$test = 'attribut_html';
	require '../test.inc';
	include_spip("inc/filtres");

	$url = "/ecrire/?exec=exec&id_obj=id_obj&no_val";
	$amp = str_replace('&', '&amp;', $url);

	$essais[] =
	 array("aujourd&#39;hui &gt; &quot;30&quot; &rarr; 50","aujourd'hui > \"30\" &rarr; <a href='http://www.spip.net'>50</a>");

	$essais[] = 
	 array('L&#39;histoire &#39;tr&#232;s&#39; &quot;folle&quot; des m&#233;tas en iitalik','L\'histoire \'tr&egrave;s\' "folle" <strong>des</strong>&nbsp;m&eacute;tas<p>en <em>ii</em>talik</p>');

	// le a` risque de matcher \s
	$essais[] =
	array('allons &#224; la mer', 'allons '.chr(195).chr(160).' la mer');

//
// hop ! on y va
//
	$err = tester_fun('attribut_html', $essais);
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";

?>
