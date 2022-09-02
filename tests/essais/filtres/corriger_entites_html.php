<?php
/**
 * Test unitaire de la fonction corriger_entites_html
 * du fichier ./inc/filtres.php
 *
 */
namespace Spip\Core\Tests;

find_in_path("./inc/filtres.php",'',true);

/**
 * La fonction appelee pour chaque jeu de test
 * Nommage conventionnel : test_[[dossier1_][[dossier2_]...]]fichier
 * @param ...$args
 * @return mixed
 */
function test_filtres_corriger_entites_html(...$args) {
	return corriger_entites_html(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_filtres_corriger_entites_html(){
		$essais =  [
  0 => 
   [
    0 => '',
    1 => '',
  ],
  1 => 
   [
    0 => '0',
    1 => '0',
  ],
  2 => 
   [
    0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
  ],
  3 => 
   [
    0 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ],
  4 => 
   [
    0 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;&amp;lt;&amp;gt;&amp;quot;',
    1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
  ],
  5 => 
   [
    0 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
  ],
  6 => 
   [
    0 => 'Un texte avec des entit&#233;s num&#233;riques echap&#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
    1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
  ],
  7 => 
   [
    0 => 'Un texte sans entites &<>"\'',
    1 => 'Un texte sans entites &<>"\'',
  ],
  8 => 
   [
    0 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ],
  9 => 
   [
    0 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
  ],
  10 => 
   [
    0 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
  ],
];
		return $essais;
	}
