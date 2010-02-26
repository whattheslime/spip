<?php
/**
 * Test unitaire de la fonction proteger_amp
 * du fichier inc/filtres.php
 *
 * genere automatiquement par TestBuilder
 * le 
 */

	$test = 'proteger_amp';
	require '../test.inc';
	find_in_path("inc/filtres.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('proteger_amp', essais_proteger_amp());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

												function essais_proteger_amp(){
		$essais = array (
  0 => 
  array (
    0 => '',
    1 => '',
  ),
  1 => 
  array (
    0 => '0',
    1 => '0',
  ),
  2 => 
  array (
    0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
  ),
  3 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ),
  4 => 
  array (
    0 => 'Un texte sans entites &amp;<>"\'',
    1 => 'Un texte sans entites &<>"\'',
  ),
  5 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ),
  6 => 
  array (
    0 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
  ),
);
		return $essais;
	}














?>