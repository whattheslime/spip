<?php
/**
 * Test unitaire de la fonction var2js
 * du fichier ./inc/json.php
 *
 */
namespace Spip\Core\Tests;

find_in_path("./inc/json.php",'',true);

/**
 * La fonction appelee pour chaque jeu de test
 * Nommage conventionnel : test_[[dossier1_][[dossier2_]...]]fichier
 * @param ...$args
 * @return mixed
 */
function test_json_var2js(...$args) {
	return var2js(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_json_var2js(){
		$essais =  [
  0 => 
   [
    0 => 'true',
    1 => true,
  ],
  1 => 
   [
    0 => 'false',
    1 => false,
  ],
  2 => 
   [
    0 => '0',
    1 => 0,
  ],
  3 => 
   [
    0 => '-1',
    1 => -1,
  ],
  4 => 
   [
    0 => '1',
    1 => 1,
  ],
  5 => 
   [
    0 => '2',
    1 => 2,
  ],
  6 => 
   [
    0 => '3',
    1 => 3,
  ],
  7 => 
   [
    0 => '4',
    1 => 4,
  ],
  8 => 
   [
    0 => '5',
    1 => 5,
  ],
  9 => 
   [
    0 => '6',
    1 => 6,
  ],
  10 => 
   [
    0 => '7',
    1 => 7,
  ],
  11 => 
   [
    0 => '10',
    1 => 10,
  ],
  12 => 
   [
    0 => '20',
    1 => 20,
  ],
  13 => 
   [
    0 => '30',
    1 => 30,
  ],
  14 => 
   [
    0 => '50',
    1 => 50,
  ],
  15 => 
   [
    0 => '100',
    1 => 100,
  ],
  16 => 
   [
    0 => '1000',
    1 => 1000,
  ],
  17 => 
   [
    0 => '10000',
    1 => 10000,
  ],
  18 => 
   [
    0 => '""',
    1 => '',
  ],
  19 => 
   [
    0 => '"0"',
    1 => '0',
  ],
  20 => 
   [
    0 => '"Un texte avec des <a href=\\"http:\\/\\/spip.net\\">liens<\\/a> [Article 1->art1] [spip->http:\\/\\/www.spip.net] http:\\/\\/www.spip.net"',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
  ],
  21 => 
   [
    0 => '"Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;"',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ],
  22 => 
   [
    0 => '"Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;"',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
  ],
  23 => 
   [
    0 => '"Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;"',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
  ],
  24 => 
   [
    0 => '"Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;"',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
  ],
  25 => 
   [
    0 => '"Un texte sans entites &<>\\"\'"',
    1 => 'Un texte sans entites &<>"\'',
  ],
  26 => 
   [
    0 => '"{{{Des raccourcis}}} {italique} {{gras}} <code>du code<\\/code>"',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ],
  27 => 
   [
    0 => '"Un modele <modeleinexistant|lien=[->http:\\/\\/www.spip.net]>"',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
  ],
  28 => 
   [
    0 => '"Un texte avec des retour\\na la ligne et meme des\\n\\nparagraphes"',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
  ],
  29 => 
   [
    0 => '[]',
    1 => 
     [
    ],
  ],
  30 => 
   [
    0 => '["","0","Un texte avec des <a href=\\"http:\\/\\/spip.net\\">liens<\\/a> [Article 1->art1] [spip->http:\\/\\/www.spip.net] http:\\/\\/www.spip.net","Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;","Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;","Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;","Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;","Un texte sans entites &<>\\"\'","{{{Des raccourcis}}} {italique} {{gras}} <code>du code<\\/code>","Un modele <modeleinexistant|lien=[->http:\\/\\/www.spip.net]>","Un texte avec des retour\\na la ligne et meme des\\n\\nparagraphes"]',
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
  ],
  31 => 
   [
    0 => '[0,-1,1,2,3,4,5,6,7,10,20,30,50,100,1000,10000]',
    1 => 
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
  32 => 
   [
    0 => '[true,false]',
    1 => 
     [
      0 => true,
      1 => false,
    ],
  ],
  33 => 
   [
    0 => 'null',
    1 => NULL,
  ],
  34 => 
   [
    0 => 'null',
    1 => NULL,
  ],
];
		return $essais;
	}

