<?php
/**
 * Test unitaire de la fonction chevron_ouvrant
 * du fichier inc/texte.php
 *
 */
namespace Spip\Core\Tests;

find_in_path("inc/texte.php",'',true);

function pretest_propre_chevron_ouvrant(){
	$GLOBALS['meta']['type_urls'] = $type_urls = "page";

	// initialiser les plugins qui changent les intertitre (Z), et les restaurer juste apres
	$mem = array(
		isset($GLOBALS['debut_intertitre']) ? $GLOBALS['debut_intertitre'] : null,
		isset($GLOBALS['spip_raccourcis_typo']) ? $GLOBALS['spip_raccourcis_typo'] : null
	);
	propre('rien du tout');
	list($GLOBALS['debut_intertitre'],$GLOBALS['spip_raccourcis_typo']) = $mem;
}

/**
 * La fonction appelee pour chaque jeu de test
 * Nommage conventionnel : test_[[dossier1_][[dossier2_]...]]fichier
 * @param ...$args
 * @return mixed
 */
function test_propre_chevron_ouvrant(...$args) {
	return propre(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_propre_chevron_ouvrant(){
		$essais = array (
  0 => 
	  array (
	    0 => '<p>a&lt;b</p>',
	    1 => 'a<b',
	  ),
	1 =>
	  array (
	    0 => '<p><i>a&lt;b</i></p>',
	    1 => '{a<b}',
	  ),
	2 =>
	  array (
	    0 => '<p><strong>a&lt;b</strong></p>',
	    1 => '{{a<b}}',
	  ),
	3 =>
	  array (
	    0 => '<h2 class="spip">a&lt;b</h2>',
	    1 => '{{{a<b}}}',
	  ),
	4 =>
	  array (
	    0 => '<p><i>0 &lt; a &lt; 1</i> et <i>a > 5</i></p>',
	    1 => '{0 < a < 1} et {a > 5}',
	  ),
	5 =>
	  array (
	    0 => '<p><i>0 &lt; a &lt; 1.0</i> et <i>a > 5</i></p>',
	    1 => '{0 < a < 1.0} et {a > 5}',
	  ),

	);
	return $essais;
}