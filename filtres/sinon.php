<?php
/**
 * Test unitaire de la fonction sinon
 * du fichier inc/filtres.php
 *
 * genere automatiquement par TestBuilder
 * le 
 */

	$test = 'sinon';
	require '../test.inc';
	find_in_path("inc/filtres.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('sinon', essais_sinon());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_sinon(){
		$essais = array (
  0 => 
  array (
    0 => '',
    1 => '',
    2 => '',
  ),
  1 => 
  array (
    0 => '0',
    1 => '',
    2 => '0',
  ),
  2 => 
  array (
    0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    1 => '',
    2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
  ),
  3 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    1 => '',
    2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ),
  4 => 
  array (
    0 => 'Un texte sans entites &<>"\'',
    1 => '',
    2 => 'Un texte sans entites &<>"\'',
  ),
  5 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    1 => '',
    2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ),
  6 => 
  array (
    0 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    1 => '',
    2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
  ),
  7 => 
  array (
    0 => '0',
    1 => '0',
    2 => '',
  ),
  8 => 
  array (
    0 => '0',
    1 => '0',
    2 => '0',
  ),
  9 => 
  array (
    0 => '0',
    1 => '0',
    2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
  ),
  10 => 
  array (
    0 => '0',
    1 => '0',
    2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ),
  11 => 
  array (
    0 => '0',
    1 => '0',
    2 => 'Un texte sans entites &<>"\'',
  ),
  12 => 
  array (
    0 => '0',
    1 => '0',
    2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ),
  13 => 
  array (
    0 => '0',
    1 => '0',
    2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
  ),
  14 => 
  array (
    0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => '',
  ),
  15 => 
  array (
    0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => '0',
  ),
  16 => 
  array (
    0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
  ),
  17 => 
  array (
    0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ),
  18 => 
  array (
    0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => 'Un texte sans entites &<>"\'',
  ),
  19 => 
  array (
    0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ),
  20 => 
  array (
    0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
  ),
  21 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => '',
  ),
  22 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => '0',
  ),
  23 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
  ),
  24 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ),
  25 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => 'Un texte sans entites &<>"\'',
  ),
  26 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ),
  27 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
  ),
  28 => 
  array (
    0 => 'Un texte sans entites &<>"\'',
    1 => 'Un texte sans entites &<>"\'',
    2 => '',
  ),
  29 => 
  array (
    0 => 'Un texte sans entites &<>"\'',
    1 => 'Un texte sans entites &<>"\'',
    2 => '0',
  ),
  30 => 
  array (
    0 => 'Un texte sans entites &<>"\'',
    1 => 'Un texte sans entites &<>"\'',
    2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
  ),
  31 => 
  array (
    0 => 'Un texte sans entites &<>"\'',
    1 => 'Un texte sans entites &<>"\'',
    2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ),
  32 => 
  array (
    0 => 'Un texte sans entites &<>"\'',
    1 => 'Un texte sans entites &<>"\'',
    2 => 'Un texte sans entites &<>"\'',
  ),
  33 => 
  array (
    0 => 'Un texte sans entites &<>"\'',
    1 => 'Un texte sans entites &<>"\'',
    2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ),
  34 => 
  array (
    0 => 'Un texte sans entites &<>"\'',
    1 => 'Un texte sans entites &<>"\'',
    2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
  ),
  35 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => '',
  ),
  36 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => '0',
  ),
  37 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
  ),
  38 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ),
  39 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => 'Un texte sans entites &<>"\'',
  ),
  40 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ),
  41 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
  ),
  42 => 
  array (
    0 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => '',
  ),
  43 => 
  array (
    0 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => '0',
  ),
  44 => 
  array (
    0 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
  ),
  45 => 
  array (
    0 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ),
  46 => 
  array (
    0 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 'Un texte sans entites &<>"\'',
  ),
  47 => 
  array (
    0 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ),
  48 => 
  array (
    0 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
  ),
  49 => 
  array (
    0 => 0,
    1 => 0,
    2 => '',
  ),
  50 => 
  array (
    0 => 0,
    1 => 0,
    2 => '0',
  ),
  51 => 
  array (
    0 => 0,
    1 => 0,
    2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
  ),
  52 => 
  array (
    0 => 0,
    1 => 0,
    2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ),
  53 => 
  array (
    0 => 0,
    1 => 0,
    2 => 'Un texte sans entites &<>"\'',
  ),
  54 => 
  array (
    0 => 0,
    1 => 0,
    2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ),
  55 => 
  array (
    0 => 0,
    1 => 0,
    2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
  ),
  56 => 
  array (
    0 => -1,
    1 => -1,
    2 => '',
  ),
  57 => 
  array (
    0 => -1,
    1 => -1,
    2 => '0',
  ),
  58 => 
  array (
    0 => -1,
    1 => -1,
    2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
  ),
  59 => 
  array (
    0 => -1,
    1 => -1,
    2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ),
  60 => 
  array (
    0 => -1,
    1 => -1,
    2 => 'Un texte sans entites &<>"\'',
  ),
  61 => 
  array (
    0 => -1,
    1 => -1,
    2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ),
  62 => 
  array (
    0 => -1,
    1 => -1,
    2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
  ),
  63 => 
  array (
    0 => 1,
    1 => 1,
    2 => '',
  ),
  64 => 
  array (
    0 => 1,
    1 => 1,
    2 => '0',
  ),
  65 => 
  array (
    0 => 1,
    1 => 1,
    2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
  ),
  66 => 
  array (
    0 => 1,
    1 => 1,
    2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ),
  67 => 
  array (
    0 => 1,
    1 => 1,
    2 => 'Un texte sans entites &<>"\'',
  ),
  68 => 
  array (
    0 => 1,
    1 => 1,
    2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ),
  69 => 
  array (
    0 => 1,
    1 => 1,
    2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
  ),
  70 => 
  array (
    0 => 2,
    1 => 2,
    2 => '',
  ),
  71 => 
  array (
    0 => 2,
    1 => 2,
    2 => '0',
  ),
  72 => 
  array (
    0 => 2,
    1 => 2,
    2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
  ),
  73 => 
  array (
    0 => 2,
    1 => 2,
    2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ),
  74 => 
  array (
    0 => 2,
    1 => 2,
    2 => 'Un texte sans entites &<>"\'',
  ),
  75 => 
  array (
    0 => 2,
    1 => 2,
    2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ),
  76 => 
  array (
    0 => 2,
    1 => 2,
    2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
  ),
  77 => 
  array (
    0 => 3,
    1 => 3,
    2 => '',
  ),
  78 => 
  array (
    0 => 3,
    1 => 3,
    2 => '0',
  ),
  79 => 
  array (
    0 => 3,
    1 => 3,
    2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
  ),
  80 => 
  array (
    0 => 3,
    1 => 3,
    2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ),
  81 => 
  array (
    0 => 3,
    1 => 3,
    2 => 'Un texte sans entites &<>"\'',
  ),
  82 => 
  array (
    0 => 3,
    1 => 3,
    2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ),
  83 => 
  array (
    0 => 3,
    1 => 3,
    2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
  ),
  84 => 
  array (
    0 => 4,
    1 => 4,
    2 => '',
  ),
  85 => 
  array (
    0 => 4,
    1 => 4,
    2 => '0',
  ),
  86 => 
  array (
    0 => 4,
    1 => 4,
    2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
  ),
  87 => 
  array (
    0 => 4,
    1 => 4,
    2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ),
  88 => 
  array (
    0 => 4,
    1 => 4,
    2 => 'Un texte sans entites &<>"\'',
  ),
  89 => 
  array (
    0 => 4,
    1 => 4,
    2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ),
  90 => 
  array (
    0 => 4,
    1 => 4,
    2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
  ),
  91 => 
  array (
    0 => 5,
    1 => 5,
    2 => '',
  ),
  92 => 
  array (
    0 => 5,
    1 => 5,
    2 => '0',
  ),
  93 => 
  array (
    0 => 5,
    1 => 5,
    2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
  ),
  94 => 
  array (
    0 => 5,
    1 => 5,
    2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ),
  95 => 
  array (
    0 => 5,
    1 => 5,
    2 => 'Un texte sans entites &<>"\'',
  ),
  96 => 
  array (
    0 => 5,
    1 => 5,
    2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ),
  97 => 
  array (
    0 => 5,
    1 => 5,
    2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
  ),
  98 => 
  array (
    0 => 6,
    1 => 6,
    2 => '',
  ),
  99 => 
  array (
    0 => 6,
    1 => 6,
    2 => '0',
  ),
  100 => 
  array (
    0 => 6,
    1 => 6,
    2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
  ),
  101 => 
  array (
    0 => 6,
    1 => 6,
    2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ),
  102 => 
  array (
    0 => 6,
    1 => 6,
    2 => 'Un texte sans entites &<>"\'',
  ),
  103 => 
  array (
    0 => 6,
    1 => 6,
    2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ),
  104 => 
  array (
    0 => 6,
    1 => 6,
    2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
  ),
  105 => 
  array (
    0 => 7,
    1 => 7,
    2 => '',
  ),
  106 => 
  array (
    0 => 7,
    1 => 7,
    2 => '0',
  ),
  107 => 
  array (
    0 => 7,
    1 => 7,
    2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
  ),
  108 => 
  array (
    0 => 7,
    1 => 7,
    2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ),
  109 => 
  array (
    0 => 7,
    1 => 7,
    2 => 'Un texte sans entites &<>"\'',
  ),
  110 => 
  array (
    0 => 7,
    1 => 7,
    2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ),
  111 => 
  array (
    0 => 7,
    1 => 7,
    2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
  ),
  112 => 
  array (
    0 => 10,
    1 => 10,
    2 => '',
  ),
  113 => 
  array (
    0 => 10,
    1 => 10,
    2 => '0',
  ),
  114 => 
  array (
    0 => 10,
    1 => 10,
    2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
  ),
  115 => 
  array (
    0 => 10,
    1 => 10,
    2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ),
  116 => 
  array (
    0 => 10,
    1 => 10,
    2 => 'Un texte sans entites &<>"\'',
  ),
  117 => 
  array (
    0 => 10,
    1 => 10,
    2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ),
  118 => 
  array (
    0 => 10,
    1 => 10,
    2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
  ),
  119 => 
  array (
    0 => 20,
    1 => 20,
    2 => '',
  ),
  120 => 
  array (
    0 => 20,
    1 => 20,
    2 => '0',
  ),
  121 => 
  array (
    0 => 20,
    1 => 20,
    2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
  ),
  122 => 
  array (
    0 => 20,
    1 => 20,
    2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ),
  123 => 
  array (
    0 => 20,
    1 => 20,
    2 => 'Un texte sans entites &<>"\'',
  ),
  124 => 
  array (
    0 => 20,
    1 => 20,
    2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ),
  125 => 
  array (
    0 => 20,
    1 => 20,
    2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
  ),
  126 => 
  array (
    0 => 30,
    1 => 30,
    2 => '',
  ),
  127 => 
  array (
    0 => 30,
    1 => 30,
    2 => '0',
  ),
  128 => 
  array (
    0 => 30,
    1 => 30,
    2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
  ),
  129 => 
  array (
    0 => 30,
    1 => 30,
    2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ),
  130 => 
  array (
    0 => 30,
    1 => 30,
    2 => 'Un texte sans entites &<>"\'',
  ),
  131 => 
  array (
    0 => 30,
    1 => 30,
    2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ),
  132 => 
  array (
    0 => 30,
    1 => 30,
    2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
  ),
  133 => 
  array (
    0 => 50,
    1 => 50,
    2 => '',
  ),
  134 => 
  array (
    0 => 50,
    1 => 50,
    2 => '0',
  ),
  135 => 
  array (
    0 => 50,
    1 => 50,
    2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
  ),
  136 => 
  array (
    0 => 50,
    1 => 50,
    2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ),
  137 => 
  array (
    0 => 50,
    1 => 50,
    2 => 'Un texte sans entites &<>"\'',
  ),
  138 => 
  array (
    0 => 50,
    1 => 50,
    2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ),
  139 => 
  array (
    0 => 50,
    1 => 50,
    2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
  ),
  140 => 
  array (
    0 => 100,
    1 => 100,
    2 => '',
  ),
  141 => 
  array (
    0 => 100,
    1 => 100,
    2 => '0',
  ),
  142 => 
  array (
    0 => 100,
    1 => 100,
    2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
  ),
  143 => 
  array (
    0 => 100,
    1 => 100,
    2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ),
  144 => 
  array (
    0 => 100,
    1 => 100,
    2 => 'Un texte sans entites &<>"\'',
  ),
  145 => 
  array (
    0 => 100,
    1 => 100,
    2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ),
  146 => 
  array (
    0 => 100,
    1 => 100,
    2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
  ),
  147 => 
  array (
    0 => 1000,
    1 => 1000,
    2 => '',
  ),
  148 => 
  array (
    0 => 1000,
    1 => 1000,
    2 => '0',
  ),
  149 => 
  array (
    0 => 1000,
    1 => 1000,
    2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
  ),
  150 => 
  array (
    0 => 1000,
    1 => 1000,
    2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ),
  151 => 
  array (
    0 => 1000,
    1 => 1000,
    2 => 'Un texte sans entites &<>"\'',
  ),
  152 => 
  array (
    0 => 1000,
    1 => 1000,
    2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ),
  153 => 
  array (
    0 => 1000,
    1 => 1000,
    2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
  ),
  154 => 
  array (
    0 => 10000,
    1 => 10000,
    2 => '',
  ),
  155 => 
  array (
    0 => 10000,
    1 => 10000,
    2 => '0',
  ),
  156 => 
  array (
    0 => 10000,
    1 => 10000,
    2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
  ),
  157 => 
  array (
    0 => 10000,
    1 => 10000,
    2 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ),
  158 => 
  array (
    0 => 10000,
    1 => 10000,
    2 => 'Un texte sans entites &<>"\'',
  ),
  159 => 
  array (
    0 => 10000,
    1 => 10000,
    2 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ),
  160 => 
  array (
    0 => 10000,
    1 => 10000,
    2 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
  ),
);
		return $essais;
	}





?>