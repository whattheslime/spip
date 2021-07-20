<?php
/**
 * Test unitaire de la fonction identifiant_slug
 * du fichier ./inc/filtres.php
 *
 * genere automatiquement par TestBuilder
 * le 2021-03-09 12:06
 */

	$test = 'identifiant_slug';
	$remonte = __DIR__ . '/';
	while (!is_file($remonte."test.inc"))
		$remonte = $remonte."../";
	require $remonte.'test.inc';
	find_in_path("./inc/filtres.php",'',true);

	// chercher la fonction si elle n'existe pas
	if (!function_exists($f='identifiant_slug')){
		find_in_path("inc/filtres.php",'',true);
		$f = chercher_filtre($f);
	}

	//
	// hop ! on y va
	//
	$err = tester_fun($f, essais_identifiant_slug());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_identifiant_slug(){
		$essais = array (
  0 => 
  array (
    0 => '1',
    1 => true,
  ),
  1 => 
  array (
    0 => '',
    1 => false,
  ),
  2 => 
  array (
    0 => '0',
    1 => 0,
  ),
  3 => 
  array (
    0 => '1',
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
    0 => '0',
    1 => 0.0,
  ),
  19 => 
  array (
    0 => '0_25',
    1 => 0.25,
  ),
  20 => 
  array (
    0 => '0_5',
    1 => 0.5,
  ),
  21 => 
  array (
    0 => '0_75',
    1 => 0.75,
  ),
  22 => 
  array (
    0 => '1',
    1 => 1.0,
  ),
  23 => 
  array (
    0 => '',
    1 => '',
  ),
  24 => 
  array (
    0 => '0',
    1 => '0',
  ),
  25 => 
  array (
    0 => 'un_texte_avec_des_liens_article_1_art1_spip_https_www_spip_n',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
  ),
  26 => 
  array (
    0 => 'un_texte_avec_des_entites',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ),
  27 => 
  array (
    0 => 'un_texte_avec_des_entit_eacute_s_echap_eacute_amp',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
  ),
  28 => 
  array (
    0 => 'un_texte_avec_des_entites_numeriques_38_60_62',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
  ),
  29 => 
  array (
    0 => 'un_texte_avec_des_entites_numeriques_echapees_38_60_62',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
  ),
  30 => 
  array (
    0 => 'un_texte_sans_entites',
    1 => 'Un texte sans entites &<>"\'',
  ),
  31 => 
  array (
    0 => 'des_raccourcis_italique_gras_du_code',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ),
  32 => 
  array (
    0 => 'un_modele_https_www_spip_net',
    1 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
  ),
  33 => 
  array (
    0 => 'un_texte_avec_des_retour_a_la_ligne_et_meme_des_paragraphes',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
  ),
  34 => 
  array (
    0 => 'un_texte_avec_des_liens_avec_des_accents_iso_a_e_i_o_u_artic',
    1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents ISO aàâä eéèêë iîï oô uùü</a> [Article 1 avec des accents ISO aàâä eéèêë iîï oô uùü->art1] [spip avec des accents ISO aàâä eéèêë iîï oô uùü->https://www.spip.net] https://www.spip.net',
  ),
  35 => 
  array (
    0 => 'un_texte_avec_des_entites_et_avec_des_accents_iso_a_e_i_o_u',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
  ),
  36 => 
  array (
    0 => 'un_texte_avec_des_entit_eacute_s_echap_eacute_amp_et_avec_de',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
  ),
  37 => 
  array (
    0 => 'un_texte_avec_des_entites_numeriques_38_60_62_et_avec_des_ac',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
  ),
  38 => 
  array (
    0 => 'un_texte_avec_des_entites_numeriques_echapees_38_60_62_et_av',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents ISO aàâä eéèêë iîï oô uùü',
  ),
  39 => 
  array (
    0 => 'un_texte_sans_entites_et_avec_des_accents_iso_a_e_i_o_u',
    1 => 'Un texte sans entites &<>"\' et avec des accents ISO aàâä eéèêë iîï oô uùü',
  ),
  40 => 
  array (
    0 => 'des_raccourcis_avec_des_accents_iso_a_e_i_o_u_italique_avec_',
    1 => '{{{Des raccourcis avec des accents ISO aàâä eéèêë iîï oô uùü}}} {italique avec des accents ISO aàâä eéèêë iîï oô uùü} {{gras avec des accents ISO aàâä eéèêë iîï oô uùü}} <code>du code avec des accents ISO aàâä eéèêë iîï oô uùü</code>',
  ),
  41 => 
  array (
    0 => 'un_modele_avec_des_accents_iso_a_e_i_o_u_https_www_spip_net',
    1 => 'Un modele avec des accents ISO aàâä eéèêë iîï oô uùü <modeleinexistant|lien=[avec des accents ISO aàâä eéèêë iîï oô uùü->https://www.spip.net]>',
  ),
  42 => 
  array (
    0 => 'un_texte_avec_des_retour_a_la_ligne_et_meme_des_paragraphes_',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents ISO aàâä eéèêë iîï oô uùü',
  ),
  43 => 
  array (
    0 => 'un_texte_avec_des_liens_avec_des_accents_utf_8_aaaa_eeeee_ii',
    1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</a> [Article 1 avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->art1] [spip avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->https://www.spip.net] https://www.spip.net',
  ),
  44 => 
  array (
    0 => 'un_texte_avec_des_entites_et_avec_des_accents_utf_8_aaaa_eee',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
  ),
  45 => 
  array (
    0 => 'un_texte_avec_des_entit_eacute_s_echap_eacute_amp_et_avec_de',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
  ),
  46 => 
  array (
    0 => 'un_texte_avec_des_entites_numeriques_38_60_62_et_avec_des_ac',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
  ),
  47 => 
  array (
    0 => 'un_texte_avec_des_entites_numeriques_echapees_38_60_62_et_av',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
  ),
  48 => 
  array (
    0 => 'un_texte_sans_entites_et_avec_des_accents_utf_8_aaaa_eeeee_i',
    1 => 'Un texte sans entites &<>"\' et avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
  ),
  49 => 
  array (
    0 => 'des_raccourcis_avec_des_accents_utf_8_aaaa_eeeee_iii_oo_uuu_',
    1 => '{{{Des raccourcis avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}}} {italique avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼} {{gras avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼}} <code>du code avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼</code>',
  ),
  50 => 
  array (
    0 => 'un_modele_avec_des_accents_utf_8_aaaa_eeeee_iii_oo_uuu_https',
    1 => 'Un modele avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼ <modeleinexistant|lien=[avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼->https://www.spip.net]>',
  ),
  51 => 
  array (
    0 => 'un_texte_avec_des_retour_a_la_ligne_et_meme_des_paragraphes_',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 aÃ Ã¢Ã¤ eÃ©Ã¨ÃªÃ« iÃ®Ã¯ oÃ´ uÃ¹Ã¼',
  ),
  52 => 
  array (
    0 => 'c0',
    1 => 0,
    2 => 'class',
  ),
  53 => 
  array (
    0 => 'c1',
    1 => -1,
    2 => 'class',
  ),
  54 => 
  array (
    0 => 'c1',
    1 => 1,
    2 => 'class',
  ),
  55 => 
  array (
    0 => 'c2',
    1 => 2,
    2 => 'class',
  ),
  56 => 
  array (
    0 => 'c3',
    1 => 3,
    2 => 'class',
  ),
  57 => 
  array (
    0 => 'c4',
    1 => 4,
    2 => 'class',
  ),
  58 => 
  array (
    0 => 'c5',
    1 => 5,
    2 => 'class',
  ),
  59 => 
  array (
    0 => 'c6',
    1 => 6,
    2 => 'class',
  ),
  60 => 
  array (
    0 => 'c7',
    1 => 7,
    2 => 'class',
  ),
  61 => 
  array (
    0 => 'c10',
    1 => 10,
    2 => 'class',
  ),
  62 => 
  array (
    0 => 'c20',
    1 => 20,
    2 => 'class',
  ),
  63 => 
  array (
    0 => 'c30',
    1 => 30,
    2 => 'class',
  ),
  64 => 
  array (
    0 => 'c50',
    1 => 50,
    2 => 'class',
  ),
  65 => 
  array (
    0 => 'c100',
    1 => 100,
    2 => 'class',
  ),
  66 => 
  array (
    0 => 'c1000',
    1 => 1000,
    2 => 'class',
  ),
  67 => 
  array (
    0 => 'c10000',
    1 => 10000,
    2 => 'class',
  ),
  68 => 
  array (
    0 => 'i0',
    1 => 0,
    2 => 'id',
  ),
  69 => 
  array (
    0 => 'i1',
    1 => -1,
    2 => 'id',
  ),
  70 => 
  array (
    0 => 'i1',
    1 => 1,
    2 => 'id',
  ),
  71 => 
  array (
    0 => 'i2',
    1 => 2,
    2 => 'id',
  ),
  72 => 
  array (
    0 => 'i3',
    1 => 3,
    2 => 'id',
  ),
  73 => 
  array (
    0 => 'i4',
    1 => 4,
    2 => 'id',
  ),
  74 => 
  array (
    0 => 'i5',
    1 => 5,
    2 => 'id',
  ),
  75 => 
  array (
    0 => 'i6',
    1 => 6,
    2 => 'id',
  ),
  76 => 
  array (
    0 => 'i7',
    1 => 7,
    2 => 'id',
  ),
  77 => 
  array (
    0 => 'i10',
    1 => 10,
    2 => 'id',
  ),
  78 => 
  array (
    0 => 'i20',
    1 => 20,
    2 => 'id',
  ),
  79 => 
  array (
    0 => 'i30',
    1 => 30,
    2 => 'id',
  ),
  80 => 
  array (
    0 => 'i50',
    1 => 50,
    2 => 'id',
  ),
  81 => 
  array (
    0 => 'i100',
    1 => 100,
    2 => 'id',
  ),
  82 => 
  array (
    0 => 'i1000',
    1 => 1000,
    2 => 'id',
  ),
  83 => 
  array (
    0 => 'i10000',
    1 => 10000,
    2 => 'id',
  ),
  84 => 
  array (
    0 => 'a0',
    1 => 0,
    2 => 'anchor',
  ),
  85 => 
  array (
    0 => 'a1',
    1 => -1,
    2 => 'anchor',
  ),
  86 => 
  array (
    0 => 'a1',
    1 => 1,
    2 => 'anchor',
  ),
  87 => 
  array (
    0 => 'a2',
    1 => 2,
    2 => 'anchor',
  ),
  88 => 
  array (
    0 => 'a3',
    1 => 3,
    2 => 'anchor',
  ),
  89 => 
  array (
    0 => 'a4',
    1 => 4,
    2 => 'anchor',
  ),
  90 => 
  array (
    0 => 'a5',
    1 => 5,
    2 => 'anchor',
  ),
  91 => 
  array (
    0 => 'a6',
    1 => 6,
    2 => 'anchor',
  ),
  92 => 
  array (
    0 => 'a7',
    1 => 7,
    2 => 'anchor',
  ),
  93 => 
  array (
    0 => 'a10',
    1 => 10,
    2 => 'anchor',
  ),
  94 => 
  array (
    0 => 'a20',
    1 => 20,
    2 => 'anchor',
  ),
  95 => 
  array (
    0 => 'a30',
    1 => 30,
    2 => 'anchor',
  ),
  96 => 
  array (
    0 => 'a50',
    1 => 50,
    2 => 'anchor',
  ),
  97 => 
  array (
    0 => 'a100',
    1 => 100,
    2 => 'anchor',
  ),
  98 => 
  array (
    0 => 'a1000',
    1 => 1000,
    2 => 'anchor',
  ),
  99 => 
  array (
    0 => 'a10000',
    1 => 10000,
    2 => 'anchor',
  ),
  100 => 
  array (
    0 => '0',
    1 => 0,
    2 => 'name',
  ),
  101 => 
  array (
    0 => '1',
    1 => -1,
    2 => 'name',
  ),
  102 => 
  array (
    0 => '1',
    1 => 1,
    2 => 'name',
  ),
  103 => 
  array (
    0 => '2',
    1 => 2,
    2 => 'name',
  ),
  104 => 
  array (
    0 => '3',
    1 => 3,
    2 => 'name',
  ),
  105 => 
  array (
    0 => '4',
    1 => 4,
    2 => 'name',
  ),
  106 => 
  array (
    0 => '5',
    1 => 5,
    2 => 'name',
  ),
  107 => 
  array (
    0 => '6',
    1 => 6,
    2 => 'name',
  ),
  108 => 
  array (
    0 => '7',
    1 => 7,
    2 => 'name',
  ),
  109 => 
  array (
    0 => '10',
    1 => 10,
    2 => 'name',
  ),
  110 => 
  array (
    0 => '20',
    1 => 20,
    2 => 'name',
  ),
  111 => 
  array (
    0 => '30',
    1 => 30,
    2 => 'name',
  ),
  112 => 
  array (
    0 => '50',
    1 => 50,
    2 => 'name',
  ),
  113 => 
  array (
    0 => '100',
    1 => 100,
    2 => 'name',
  ),
  114 => 
  array (
    0 => '1000',
    1 => 1000,
    2 => 'name',
  ),
  115 => 
  array (
    0 => '10000',
    1 => 10000,
    2 => 'name',
  ),
  116 => 
  array (
    0 => 's0_cfcd208',
    1 => 0,
    2 => '',
    3 => 
    array (
      'longueur_mini' => 10,
    ),
  ),
  117 => 
  array (
    0 => 's1_6bb61e3',
    1 => -1,
    2 => '',
    3 => 
    array (
      'longueur_mini' => 10,
    ),
  ),
  118 => 
  array (
    0 => 's1_c4ca423',
    1 => 1,
    2 => '',
    3 => 
    array (
      'longueur_mini' => 10,
    ),
  ),
  119 => 
  array (
    0 => 's2_c81e728',
    1 => 2,
    2 => '',
    3 => 
    array (
      'longueur_mini' => 10,
    ),
  ),
  120 => 
  array (
    0 => 's3_eccbc87',
    1 => 3,
    2 => '',
    3 => 
    array (
      'longueur_mini' => 10,
    ),
  ),
  121 => 
  array (
    0 => 's4_a87ff67',
    1 => 4,
    2 => '',
    3 => 
    array (
      'longueur_mini' => 10,
    ),
  ),
  122 => 
  array (
    0 => 's5_e4da3b7',
    1 => 5,
    2 => '',
    3 => 
    array (
      'longueur_mini' => 10,
    ),
  ),
  123 => 
  array (
    0 => 's6_1679091',
    1 => 6,
    2 => '',
    3 => 
    array (
      'longueur_mini' => 10,
    ),
  ),
  124 => 
  array (
    0 => 's7_8f14e45',
    1 => 7,
    2 => '',
    3 => 
    array (
      'longueur_mini' => 10,
    ),
  ),
  125 => 
  array (
    0 => 's10_d3d944',
    1 => 10,
    2 => '',
    3 => 
    array (
      'longueur_mini' => 10,
    ),
  ),
  126 => 
  array (
    0 => 's20_98f137',
    1 => 20,
    2 => '',
    3 => 
    array (
      'longueur_mini' => 10,
    ),
  ),
  127 => 
  array (
    0 => 's30_34173c',
    1 => 30,
    2 => '',
    3 => 
    array (
      'longueur_mini' => 10,
    ),
  ),
  128 => 
  array (
    0 => 's50_c0c7c7',
    1 => 50,
    2 => '',
    3 => 
    array (
      'longueur_mini' => 10,
    ),
  ),
  129 => 
  array (
    0 => 's100_f8991',
    1 => 100,
    2 => '',
    3 => 
    array (
      'longueur_mini' => 10,
    ),
  ),
  130 => 
  array (
    0 => 's1000_a9b7',
    1 => 1000,
    2 => '',
    3 => 
    array (
      'longueur_mini' => 10,
    ),
  ),
  131 => 
  array (
    0 => 's10000_b7a',
    1 => 10000,
    2 => '',
    3 => 
    array (
      'longueur_mini' => 10,
    ),
  ),
);
		return $essais;
	}

























?>