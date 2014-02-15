<?php
/**
 * Test unitaire de la fonction parametre_url
 * du fichier ./inc/utils.php
 *
 * genere automatiquement par TestBuilder
 * le 2012-02-02 09:22
 */

	$test = 'parametre_url';
	$remonte = "../";
	while (!is_dir($remonte."ecrire"))
		$remonte = "../$remonte";
	require $remonte.'tests/test.inc';
	find_in_path("./inc/utils.php",'',true);

	// chercher la fonction si elle n'existe pas
	if (!function_exists($f='parametre_url')){
		find_in_path("inc/filtres.php",'',true);
		$f = chercher_filtre($f);
	}

	//
	// hop ! on y va
	//
	$err = tester_fun($f, essais_parametre_url());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_parametre_url(){
		$essais = array (
  0 => 
  array (
    0 => '/ecrire/?exec=exec&amp;id_obj=id_obj&amp;no_val&amp;ajout=valajout',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'ajout',
    3 => 'valajout',
  ),
  1 => 
  array (
    0 => '/ecrire/?exec=exec&amp;no_val',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'id_obj',
    3 => '',
  ),
  2 => 
  array (
    0 => '/ecrire/?exec=exec&amp;id_obj=changobj&amp;no_val',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'id_obj',
    3 => 'changobj',
  ),
  3 => 
  array (
    0 => '/ecrire/?exec=exec&amp;id_obj=id_obj&amp;no_val=yes_val',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'no_val',
    3 => 'yes_val',
  ),
  4 => 
  array (
    0 => '/ecrire/?exec=exec&amp;id_obj=id_obj',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'no_val',
    3 => '',
  ),
  5 => 
  array (
    0 => '/ecrire/?exec=exec&no_val',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'id_obj',
    3 => '',
    4 => '&',
  ),
  6 => 
  array (
    0 => '/ecrire/?exec=exec&id_obj=id_obj',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'no_val',
    3 => '',
    4 => '&',
  ),
  7 => 
  array (
    0 => 'id_objv',
    1 => '/ecrire/?exec=exec&id_obj=id_objv&no_val',
    2 => 'id_obj',
  ),
  8 => 
  array (
    0 => '',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'no_val',
  ),
  9 => 
  array (
    0 => NULL,
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'toto',
  ),
  10 => 
  array (
    0 => '/ecrire/?exec=exec&amp;id_obj=id_obj&amp;no_val&amp;id1=valeur&amp;id2=valeur&amp;id3=valeur',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'id1|id2|id3',
    3 => 'valeur',
  ),
  11 => 
  array (
    0 => '/ecrire/?exec=exec&amp;id_obj=valeur&amp;no_val&amp;id2=valeur&amp;id3=valeur',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'id_obj|id2|id3',
    3 => 'valeur',
  ),
  12 => 
  array (
    0 => '/ecrire/?exec=exec&amp;id_obj=id_obj&amp;no_val=valeur&amp;id1=valeur&amp;id3=valeur',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'id1|no_val|id3',
    3 => 'valeur',
  ),
  13 => 
  array (
    0 => NULL,
    1 => '/ecrire/?exec=exec&id_obj=id_objv&no_val',
    2 => 'id_obj|no_val',
  ),
  14 => 
  array (
    0 => '/ecrire/?exec=exec&amp;id_obj=id_obj&amp;no_val',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'tab',
    3 => 
    array (
    ),
  ),
  15 => 
  array (
    0 => '/ecrire/?exec=exec&amp;id_obj=id_obj&amp;no_val&amp;tab[]=0&amp;tab[]=-1&amp;tab[]=1&amp;tab[]=2&amp;tab[]=3&amp;tab[]=4&amp;tab[]=5&amp;tab[]=6&amp;tab[]=7&amp;tab[]=10&amp;tab[]=20&amp;tab[]=30&amp;tab[]=50&amp;tab[]=100&amp;tab[]=1000&amp;tab[]=10000',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'tab',
    3 => 
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
    0 => '/ecrire/?exec=exec&amp;id_obj=id_obj&amp;no_val&amp;tab[]=1&amp;tab[]=',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'tab',
    3 => 
    array (
      0 => true,
      1 => false,
    ),
  ),
  17 => 
  array (
    0 => '/ecrire/?exec=exec&amp;id_obj=id_obj&amp;no_val&amp;tab[]=Array&amp;tab[]=Array&amp;tab[]=Array&amp;tab[]=Array',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'tab',
    3 => 
    array (
      0 => 
      array (
      ),
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
      2 => 
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
      3 => 
      array (
        0 => true,
        1 => false,
      ),
    ),
  ),
  18 => 
  array (
    0 => '/ecrire/?exec=exec&amp;id_obj=id_obj&amp;no_val',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'tab[]',
    3 => 
    array (
    ),
  ),
  19 => 
  array (
    0 => '/ecrire/?exec=exec&amp;id_obj=id_obj&amp;no_val&amp;tab[]=0&amp;tab[]=-1&amp;tab[]=1&amp;tab[]=2&amp;tab[]=3&amp;tab[]=4&amp;tab[]=5&amp;tab[]=6&amp;tab[]=7&amp;tab[]=10&amp;tab[]=20&amp;tab[]=30&amp;tab[]=50&amp;tab[]=100&amp;tab[]=1000&amp;tab[]=10000',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'tab[]',
    3 => 
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
  20 => 
  array (
    0 => '/ecrire/?exec=exec&amp;id_obj=id_obj&amp;no_val&amp;tab[]=1&amp;tab[]=',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'tab[]',
    3 => 
    array (
      0 => true,
      1 => false,
    ),
  ),
);
		return $essais;
	}








































?>