<?php
/**
 * Test unitaire de la fonction inserer_attribut
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
function test_filtres_inserer_attribut(...$args) {
	return inserer_attribut(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_filtres_inserer_attribut(){
		$essais =  [
  0 => 
   [
    0 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => '',
    4 => true,
    5 => true,
  ],
  1 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => '',
    4 => true,
    5 => false,
  ],
  2 => 
   [
    0 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => '',
    4 => false,
    5 => true,
  ],
  3 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => '',
    4 => false,
    5 => false,
  ],
  4 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'0\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => '0',
    4 => true,
    5 => true,
  ],
  5 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'0\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => '0',
    4 => true,
    5 => false,
  ],
  6 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'0\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => '0',
    4 => false,
    5 => true,
  ],
  7 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'0\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => '0',
    4 => false,
    5 => false,
  ],
  8 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des &lt;a href=&#034;http://spip.net&#034;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;https://www.spip.net] https://www.spip.net\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
    4 => true,
    5 => true,
  ],
  9 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des &lt;a href=&#034;http://spip.net&#034;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;https://www.spip.net] https://www.spip.net\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
    4 => true,
    5 => false,
  ],
  10 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
    4 => false,
    5 => true,
  ],
  11 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
    4 => false,
    5 => false,
  ],
  12 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des entit&#233;s &#38;&lt;&gt;&#034;\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&#034;',
    4 => true,
    5 => true,
  ],
  13 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des entit&#233;s &#38;&lt;&gt;&#034;\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&#034;',
    4 => true,
    5 => false,
  ],
  14 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des entit&eacute;s &amp;&lt;&gt;&#034;\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&#034;',
    4 => false,
    5 => true,
  ],
  15 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des entit&eacute;s &amp;&lt;&gt;&#034;\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&#034;',
    4 => false,
    5 => false,
  ],
  16 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un texte sans entites &#38;&lt;&gt;&#034;&#039;\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte sans entites &<>"\'',
    4 => true,
    5 => true,
  ],
  17 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un texte sans entites &#38;&lt;&gt;&#034;&#039;\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte sans entites &<>"\'',
    4 => true,
    5 => false,
  ],
  18 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un texte sans entites &<>"&#039;\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte sans entites &<>"\'',
    4 => false,
    5 => true,
  ],
  19 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un texte sans entites &<>"&#039;\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte sans entites &<>"\'',
    4 => false,
    5 => false,
  ],
  20 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    4 => true,
    5 => true,
  ],
  21 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    4 => true,
    5 => false,
  ],
  22 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    4 => false,
    5 => true,
  ],
  23 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    4 => false,
    5 => false,
  ],
  24 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un modele &lt;modeleinexistant|lien=[-&gt;https://www.spip.net]&gt;\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
    4 => true,
    5 => true,
  ],
  25 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un modele &lt;modeleinexistant|lien=[-&gt;https://www.spip.net]&gt;\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
    4 => true,
    5 => false,
  ],
  26 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un modele <modeleinexistant|lien=[->https://www.spip.net]>\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
    4 => false,
    5 => true,
  ],
  27 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un modele <modeleinexistant|lien=[->https://www.spip.net]>\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
    4 => false,
    5 => false,
  ],
  28 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des retour
a la ligne et meme des paragraphes\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    4 => true,
    5 => true,
  ],
  29 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des retour
a la ligne et meme des paragraphes\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    4 => true,
    5 => false,
  ],
  30 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des retour
a la ligne et meme des

paragraphes\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    4 => false,
    5 => true,
  ],
  31 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des retour
a la ligne et meme des

paragraphes\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    4 => false,
    5 => false,
  ],
  32 => 
   [
    0 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => '',
    4 => true,
    5 => true,
  ],
  33 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => '',
    4 => true,
    5 => false,
  ],
  34 => 
   [
    0 => '<a href=\'https://www.spip.net\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => '',
    4 => false,
    5 => true,
  ],
  35 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => '',
    4 => false,
    5 => false,
  ],
  36 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'0\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => '0',
    4 => true,
    5 => true,
  ],
  37 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'0\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => '0',
    4 => true,
    5 => false,
  ],
  38 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'0\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => '0',
    4 => false,
    5 => true,
  ],
  39 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'0\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => '0',
    4 => false,
    5 => false,
  ],
  40 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des &lt;a href=&#034;http://spip.net&#034;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;https://www.spip.net] https://www.spip.net\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
    4 => true,
    5 => true,
  ],
  41 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des &lt;a href=&#034;http://spip.net&#034;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;https://www.spip.net] https://www.spip.net\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
    4 => true,
    5 => false,
  ],
  42 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
    4 => false,
    5 => true,
  ],
  43 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
    4 => false,
    5 => false,
  ],
  44 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des entit&#233;s &#38;&lt;&gt;&#034;\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&#034;',
    4 => true,
    5 => true,
  ],
  45 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des entit&#233;s &#38;&lt;&gt;&#034;\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&#034;',
    4 => true,
    5 => false,
  ],
  46 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des entit&eacute;s &amp;&lt;&gt;&#034;\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&#034;',
    4 => false,
    5 => true,
  ],
  47 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des entit&eacute;s &amp;&lt;&gt;&#034;\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&#034;',
    4 => false,
    5 => false,
  ],
  48 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un texte sans entites &#38;&lt;&gt;&#034;&#039;\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte sans entites &<>"\'',
    4 => true,
    5 => true,
  ],
  49 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un texte sans entites &#38;&lt;&gt;&#034;&#039;\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte sans entites &<>"\'',
    4 => true,
    5 => false,
  ],
  50 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un texte sans entites &<>"&#039;\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte sans entites &<>"\'',
    4 => false,
    5 => true,
  ],
  51 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un texte sans entites &<>"&#039;\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte sans entites &<>"\'',
    4 => false,
    5 => false,
  ],
  52 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    4 => true,
    5 => true,
  ],
  53 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    4 => true,
    5 => false,
  ],
  54 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    4 => false,
    5 => true,
  ],
  55 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    4 => false,
    5 => false,
  ],
  56 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un modele &lt;modeleinexistant|lien=[-&gt;https://www.spip.net]&gt;\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
    4 => true,
    5 => true,
  ],
  57 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un modele &lt;modeleinexistant|lien=[-&gt;https://www.spip.net]&gt;\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
    4 => true,
    5 => false,
  ],
  58 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un modele <modeleinexistant|lien=[->https://www.spip.net]>\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
    4 => false,
    5 => true,
  ],
  59 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un modele <modeleinexistant|lien=[->https://www.spip.net]>\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
    4 => false,
    5 => false,
  ],
  60 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des retour
a la ligne et meme des paragraphes\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    4 => true,
    5 => true,
  ],
  61 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des retour
a la ligne et meme des paragraphes\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    4 => true,
    5 => false,
  ],
  62 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des retour
a la ligne et meme des

paragraphes\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    4 => false,
    5 => true,
  ],
  63 => 
   [
    0 => '<a href=\'https://www.spip.net\' title=\'Un texte avec des retour
a la ligne et meme des

paragraphes\'>SPIP</a>',
    1 => '<a href=\'https://www.spip.net\' title=\'Simplement\'>SPIP</a>',
    2 => 'title',
    3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    4 => false,
    5 => false,
  ],
  64 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    2 => 'alt',
    3 => '',
    4 => true,
    5 => true,
  ],
  65 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    2 => 'alt',
    3 => '',
    4 => true,
    5 => false,
  ],
  66 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    2 => 'alt',
    3 => '',
    4 => false,
    5 => true,
  ],
  67 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    2 => 'alt',
    3 => '',
    4 => false,
    5 => false,
  ],
  68 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'0\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    2 => 'alt',
    3 => '0',
    4 => true,
    5 => true,
  ],
  69 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'0\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    2 => 'alt',
    3 => '0',
    4 => true,
    5 => false,
  ],
  70 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'0\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    2 => 'alt',
    3 => '0',
    4 => false,
    5 => true,
  ],
  71 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'0\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    2 => 'alt',
    3 => '0',
    4 => false,
    5 => false,
  ],
  72 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des &lt;a href=&#034;http://spip.net&#034;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;https://www.spip.net] https://www.spip.net\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
    4 => true,
    5 => true,
  ],
  73 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des &lt;a href=&#034;http://spip.net&#034;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;https://www.spip.net] https://www.spip.net\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
    4 => true,
    5 => false,
  ],
  74 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
    4 => false,
    5 => true,
  ],
  75 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
    4 => false,
    5 => false,
  ],
  76 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des entit&#233;s &#38;&lt;&gt;&#034;\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    4 => true,
    5 => true,
  ],
  77 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des entit&#233;s &#38;&lt;&gt;&#034;\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    4 => true,
    5 => false,
  ],
  78 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des entit&eacute;s &amp;&lt;&gt;&#034;\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&#034;',
    4 => false,
    5 => true,
  ],
  79 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    4 => false,
    5 => false,
  ],
  80 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte sans entites &#38;&lt;&gt;&#034;&#039;\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    2 => 'alt',
    3 => 'Un texte sans entites &<>"\'',
    4 => true,
    5 => true,
  ],
  81 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte sans entites &#38;&lt;&gt;&#034;&#039;\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    2 => 'alt',
    3 => 'Un texte sans entites &<>"\'',
    4 => true,
    5 => false,
  ],
  82 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte sans entites &<>"&#039;\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    2 => 'alt',
    3 => 'Un texte sans entites &<>"\'',
    4 => false,
    5 => true,
  ],
  83 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte sans entites &<>"&#039;\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    2 => 'alt',
    3 => 'Un texte sans entites &<>"\'',
    4 => false,
    5 => false,
  ],
  84 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    2 => 'alt',
    3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    4 => true,
    5 => true,
  ],
  85 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    2 => 'alt',
    3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    4 => true,
    5 => false,
  ],
  86 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    2 => 'alt',
    3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    4 => false,
    5 => true,
  ],
  87 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    2 => 'alt',
    3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    4 => false,
    5 => false,
  ],
  88 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un modele &lt;modeleinexistant|lien=[-&gt;https://www.spip.net]&gt;\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    2 => 'alt',
    3 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
    4 => true,
    5 => true,
  ],
  89 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un modele &lt;modeleinexistant|lien=[-&gt;https://www.spip.net]&gt;\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    2 => 'alt',
    3 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
    4 => true,
    5 => false,
  ],
  90 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un modele <modeleinexistant|lien=[->https://www.spip.net]>\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    2 => 'alt',
    3 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
    4 => false,
    5 => true,
  ],
  91 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un modele <modeleinexistant|lien=[->https://www.spip.net]>\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    2 => 'alt',
    3 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
    4 => false,
    5 => false,
  ],
  92 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des retour
a la ligne et meme des paragraphes\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    4 => true,
    5 => true,
  ],
  93 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des retour
a la ligne et meme des paragraphes\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    4 => true,
    5 => false,
  ],
  94 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des retour
a la ligne et meme des

paragraphes\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    4 => false,
    5 => true,
  ],
  95 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des retour
a la ligne et meme des

paragraphes\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    4 => false,
    5 => false,
  ],
  96 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => '',
    4 => true,
    5 => true,
  ],
  97 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => '',
    4 => true,
    5 => false,
  ],
  98 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => '',
    4 => false,
    5 => true,
  ],
  99 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => '',
    4 => false,
    5 => false,
  ],
  100 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'0\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => '0',
    4 => true,
    5 => true,
  ],
  101 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'0\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => '0',
    4 => true,
    5 => false,
  ],
  102 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'0\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => '0',
    4 => false,
    5 => true,
  ],
  103 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'0\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => '0',
    4 => false,
    5 => false,
  ],
  104 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des &lt;a href=&#034;http://spip.net&#034;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;https://www.spip.net] https://www.spip.net\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
    4 => true,
    5 => true,
  ],
  105 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des &lt;a href=&#034;http://spip.net&#034;&gt;liens&lt;/a&gt; [Article 1-&gt;art1] [spip-&gt;https://www.spip.net] https://www.spip.net\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
    4 => true,
    5 => false,
  ],
  106 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
    4 => false,
    5 => true,
  ],
  107 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
    4 => false,
    5 => false,
  ],
  108 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des entit&#233;s &#38;&lt;&gt;&#034;\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    4 => true,
    5 => true,
  ],
  109 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des entit&#233;s &#38;&lt;&gt;&#034;\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    4 => true,
    5 => false,
  ],
  110 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    4 => false,
    5 => true,
  ],
  111 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
    4 => false,
    5 => false,
  ],
  112 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte sans entites &#38;&lt;&gt;&#034;&#039;\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un texte sans entites &<>"\'',
    4 => true,
    5 => true,
  ],
  113 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte sans entites &#38;&lt;&gt;&#034;&#039;\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un texte sans entites &<>"\'',
    4 => true,
    5 => false,
  ],
  114 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte sans entites &<>"&#039;\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un texte sans entites &<>"\'',
    4 => false,
    5 => true,
  ],
  115 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte sans entites &<>"&#039;\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un texte sans entites &<>"\'',
    4 => false,
    5 => false,
  ],
  116 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    4 => true,
    5 => true,
  ],
  117 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    4 => true,
    5 => false,
  ],
  118 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    4 => false,
    5 => true,
  ],
  119 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    4 => false,
    5 => false,
  ],
  120 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un modele &lt;modeleinexistant|lien=[-&gt;https://www.spip.net]&gt;\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
    4 => true,
    5 => true,
  ],
  121 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un modele &lt;modeleinexistant|lien=[-&gt;https://www.spip.net]&gt;\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
    4 => true,
    5 => false,
  ],
  122 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un modele <modeleinexistant|lien=[->https://www.spip.net]>\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
    4 => false,
    5 => true,
  ],
  123 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un modele <modeleinexistant|lien=[->https://www.spip.net]>\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
    4 => false,
    5 => false,
  ],
  124 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des retour
a la ligne et meme des paragraphes\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    4 => true,
    5 => true,
  ],
  125 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des retour
a la ligne et meme des paragraphes\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    4 => true,
    5 => false,
  ],
  126 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des retour
a la ligne et meme des

paragraphes\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    4 => false,
    5 => true,
  ],
  127 => 
   [
    0 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'Un texte avec des retour
a la ligne et meme des

paragraphes\' /></a>',
    1 => '<a href=\'https://www.spip.net\'><img src=\'https://www.spip.net/IMG/logo/siteon0.png\' alt=\'SPIP\' /></a>',
    2 => 'alt',
    3 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
    4 => false,
    5 => false,
  ],
  128 => 
   [
    0 => '<input value=\'&lt;span style=&#034;color:red;&#034;&gt;ho&lt;/span&gt;\' />',
    1 => '<input />',
    2 => 'value',
    3 => '<span style="color:red;">ho</span>',
  ],
];
		return $essais;
	}
