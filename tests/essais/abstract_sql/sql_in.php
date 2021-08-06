<?php
/**
 * Test unitaire de la fonction sql_in
 * du fichier base/abstract_sql.php
 *
 */
namespace Spip\Core\Tests;

find_in_path("base/abstract_sql.php",'',true);

/**
 * La fonction appelee pour chaque jeu de test
 * Nommage conventionnel : test_[[dossier1_][[dossier2_]...]]fichier
 * @param ...$args
 * @return mixed
 */
function test_abstract_sql_sql_in(...$args) {
	return sql_in(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_abstract_sql_sql_in(){
	// charger la connexion SQL
	$nb = sql_countsel('spip_articles');
	$type_sql = $GLOBALS['connexions'][0]['type'];
	$test_provider = 'Spip\Core\Tests\essais_abstract_sql_sql_in_' . $type_sql;

	return $test_provider();
}


function essais_abstract_sql_sql_in_sqlite3(){
	$essais = array (
 0 =>
 array (
   0 => '(id_rubrique  IN (1,2,3))',
   1 => 'id_rubrique',
   2 => '1,2,3',
 ),
 1 =>
 array (
   0 => '(id_rubrique  IN (1,2,3))',
   1 => 'id_rubrique',
   2 =>
   array (
     0 => 1,
     1 => 2,
     2 => 3,
   ),
 ),
 2 =>
 array (
   0 => '(id_rubrique NOT IN (1,2,3))',
   1 => 'id_rubrique',
   2 => '1,2,3',
   3 => 'NOT',
 ),
 3 =>
 array (
   0 => '(id_rubrique NOT IN (1,2,3))',
   1 => 'id_rubrique',
   2 =>
   array (
     0 => 1,
     1 => 2,
     2 => 3,
   ),
   3 => 'NOT',
 ),
 4 =>
 array (
   0 => '0=1',
   1 => 'id_rubrique',
   2 =>
   array (
   ),
 ),
 5 =>
 array (
   0 => '(id_rubrique  IN (\'\',0,\'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net\',\'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;\',\'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;\',\'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;\',\'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;\',\'Un texte sans entites &<>"\'\'\',\'{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>\',\'Un modele <modeleinexistant|lien=[->https://www.spip.net]>\',\'Un texte avec des retour
a la ligne et meme des

paragraphes\'))',
   1 => 'id_rubrique',
   2 =>
   array (
     0 => '',
     1 => '0',
     2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
     3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
     4 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
     5 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
     6 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
     7 => 'Un texte sans entites &<>"\'',
     8 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
     9 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
     10 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
   ),
 ),
 6 =>
 array (
   0 => '(id_rubrique  IN (0,-1,1,2,3,4,5,6,7,10,20,30,50,100,1000,10000))',
   1 => 'id_rubrique',
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
 ),
 7 =>
 array (
   0 => '0=1',
   1 => 'id_rubrique',
   2 =>
   array (
     0 =>
     array (
     ),
     1 =>
     array (
       0 => '',
       1 => '0',
       2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
       3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
       4 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
       5 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
       6 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
       7 => 'Un texte sans entites &<>"\'',
       8 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
       9 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
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
 8 =>
 array (
   0 => '(id_rubrique  IN (2))',
   1 => 'id_rubrique',
   2 => 2,
 ),
 9 =>
 array (
   0 => '(id_rubrique  IN (1,0))',
   1 => 'id_rubrique',
   2 =>
   array (
     0 => true,
     1 => false,
   ),
 ),
);
	return $essais;
}

function essais_abstract_sql_sql_in_mysql(){
	$essais = array (
 0 =>
 array (
   0 => '(id_rubrique  IN (1,2,3))',
   1 => 'id_rubrique',
   2 => '1,2,3',
 ),
 1 =>
 array (
   0 => '(id_rubrique  IN (1,2,3))',
   1 => 'id_rubrique',
   2 =>
   array (
     0 => 1,
     1 => 2,
     2 => 3,
   ),
 ),
 2 =>
 array (
   0 => '(id_rubrique NOT IN (1,2,3))',
   1 => 'id_rubrique',
   2 => '1,2,3',
   3 => 'NOT',
 ),
 3 =>
 array (
   0 => '(id_rubrique NOT IN (1,2,3))',
   1 => 'id_rubrique',
   2 =>
   array (
     0 => 1,
     1 => 2,
     2 => 3,
   ),
   3 => 'NOT',
 ),
 4 =>
 array (
   0 => '0=1',
   1 => 'id_rubrique',
   2 =>
   array (
   ),
 ),
 5 =>
 array (
   0 => '(id_rubrique  IN (\'\',0,\'Un texte avec des <a href=\"http://spip.net\">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net\',\'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;\',\'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;\',\'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;\',\'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;\',\'Un texte sans entites &<>\"\\\'\',\'{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>\',\'Un modele <modeleinexistant|lien=[->https://www.spip.net]>\',\'Un texte avec des retour
a la ligne et meme des

paragraphes\'))',
   1 => 'id_rubrique',
   2 =>
   array (
     0 => '',
     1 => '0',
     2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
     3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
     4 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
     5 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
     6 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
     7 => 'Un texte sans entites &<>"\'',
     8 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
     9 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
     10 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
   ),
 ),
 6 =>
 array (
   0 => '(id_rubrique  IN (0,-1,1,2,3,4,5,6,7,10,20,30,50,100,1000,10000))',
   1 => 'id_rubrique',
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
 ),
 7 =>
 array (
   0 => '0=1',
   1 => 'id_rubrique',
   2 =>
   array (
     0 =>
     array (
     ),
     1 =>
     array (
       0 => '',
       1 => '0',
       2 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
       3 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
       4 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
       5 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
       6 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
       7 => 'Un texte sans entites &<>"\'',
       8 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
       9 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
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
 8 =>
 array (
   0 => '(id_rubrique  IN (2))',
   1 => 'id_rubrique',
   2 => 2,
 ),
 9 =>
 array (
   0 => '(id_rubrique  IN (1,0))',
   1 => 'id_rubrique',
   2 =>
   array (
     0 => true,
     1 => false,
   ),
 ),
);
	return $essais;
}

