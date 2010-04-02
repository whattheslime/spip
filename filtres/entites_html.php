<?php


	$test = 'entites_html';
	require '../test.inc';
	include_spip("inc/filtres");
	

	$essais[] =
	 array("&lt;code&gt;&amp;#233;&lt;/code&gt;&#233;","<code>&#233;</code>&#233;");

//
// hop ! on y va
//
	$err = tester_fun('entites_html', $essais);
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";

function essais_entites_html(){
		$essais = array (
  0 => 
  array (
    0 => '',
    1 => '',
    2 => false,
  ),
  1 => 
  array (
    0 => '0',
    1 => '0',
    2 => false,
  ),
  2 => 
  array (
    0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => false,
  ),
  3 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s &amp;&amp;lt;&amp;gt;&amp;quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => false,
  ),
  4 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    2 => false,
  ),
  5 => 
  array (
    0 => 'Un texte avec des entit&#233;s num&#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    2 => false,
  ),
  6 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    2 => false,
  ),
  7 => 
  array (
    0 => 'Un texte sans entites &amp;&lt;&gt;&quot;\'',
    1 => 'Un texte sans entites &<>"\'',
    2 => false,
  ),
  8 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => false,
  ),
  9 => 
  array (
    0 => 'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => false,
  ),
  10 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    2 => false,
  ),
);
		return $essais;
	}


?>
