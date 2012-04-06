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

	$essais = essais_typo();
	$err = tester_fun('typo', $essais);
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";

		function essais_typo(){
		$essais = array (
  0 => 
  array (
    0 => 'Quelle question&nbsp;!',
    1 => 'Quelle question!',
  ),
  1 => 
  array (
    0 => '',
    1 => '',
    2 => true,
  ),
  2 => 
  array (
    0 => '',
    1 => '',
    2 => false,
  ),
  3 => 
  array (
    0 => '0',
    1 => '0',
    2 => true,
  ),
  4 => 
  array (
    0 => '0',
    1 => '0',
    2 => false,
  ),
  5 => 
  array (
    0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => true,
  ),
  6 => 
  array (
    0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => false,
  ),
  7 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => true,
  ),
  8 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => false,
  ),
  9 => 
  array (
    0 => 'Un texte sans entites &amp;&lt;>"&#8217;',
    1 => 'Un texte sans entites &<>"\'',
    2 => true,
  ),
  10 => 
  array (
    0 => 'Un texte sans entites &amp;&lt;>"&#8217;',
    1 => 'Un texte sans entites &<>"\'',
    2 => false,
  ),
  11 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} <code class=\'spip_code\' dir=\'ltr\'>du code</code>',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => true,
  ),
  12 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => false,
  ),
  13 => 
  array (
    0 => 'Un modele <tt>&lt;modeleinexistant|lien=[-&gt;</tt>http://www.spip.net]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => true,
  ),
  14 => 
  array (
    0 => 'Un modele <tt>&lt;modeleinexistant|lien=[-&gt;</tt>http://www.spip.net]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => false,
  ),
);
		return $essais;
	}




?>
