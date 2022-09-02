<?php
/**
 * Test unitaire de la fonction traiter_raccourcis
 * du fichier inc/texte.php
 *
 *
 */

namespace Spip\Core\Tests;

find_in_path("inc/texte.php", '', true);

function pretest_propre_traiter_raccourcis($revert = false){
	static $mem = [null, null];
	if ($revert) {
		$GLOBALS['toujours_paragrapher'] = $mem[0];
		$GLOBALS['puce'] = $mem[1];
	}
	else {
		$mem = [$GLOBALS['toujours_paragrapher'] ?? null, $GLOBALS['puce'] ?? null];
		// ces tests sont prevus pour la variable de personnalisation :
		$GLOBALS['toujours_paragrapher'] = false;
		$GLOBALS['puce'] = '-';
	}
}

/**
 * La fonction appelee pour chaque jeu de test
 * Nommage conventionnel : test_[[dossier1_][[dossier2_]...]]fichier
 * @param ...$args
 * @return mixed
 */
function test_propre_traiter_raccourcis(...$args){
	return traiter_raccourcis(...$args);
}

function posttest_propre_traiter_raccourcis(){
	pretest_propre_traiter_raccourcis('revert');
}

/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_propre_traiter_raccourcis(){
	$essais = [];

	/*
	if (!preg_match($c = ",<p\b.*?>titi</p>\n<p\b.*?>toto</p>,",
	$b = propre( $a = "titi\n\ntoto")))
		$err[] = htmlentities ("$a -- $b -- $c");

	if (!preg_match(",<p\b.*?>titi</p>\n<p\b.*?>toto<br /></p>,",
	propre("titi\n\n<br />toto<br />")))
		$err[] = 'erreur 2';


	if (!strpos(propre("Ligne\n\n<br class=\"n\" />\n\nAutre"), '<br class="n" />'))
		$err[] = "erreur le &lt;br class='truc'> n'est pas preserve";
	*/


// trois tests un peu identiques sur <br />...
	$essais['div'] = [
		"<div>titi<br />toto</div>\n<p><br />tata</p>\n",
		'<div>titi<br />toto</div><br />tata'
	];
	$essais['span'] = [
		'<span>titi<br />toto</span><br />tata',
		'<span>titi<br />toto</span><br />tata'
	];
	$essais['table'] = [
		"<table><tr><td>titi<br />toto</td></tr></table>\n<p><br />tata</p>\n",
		'<table><tr><td>titi<br />toto</td></tr></table><br />tata'
	];

// melanges de \n et de <br />
	$essais['\n_x1_mixte1'] = [
		"titi\n<br />toto<br />",
		"titi\n<br />toto<br />"
	];
	$essais['\n_x1_mixte2'] = [
		"titi\n<br />\ntoto<br />",
		"titi\n<br />\ntoto<br />"
	];

// des tirets en debut de texte
	$essais['tirets1'] = [
		"&mdash;&nbsp;chose\n<br />&mdash;&nbsp;truc",
		"-- chose\n-- truc"
	];

	$essais['tirets2'] = [
		"-&nbsp;chose\n<br />-&nbsp;truc",
		"- chose\n- truc"
	];
// ligne horizontale
	$essais['lignehorizontale'] = [
		"<hr class=\"spip\" />",
		"\n----\n"
	];

	return $essais;
}

