<?php
/**
 * Test unitaire de la fonction corriger_entites_html
 * du fichier ./inc/filtres.php
 *
 * genere automatiquement par TestBuilder
 * le 2010-03-16 09:41
 */

	$test = 'corriger_entites_html';
	$remonte = "../";
	while (!is_dir($remonte."ecrire"))
		$remonte = "../$remonte";
	require $remonte.'tests/test.inc';
	find_in_path("./inc/filtres.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('corriger_entites_html', essais_corriger_entites_html());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_corriger_entites_html(){
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
    0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ),
  4 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;&amp;lt;&amp;gt;&amp;quot;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
  ),
  5 => 
  array (
    0 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
  ),
  6 => 
  array (
    0 => 'Un texte avec des entit&#233;s num&#233;riques echap&#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
  ),
  7 => 
  array (
    0 => 'Un texte sans entites &<>"\'',
    1 => 'Un texte sans entites &<>"\'',
  ),
  8 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ),
  9 => 
  array (
    0 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
  ),
  10 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
  ),
);
		return $essais;
	}








?>