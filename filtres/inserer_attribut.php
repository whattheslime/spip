<?php
/**
 * Test unitaire de la fonction inserer_attribut
 * du fichier ./inc/filtres.php
 *
 * genere automatiquement par TestBuilder
 * le 2010-03-06 15:05
 */

	$test = 'inserer_attribut';
	$remonte = "../";
	while (!is_dir($remonte."ecrire"))
		$remonte = "../$remonte";
	require $remonte.'tests/test.inc';
	find_in_path("./inc/filtres.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('inserer_attribut', essais_inserer_attribut());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_inserer_attribut(){
		$essais = array (
  0 => 
  array (
    0 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => '',
    4 => true,
    5 => true,
  ),
  1 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => '',
    4 => true,
    5 => false,
  ),
  2 => 
  array (
    0 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => '',
    4 => false,
    5 => true,
  ),
  3 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => '',
    4 => false,
    5 => false,
  ),
  4 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'0\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => '0',
    4 => true,
    5 => true,
  ),
  5 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'0\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => '0',
    4 => true,
    5 => false,
  ),
  6 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'0\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => '0',
    4 => false,
    5 => true,
  ),
  7 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'0\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => '0',
    4 => false,
    5 => false,
  ),
  8 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un texte avec des &lt;a href=&quot;http://spip.net/&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    4 => true,
    5 => true,
  ),
  9 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un texte avec des &lt;a href=&quot;http://spip.net/&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    4 => true,
    5 => false,
  ),
  10 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    4 => false,
    5 => true,
  ),
  11 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    4 => false,
    5 => false,
  ),
  12 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un texte avec des entit&#233;s &#38;&lt;&gt;&quot;\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    4 => true,
    5 => true,
  ),
  13 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un texte avec des entit&#233;s &#38;&lt;&gt;&quot;\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    4 => true,
    5 => false,
  ),
  14 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    4 => false,
    5 => true,
  ),
  15 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    4 => false,
    5 => false,
  ),
  16 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un texte sans entites &#38;&lt;&gt;&quot;&#039;\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte sans entites &<>"\'',
    4 => true,
    5 => true,
  ),
  17 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un texte sans entites &#38;&lt;&gt;&quot;&#039;\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte sans entites &<>"\'',
    4 => true,
    5 => false,
  ),
  18 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un texte sans entites &<>"&#039;\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte sans entites &<>"\'',
    4 => false,
    5 => true,
  ),
  19 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un texte sans entites &<>"&#039;\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte sans entites &<>"\'',
    4 => false,
    5 => false,
  ),
  20 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    4 => true,
    5 => true,
  ),
  21 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    4 => true,
    5 => false,
  ),
  22 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    4 => false,
    5 => true,
  ),
  23 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    4 => false,
    5 => false,
  ),
  24 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    4 => true,
    5 => true,
  ),
  25 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    4 => true,
    5 => false,
  ),
  26 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un modele <modeleinexistant|lien=[->http://www.spip.net]>\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    4 => false,
    5 => true,
  ),
  27 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un modele <modeleinexistant|lien=[->http://www.spip.net]>\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    4 => false,
    5 => false,
  ),
  28 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un texte avec des retour
a la ligne et meme des paragraphes\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    4 => true,
    5 => true,
  ),
  29 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un texte avec des retour
a la ligne et meme des paragraphes\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    4 => true,
    5 => false,
  ),
  30 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un texte avec des retour
a la ligne et meme des

paragraphes\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    4 => false,
    5 => true,
  ),
  31 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un texte avec des retour
a la ligne et meme des

paragraphes\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    4 => false,
    5 => false,
  ),
  32 => 
  array (
    0 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => '',
    4 => true,
    5 => true,
  ),
  33 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => '',
    4 => true,
    5 => false,
  ),
  34 => 
  array (
    0 => '<a href=\'http://www.spip.net\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => '',
    4 => false,
    5 => true,
  ),
  35 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => '',
    4 => false,
    5 => false,
  ),
  36 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'0\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => '0',
    4 => true,
    5 => true,
  ),
  37 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'0\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => '0',
    4 => true,
    5 => false,
  ),
  38 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'0\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => '0',
    4 => false,
    5 => true,
  ),
  39 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'0\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => '0',
    4 => false,
    5 => false,
  ),
  40 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un texte avec des &lt;a href=&quot;http://spip.net/&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    4 => true,
    5 => true,
  ),
  41 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un texte avec des &lt;a href=&quot;http://spip.net/&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    4 => true,
    5 => false,
  ),
  42 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    4 => false,
    5 => true,
  ),
  43 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    4 => false,
    5 => false,
  ),
  44 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un texte avec des entit&#233;s &#38;&lt;&gt;&quot;\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    4 => true,
    5 => true,
  ),
  45 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un texte avec des entit&#233;s &#38;&lt;&gt;&quot;\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    4 => true,
    5 => false,
  ),
  46 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    4 => false,
    5 => true,
  ),
  47 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    4 => false,
    5 => false,
  ),
  48 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un texte sans entites &#38;&lt;&gt;&quot;&#039;\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte sans entites &<>"\'',
    4 => true,
    5 => true,
  ),
  49 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un texte sans entites &#38;&lt;&gt;&quot;&#039;\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte sans entites &<>"\'',
    4 => true,
    5 => false,
  ),
  50 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un texte sans entites &<>"&#039;\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte sans entites &<>"\'',
    4 => false,
    5 => true,
  ),
  51 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un texte sans entites &<>"&#039;\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte sans entites &<>"\'',
    4 => false,
    5 => false,
  ),
  52 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    4 => true,
    5 => true,
  ),
  53 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    4 => true,
    5 => false,
  ),
  54 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    4 => false,
    5 => true,
  ),
  55 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    4 => false,
    5 => false,
  ),
  56 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    4 => true,
    5 => true,
  ),
  57 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    4 => true,
    5 => false,
  ),
  58 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un modele <modeleinexistant|lien=[->http://www.spip.net]>\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    4 => false,
    5 => true,
  ),
  59 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un modele <modeleinexistant|lien=[->http://www.spip.net]>\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    4 => false,
    5 => false,
  ),
  60 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un texte avec des retour
a la ligne et meme des paragraphes\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    4 => true,
    5 => true,
  ),
  61 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un texte avec des retour
a la ligne et meme des paragraphes\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    4 => true,
    5 => false,
  ),
  62 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un texte avec des retour
a la ligne et meme des

paragraphes\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    4 => false,
    5 => true,
  ),
  63 => 
  array (
    0 => '<a href=\'http://www.spip.net\' title=\'Un texte avec des retour
a la ligne et meme des

paragraphes\'>SPIP</a>',
    1 => '<a href=\'http://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    4 => false,
    5 => false,
  ),
  64 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    2 => 'alt',
    3 => '',
    4 => true,
    5 => true,
  ),
  65 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    2 => 'alt',
    3 => '',
    4 => true,
    5 => false,
  ),
  66 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    2 => 'alt',
    3 => '',
    4 => false,
    5 => true,
  ),
  67 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    2 => 'alt',
    3 => '',
    4 => false,
    5 => false,
  ),
  68 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'0\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    2 => 'alt',
    3 => '0',
    4 => true,
    5 => true,
  ),
  69 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'0\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    2 => 'alt',
    3 => '0',
    4 => true,
    5 => false,
  ),
  70 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'0\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    2 => 'alt',
    3 => '0',
    4 => false,
    5 => true,
  ),
  71 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'0\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    2 => 'alt',
    3 => '0',
    4 => false,
    5 => false,
  ),
  72 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un texte avec des &lt;a href=&quot;http://spip.net/&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    4 => true,
    5 => true,
  ),
  73 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un texte avec des &lt;a href=&quot;http://spip.net/&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    4 => true,
    5 => false,
  ),
  74 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    4 => false,
    5 => true,
  ),
  75 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    4 => false,
    5 => false,
  ),
  76 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un texte avec des entit&#233;s &#38;&lt;&gt;&quot;\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    4 => true,
    5 => true,
  ),
  77 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un texte avec des entit&#233;s &#38;&lt;&gt;&quot;\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    4 => true,
    5 => false,
  ),
  78 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    4 => false,
    5 => true,
  ),
  79 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    4 => false,
    5 => false,
  ),
  80 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un texte sans entites &#38;&lt;&gt;&quot;&#039;\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    2 => 'alt',
    3 => 'Un texte sans entites &<>"\'',
    4 => true,
    5 => true,
  ),
  81 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un texte sans entites &#38;&lt;&gt;&quot;&#039;\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    2 => 'alt',
    3 => 'Un texte sans entites &<>"\'',
    4 => true,
    5 => false,
  ),
  82 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un texte sans entites &<>"&#039;\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    2 => 'alt',
    3 => 'Un texte sans entites &<>"\'',
    4 => false,
    5 => true,
  ),
  83 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un texte sans entites &<>"&#039;\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    2 => 'alt',
    3 => 'Un texte sans entites &<>"\'',
    4 => false,
    5 => false,
  ),
  84 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    2 => 'alt',
    3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    4 => true,
    5 => true,
  ),
  85 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    2 => 'alt',
    3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    4 => true,
    5 => false,
  ),
  86 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    2 => 'alt',
    3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    4 => false,
    5 => true,
  ),
  87 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    2 => 'alt',
    3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    4 => false,
    5 => false,
  ),
  88 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    2 => 'alt',
    3 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    4 => true,
    5 => true,
  ),
  89 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    2 => 'alt',
    3 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    4 => true,
    5 => false,
  ),
  90 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un modele <modeleinexistant|lien=[->http://www.spip.net]>\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    2 => 'alt',
    3 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    4 => false,
    5 => true,
  ),
  91 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un modele <modeleinexistant|lien=[->http://www.spip.net]>\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    2 => 'alt',
    3 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    4 => false,
    5 => false,
  ),
  92 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un texte avec des retour
a la ligne et meme des paragraphes\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    4 => true,
    5 => true,
  ),
  93 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un texte avec des retour
a la ligne et meme des paragraphes\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    4 => true,
    5 => false,
  ),
  94 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un texte avec des retour
a la ligne et meme des

paragraphes\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    4 => false,
    5 => true,
  ),
  95 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un texte avec des retour
a la ligne et meme des

paragraphes\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    4 => false,
    5 => false,
  ),
  96 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => '',
    4 => true,
    5 => true,
  ),
  97 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => '',
    4 => true,
    5 => false,
  ),
  98 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => '',
    4 => false,
    5 => true,
  ),
  99 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => '',
    4 => false,
    5 => false,
  ),
  100 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'0\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => '0',
    4 => true,
    5 => true,
  ),
  101 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'0\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => '0',
    4 => true,
    5 => false,
  ),
  102 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'0\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => '0',
    4 => false,
    5 => true,
  ),
  103 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'0\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => '0',
    4 => false,
    5 => false,
  ),
  104 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un texte avec des &lt;a href=&quot;http://spip.net/&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    4 => true,
    5 => true,
  ),
  105 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un texte avec des &lt;a href=&quot;http://spip.net/&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    4 => true,
    5 => false,
  ),
  106 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    4 => false,
    5 => true,
  ),
  107 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    4 => false,
    5 => false,
  ),
  108 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un texte avec des entit&#233;s &#38;&lt;&gt;&quot;\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    4 => true,
    5 => true,
  ),
  109 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un texte avec des entit&#233;s &#38;&lt;&gt;&quot;\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    4 => true,
    5 => false,
  ),
  110 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    4 => false,
    5 => true,
  ),
  111 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    4 => false,
    5 => false,
  ),
  112 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un texte sans entites &#38;&lt;&gt;&quot;&#039;\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un texte sans entites &<>"\'',
    4 => true,
    5 => true,
  ),
  113 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un texte sans entites &#38;&lt;&gt;&quot;&#039;\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un texte sans entites &<>"\'',
    4 => true,
    5 => false,
  ),
  114 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un texte sans entites &<>"&#039;\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un texte sans entites &<>"\'',
    4 => false,
    5 => true,
  ),
  115 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un texte sans entites &<>"&#039;\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un texte sans entites &<>"\'',
    4 => false,
    5 => false,
  ),
  116 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    4 => true,
    5 => true,
  ),
  117 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    4 => true,
    5 => false,
  ),
  118 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    4 => false,
    5 => true,
  ),
  119 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    4 => false,
    5 => false,
  ),
  120 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    4 => true,
    5 => true,
  ),
  121 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    4 => true,
    5 => false,
  ),
  122 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un modele <modeleinexistant|lien=[->http://www.spip.net]>\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    4 => false,
    5 => true,
  ),
  123 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un modele <modeleinexistant|lien=[->http://www.spip.net]>\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    4 => false,
    5 => false,
  ),
  124 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un texte avec des retour
a la ligne et meme des paragraphes\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    4 => true,
    5 => true,
  ),
  125 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un texte avec des retour
a la ligne et meme des paragraphes\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    4 => true,
    5 => false,
  ),
  126 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un texte avec des retour
a la ligne et meme des

paragraphes\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    4 => false,
    5 => true,
  ),
  127 => 
  array (
    0 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'Un texte avec des retour
a la ligne et meme des

paragraphes\' /></a>',
    1 => '<a href=\'http://www.spip.net\'><img src=\'http://www.spip.net/squelettes/img/spip.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    4 => false,
    5 => false,
  ),
  128 => 
  array (
    0 => '<input value=\'&lt;span style=&quot;color:red;&quot;&gt;ho&lt;/span&gt;\' />',
    1 => '<input />',
    2 => 'value',
    3 => '<span style="color:red;">ho</span>',
  ),
);
		return $essais;
	}



















































?>