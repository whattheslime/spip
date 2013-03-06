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

if (!defined('_VAR_MODE')) {
	define('_VAR_MODE', 'recalcul');
}

// pour notice sur recuperer_fond()
if (!isset($GLOBALS['spip_lang'])) {
	include_spip('inc/lang');
	utiliser_langue_visiteur();
}


// vous devez theoriquement definir $test avant d'inclure ce script
#spip_log('test ' . $test,'testrunner');
$GLOBALS['taille_des_logs'] = 1024;
$GLOBALS['compteur_essai'] = 0;

// pas admin ? passe ton chemin (ce script est un vilain trou de securite)
if ($visiteur_session['statut'] != '0minirezo'   and ( $_SERVER["REMOTE_ADDR"]!='127.0.0.1') )
	die('pas admin !');
/***
* fonction pas obligatoire a utiliser mais qui simplifie la vie du testeur
* $fun: le nom de la fonction a tester
* $essais: un tableau d'items array(résultat, arg1, arg2 ...) a tester
*  descriptif dans l'index "je teste ca"=>array(...)
*  si pas d'index, "test {numero}" sera utilise
* retourne un tableau de textes d'erreur dont le but est d'etre vide :)
*/
function tester_fun($fun, $essais, $opts = array())
{
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
				array_shift($copy);
				$res = call_user_func_array($fun, $copy);
		}
		$ok = false;
		#var_dump($res);
		if (is_array($ess) and is_array($ess[0]) and isset($ess[0][0])
		  && function_exists($ess[0][0]) && isset($ess[0][1]) && isset($ess[0][2])) {
			$ok = ($ess[0][0]($ess[0][1],$res)==$ess[0][2]);
		} else {
			$ok =
			  ( (is_array($res) AND is_array($ess[0]))?
				  (!count(array_diff_assoc_recursive($res,$ess[0]))
				    AND !count(array_diff_assoc_recursive($ess[0],$res)))
				  :
						( is_double($res)?(($res-$ess[0])<1e-10*abs($res)):$res === $ess[0]) );
		}

		spip_log('test ' . $GLOBALS['test']." : Essai ".$GLOBALS['compteur_essai']++.($ok?" ok":" ECHEC"),'testrunner');
		if (!$ok) {
			$erritem_args = array();
			for ($iarg = 1; $iarg < count($ess); ++$iarg) {
				$erritem_args[] = htmlspecialchars(var_export($ess[$iarg], true));
			}
			$err[] = display_error(
			  $titre,
				"$fun(". join($erritem_args,', ') . ")",
				$res,
				$ess[0],
				$opts
			);
		}
	}
	return $err;
}

function display_error($titre,$call,$result,$expected,$opts=array()){
	static $bef,$mid,$end;
	if (!isset($bef)){
		// options
		foreach (array(
			'out' => '<dt>@</dt><dd>@</dd>'
		) as $opt => $def) {
			$$opt = isset($opts[$opt]) ? $opts[$opt] : $def;
		}
		// l'enrobage de sortie
		list($bef, $mid, $end) = explode('@', $out);
	}
	
	return 
	  $bef 
	  . (is_numeric($titre) ? "test $titre" : htmlspecialchars($titre))
	  . $mid
	  . "<pre>$call</pre>"
		. '<pre>// resultat:' . htmlspecialchars(var_export($result, true))."</pre>"
		. '<pre>// attendu :' . htmlspecialchars(var_export($expected, true))."</pre>"
	  . $end;
}

// pour essayer de calculer/montrer le temps qu'on y met
register_shutdown_function('afficher_timer', time() + microtime());

function afficher_timer($depart) {
	echo sprintf(" %.2fs", time() + microtime() - $depart);
}


if (!function_exists('array_diff_assoc_recursive')) {
// http://www.php.net/manual/fr/function.array-diff-assoc.php#73972
function array_diff_assoc_recursive($array1, $array2)
{
    foreach($array1 as $key => $value)
    {
        if(is_array($value))
        {
           if(!isset($array2[$key]))
              {
                  $difference[$key] = $value;
              }
              elseif(!is_array($array2[$key]))
              {
                  $difference[$key] = $value;
              }
              else
              {
                  $new_diff = array_diff_assoc_recursive($value, $array2[$key]);
                  if ($new_diff !== array())
                  {
                        $difference[$key] = $new_diff;
                  }
              }
       }
       elseif(!array_key_exists($key, $array2) || $array2[$key] != $value)
       {
              $difference[$key] = $value;
       }
    }
    return !isset($difference) ? array() : $difference;
}
}
