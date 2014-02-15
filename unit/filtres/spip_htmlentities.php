<?php
/**
 * Test unitaire de la fonction spip_htmlentities
 * du fichier ./inc/filtres.php
 *
 * genere automatiquement par TestBuilder
 * le 2013-12-13 17:38
 */

	$test = 'spip_htmlentities';
	$remonte = "../";
	while (!is_dir($remonte."ecrire"))
		$remonte = "../$remonte";
	require $remonte.'tests/test.inc';
	find_in_path("./inc/filtres.php",'',true);

	// chercher la fonction si elle n'existe pas
	if (!function_exists($f='spip_htmlentities')){
		find_in_path("inc/filtres.php",'',true);
		$f = chercher_filtre($f);
	}
	if (!$f) die ("pas trouve la fonction $test");

	//
	// hop ! on y va
	//
	$err = tester_fun($f, essais_spip_htmlentities());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_spip_htmlentities(){
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
    0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
  ),
  3 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ),
  4 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
  ),
  5 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
  ),
  6 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
  ),
  7 => 
  array (
    0 => 'Un texte sans entites &amp;&lt;&gt;&quot;\'',
    1 => 'Un texte sans entites &<>"\'',
  ),
  8 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ),
  9 => 
  array (
    0 => 'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;',
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
  11 => 
  array (
    0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;&lt;/a&gt; [Article 1 avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;art1] [spip avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents ISO aàâä eéèêë iîï oô uùü</a> [Article 1 avec des accents ISO aàâä eéèêë iîï oô uùü->art1] [spip avec des accents ISO aàâä eéèêë iîï oô uùü->http://www.spip.net] http://www.spip.net',
  ),
  12 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
  ),
  13 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
  ),
  14 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
  ),
  15 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
  ),
  16 => 
  array (
    0 => 'Un texte sans entites &amp;&lt;&gt;&quot;\' et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte sans entites &<>"\' et avec des accents ISO aàâä eéèêë iîï oô uùü',
  ),
  17 => 
  array (
    0 => '{{{Des raccourcis avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;}}} {italique avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;} {{gras avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;}} &lt;code&gt;du code avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;&lt;/code&gt;',
    1 => '{{{Des raccourcis avec des accents ISO aàâä eéèêë iîï oô uùü}}} {italique avec des accents ISO aàâä eéèêë iîï oô uùü} {{gras avec des accents ISO aàâä eéèêë iîï oô uùü}} <code>du code avec des accents ISO aàâä eéèêë iîï oô uùü</code>',
  ),
  18 => 
  array (
    0 => 'Un modele avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml; &lt;modeleinexistant|lien=[avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;http://www.spip.net]&gt;',
    1 => 'Un modele avec des accents ISO aàâä eéèêë iîï oô uùü <modeleinexistant|lien=[avec des accents ISO aàâä eéèêë iîï oô uùü->http://www.spip.net]>',
  ),
  19 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents ISO aàâä eéèêë iîï oô uùü',
  ),
  20 => 
  array (
    0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;&lt;/a&gt; [Article 1 avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;-&gt;art1] [spip avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;-&gt;http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</a> [Article 1 avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->art1] [spip avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->http://www.spip.net] http://www.spip.net',
  ),
  21 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
  ),
  22 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
  ),
  23 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
  ),
  24 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
  ),
  25 => 
  array (
    0 => 'Un texte sans entites &amp;&lt;&gt;&quot;\' et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte sans entites &<>"\' et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
  ),
  26 => 
  array (
    0 => '{{{Des raccourcis avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;}}} {italique avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;} {{gras avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;}} &lt;code&gt;du code avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;&lt;/code&gt;',
    1 => '{{{Des raccourcis avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}}} {italique avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼} {{gras avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}} <code>du code avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</code>',
  ),
  27 => 
  array (
    0 => 'Un modele avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14; &lt;modeleinexistant|lien=[avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;-&gt;http://www.spip.net]&gt;',
    1 => 'Un modele avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼ <modeleinexistant|lien=[avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->http://www.spip.net]>',
  ),
  28 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
  ),
  29 => 
  array (
    0 => '',
    1 => '',
    2 => ENT_COMPAT|ENT_HTML401,
  ),
  30 => 
  array (
    0 => '0',
    1 => '0',
    2 => ENT_COMPAT|ENT_HTML401,
  ),
  31 => 
  array (
    0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => ENT_COMPAT|ENT_HTML401,
  ),
  32 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => ENT_COMPAT|ENT_HTML401,
  ),
  33 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    2 => ENT_COMPAT|ENT_HTML401,
  ),
  34 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    2 => ENT_COMPAT|ENT_HTML401,
  ),
  35 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    2 => ENT_COMPAT|ENT_HTML401,
  ),
  36 => 
  array (
    0 => 'Un texte sans entites &amp;&lt;&gt;&quot;\'',
    1 => 'Un texte sans entites &<>"\'',
    2 => ENT_COMPAT|ENT_HTML401,
  ),
  37 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => ENT_COMPAT|ENT_HTML401,
  ),
  38 => 
  array (
    0 => 'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => ENT_COMPAT|ENT_HTML401,
  ),
  39 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    2 => ENT_COMPAT|ENT_HTML401,
  ),
  40 => 
  array (
    0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;&lt;/a&gt; [Article 1 avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;art1] [spip avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents ISO aàâä eéèêë iîï oô uùü</a> [Article 1 avec des accents ISO aàâä eéèêë iîï oô uùü->art1] [spip avec des accents ISO aàâä eéèêë iîï oô uùü->http://www.spip.net] http://www.spip.net',
    2 => ENT_COMPAT|ENT_HTML401,
  ),
  41 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_COMPAT|ENT_HTML401,
  ),
  42 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_COMPAT|ENT_HTML401,
  ),
  43 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_COMPAT|ENT_HTML401,
  ),
  44 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_COMPAT|ENT_HTML401,
  ),
  45 => 
  array (
    0 => 'Un texte sans entites &amp;&lt;&gt;&quot;\' et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte sans entites &<>"\' et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_COMPAT|ENT_HTML401,
  ),
  46 => 
  array (
    0 => '{{{Des raccourcis avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;}}} {italique avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;} {{gras avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;}} &lt;code&gt;du code avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;&lt;/code&gt;',
    1 => '{{{Des raccourcis avec des accents ISO aàâä eéèêë iîï oô uùü}}} {italique avec des accents ISO aàâä eéèêë iîï oô uùü} {{gras avec des accents ISO aàâä eéèêë iîï oô uùü}} <code>du code avec des accents ISO aàâä eéèêë iîï oô uùü</code>',
    2 => ENT_COMPAT|ENT_HTML401,
  ),
  47 => 
  array (
    0 => 'Un modele avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml; &lt;modeleinexistant|lien=[avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;http://www.spip.net]&gt;',
    1 => 'Un modele avec des accents ISO aàâä eéèêë iîï oô uùü <modeleinexistant|lien=[avec des accents ISO aàâä eéèêë iîï oô uùü->http://www.spip.net]>',
    2 => ENT_COMPAT|ENT_HTML401,
  ),
  48 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_COMPAT|ENT_HTML401,
  ),
  49 => 
  array (
    0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;&lt;/a&gt; [Article 1 avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;-&gt;art1] [spip avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;-&gt;http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</a> [Article 1 avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->art1] [spip avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->http://www.spip.net] http://www.spip.net',
    2 => ENT_COMPAT|ENT_HTML401,
  ),
  50 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_COMPAT|ENT_HTML401,
  ),
  51 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_COMPAT|ENT_HTML401,
  ),
  52 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_COMPAT|ENT_HTML401,
  ),
  53 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_COMPAT|ENT_HTML401,
  ),
  54 => 
  array (
    0 => 'Un texte sans entites &amp;&lt;&gt;&quot;\' et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte sans entites &<>"\' et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_COMPAT|ENT_HTML401,
  ),
  55 => 
  array (
    0 => '{{{Des raccourcis avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;}}} {italique avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;} {{gras avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;}} &lt;code&gt;du code avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;&lt;/code&gt;',
    1 => '{{{Des raccourcis avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}}} {italique avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼} {{gras avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}} <code>du code avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</code>',
    2 => ENT_COMPAT|ENT_HTML401,
  ),
  56 => 
  array (
    0 => 'Un modele avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14; &lt;modeleinexistant|lien=[avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;-&gt;http://www.spip.net]&gt;',
    1 => 'Un modele avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼ <modeleinexistant|lien=[avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->http://www.spip.net]>',
    2 => ENT_COMPAT|ENT_HTML401,
  ),
  57 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_COMPAT|ENT_HTML401,
  ),
  58 => 
  array (
    0 => '',
    1 => '',
    2 => ENT_QUOTES,
  ),
  59 => 
  array (
    0 => '0',
    1 => '0',
    2 => ENT_QUOTES,
  ),
  60 => 
  array (
    0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => ENT_QUOTES,
  ),
  61 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => ENT_QUOTES,
  ),
  62 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    2 => ENT_QUOTES,
  ),
  63 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    2 => ENT_QUOTES,
  ),
  64 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    2 => ENT_QUOTES,
  ),
  65 => 
  array (
    0 => 'Un texte sans entites &amp;&lt;&gt;&quot;&#039;',
    1 => 'Un texte sans entites &<>"\'',
    2 => ENT_QUOTES,
  ),
  66 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => ENT_QUOTES,
  ),
  67 => 
  array (
    0 => 'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => ENT_QUOTES,
  ),
  68 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    2 => ENT_QUOTES,
  ),
  69 => 
  array (
    0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;&lt;/a&gt; [Article 1 avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;art1] [spip avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents ISO aàâä eéèêë iîï oô uùü</a> [Article 1 avec des accents ISO aàâä eéèêë iîï oô uùü->art1] [spip avec des accents ISO aàâä eéèêë iîï oô uùü->http://www.spip.net] http://www.spip.net',
    2 => ENT_QUOTES,
  ),
  70 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_QUOTES,
  ),
  71 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_QUOTES,
  ),
  72 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_QUOTES,
  ),
  73 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_QUOTES,
  ),
  74 => 
  array (
    0 => 'Un texte sans entites &amp;&lt;&gt;&quot;&#039; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte sans entites &<>"\' et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_QUOTES,
  ),
  75 => 
  array (
    0 => '{{{Des raccourcis avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;}}} {italique avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;} {{gras avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;}} &lt;code&gt;du code avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;&lt;/code&gt;',
    1 => '{{{Des raccourcis avec des accents ISO aàâä eéèêë iîï oô uùü}}} {italique avec des accents ISO aàâä eéèêë iîï oô uùü} {{gras avec des accents ISO aàâä eéèêë iîï oô uùü}} <code>du code avec des accents ISO aàâä eéèêë iîï oô uùü</code>',
    2 => ENT_QUOTES,
  ),
  76 => 
  array (
    0 => 'Un modele avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml; &lt;modeleinexistant|lien=[avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;http://www.spip.net]&gt;',
    1 => 'Un modele avec des accents ISO aàâä eéèêë iîï oô uùü <modeleinexistant|lien=[avec des accents ISO aàâä eéèêë iîï oô uùü->http://www.spip.net]>',
    2 => ENT_QUOTES,
  ),
  77 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_QUOTES,
  ),
  78 => 
  array (
    0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;&lt;/a&gt; [Article 1 avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;-&gt;art1] [spip avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;-&gt;http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</a> [Article 1 avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->art1] [spip avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->http://www.spip.net] http://www.spip.net',
    2 => ENT_QUOTES,
  ),
  79 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_QUOTES,
  ),
  80 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_QUOTES,
  ),
  81 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_QUOTES,
  ),
  82 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_QUOTES,
  ),
  83 => 
  array (
    0 => 'Un texte sans entites &amp;&lt;&gt;&quot;&#039; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte sans entites &<>"\' et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_QUOTES,
  ),
  84 => 
  array (
    0 => '{{{Des raccourcis avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;}}} {italique avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;} {{gras avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;}} &lt;code&gt;du code avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;&lt;/code&gt;',
    1 => '{{{Des raccourcis avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}}} {italique avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼} {{gras avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}} <code>du code avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</code>',
    2 => ENT_QUOTES,
  ),
  85 => 
  array (
    0 => 'Un modele avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14; &lt;modeleinexistant|lien=[avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;-&gt;http://www.spip.net]&gt;',
    1 => 'Un modele avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼ <modeleinexistant|lien=[avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->http://www.spip.net]>',
    2 => ENT_QUOTES,
  ),
  86 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_QUOTES,
  ),
  87 => 
  array (
    0 => '',
    1 => '',
	  2 => ENT_NOQUOTES,
  ),
  88 => 
  array (
    0 => '0',
    1 => '0',
    2 => ENT_NOQUOTES,
  ),
  89 => 
  array (
    0 => 'Un texte avec des &lt;a href="http://spip.net"&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => ENT_NOQUOTES,
  ),
  90 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => ENT_NOQUOTES,
  ),
  91 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    2 => ENT_NOQUOTES,
  ),
  92 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    2 => ENT_NOQUOTES,
  ),
  93 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    2 => ENT_NOQUOTES,
  ),
  94 => 
  array (
    0 => 'Un texte sans entites &amp;&lt;&gt;"\'',
    1 => 'Un texte sans entites &<>"\'',
    2 => ENT_NOQUOTES,
  ),
  95 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => ENT_NOQUOTES,
  ),
  96 => 
  array (
    0 => 'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => ENT_NOQUOTES,
  ),
  97 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    2 => ENT_NOQUOTES,
  ),
  98 => 
  array (
    0 => 'Un texte avec des &lt;a href="http://spip.net"&gt;liens avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;&lt;/a&gt; [Article 1 avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;art1] [spip avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents ISO aàâä eéèêë iîï oô uùü</a> [Article 1 avec des accents ISO aàâä eéèêë iîï oô uùü->art1] [spip avec des accents ISO aàâä eéèêë iîï oô uùü->http://www.spip.net] http://www.spip.net',
    2 => ENT_NOQUOTES,
  ),
  99 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_NOQUOTES,
  ),
  100 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_NOQUOTES,
  ),
  101 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_NOQUOTES,
  ),
  102 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_NOQUOTES,
  ),
  103 => 
  array (
    0 => 'Un texte sans entites &amp;&lt;&gt;"\' et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte sans entites &<>"\' et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_NOQUOTES,
  ),
  104 => 
  array (
    0 => '{{{Des raccourcis avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;}}} {italique avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;} {{gras avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;}} &lt;code&gt;du code avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;&lt;/code&gt;',
    1 => '{{{Des raccourcis avec des accents ISO aàâä eéèêë iîï oô uùü}}} {italique avec des accents ISO aàâä eéèêë iîï oô uùü} {{gras avec des accents ISO aàâä eéèêë iîï oô uùü}} <code>du code avec des accents ISO aàâä eéèêë iîï oô uùü</code>',
    2 => ENT_NOQUOTES,
  ),
  105 => 
  array (
    0 => 'Un modele avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml; &lt;modeleinexistant|lien=[avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;http://www.spip.net]&gt;',
    1 => 'Un modele avec des accents ISO aàâä eéèêë iîï oô uùü <modeleinexistant|lien=[avec des accents ISO aàâä eéèêë iîï oô uùü->http://www.spip.net]>',
    2 => ENT_NOQUOTES,
  ),
  106 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_NOQUOTES,
  ),
  107 => 
  array (
    0 => 'Un texte avec des &lt;a href="http://spip.net"&gt;liens avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;&lt;/a&gt; [Article 1 avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;-&gt;art1] [spip avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;-&gt;http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</a> [Article 1 avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->art1] [spip avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->http://www.spip.net] http://www.spip.net',
    2 => ENT_NOQUOTES,
  ),
  108 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_NOQUOTES,
  ),
  109 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_NOQUOTES,
  ),
  110 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_NOQUOTES,
  ),
  111 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_NOQUOTES,
  ),
  112 => 
  array (
    0 => 'Un texte sans entites &amp;&lt;&gt;"\' et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte sans entites &<>"\' et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_NOQUOTES,
  ),
  113 => 
  array (
    0 => '{{{Des raccourcis avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;}}} {italique avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;} {{gras avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;}} &lt;code&gt;du code avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;&lt;/code&gt;',
    1 => '{{{Des raccourcis avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}}} {italique avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼} {{gras avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}} <code>du code avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</code>',
    2 => ENT_NOQUOTES,
  ),
  114 => 
  array (
    0 => 'Un modele avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14; &lt;modeleinexistant|lien=[avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;-&gt;http://www.spip.net]&gt;',
    1 => 'Un modele avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼ <modeleinexistant|lien=[avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->http://www.spip.net]>',
    2 => ENT_NOQUOTES,
  ),
  115 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_NOQUOTES,
  ),
  116 => 
  array (
    0 => '',
    1 => '',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
  ),
  117 => 
  array (
    0 => '0',
    1 => '0',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
  ),
  118 => 
  array (
    0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
  ),
  119 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
  ),
  120 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
  ),
  121 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
  ),
  122 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
  ),
  123 => 
  array (
    0 => 'Un texte sans entites &amp;&lt;&gt;&quot;\'',
    1 => 'Un texte sans entites &<>"\'',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
  ),
  124 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
  ),
  125 => 
  array (
    0 => 'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
  ),
  126 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
  ),
  127 => 
  array (
    0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;&lt;/a&gt; [Article 1 avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;art1] [spip avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents ISO aàâä eéèêë iîï oô uùü</a> [Article 1 avec des accents ISO aàâä eéèêë iîï oô uùü->art1] [spip avec des accents ISO aàâä eéèêë iîï oô uùü->http://www.spip.net] http://www.spip.net',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
  ),
  128 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
  ),
  129 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
  ),
  130 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
  ),
  131 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
  ),
  132 => 
  array (
    0 => 'Un texte sans entites &amp;&lt;&gt;&quot;\' et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte sans entites &<>"\' et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
  ),
  133 => 
  array (
    0 => '{{{Des raccourcis avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;}}} {italique avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;} {{gras avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;}} &lt;code&gt;du code avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;&lt;/code&gt;',
    1 => '{{{Des raccourcis avec des accents ISO aàâä eéèêë iîï oô uùü}}} {italique avec des accents ISO aàâä eéèêë iîï oô uùü} {{gras avec des accents ISO aàâä eéèêë iîï oô uùü}} <code>du code avec des accents ISO aàâä eéèêë iîï oô uùü</code>',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
  ),
  134 => 
  array (
    0 => 'Un modele avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml; &lt;modeleinexistant|lien=[avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;http://www.spip.net]&gt;',
    1 => 'Un modele avec des accents ISO aàâä eéèêë iîï oô uùü <modeleinexistant|lien=[avec des accents ISO aàâä eéèêë iîï oô uùü->http://www.spip.net]>',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
  ),
  135 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
  ),
  136 => 
  array (
    0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;&lt;/a&gt; [Article 1 avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;-&gt;art1] [spip avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;-&gt;http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</a> [Article 1 avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->art1] [spip avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->http://www.spip.net] http://www.spip.net',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
  ),
  137 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
  ),
  138 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
  ),
  139 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
  ),
  140 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
  ),
  141 => 
  array (
    0 => 'Un texte sans entites &amp;&lt;&gt;&quot;\' et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte sans entites &<>"\' et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
  ),
  142 => 
  array (
    0 => '{{{Des raccourcis avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;}}} {italique avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;} {{gras avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;}} &lt;code&gt;du code avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;&lt;/code&gt;',
    1 => '{{{Des raccourcis avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}}} {italique avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼} {{gras avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}} <code>du code avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</code>',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
  ),
  143 => 
  array (
    0 => 'Un modele avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14; &lt;modeleinexistant|lien=[avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;-&gt;http://www.spip.net]&gt;',
    1 => 'Un modele avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼ <modeleinexistant|lien=[avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->http://www.spip.net]>',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
  ),
  144 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
  ),
  145 => 
  array (
    0 => '',
    1 => '',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
  ),
  146 => 
  array (
    0 => '0',
    1 => '0',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
  ),
  147 => 
  array (
    0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
  ),
  148 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
  ),
  149 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
  ),
  150 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
  ),
  151 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
  ),
  152 => 
  array (
    0 => 'Un texte sans entites &amp;&lt;&gt;&quot;\'',
    1 => 'Un texte sans entites &<>"\'',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
  ),
  153 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
  ),
  154 => 
  array (
    0 => 'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
  ),
  155 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
  ),
  156 => 
  array (
    0 => '',
    1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents ISO aàâä eéèêë iîï oô uùü</a> [Article 1 avec des accents ISO aàâä eéèêë iîï oô uùü->art1] [spip avec des accents ISO aàâä eéèêë iîï oô uùü->http://www.spip.net] http://www.spip.net',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
  ),
  157 => 
  array (
    0 => '',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
  ),
  158 => 
  array (
    0 => '',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
  ),
  159 => 
  array (
    0 => '',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
  ),
  160 => 
  array (
    0 => '',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
  ),
  161 => 
  array (
    0 => '',
    1 => 'Un texte sans entites &<>"\' et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
  ),
  162 => 
  array (
    0 => '',
    1 => '{{{Des raccourcis avec des accents ISO aàâä eéèêë iîï oô uùü}}} {italique avec des accents ISO aàâä eéèêë iîï oô uùü} {{gras avec des accents ISO aàâä eéèêë iîï oô uùü}} <code>du code avec des accents ISO aàâä eéèêë iîï oô uùü</code>',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
  ),
  163 => 
  array (
    0 => '',
    1 => 'Un modele avec des accents ISO aàâä eéèêë iîï oô uùü <modeleinexistant|lien=[avec des accents ISO aàâä eéèêë iîï oô uùü->http://www.spip.net]>',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
  ),
  164 => 
  array (
    0 => '',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
  ),
  165 => 
  array (
    0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;&lt;/a&gt; [Article 1 avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;art1] [spip avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</a> [Article 1 avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->art1] [spip avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->http://www.spip.net] http://www.spip.net',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
  ),
  166 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
  ),
  167 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
  ),
  168 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
  ),
  169 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
  ),
  170 => 
  array (
    0 => 'Un texte sans entites &amp;&lt;&gt;&quot;\' et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte sans entites &<>"\' et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
  ),
  171 => 
  array (
    0 => '{{{Des raccourcis avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;}}} {italique avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;} {{gras avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;}} &lt;code&gt;du code avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;&lt;/code&gt;',
    1 => '{{{Des raccourcis avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}}} {italique avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼} {{gras avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}} <code>du code avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</code>',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
  ),
  172 => 
  array (
    0 => 'Un modele avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml; &lt;modeleinexistant|lien=[avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;http://www.spip.net]&gt;',
    1 => 'Un modele avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼ <modeleinexistant|lien=[avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->http://www.spip.net]>',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
  ),
  173 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
  ),
  174 => 
  array (
    0 => '',
    1 => '',
    2 => ENT_QUOTES,
    3 => 'ISO-8859-1',
  ),
  175 => 
  array (
    0 => '0',
    1 => '0',
    2 => ENT_QUOTES,
    3 => 'ISO-8859-1',
  ),
  176 => 
  array (
    0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;&lt;/a&gt; [Article 1 avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;art1] [spip avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents ISO aàâä eéèêë iîï oô uùü</a> [Article 1 avec des accents ISO aàâä eéèêë iîï oô uùü->art1] [spip avec des accents ISO aàâä eéèêë iîï oô uùü->http://www.spip.net] http://www.spip.net',
    2 => ENT_QUOTES,
    3 => 'ISO-8859-1',
  ),
  177 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_QUOTES,
    3 => 'ISO-8859-1',
  ),
  178 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_QUOTES,
    3 => 'ISO-8859-1',
  ),
  179 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_QUOTES,
    3 => 'ISO-8859-1',
  ),
  180 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_QUOTES,
    3 => 'ISO-8859-1',
  ),
  181 => 
  array (
    0 => 'Un texte sans entites &amp;&lt;&gt;&quot;&#039; et avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte sans entites &<>"\' et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_QUOTES,
    3 => 'ISO-8859-1',
  ),
  182 => 
  array (
    0 => '{{{Des raccourcis avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;}}} {italique avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;} {{gras avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;}} &lt;code&gt;du code avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;&lt;/code&gt;',
    1 => '{{{Des raccourcis avec des accents ISO aàâä eéèêë iîï oô uùü}}} {italique avec des accents ISO aàâä eéèêë iîï oô uùü} {{gras avec des accents ISO aàâä eéèêë iîï oô uùü}} <code>du code avec des accents ISO aàâä eéèêë iîï oô uùü</code>',
    2 => ENT_QUOTES,
    3 => 'ISO-8859-1',
  ),
  183 => 
  array (
    0 => 'Un modele avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml; &lt;modeleinexistant|lien=[avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;http://www.spip.net]&gt;',
    1 => 'Un modele avec des accents ISO aàâä eéèêë iîï oô uùü <modeleinexistant|lien=[avec des accents ISO aàâä eéèêë iîï oô uùü->http://www.spip.net]>',
    2 => ENT_QUOTES,
    3 => 'ISO-8859-1',
  ),
  184 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents ISO a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_QUOTES,
    3 => 'ISO-8859-1',
  ),
  185 => 
  array (
    0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;&lt;/a&gt; [Article 1 avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;-&gt;art1] [spip avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;-&gt;http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</a> [Article 1 avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->art1] [spip avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->http://www.spip.net] http://www.spip.net',
    2 => ENT_QUOTES,
    3 => 'ISO-8859-1',
  ),
  186 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_QUOTES,
    3 => 'ISO-8859-1',
  ),
  187 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_QUOTES,
    3 => 'ISO-8859-1',
  ),
  188 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_QUOTES,
    3 => 'ISO-8859-1',
  ),
  189 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_QUOTES,
    3 => 'ISO-8859-1',
  ),
  190 => 
  array (
    0 => 'Un texte sans entites &amp;&lt;&gt;&quot;&#039; et avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte sans entites &<>"\' et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_QUOTES,
    3 => 'ISO-8859-1',
  ),
  191 => 
  array (
    0 => '{{{Des raccourcis avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;}}} {italique avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;} {{gras avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;}} &lt;code&gt;du code avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;&lt;/code&gt;',
    1 => '{{{Des raccourcis avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}}} {italique avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼} {{gras avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}} <code>du code avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</code>',
    2 => ENT_QUOTES,
    3 => 'ISO-8859-1',
  ),
  192 => 
  array (
    0 => 'Un modele avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14; &lt;modeleinexistant|lien=[avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;-&gt;http://www.spip.net]&gt;',
    1 => 'Un modele avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼ <modeleinexistant|lien=[avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->http://www.spip.net]>',
    2 => ENT_QUOTES,
    3 => 'ISO-8859-1',
  ),
  193 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 a&Atilde;&nbsp;&Atilde;&cent;&Atilde;&curren; e&Atilde;&copy;&Atilde;&uml;&Atilde;&ordf;&Atilde;&laquo; i&Atilde;&reg;&Atilde;&macr; o&Atilde;&acute; u&Atilde;&sup1;&Atilde;&frac14;',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_QUOTES,
    3 => 'ISO-8859-1',
  ),
  194 => 
  array (
    0 => '',
    1 => '',
    2 => ENT_QUOTES,
    3 => 'UTF-8',
  ),
  195 => 
  array (
    0 => '0',
    1 => '0',
    2 => ENT_QUOTES,
    3 => 'UTF-8',
  ),
  196 => 
  array (
    0 => '',
    1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents ISO aàâä eéèêë iîï oô uùü</a> [Article 1 avec des accents ISO aàâä eéèêë iîï oô uùü->art1] [spip avec des accents ISO aàâä eéèêë iîï oô uùü->http://www.spip.net] http://www.spip.net',
    2 => ENT_QUOTES,
    3 => 'UTF-8',
  ),
  197 => 
  array (
    0 => '',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_QUOTES,
    3 => 'UTF-8',
  ),
  198 => 
  array (
    0 => '',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_QUOTES,
    3 => 'UTF-8',
  ),
  199 => 
  array (
    0 => '',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_QUOTES,
    3 => 'UTF-8',
  ),
  200 => 
  array (
    0 => '',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_QUOTES,
    3 => 'UTF-8',
  ),
  201 => 
  array (
    0 => '',
    1 => 'Un texte sans entites &<>"\' et avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_QUOTES,
    3 => 'UTF-8',
  ),
  202 => 
  array (
    0 => '',
    1 => '{{{Des raccourcis avec des accents ISO aàâä eéèêë iîï oô uùü}}} {italique avec des accents ISO aàâä eéèêë iîï oô uùü} {{gras avec des accents ISO aàâä eéèêë iîï oô uùü}} <code>du code avec des accents ISO aàâä eéèêë iîï oô uùü</code>',
    2 => ENT_QUOTES,
    3 => 'UTF-8',
  ),
  203 => 
  array (
    0 => '',
    1 => 'Un modele avec des accents ISO aàâä eéèêë iîï oô uùü <modeleinexistant|lien=[avec des accents ISO aàâä eéèêë iîï oô uùü->http://www.spip.net]>',
    2 => ENT_QUOTES,
    3 => 'UTF-8',
  ),
  204 => 
  array (
    0 => '',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents ISO aàâä eéèêë iîï oô uùü',
    2 => ENT_QUOTES,
    3 => 'UTF-8',
  ),
  205 => 
  array (
    0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;&lt;/a&gt; [Article 1 avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;art1] [spip avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</a> [Article 1 avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->art1] [spip avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->http://www.spip.net] http://www.spip.net',
    2 => ENT_QUOTES,
    3 => 'UTF-8',
  ),
  206 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_QUOTES,
    3 => 'UTF-8',
  ),
  207 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_QUOTES,
    3 => 'UTF-8',
  ),
  208 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_QUOTES,
    3 => 'UTF-8',
  ),
  209 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_QUOTES,
    3 => 'UTF-8',
  ),
  210 => 
  array (
    0 => 'Un texte sans entites &amp;&lt;&gt;&quot;&#039; et avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte sans entites &<>"\' et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_QUOTES,
    3 => 'UTF-8',
  ),
  211 => 
  array (
    0 => '{{{Des raccourcis avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;}}} {italique avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;} {{gras avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;}} &lt;code&gt;du code avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;&lt;/code&gt;',
    1 => '{{{Des raccourcis avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}}} {italique avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼} {{gras avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}} <code>du code avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</code>',
    2 => ENT_QUOTES,
    3 => 'UTF-8',
  ),
  212 => 
  array (
    0 => 'Un modele avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml; &lt;modeleinexistant|lien=[avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;-&gt;http://www.spip.net]&gt;',
    1 => 'Un modele avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼ <modeleinexistant|lien=[avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->http://www.spip.net]>',
    2 => ENT_QUOTES,
    3 => 'UTF-8',
  ),
  213 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 a&agrave;&acirc;&auml; e&eacute;&egrave;&ecirc;&euml; i&icirc;&iuml; o&ocirc; u&ugrave;&uuml;',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
    2 => ENT_QUOTES,
    3 => 'UTF-8',
  ),
  214 => 
  array (
    0 => '',
    1 => '',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
    4 => false,
  ),
  215 => 
  array (
    0 => '0',
    1 => '0',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
    4 => false,
  ),
  216 => 
  array (
    0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
    4 => false,
  ),
  217 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
    4 => false,
  ),
  218 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
    4 => false,
  ),
  219 => 
  array (
    0 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
    4 => false,
  ),
  220 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
    4 => false,
  ),
  221 => 
  array (
    0 => 'Un texte sans entites &amp;&lt;&gt;&quot;\'',
    1 => 'Un texte sans entites &<>"\'',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
    4 => false,
  ),
  222 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
    4 => false,
  ),
  223 => 
  array (
    0 => 'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
    4 => false,
  ),
  224 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
    4 => false,
  ),
  225 => 
  array (
    0 => '',
    1 => '',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
    4 => true,
  ),
  226 => 
  array (
    0 => '0',
    1 => '0',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
    4 => true,
  ),
  227 => 
  array (
    0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
    4 => true,
  ),
  228 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
    4 => true,
  ),
  229 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
    4 => true,
  ),
  230 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
    4 => true,
  ),
  231 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
    4 => true,
  ),
  232 => 
  array (
    0 => 'Un texte sans entites &amp;&lt;&gt;&quot;\'',
    1 => 'Un texte sans entites &<>"\'',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
    4 => true,
  ),
  233 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
    4 => true,
  ),
  234 => 
  array (
    0 => 'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
    4 => true,
  ),
  235 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'ISO-8859-1',
    4 => true,
  ),
  236 => 
  array (
    0 => '',
    1 => '',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
    4 => false,
  ),
  237 => 
  array (
    0 => '0',
    1 => '0',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
    4 => false,
  ),
  238 => 
  array (
    0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
    4 => false,
  ),
  239 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
    4 => false,
  ),
  240 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
    4 => false,
  ),
  241 => 
  array (
    0 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
    4 => false,
  ),
  242 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
    4 => false,
  ),
  243 => 
  array (
    0 => 'Un texte sans entites &amp;&lt;&gt;&quot;\'',
    1 => 'Un texte sans entites &<>"\'',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
    4 => false,
  ),
  244 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
    4 => false,
  ),
  245 => 
  array (
    0 => 'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
    4 => false,
  ),
  246 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
    4 => false,
  ),
  247 => 
  array (
    0 => '',
    1 => '',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
    4 => true,
  ),
  248 => 
  array (
    0 => '0',
    1 => '0',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
    4 => true,
  ),
  249 => 
  array (
    0 => 'Un texte avec des &lt;a href=&quot;http://spip.net&quot;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
    4 => true,
  ),
  250 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
    4 => true,
  ),
  251 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;eacute;s echap&amp;amp;eacute; &amp;amp;amp;&amp;amp;lt;&amp;amp;gt;&amp;amp;quot;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
    4 => true,
  ),
  252 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
    4 => true,
  ),
  253 => 
  array (
    0 => 'Un texte avec des entit&amp;amp;#233;s num&amp;amp;#233;riques echap&amp;amp;#233;es &amp;amp;#38;&amp;amp;#60;&amp;amp;#62;&amp;amp;quot;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
    4 => true,
  ),
  254 => 
  array (
    0 => 'Un texte sans entites &amp;&lt;&gt;&quot;\'',
    1 => 'Un texte sans entites &<>"\'',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
    4 => true,
  ),
  255 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
    4 => true,
  ),
  256 => 
  array (
    0 => 'Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
    4 => true,
  ),
  257 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    2 => ENT_COMPAT|ENT_HTML401,
    3 => 'UTF-8',
    4 => true,
  ),
);
		return $essais;
	}























































?>