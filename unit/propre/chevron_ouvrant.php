<?php
/**
 * Test unitaire de la fonction propre
 * du fichier inc/texte.php
 *
 * genere automatiquement par testbuilder
 * le 
 */

	$test = 'propre';
	$remonte = "../";
	while (!is_dir($remonte."ecrire"))
		$remonte = "../$remonte";
	require $remonte.'tests/test.inc';
	find_in_path("inc/texte.php",'',true);
	$GLOBALS['meta']['type_urls'] = $type_urls = "page";

	// initialiser les plugins qui changent les intertitre (Z), et les restaurer juste apres
	$mem = array(
		isset($GLOBALS['debut_intertitre']) ? $GLOBALS['debut_intertitre'] : null,
		isset($GLOBALS['spip_raccourcis_typo']) ? $GLOBALS['spip_raccourcis_typo'] : null
	);
	propre('rien du tout');
	list($GLOBALS['debut_intertitre'],$GLOBALS['spip_raccourcis_typo']) = $mem;

	//
	// hop ! on y va
	//
	$err = tester_fun('propre', essais_chevron_ouvrant());

	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

function essais_chevron_ouvrant(){
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
	    0 => '<h3 class="spip">a&lt;b</h3>',
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