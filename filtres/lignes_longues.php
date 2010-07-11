<?php
/**
 * Test unitaire de la fonction lignes_longues
 * du fichier inc/filtres.php
 *
 * genere automatiquement par testbuilder
 * le 
 */

	$test = 'lignes_longues';
	require '../test.inc';
	find_in_path("inc/filtres.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('lignes_longues', essais_lignes_longues());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

														function essais_lignes_longues(){
		$essais = array (
  0 => 
  array (
    0 => '',
    1 => '',
    2 => 0,
  ),
  1 => 
  array (
    0 => '',
    1 => '',
    2 => -1,
  ),
  2 => 
  array (
    0 => '',
    1 => '',
    2 => 1,
  ),
  3 => 
  array (
    0 => '',
    1 => '',
    2 => 2,
  ),
  4 => 
  array (
    0 => '',
    1 => '',
    2 => 3,
  ),
  5 => 
  array (
    0 => '',
    1 => '',
    2 => 4,
  ),
  6 => 
  array (
    0 => '',
    1 => '',
    2 => 5,
  ),
  7 => 
  array (
    0 => '',
    1 => '',
    2 => 6,
  ),
  8 => 
  array (
    0 => '',
    1 => '',
    2 => 7,
  ),
  9 => 
  array (
    0 => '',
    1 => '',
    2 => 10,
  ),
  10 => 
  array (
    0 => '',
    1 => '',
    2 => 20,
  ),
  11 => 
  array (
    0 => '',
    1 => '',
    2 => 30,
  ),
  12 => 
  array (
    0 => '',
    1 => '',
    2 => 50,
  ),
  13 => 
  array (
    0 => '',
    1 => '',
    2 => 100,
  ),
  14 => 
  array (
    0 => '',
    1 => '',
    2 => 1000,
  ),
  15 => 
  array (
    0 => '',
    1 => '',
    2 => 10000,
  ),
  16 => 
  array (
    0 => '0',
    1 => '0',
    2 => 0,
  ),
  17 => 
  array (
    0 => '0',
    1 => '0',
    2 => -1,
  ),
  18 => 
  array (
    0 => '0 ',
    1 => '0',
    2 => 1,
  ),
  19 => 
  array (
    0 => '0',
    1 => '0',
    2 => 2,
  ),
  20 => 
  array (
    0 => '0',
    1 => '0',
    2 => 3,
  ),
  21 => 
  array (
    0 => '0',
    1 => '0',
    2 => 4,
  ),
  22 => 
  array (
    0 => '0',
    1 => '0',
    2 => 5,
  ),
  23 => 
  array (
    0 => '0',
    1 => '0',
    2 => 6,
  ),
  24 => 
  array (
    0 => '0',
    1 => '0',
    2 => 7,
  ),
  25 => 
  array (
    0 => '0',
    1 => '0',
    2 => 10,
  ),
  26 => 
  array (
    0 => '0',
    1 => '0',
    2 => 20,
  ),
  27 => 
  array (
    0 => '0',
    1 => '0',
    2 => 30,
  ),
  28 => 
  array (
    0 => '0',
    1 => '0',
    2 => 50,
  ),
  29 => 
  array (
    0 => '0',
    1 => '0',
    2 => 100,
  ),
  30 => 
  array (
    0 => '0',
    1 => '0',
    2 => 1000,
  ),
  31 => 
  array (
    0 => '0',
    1 => '0',
    2 => 10000,
  ),
  32 => 
  array (
    0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => 0,
  ),
  33 => 
  array (
    0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => -1,
  ),
  34 => 
  array (
    0 => 'U n     t          e        x t          e         a  v e        c   d e        s      <a href="http://spip.net">l  i     e        n    s     </a> [A r  t          i     c  l  e         1   ->a  r  t          1   ] [s     p        i     p        ->h  t          t          p        :/    /    w      w      w      .    s     p        i     p        .    n    e        t          ] h  t          t          p        :/    /    w      w      w      .    s     p        i     p        .    n    e        t          ',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => 1,
  ),
  35 => 
  array (
    0 => 'Un  te xt e  av ec  de s <a href="http://spip.net">li en s</a> [Ar ti cl e 1->ar t1 ] [sp   ip   ->ht  tp  ://  ww  w.  sp   ip   .n  et  ] ht  tp  ://  ww  w.  sp   ip   .n  et  ',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => 2,
  ),
  36 => 
  array (
    0 => 'Un tex te ave c des  <a href="http://spip.net">lie ns</a> [Art icl e 1->art 1] [spi   p->htt  p://w  ww.  spi   p.n  et] htt  p://w  ww.  spi   p.n  et',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => 3,
  ),
  37 => 
  array (
    0 => 'Un text e avec  des <a href="http://spip.net">lien s</a> [Arti cle 1->art1 ] [spip ->http  ://ww  w.sp  ip .net] http  ://ww  w.sp  ip .net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => 4,
  ),
  38 => 
  array (
    0 => 'Un texte  avec des <a href="http://spip.net">liens </a> [Artic le 1->art1] [spip->http://www  .spip  .net] http://www  .spip  .net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => 5,
  ),
  39 => 
  array (
    0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Articl e 1->art1] [spip->http://www.  spip.n  et] http://www.  spip.n  et',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => 6,
  ),
  40 => 
  array (
    0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article  1->art1] [spip->http://www.s  pip.net  ] http://www.s  pip.net  ',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => 7,
  ),
  41 => 
  array (
    0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip  .net] http://www.spip  .net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => 10,
  ),
  42 => 
  array (
    0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => 20,
  ),
  43 => 
  array (
    0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => 30,
  ),
  44 => 
  array (
    0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => 50,
  ),
  45 => 
  array (
    0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => 100,
  ),
  46 => 
  array (
    0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => 1000,
  ),
  47 => 
  array (
    0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => 10000,
  ),
  48 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => 0,
  ),
  49 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => -1,
  ),
  50 => 
  array (
    0 => 'U n   t    e     x t    e      a v e     c  d e     s   e     n  t    i t    és   &&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &&lt;&gt;&quot;',
    2 => 1,
  ),
  51 => 
  array (
    0 => 'Un  te xt e  av ec  de s en ti tés &&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &&lt;&gt;&quot;',
    2 => 2,
  ),
  52 => 
  array (
    0 => 'Un tex te ave c des  ent ités &&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &&lt;&gt;&quot;',
    2 => 3,
  ),
  53 => 
  array (
    0 => 'Un text e avec  des enti tés &&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &&lt;&gt;&quot;',
    2 => 4,
  ),
  54 => 
  array (
    0 => 'Un texte  avec des entit és &&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &&lt;&gt;&quot;',
    2 => 5,
  ),
  55 => 
  array (
    0 => 'Un texte avec des entités &&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &&lt;&gt;&quot;',
    2 => 6,
  ),
  56 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &&lt;&gt;&quot;',
    2 => 7,
  ),
  57 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &&lt;&gt;&quot;',
    2 => 10,
  ),
  58 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &&lt;&gt;&quot;',
    2 => 20,
  ),
  59 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &&lt;&gt;&quot;',
    2 => 30,
  ),
  60 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &&lt;&gt;&quot;',
    2 => 50,
  ),
  61 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &&lt;&gt;&quot;',
    2 => 100,
  ),
  62 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &&lt;&gt;&quot;',
    2 => 1000,
  ),
  63 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &&lt;&gt;&quot;',
    2 => 10000,
  ),
  64 => 
  array (
    0 => 'Un texte sans entites &<>"\'',
    1 => 'Un texte sans entites &<>"\'',
    2 => 0,
  ),
  65 => 
  array (
    0 => 'Un texte sans entites &<>"\'',
    1 => 'Un texte sans entites &<>"\'',
    2 => -1,
  ),
  66 => 
  array (
    0 => 'U n    t    e    x t    e     s   a n   s    e    n   t    i t    e    s    &<>"\'',
    1 => 'Un texte sans entites &<>"\'',
    2 => 1,
  ),
  67 => 
  array (
    0 => 'Un  te  xt e  sa ns  en ti te  s &<>"\'',
    1 => 'Un texte sans entites &<>"\'',
    2 => 2,
  ),
  68 => 
  array (
    0 => 'Un tex te san s ent ite s &<>"\'',
    1 => 'Un texte sans entites &<>"\'',
    2 => 3,
  ),
  69 => 
  array (
    0 => 'Un text e sans  enti tes &<>"\'',
    1 => 'Un texte sans entites &<>"\'',
    2 => 4,
  ),
  70 => 
  array (
    0 => 'Un texte  sans entit es &<>"\'',
    1 => 'Un texte sans entites &<>"\'',
    2 => 5,
  ),
  71 => 
  array (
    0 => 'Un texte sans entite s &<>"\'',
    1 => 'Un texte sans entites &<>"\'',
    2 => 6,
  ),
  72 => 
  array (
    0 => 'Un texte sans entites  &<>"\'',
    1 => 'Un texte sans entites &<>"\'',
    2 => 7,
  ),
  73 => 
  array (
    0 => 'Un texte sans entites &<>"\'',
    1 => 'Un texte sans entites &<>"\'',
    2 => 10,
  ),
  74 => 
  array (
    0 => 'Un texte sans entites &<>"\'',
    1 => 'Un texte sans entites &<>"\'',
    2 => 20,
  ),
  75 => 
  array (
    0 => 'Un texte sans entites &<>"\'',
    1 => 'Un texte sans entites &<>"\'',
    2 => 30,
  ),
  76 => 
  array (
    0 => 'Un texte sans entites &<>"\'',
    1 => 'Un texte sans entites &<>"\'',
    2 => 50,
  ),
  77 => 
  array (
    0 => 'Un texte sans entites &<>"\'',
    1 => 'Un texte sans entites &<>"\'',
    2 => 100,
  ),
  78 => 
  array (
    0 => 'Un texte sans entites &<>"\'',
    1 => 'Un texte sans entites &<>"\'',
    2 => 1000,
  ),
  79 => 
  array (
    0 => 'Un texte sans entites &<>"\'',
    1 => 'Un texte sans entites &<>"\'',
    2 => 10000,
  ),
  80 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => 0,
  ),
  81 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => -1,
  ),
  82 => 
  array (
    0 => '{{{D e   s    r   a   c    c    o  u   r   c    i   s   }}} {i   t a   l i   q u   e   } {{g r   a   s   }} <code>d  u    c    o  d  e   </code>',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => 1,
  ),
  83 => 
  array (
    0 => '{{{De s ra cc ou rc is }}} {it al iq ue } {{gr a s}} <code>du  co de </code>',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => 2,
  ),
  84 => 
  array (
    0 => '{{{Des  rac cou rci s}}} {ita liq ue} {{gra s}} <code>du cod e</code>',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => 3,
  ),
  85 => 
  array (
    0 => '{{{Des racc ourc is}}} {ital ique } {{gras }} <code>du code </code>',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => 4,
  ),
  86 => 
  array (
    0 => '{{{Des racco urcis }}} {itali que} {{gras}} <code>du code</code>',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => 5,
  ),
  87 => 
  array (
    0 => '{{{Des raccou rcis}}} {italiq ue} {{gras}} <code>du code</code>',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => 6,
  ),
  88 => 
  array (
    0 => '{{{Des raccour cis}}} {italiqu e} {{gras}} <code>du code</code>',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => 7,
  ),
  89 => 
  array (
    0 => '{{{Des raccourcis }}} {italique} {{gras}} <code>du code</code>',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => 10,
  ),
  90 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => 20,
  ),
  91 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => 30,
  ),
  92 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => 50,
  ),
  93 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => 100,
  ),
  94 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => 1000,
  ),
  95 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => 10000,
  ),
  96 => 
  array (
    0 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 0,
  ),
  97 => 
  array (
    0 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => -1,
  ),
  98 => 
  array (
    0 => 'U n   m o d e   l e    <modeleinexistant|lien=[->h t   t   p   :/  /  w   w   w   .  s p   i p   .  n  e   t   ]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 1,
  ),
  99 => 
  array (
    0 => 'Un  mo de le  <modeleinexistant|lien=[->ht tp :// ww w. sp ip .n et ]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 2,
  ),
  100 => 
  array (
    0 => 'Un mod ele  <modeleinexistant|lien=[->htt p://w ww. spi p.n et]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 3,
  ),
  101 => 
  array (
    0 => 'Un mode le <modeleinexistant|lien=[->http ://ww w.sp ip.n et]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 4,
  ),
  102 => 
  array (
    0 => 'Un model e <modeleinexistant|lien=[->http://www .spip .net]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 5,
  ),
  103 => 
  array (
    0 => 'Un modele  <modeleinexistant|lien=[->http://www. spip.n et]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 6,
  ),
  104 => 
  array (
    0 => 'Un modele <modeleinexistant|lien=[->http://www.s pip.net ]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 7,
  ),
  105 => 
  array (
    0 => 'Un modele <modeleinexistant|lien=[->http://www.spip .net]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 10,
  ),
  106 => 
  array (
    0 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 20,
  ),
  107 => 
  array (
    0 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 30,
  ),
  108 => 
  array (
    0 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 50,
  ),
  109 => 
  array (
    0 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 100,
  ),
  110 => 
  array (
    0 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 1000,
  ),
  111 => 
  array (
    0 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 10000,
  ),
  112 => 
  array (
    0 => 'ne coupe pas mon espace insécable ci-après &nbsp;',
    1 => 'ne coupe pas mon espace insécable ci-après &nbsp;',
    2 => 0,
  ),
  113 => 
  array (
    0 => 'ne coupe pas mon espace insécable ci-après &nbsp;',
    1 => 'ne coupe pas mon espace insécable ci-après &nbsp;',
    2 => -1,
  ),
  114 => 
  array (
    0 => 'n   e      c    o  u p    e      p    a    s     m o  n    e     s    p    a    c    e      i  n   s    éc    a    b l e      c    i  -a    p    r ès     &nbsp;',
    1 => 'ne coupe pas mon espace insécable ci-après &nbsp;',
    2 => 1,
  ),
  115 => 
  array (
    0 => 'ne  co up e pa  s mo n es pa  ce  in séca bl e ci -ap rès &nbsp;',
    1 => 'ne coupe pas mon espace insécable ci-après &nbsp;',
    2 => 2,
  ),
  116 => 
  array (
    0 => 'ne cou pe pas  mon  esp ace  ins écab le ci-apr ès &nbsp;',
    1 => 'ne coupe pas mon espace insécable ci-après &nbsp;',
    2 => 3,
  ),
  117 => 
  array (
    0 => 'ne coup e pas mon espa ce insécabl e ci-après &nbsp;',
    1 => 'ne coupe pas mon espace insécable ci-après &nbsp;',
    2 => 4,
  ),
  118 => 
  array (
    0 => 'ne coupe  pas mon espac e insécable  ci-après &nbsp;',
    1 => 'ne coupe pas mon espace insécable ci-après &nbsp;',
    2 => 5,
  ),
  119 => 
  array (
    0 => 'ne coupe pas mon espace  insécable ci-après &nbsp;',
    1 => 'ne coupe pas mon espace insécable ci-après &nbsp;',
    2 => 6,
  ),
  120 => 
  array (
    0 => 'ne coupe pas mon espace insécable ci-après &nbsp;',
    1 => 'ne coupe pas mon espace insécable ci-après &nbsp;',
    2 => 7,
  ),
  121 => 
  array (
    0 => 'ne coupe pas mon espace insécable ci-après &nbsp;',
    1 => 'ne coupe pas mon espace insécable ci-après &nbsp;',
    2 => 10,
  ),
  122 => 
  array (
    0 => 'ne coupe pas mon espace insécable ci-après &nbsp;',
    1 => 'ne coupe pas mon espace insécable ci-après &nbsp;',
    2 => 20,
  ),
  123 => 
  array (
    0 => 'ne coupe pas mon espace insécable ci-après &nbsp;',
    1 => 'ne coupe pas mon espace insécable ci-après &nbsp;',
    2 => 30,
  ),
  124 => 
  array (
    0 => 'ne coupe pas mon espace insécable ci-après &nbsp;',
    1 => 'ne coupe pas mon espace insécable ci-après &nbsp;',
    2 => 50,
  ),
  125 => 
  array (
    0 => 'ne coupe pas mon espace insécable ci-après &nbsp;',
    1 => 'ne coupe pas mon espace insécable ci-après &nbsp;',
    2 => 100,
  ),
  126 => 
  array (
    0 => 'ne coupe pas mon espace insécable ci-après &nbsp;',
    1 => 'ne coupe pas mon espace insécable ci-après &nbsp;',
    2 => 1000,
  ),
  127 => 
  array (
    0 => 'ne coupe pas mon espace insécable ci-après &nbsp;',
    1 => 'ne coupe pas mon espace insécable ci-après &nbsp;',
    2 => 10000,
  ),
  128 => 
  array (
    0 => 'U n   t    e     x t    e      a v e     c  d e     s   e     n  t    i t    és   &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => 1,
  ),
  129 => 
  array (
    0 => 'Un  te xt e  av ec  de s en ti tés &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => 2,
  ),
  130 => 
  array (
    0 => 'Un tex te ave c des  ent ités &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => 3,
  ),
  131 => 
  array (
    0 => 'Un text e avec  des enti tés &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => 4,
  ),
  132 => 
  array (
    0 => 'Un texte  avec des entit és &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => 5,
  ),
  133 => 
  array (
    0 => 'Un texte avec des entités &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => 6,
  ),
  134 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => 7,
  ),
  135 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => 10,
  ),
  136 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => 20,
  ),
  137 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => 30,
  ),
  138 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => 50,
  ),
  139 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => 100,
  ),
  140 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => 1000,
  ),
  141 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => 10000,
  ),
  142 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    2 => 0,
  ),
  143 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    2 => -1,
  ),
  144 => 
  array (
    0 => 'U n   t         e          x t         e           a     v e          c     d e          s   e          n  t         i t         &amp;e          a     c    u   t         e          ;s   e          c    h a     p  &amp;e          a     c    u   t         e          ; &amp;a     m p  ;&amp;l t         ;&amp;g t         ;&amp;q u   o t         ;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    2 => 1,
  ),
  145 => 
  array (
    0 => 'Un  te   xt e  av ec   de s en ti t&amp;ea  cu  te   ;s ec  ha p&amp;ea  cu  te   ; &amp;am p;&amp;lt ;&amp;gt ;&amp;qu ot ;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    2 => 2,
  ),
  146 => 
  array (
    0 => 'Un tex te ave c des  ent it&amp;eac  ute  ;s ech ap&amp;eac  ute  ; &amp;amp ;&amp;lt;&amp;gt;&amp;quo t;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    2 => 3,
  ),
  147 => 
  array (
    0 => 'Un text e avec  des enti t&amp;eacu  te;s echa p&amp;eacu  te; &amp;amp;&amp;lt;&amp;gt;&amp;quot ;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    2 => 4,
  ),
  148 => 
  array (
    0 => 'Un texte  avec des entit &amp;eacut  e;s echap &amp;eacut  e; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    2 => 5,
  ),
  149 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute  ;s echap&amp;eacute  ; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    2 => 6,
  ),
  150 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    2 => 7,
  ),
  151 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    2 => 10,
  ),
  152 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    2 => 20,
  ),
  153 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    2 => 30,
  ),
  154 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    2 => 50,
  ),
  155 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    2 => 100,
  ),
  156 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    2 => 1000,
  ),
  157 => 
  array (
    0 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
    2 => 10000,
  ),
  158 => 
  array (
    0 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    2 => 0,
  ),
  159 => 
  array (
    0 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    2 => -1,
  ),
  160 => 
  array (
    0 => 'U n    t    e      x t    e       a v e      c  d e      s    e      n   t    i  t    és    n   u  m ér i  q u  e      s    &#38;&#60;&#62;&quot;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    2 => 1,
  ),
  161 => 
  array (
    0 => 'Un  te xt e  av ec  de s en ti tés nu méri qu es  &#38;&#60;&#62;&quot;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    2 => 2,
  ),
  162 => 
  array (
    0 => 'Un tex te ave c des  ent ités num ériq ues  &#38;&#60;&#62;&quot;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    2 => 3,
  ),
  163 => 
  array (
    0 => 'Un text e avec  des enti tés numériqu es &#38;&#60;&#62;&quot;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    2 => 4,
  ),
  164 => 
  array (
    0 => 'Un texte  avec des entit és numérique s &#38;&#60;&#62;&quot;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    2 => 5,
  ),
  165 => 
  array (
    0 => 'Un texte avec des entités numériques  &#38;&#60;&#62;&quot;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    2 => 6,
  ),
  166 => 
  array (
    0 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    2 => 7,
  ),
  167 => 
  array (
    0 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    2 => 10,
  ),
  168 => 
  array (
    0 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    2 => 20,
  ),
  169 => 
  array (
    0 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    2 => 30,
  ),
  170 => 
  array (
    0 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    2 => 50,
  ),
  171 => 
  array (
    0 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    2 => 100,
  ),
  172 => 
  array (
    0 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    2 => 1000,
  ),
  173 => 
  array (
    0 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    2 => 10000,
  ),
  174 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    2 => 0,
  ),
  175 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    2 => -1,
  ),
  176 => 
  array (
    0 => 'U n    t     e        x t     e         a  v e        c   d e        s     e        n   t     i  t     &amp;#233;s     n   u   m &amp;#233;r i  q  u   e        s     e        c  h a  p &amp;#233;e        s     &amp;#38;&amp;#60;&amp;#62;&amp;q  u   o t     ;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    2 => 1,
  ),
  177 => 
  array (
    0 => 'Un  te xt e  av ec   de s en ti t&amp;#233;s nu m&amp;#233;ri qu  es   ec  ha p&amp;#233;es   &amp;#38;&amp;#60;&amp;#62;&amp;qu  ot ;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    2 => 2,
  ),
  178 => 
  array (
    0 => 'Un tex te ave c des  ent it&amp;#233;s num &amp;#233;riq ues  ech ap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quo t;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    2 => 3,
  ),
  179 => 
  array (
    0 => 'Un text e avec  des enti t&amp;#233;s num&amp;#233;riqu es echa p&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot ;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    2 => 4,
  ),
  180 => 
  array (
    0 => 'Un texte  avec des entit &amp;#233;s num&amp;#233;rique s echap &amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    2 => 5,
  ),
  181 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques  echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    2 => 6,
  ),
  182 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    2 => 7,
  ),
  183 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    2 => 10,
  ),
  184 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    2 => 20,
  ),
  185 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    2 => 30,
  ),
  186 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    2 => 50,
  ),
  187 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    2 => 100,
  ),
  188 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    2 => 1000,
  ),
  189 => 
  array (
    0 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    2 => 10000,
  ),
  190 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    2 => 0,
  ),
  191 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    2 => -1,
  ),
  192 => 
  array (
    0 => 'U n   t    e           x t    e            a      v e           c  d  e           s    r    e           t    o u r    
a       l  a       l  i g  n  e            e           t     m  e           m  e            d  e           s   

p  a      r    a      g  r    a      p  h e           s   ',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    2 => 1,
  ),
  193 => 
  array (
    0 => 'Un  te xt e  av ec  de  s re to ur 
a la  li gn e et  me  me   de  s

pa ra gr a phe s',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    2 => 2,
  ),
  194 => 
  array (
    0 => 'Un tex te ave c des   ret our 
a la lig ne et mem e des  

par agr aph es',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    2 => 3,
  ),
  195 => 
  array (
    0 => 'Un text e avec  des reto ur
a la lign e et meme  des

para grap hes',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    2 => 4,
  ),
  196 => 
  array (
    0 => 'Un texte  avec des retou r
a la ligne  et meme des

parag raphe s',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    2 => 5,
  ),
  197 => 
  array (
    0 => 'Un texte avec des retour 
a la ligne et meme des

paragr aphes',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    2 => 6,
  ),
  198 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragra phes',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    2 => 7,
  ),
  199 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphe s',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    2 => 10,
  ),
  200 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    2 => 20,
  ),
  201 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    2 => 30,
  ),
  202 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    2 => 50,
  ),
  203 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    2 => 100,
  ),
  204 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    2 => 1000,
  ),
  205 => 
  array (
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    2 => 10000,
  ),
  206 => 
  array (
    0 => 'Respecte mon point d\'interrogation&nbsp;!',
    1 => 'Respecte mon point d\'interrogation&nbsp;!',
  ),
);
		return $essais;
	}





























































?>