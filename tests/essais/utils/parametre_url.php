<?php
/**
 * Test unitaire de la fonction parametre_url
 * du fichier ./inc/utils.php
 *
 */
namespace Spip\Core\Tests;

find_in_path("./inc/utils.php",'',true);

/**
 * La fonction appelee pour chaque jeu de test
 * Nommage conventionnel : test_[[dossier1_][[dossier2_]...]]fichier
 * @param ...$args
 * @return mixed
 */
function test_utils_parametre_url(...$args) {
	return parametre_url(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_utils_parametre_url(){
		$essais =  [
  0 => 
   [
    0 => '/ecrire/?exec=exec&amp;id_obj=id_obj&amp;no_val&amp;ajout=valajout',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'ajout',
    3 => 'valajout',
  ],
  1 => 
   [
    0 => '/ecrire/?exec=exec&amp;no_val',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'id_obj',
    3 => '',
  ],
  2 => 
   [
    0 => '/ecrire/?exec=exec&amp;id_obj=changobj&amp;no_val',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'id_obj',
    3 => 'changobj',
  ],
  3 => 
   [
    0 => '/ecrire/?exec=exec&amp;id_obj=id_obj&amp;no_val=yes_val',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'no_val',
    3 => 'yes_val',
  ],
  4 => 
   [
    0 => '/ecrire/?exec=exec&amp;id_obj=id_obj',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'no_val',
    3 => '',
  ],
  5 => 
   [
    0 => '/ecrire/?exec=exec&no_val',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'id_obj',
    3 => '',
    4 => '&',
  ],
  6 => 
   [
    0 => '/ecrire/?exec=exec&id_obj=id_obj',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'no_val',
    3 => '',
    4 => '&',
  ],
  7 => 
   [
    0 => 'id_objv',
    1 => '/ecrire/?exec=exec&id_obj=id_objv&no_val',
    2 => 'id_obj',
  ],
  8 => 
   [
    0 => '',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'no_val',
  ],
  9 => 
   [
    0 => NULL,
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'toto',
  ],
  10 => 
   [
    0 => '/ecrire/?exec=exec&amp;id_obj=id_obj&amp;no_val&amp;id1=valeur&amp;id2=valeur&amp;id3=valeur',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'id1|id2|id3',
    3 => 'valeur',
  ],
  11 => 
   [
    0 => '/ecrire/?exec=exec&amp;id_obj=valeur&amp;no_val&amp;id2=valeur&amp;id3=valeur',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'id_obj|id2|id3',
    3 => 'valeur',
  ],
  12 => 
   [
    0 => '/ecrire/?exec=exec&amp;id_obj=id_obj&amp;no_val=valeur&amp;id1=valeur&amp;id3=valeur',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'id1|no_val|id3',
    3 => 'valeur',
  ],
  13 => 
   [
    0 => NULL,
    1 => '/ecrire/?exec=exec&id_obj=id_objv&no_val',
    2 => 'id_obj|no_val',
  ],
  14 => 
   [
    0 => '/ecrire/?exec=exec&amp;id_obj=id_obj&amp;no_val',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'tab',
    3 => 
     [
    ],
  ],
  15 => 
   [
    0 => '/ecrire/?exec=exec&amp;id_obj=id_obj&amp;no_val&amp;tab[]=0&amp;tab[]=-1&amp;tab[]=1&amp;tab[]=2&amp;tab[]=3&amp;tab[]=4&amp;tab[]=5&amp;tab[]=6&amp;tab[]=7&amp;tab[]=10&amp;tab[]=20&amp;tab[]=30&amp;tab[]=50&amp;tab[]=100&amp;tab[]=1000&amp;tab[]=10000',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'tab',
    3 => 
     [
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
    ],
  ],
  16 => 
   [
    0 => '/ecrire/?exec=exec&amp;id_obj=id_obj&amp;no_val&amp;tab[]=1&amp;tab[]=',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'tab',
    3 => 
     [
      0 => true,
      1 => false,
    ],
  ],
  17 => 
   [
    0 => '/ecrire/?exec=exec&amp;id_obj=id_obj&amp;no_val&amp;tab[]=Array&amp;tab[]=Array&amp;tab[]=Array&amp;tab[]=Array',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'tab',
    3 => 
     [
      0 => 
       [
      ],
      1 => 
       [
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
      ],
      2 => 
       [
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
      ],
      3 => 
       [
        0 => true,
        1 => false,
      ],
    ],
  ],
  18 => 
   [
    0 => '/ecrire/?exec=exec&amp;id_obj=id_obj&amp;no_val',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'tab[]',
    3 => 
     [
    ],
  ],
  19 => 
   [
    0 => '/ecrire/?exec=exec&amp;id_obj=id_obj&amp;no_val&amp;tab[]=0&amp;tab[]=-1&amp;tab[]=1&amp;tab[]=2&amp;tab[]=3&amp;tab[]=4&amp;tab[]=5&amp;tab[]=6&amp;tab[]=7&amp;tab[]=10&amp;tab[]=20&amp;tab[]=30&amp;tab[]=50&amp;tab[]=100&amp;tab[]=1000&amp;tab[]=10000',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'tab[]',
    3 => 
     [
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
    ],
  ],
  20 => 
   [
    0 => '/ecrire/?exec=exec&amp;id_obj=id_obj&amp;no_val&amp;tab[]=1&amp;tab[]=',
    1 => '/ecrire/?exec=exec&id_obj=id_obj&no_val',
    2 => 'tab[]',
    3 => 
     [
      0 => true,
      1 => false,
    ],
  ],
	21 =>
	[
		0 => 'http://domaine/spip.php?t[]=0&amp;t[]=2',
		1 => 'http://domaine/spip.php?t[]=1',
		2 => 't',
		3 => [0,2]
	],
	22 =>
	[
		0 => 'http://domaine/spip.php?t[]=0&amp;t[]=2',
		1 => 'http://domaine/spip.php?t[]=1',
		2 => 't[]',
		3 => [0,2]
	],
	23 =>
	[
		0 => ['1','2'],
		1 => 'http://domaine/spip.php?t[]=1&t[]=2',
		2 => 't',
	],
	24 =>
	[
		0 => ['1','2'],
		1 => 'http://domaine/spip.php?t[]=1&t[]=2',
		2 => 't[]',
	],
];
		return $essais;
	}
