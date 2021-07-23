<?php
/**
 * Test unitaire de la fonction propre
 * du fichier inc/texte.php
 *
 */
namespace Spip\Core\Tests;

find_in_path("inc/texte.php",'',true);

function pretest_texte_propre(){
	$GLOBALS['meta']['type_urls'] = $type_urls = "page";

	changer_langue('fr'); // ce test est en fr

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
function test_texte_propre(...$args) {
	return propre(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_texte_propre(){
		$essais = array (
  0 => 
  array (
    0 => '',
    1 => '',
  ),
  1 => 
  array (
    0 => '0',
    1 => '0',
  ),
  2 => 
  array (
    0 => '<p>Un texte avec des <a href="http://spip.net">liens</a> <a href="spip.php?article1" class=\'spip_in\'>Article 1</a> <a href="http://www.spip.net" class=\'spip_out\' rel=\'external\'>spip</a> <a href="http://www.spip.net" class=\'spip_url spip_out auto\' rel=\'nofollow external\'>http://www.spip.net</a></p>',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
  ),
  3 => 
  array (
    0 => '<p>Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;</p>',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ),
  4 => 
  array (
    0 => '<p>Un texte sans entites &amp;&lt;>"&#8217;</p>',
    1 => 'Un texte sans entites &<>"\'',
  ),
  5 => 
  array (
    0 => '<h2 class="spip">Des raccourcis</h2>
<p> <i>italique</i> <strong>gras</strong> <code class=\'spip_code\' dir=\'ltr\'>du code</code></p>',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ),
  6 => 
  array (
    0 => '<p>Un modele <tt>&lt;modeleinexistant|lien=[-&gt;http://www.spip.net]&gt;</tt></p>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
  ),
  7 => 
  array (
    0 => '<p><span class="spip-puce ltr"><b>–</b></span>&nbsp;propre</p>',
    1 => '- propre',
  ),
);
		return $essais;
	}

