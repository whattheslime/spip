<?php
/**
 * Test unitaire de la fonction var2js
 * du fichier ./inc/json.php
 *
 * genere automatiquement par TestBuilder
 * le 2010-07-11 17:53
 */

	$test = 'var2js';
	$remonte = "../";
	while (!is_dir($remonte."ecrire"))
		$remonte = "../$remonte";
	require $remonte.'tests/test.inc';
	find_in_path("./inc/json.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('var2js', essais_var2js());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_var2js(){
		$essais = array (
  0 => 
  array (
    0 => 'true',
    1 => true,
  ),
  1 => 
  array (
    0 => 'false',
    1 => false,
  ),
  2 => 
  array (
    0 => '0',
    1 => 0,
  ),
  3 => 
  array (
    0 => '-1',
    1 => -1,
  ),
  4 => 
  array (
    0 => '1',
    1 => 1,
  ),
  5 => 
  array (
    0 => '2',
    1 => 2,
  ),
  6 => 
  array (
    0 => '3',
    1 => 3,
  ),
  7 => 
  array (
    0 => '4',
    1 => 4,
  ),
  8 => 
  array (
    0 => '5',
    1 => 5,
  ),
  9 => 
  array (
    0 => '6',
    1 => 6,
  ),
  10 => 
  array (
    0 => '7',
    1 => 7,
  ),
  11 => 
  array (
    0 => '10',
    1 => 10,
  ),
  12 => 
  array (
    0 => '20',
    1 => 20,
  ),
  13 => 
  array (
    0 => '30',
    1 => 30,
  ),
  14 => 
  array (
    0 => '50',
    1 => 50,
  ),
  15 => 
  array (
    0 => '100',
    1 => 100,
  ),
  16 => 
  array (
    0 => '1000',
    1 => 1000,
  ),
  17 => 
  array (
    0 => '10000',
    1 => 10000,
  ),
  18 => 
  array (
    0 => '""',
    1 => '',
  ),
  19 => 
  array (
    0 => '"0"',
    1 => '0',
  ),
  20 => 
  array (
    0 => '"Un texte avec des <a href=\\"http:\\/\\/spip.net\\">liens<\\/a> [Article 1->art1] [spip->http:\\/\\/www.spip.net] http:\\/\\/www.spip.net"',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
  ),
  21 => 
  array (
    0 => '"Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;"',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ),
  22 => 
  array (
    0 => '"Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;"',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
  ),
  23 => 
  array (
    0 => '"Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;"',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
  ),
  24 => 
  array (
    0 => '"Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;"',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
  ),
  25 => 
  array (
    0 => '"Un texte sans entites &<>\\"\'"',
    1 => 'Un texte sans entites &<>"\'',
  ),
  26 => 
  array (
    0 => '"{{{Des raccourcis}}} {italique} {{gras}} <code>du code<\\/code>"',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ),
  27 => 
  array (
    0 => '"Un modele <modeleinexistant|lien=[->http:\\/\\/www.spip.net]>"',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
  ),
  28 => 
  array (
    0 => '"Un texte avec des retour\\na la ligne et meme des\\n\\nparagraphes"',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
  ),
  29 => 
  array (
    0 => '[]',
    1 => 
    array (
    ),
  ),
  30 => 
  array (
    0 => '["","0","Un texte avec des <a href=\\"http:\\/\\/spip.net\\">liens<\\/a> [Article 1->art1] [spip->http:\\/\\/www.spip.net] http:\\/\\/www.spip.net","Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;","Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;","Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;","Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;","Un texte sans entites &<>\\"\'","{{{Des raccourcis}}} {italique} {{gras}} <code>du code<\\/code>","Un modele <modeleinexistant|lien=[->http:\\/\\/www.spip.net]>","Un texte avec des retour\\na la ligne et meme des\\n\\nparagraphes"]',
    1 => 
    array (
      0 => '',
      1 => '0',
      2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
      3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
      4 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
      5 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
      6 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
      7 => 'Un texte sans entites &<>"\'',
      8 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
      9 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
      10 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    ),
  ),
  31 => 
  array (
    0 => '[0,-1,1,2,3,4,5,6,7,10,20,30,50,100,1000,10000]',
    1 => 
    array (
      0 => 0,
      1 => -1,
      2 => 1,
      3 => 2,
      4 => 3,
      5 => 4,
      6 => 5,
      7 => 6,
      8 => 7,
      9 => 10,
      10 => 20,
      11 => 30,
      12 => 50,
      13 => 100,
      14 => 1000,
      15 => 10000,
    ),
  ),
  32 => 
  array (
    0 => '[true,false]',
    1 => 
    array (
      0 => true,
      1 => false,
    ),
  ),
  33 => 
  array (
    0 => 'null',
    1 => NULL,
  ),
  34 => 
  array (
    0 => 'null',
    1 => NULL,
  ),
);
		return $essais;
	}










?>