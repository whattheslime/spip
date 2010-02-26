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
    0 => 'U n     t          e        x t          e         a  v e        c   d e        s       <a href="http://spip.net"> l  i     e        n    s      </a>  [A r  t          i     c  l  e         1   ->a  r  t          1   ] [s     p        i     p        ->h  t          t          p        :/    /    w      w      w      .    s     p        i     p        .    n    e        t          ] h  t          t          p        :/    /    w      w      w      .    s     p        i     p        .    n    e        t          ',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => 1,
  ),
  35 => 
  array (
    0 => 'Un  te xt e  av ec  de s  <a href="http://spip.net"> li en s </a>  [Ar ti cl e 1->ar t1 ] [sp   ip   ->ht  tp  ://  ww  w.  sp   ip   .n  et  ] ht  tp  ://  ww  w.  sp   ip   .n  et  ',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => 2,
  ),
  36 => 
  array (
    0 => 'Un tex te ave c des   <a href="http://spip.net"> lie ns </a>  [Art icl e 1->art 1] [spi   p->htt  p://w  ww.  spi   p.n  et] htt  p://w  ww.  spi   p.n  et',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => 3,
  ),
  37 => 
  array (
    0 => 'Un text e avec  des  <a href="http://spip.net"> lien s </a>  [Arti cle 1->art1 ] [spip ->http  ://ww  w.sp  ip .net] http  ://ww  w.sp  ip .net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => 4,
  ),
  38 => 
  array (
    0 => 'Un texte  avec des  <a href="http://spip.net"> liens  </a>  [Artic le 1->art1] [spip->http://www  .spip  .net] http://www  .spip  .net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => 5,
  ),
  39 => 
  array (
    0 => 'Un texte avec des  <a href="http://spip.net"> liens </a>  [Articl e 1->art1] [spip->http://www.  spip.n  et] http://www.  spip.n  et',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => 6,
  ),
  40 => 
  array (
    0 => 'Un texte avec des  <a href="http://spip.net"> liens </a>  [Article  1->art1] [spip->http://www.s  pip.net  ] http://www.s  pip.net  ',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => 7,
  ),
  41 => 
  array (
    0 => 'Un texte avec des  <a href="http://spip.net"> liens </a>  [Article 1->art1] [spip->http://www.spip  .net] http://www.spip  .net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => 10,
  ),
  42 => 
  array (
    0 => 'Un texte avec des  <a href="http://spip.net"> liens </a>  [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => 20,
  ),
  43 => 
  array (
    0 => 'Un texte avec des  <a href="http://spip.net"> liens </a>  [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => 30,
  ),
  44 => 
  array (
    0 => 'Un texte avec des  <a href="http://spip.net"> liens </a>  [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => 50,
  ),
  45 => 
  array (
    0 => 'Un texte avec des  <a href="http://spip.net"> liens </a>  [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => 100,
  ),
  46 => 
  array (
    0 => 'Un texte avec des  <a href="http://spip.net"> liens </a>  [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    2 => 1000,
  ),
  47 => 
  array (
    0 => 'Un texte avec des  <a href="http://spip.net"> liens </a>  [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
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
    0 => 'U n   t        e       x t        e        a   v e       c   d e       s   e       n  t        i t        &e       a   c  u  t        e       ;s   &a   m p ;&l t        ;&g t        ;&q u  o t        ;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => 1,
  ),
  51 => 
  array (
    0 => 'Un  te  xt e  av ec  de s en ti t&ea cu te  ;s &am p;&lt ;&gt ;&qu ot ;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => 2,
  ),
  52 => 
  array (
    0 => 'Un tex te ave c des  ent it&eac ute ;s &amp ;&lt;&gt;&quo t;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => 3,
  ),
  53 => 
  array (
    0 => 'Un text e avec  des enti t&eacu te;s &amp;&lt;&gt;&quot ;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => 4,
  ),
  54 => 
  array (
    0 => 'Un texte  avec des entit &eacut e;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => 5,
  ),
  55 => 
  array (
    0 => 'Un texte avec des entit&eacute ;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => 6,
  ),
  56 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => 7,
  ),
  57 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => 10,
  ),
  58 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => 20,
  ),
  59 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => 30,
  ),
  60 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => 50,
  ),
  61 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => 100,
  ),
  62 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    2 => 1000,
  ),
  63 => 
  array (
    0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
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
    0 => '{{{D e   s    r   a   c    c    o  u   r   c    i   s   }}} {i   t a   l i   q u   e   } {{g r   a   s   }}  <code> d  u    c    o  d  e    </code> ',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => 1,
  ),
  83 => 
  array (
    0 => '{{{De s ra cc ou rc is }}} {it al iq ue } {{gr a s}}  <code> du  co de  </code> ',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => 2,
  ),
  84 => 
  array (
    0 => '{{{Des  rac cou rci s}}} {ita liq ue} {{gra s}}  <code> du cod e </code> ',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => 3,
  ),
  85 => 
  array (
    0 => '{{{Des racc ourc is}}} {ital ique } {{gras }}  <code> du code  </code> ',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => 4,
  ),
  86 => 
  array (
    0 => '{{{Des racco urcis }}} {itali que} {{gras}}  <code> du code </code> ',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => 5,
  ),
  87 => 
  array (
    0 => '{{{Des raccou rcis}}} {italiq ue} {{gras}}  <code> du code </code> ',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => 6,
  ),
  88 => 
  array (
    0 => '{{{Des raccour cis}}} {italiqu e} {{gras}}  <code> du code </code> ',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => 7,
  ),
  89 => 
  array (
    0 => '{{{Des raccourcis }}} {italique} {{gras}}  <code> du code </code> ',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => 10,
  ),
  90 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}}  <code> du code </code> ',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => 20,
  ),
  91 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}}  <code> du code </code> ',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => 30,
  ),
  92 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}}  <code> du code </code> ',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => 50,
  ),
  93 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}}  <code> du code </code> ',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => 100,
  ),
  94 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}}  <code> du code </code> ',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    2 => 1000,
  ),
  95 => 
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}}  <code> du code </code> ',
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
    0 => 'U n   m o d e   l e     <modeleinexistant|lien=[-> h t   t   p   :/  /  w   w   w   .  s p   i p   .  n  e   t   ]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 1,
  ),
  99 => 
  array (
    0 => 'Un  mo de le   <modeleinexistant|lien=[-> ht tp :// ww w. sp ip .n et ]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 2,
  ),
  100 => 
  array (
    0 => 'Un mod ele   <modeleinexistant|lien=[-> htt p://w ww. spi p.n et]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 3,
  ),
  101 => 
  array (
    0 => 'Un mode le  <modeleinexistant|lien=[-> http ://ww w.sp ip.n et]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 4,
  ),
  102 => 
  array (
    0 => 'Un model e  <modeleinexistant|lien=[-> http://www .spip .net]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 5,
  ),
  103 => 
  array (
    0 => 'Un modele   <modeleinexistant|lien=[-> http://www. spip.n et]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 6,
  ),
  104 => 
  array (
    0 => 'Un modele  <modeleinexistant|lien=[-> http://www.s pip.net ]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 7,
  ),
  105 => 
  array (
    0 => 'Un modele  <modeleinexistant|lien=[-> http://www.spip .net]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 10,
  ),
  106 => 
  array (
    0 => 'Un modele  <modeleinexistant|lien=[-> http://www.spip.net]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 20,
  ),
  107 => 
  array (
    0 => 'Un modele  <modeleinexistant|lien=[-> http://www.spip.net]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 30,
  ),
  108 => 
  array (
    0 => 'Un modele  <modeleinexistant|lien=[-> http://www.spip.net]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 50,
  ),
  109 => 
  array (
    0 => 'Un modele  <modeleinexistant|lien=[-> http://www.spip.net]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 100,
  ),
  110 => 
  array (
    0 => 'Un modele  <modeleinexistant|lien=[-> http://www.spip.net]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 1000,
  ),
  111 => 
  array (
    0 => 'Un modele  <modeleinexistant|lien=[-> http://www.spip.net]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    2 => 10000,
  ),
);
		return $essais;
	}














?>