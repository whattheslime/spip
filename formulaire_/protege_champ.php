<?php
/**
 * Test unitaire de la fonction protege_champ
 * du fichier ./balise/formulaire_.php
 *
 * genere automatiquement par TestBuilder
 * le 2010-03-15 23:31
 */

	$test = 'protege_champ';
	$remonte = "../";
	while (!is_dir($remonte."ecrire"))
		$remonte = "../$remonte";
	require $remonte.'tests/test.inc';
	find_in_path("./balise/formulaire_.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('protege_champ', essais_protege_champ());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_protege_champ(){
		$essais = array (
  0 => 
  array (
    0 => 'i:1;',
    1 => 'i:1;',
  ),
  1 => 
  array (
    0 => 's:4:"toto";',
    1 => 's:4:"toto";',
  ),
  2 => 
  array (
    0 => 'b:1;',
    1 => 'b:1;',
  ),
  3 => 
  array (
    0 => 'b:0;',
    1 => 'b:0;',
  ),
  4 => 
  array (
    0 => 'a:1:{i:0;s:4:"toto";}',
    1 => 'a:1:{i:0;s:4:"toto";}',
  ),
  5 => 
  array (
    0 => '',
    1 => '',
  ),
  6 => 
  array (
    0 => '0',
    1 => '0',
  ),
  7 => 
  array (
    0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
  ),
  8 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s &amp;&amp;lt;&amp;gt;&amp;quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ),
  9 => 
  array (
    0 => 'Un texte sans entites &amp;&lt;&gt;&quot;&#039;',
    1 => 'Un texte sans entites &<>"\'',
  ),
  10 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ),
  11 => 
  array (
    0 => 'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
  ),
  12 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
  ),
  13 => 
  array (
    0 => 
    array (
    ),
    1 => 
    array (
    ),
  ),
  14 => 
  array (
    0 => 
    array (
      0 => '',
      1 => '0',
      2 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net',
      3 => 'Un texte avec des entit&amp;eacute;s &amp;&amp;lt;&amp;gt;&amp;quot;',
      4 => 'Un texte sans entites &amp;&lt;&gt;&quot;&#039;',
      5 => '{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;',
      6 => 'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;',
      7 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    ),
    1 => 
    array (
      0 => '',
      1 => '0',
      2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
      3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
      4 => 'Un texte sans entites &<>"\'',
      5 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
      6 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
      7 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    ),
  ),
  15 => 
  array (
    0 => 
    array (
      0 => '0',
      1 => '-1',
      2 => '1',
      3 => '2',
      4 => '3',
      5 => '4',
      6 => '5',
      7 => '6',
      8 => '7',
      9 => '10',
      10 => '20',
      11 => '30',
      12 => '50',
      13 => '100',
      14 => '1000',
      15 => '10000',
    ),
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
  16 => 
  array (
    0 => 
    array (
      0 => '1',
      1 => '',
    ),
    1 => 
    array (
      0 => true,
      1 => false,
    ),
  ),
  17 => 
  array (
    0 => NULL,
    1 => NULL,
  ),
);
		return $essais;
	}










?>