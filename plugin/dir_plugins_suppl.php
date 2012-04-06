<?php
/**
 * Test unitaire de prise en compte de la constante _DIR_PLUGINS_SUPPL
 * par la fonction liste_plugin_files()
 * du fichier ./inc/plugin.php
 * 
 */

	$test = '_DIR_PLUGINS_SUPPL';

	$remonte = "../";
	while (!is_dir($remonte."ecrire"))
		$remonte = "../$remonte";
	require $remonte.'tests/test.inc';
	find_in_path("./inc/plugin.php",'',true);

	// lancer le binz
	echo essais_dir_plugins_suppl();	

function essais_dir_plugins_suppl() {
	// preparation: la constante est elle definie et comprend elle au moins 2 reps suppl?
	if (!defined('_DIR_PLUGINS_SUPPL'))
		define('_DIR_PLUGINS_SUPPL', _DIR_TMP.'plug_sup1:'._DIR_TMP.'plug_sup2');
	elseif (substr_count(_DIR_PLUGINS_SUPPL, ':') < 1)
		return 'NA : pour ce test la constante _DIR_PLUGINS_SUPPL definie dans mes_options.php doit contenir au moins 2 chemins de repertoires supplementaires separes par un ":", actuellement sa valeur est "'._DIR_PLUGINS_SUPPL.'"';

	// preparation: verifier qu'il existe au moins un dossier plugin par rep suppl (i.e. contenant un fichier paquet.xml)?
	$Ta_effacer = $Ta_retrouver = array();
	foreach ($Treps_suppl = explode(':', _DIR_PLUGINS_SUPPL) as $rep_sup) {
		$existe_paquet = FALSE;
		if (substr($rep_sup, -1) != '/')
			$rep_sup .= '/';

		// le rep suppl n'existe pas; le creer
		if (!is_dir(_DIR_RACINE.$rep_sup)) {
			if (!@mkdir(_DIR_RACINE.$rep_sup))
				return 'NA probleme de droits d\'ecriture 0, impossible de creer le dossier de _DIR_PLUGINS_SUPPL: "'.$rep_sup.'" necessaire pour ce test';
			else
				$Ta_effacer[] = _DIR_RACINE.$rep_sup;
		}

		// le rep suppl est vide: creer un dossier de plugin bidon (toto) et y copier un paquet.xml
		if (count(scandir(_DIR_RACINE.$rep_sup)) < 3) {
			if (!@mkdir(_DIR_RACINE.$rep_sup.'toto')) {
				nettoyage_plugins_suppl($Ta_effacer);
				return 'NA probleme de droits d\ecriture 1, impossible de creer un dossier dans "'._DIR_RACINE.$rep_sup.'" necessaire pour ce test';
			}
			else
				$Ta_effacer[] = _DIR_RACINE.$rep_sup.'toto';
			if (!@copy(_DIR_PLUGINS_DIST.'dump/paquet.xml', _DIR_RACINE.$rep_sup.'toto/paquet.xml')) {
				nettoyage_plugins_suppl($Ta_effacer);
				return 'NA probleme de droits d\ecriture 2, impossible de creer un fichier dans "'._DIR_RACINE.$rep_sup.'toto" necessaire pour ce test';
			}
			else {
				$Ta_effacer[] = _DIR_RACINE.$rep_sup.'toto/paquet.xml';
				$Ta_retrouver[] = _DIR_RACINE.$rep_sup.'toto';
			}
			$existe_paquet = TRUE;
		}
		else {
			if ($pointeur = opendir(_DIR_RACINE.$rep_sup)) {
				while (false !== ($rep = readdir($pointeur))) {
					if ($rep == '.' OR $rep == '..' OR !is_dir($rep))
						continue;
					else {
						if ($pointeur = opendir(_DIR_RACINE.$rep_sup.$rep)) {
							while (false !== ($fichier = readdir($pointeur))) {
								if ($fichier == 'paquet.xml') {
									$Ta_retrouver[] = _DIR_RACINE.$rep_sup.$rep;
									$existe_paquet = TRUE;
									break;
								}
							}
						}
					}
				}
			}
			// tous les sous-dossiers sont scannes et toujours pas de paquet.xml:
			// creer un dossier bidon et y copier un paquet.xml
			if (!$existe_paquet) {
				if (!in_array('toto', scandir(_DIR_RACINE.$rep_sup)) AND !@mkdir(_DIR_RACINE.$rep_sup.'toto')) {
					nettoyage_plugins_suppl($Ta_effacer);
					return 'NA probleme de droits d\ecriture 3, impossible de creer un dossier dans "'._DIR_RACINE.$rep_sup.'" necessaire pour ce test';
				}
				else
					$Ta_effacer[] = _DIR_RACINE.$rep_sup.'toto';
				if (!@copy(_DIR_PLUGINS_DIST.'dump/paquet.xml', _DIR_RACINE.$rep_sup.'toto/paquet.xml')) {
					nettoyage_plugins_suppl($Ta_effacer);
					return 'NA probleme de droits d\ecriture 4, impossible de creer un fichier dans "'._DIR_RACINE.$rep_sup.'toto" necessaire pour ce test';
				}
				else {
					$Ta_retrouver[] = _DIR_RACINE.$rep_sup.'toto';
					$Ta_effacer[] = _DIR_RACINE.$rep_sup.'toto/paquet.xml';
				}
				$existe_paquet = TRUE;
			}
		}
	}

	// preparation: creer au moins un dossier plugin hors de _DIR_PLUGINS et _DIR_PLUGINS_SUPPL
	$rep_non_suppl = '';
	if (substr_count($Treps_suppl[0], '/') > 0)
		$rep_non_suppl = substr($Treps_suppl[0], 0, strrpos($Treps_suppl[0], '/')).'/test_non_suppl';
	else
		$rep_non_suppl = _DIR_TMP.'test_non_suppl';
	if (in_array($rep_non_suppl, $Treps_suppl))
		return 'NA : le dossier "'.$rep_non_suppl.'" ne doit pas faire partie des repertoires definis dans _DIR_PLUGINS_SUPPL pour que ce test fonctionne';

	if (!is_dir($rep_non_suppl)) {
		if (!@mkdir($rep_non_suppl)) {
			nettoyage_plugins_suppl($Ta_effacer);
			return 'NA probleme de droits d\ecriture 5, impossible de creer le dossier "'.$rep_non_suppl.'" necessaire pour ce test';
		}
		else
			$Ta_effacer[] = $rep_non_suppl;
	}
	if (!file_exists($rep_non_suppl.'/paquet.xml')) {
		if (!@copy(_DIR_PLUGINS_DIST.'dump/paquet.xml', $rep_non_suppl.'/paquet.xml')) {
			nettoyage_plugins_suppl($Ta_effacer);
			return 'NA probleme de droits d\ecriture 6, impossible de creer un fichier dans "'.$rep_non_suppl.'" necessaire pour ce test';
		}
		else 
			$Ta_effacer[] = $rep_non_suppl.'/paquet.xml';
	}
		

	// test 1: lancer liste_plugin_files() et recuperer l'array retourne
	// verifier qu'on retrouve bien tous les rep suppl de _DIR_PLUGINS_SUPPL
	$Tplugins_recups = liste_plugin_files();

	$Terr = array();
	$mess_err = '';
	foreach ($Ta_retrouver as $rep) {
		if (!in_array($rep, $Tplugins_recups))
			$Terr[] = $rep;
	}
	if (count($Terr) > 0) {
		if (count($Terr) != 1)
			$mess_err .= "<li>Les repertoires supplementaires de _DIR_PLUGINS_SUPPL suivants n'ont pas etes trouves par la fonction liste_plugin_files(): ";
		else
			$mess_err .= "<li>Le repertoire supplementaire de _DIR_PLUGINS_SUPPL suivant n'a pas ete trouve par la fonction liste_plugin_files(): ";
		$mess_err .= (join(', ', $Terr));
	}


	// test 2: la liste des reps plugins trouves comprend t'elle des dossiers
	// ni dans _DIR_PLUGINS ni dans _DIR_PLUGINS_SUPPL?
	$Terr = array();
	foreach ($Tplugins_recups as $rep_plug) {
		if (!is_dir(_DIR_PLUGINS.$rep_plug) AND is_dir(_DIR_RACINE.$rep_plug)) {	// le rep existe mais pas dans _DIR_PLUGINS
			$ok = false;
			foreach ($Treps_suppl as $rep_suppl) {
				if (substr_count($rep_plug, $rep_suppl) > 0) {
					$ok = true;
					break;
				}
			}
			if (!$ok)
				$Terr[] = $rep_plug;
		}
	}
	if (count($Terr) > 0) {
		if (count($Terr) != 1) {
			$mess_err .= "<li>Les repertoires suivants ont etes trouves par la fonction liste_plugin_files(): ";
			$mess_err .= (join(', ', $Terr));
			$mess_err .= " alors qu'ils n'appartiennent ni a _DIR_PLUGINS ni a _DIR_PLUGINS_SUPPL";
		}
		else {
			$mess_err .= "<li>Le repertoire suivant a ete trouve par la fonction liste_plugin_files(): ";
			$mess_err .= (join(', ', $Terr));
			$mess_err .= " alors qu'il n'appartient ni a _DIR_PLUGINS ni a _DIR_PLUGINS_SUPPL";
		}
	}


	// sortie propre du test
	nettoyage_plugins_suppl($Ta_effacer);
	
	if ($mess_err != '')
		return '<ul>'.$mess_err.'</ul>';
	else
		return "OK";
}

// nettoyer tous les fichiers et dossiers crees pour ce test
function nettoyage_plugins_suppl($Ta_supprimer) {
	// inverser l'odre des elements de l'array pour eviter d'essayer d'effacer des reps qui contiennent encore des fichiers
	arsort($Ta_supprimer);
	foreach ($Ta_supprimer as $a_suppr) {
		if (is_dir($a_suppr))
			rmdir($a_suppr);
		elseif (file_exists($a_suppr))
			unlink($a_suppr);
		
	}
}
		
?>
