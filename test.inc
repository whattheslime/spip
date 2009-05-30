<?php

/*
 * Ce fichier s'appelle depuis un test.php
 * qui doit definir auparavant $test, et faire
 * ensuite ses tests.
 *
 * Si tout est ok, le test doit afficher 'OK' et sortir
 * Sinon du debug ou toute indication de la nuature de l'échec...
 *
 */
// let's go spip
define('_SPIP_TEST_INC', dirname(__FILE__));
// si rien defini on va dans le public
@define('_SPIP_TEST_CHDIR', dirname(_SPIP_TEST_INC));
chdir(_SPIP_TEST_CHDIR);
require dirname(_SPIP_TEST_INC) . '/ecrire/inc_version.php';

// vous devez theoriquement definir $test avant d'inclure ce script
spip_log('test ' . $test);

// pas admin ? passe ton chemin (ce script est un vilain trou de securite)
if ($auteur_session['statut'] != '0minirezo'   and ( $_SERVER["REMOTE_ADDR"]!='127.0.0.1') )
	die('pas admin !');
/***
* fonction pas obligatoire a utiliser mais qui simplifie la vie du testeur
* $fun: le nom de la fonction a tester
* $essais: un tableau d'items array(résultat, arg1, arg2 ...) a tester
*  descriptif dans l'index "je teste ca"=>array(...)
*  si pas d'index, "test {numero}" sera utilise
* retourne un tableau de textes d'erreur dont le but est d'etre vide :)
*/
function tester_fun($fun, &$essais, $opts = array())
{
// options
	foreach (array(
		'out' => '<dt>@</dt><dd>@</dd>'
	) as $opt => $def) {
		$$opt = isset($opts[$opt]) ? $opts[$opt] : $def;
	}
// l'enrobage de sortie
	list($bef, $mid, $end) = explode('@', $out);

// pas d'erreur au depart
	$err = array();

// let's go !
	foreach ($essais as $titre => $ess) {
		switch (count($ess)) {
			case 0:	$res = null; break;
			case 1:	$res = $fun(); break;
			case 2:	$res = $fun($ess[1]); break;
			case 3:	$res = $fun($ess[1], $ess[2]); break;
			case 4:	$res = $fun($ess[1], $ess[2], $ess[3]); break;
			case 5:	$res = $fun($ess[1], $ess[2], $ess[3], $ess[4]); break;
			default:
				$copy = $ess;
				array_pop($copy);
				$res = call_user_func_array($fun, $copy);
		}
		$ok = false;
		if (is_array($ess[0]) && function_exists($ess[0][0]) && isset($ess[0][1]) && isset($ess[0][2]))
			$ok = ($ess[0][0]($ess[0][1],$res)==$ess[0][2]);
		else
			$ok = ($res === $ess[0]);

		if (!$ok) {
			$erritem = $bef . (is_numeric($titre) ?
				"test $titre" : htmlspecialchars($titre)) . $mid .
				 htmlspecialchars(var_export($res, true)) . " !== $fun(";
			$erritem_args = array();
			for ($iarg = 1; $iarg < count($ess); ++$iarg) {
				$erritem_args[] = htmlspecialchars(var_export($ess[$iarg], true));
			}
			$err[] = $erritem . join($erritem_args,', ') . ') // attendu:' .
				htmlspecialchars(var_export($ess[0], true)) . $end . "\n";
		}
	}
	return $err;
}

// pour essayer de calculer/montrer le temps qu'on y met
register_shutdown_function('afficher_timer', time() + microtime());

function afficher_timer($depart) {
	echo sprintf(" %.2fs", time() + microtime() - $depart);
}
