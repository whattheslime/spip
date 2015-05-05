<?php
	$dir = (isset($_GET['dir']) AND ($_GET['dir'])) ? $_GET['dir'] : '..';
	chdir($dir);
	require 'ecrire/inc_version.php';

	// certains tests de simpletest sont réalisés non connectés
	// on se limite à certains squelettes tout de même !
	if (_request('simpletest')) {
		$test = str_replace('..','',_request('test'));
		if ((substr($test, 0, 6) != 'tests/')
			AND (substr($test, 0, 6) != 'unit/')
			AND (false === strpos($test, _DIR_CACHE))) {
				die("Squelette de test hors d'un répertoire autorisé");
		}
		$fond = $test; // squelette désiré
		// pas de boutons d'admin
		set_request('fond', null);
		set_request('test', null);
		set_request('simpletest', null);
		include _DIR_RESTREINT_ABS.'public.php';
		die();
	}


	// pas admin ? passe ton chemin (ce script est un vilain trou de securite)
	if ((!isset($GLOBALS['visiteur_session']['statut'])
	     OR $GLOBALS['visiteur_session']['statut'] != '0minirezo')
	     AND !in_array($_SERVER["REMOTE_ADDR"], array('127.0.0.1', '127.0.1.1', '::1')) ) {
		die('Administrateur local requis !');
	}

	// supprimer le vieux logs de tests
	spip_unlink(_DIR_TMP."testrunner.log");

	// chercher les bases de tests
	$bases = array('tests/unit');
	foreach (creer_chemin() as $d) {
		if ($d && @is_dir("${d}tests"))
			$bases[] = "${d}tests";
	}

	// déclarations
	$sectionold = '';

	echo
		"<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN'
			'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>\n",
		"<html><head><title>Tests de SPIP</title>",
		"<script src='jquery-2.1.js' type='text/javascript'></script>\n",
		"<script src='testrunner.js' type='text/javascript'></script>\n",
		"<link rel='stylesheet' href='tests.css' type='text/css' />\n",
		"</head><body>\n",
		"<h1>",
		"Tests SPIP ", version_spip(),
		"</h1>\n";


	foreach ($bases as $base) {

		// regarder tous les tests
		$tests = preg_files($base .= '/', '/\w+/.*\.(php|html)$');

		// utiliser le parametre $_GET['fichier'] pour limiter les tests a un seul fichier
		if (isset($_GET['fichier']) AND $_GET['fichier'] != '' AND preg_match('[^\d\w-.]', $_GET['fichier']) != 1)
			$fic = $_GET['fichier'];


		foreach ($tests as $test) {
			if (isset($fic) AND $fic != '' AND substr_count($test, $fic) == 0)
				continue;

			if (strlen($t=_request('rech')) && (strpos($test, $t)===false))
		 		continue;

			//ignorer le contenu du jeu de squelettes dédié aux tests
			if (stristr($test,'squelettes/'))
				continue;

			//ignorer le contenu des donnees de test
			if (stristr($test,'data/'))
				continue;

			//ignorer les fichiers lanceurs pour simpleTests aux tests
			if (stristr($test,'lanceur_spip.php'))
				continue;
			if (stristr($test,'all_tests.php'))
				continue;

			if (strncmp(basename($test),'inclus_',7)!==0
				AND substr(basename($test),-14) != '_fonctions.php'
			  AND (strncmp(basename($test),'NA_',3)!==0 OR _request('var_mode')=='dev')){
				if (preg_match(',\.php$,', $test))
					$url = '../'.$test.'?mode=test_general';
				else
					$url = "squel.php?test=$test&amp;var_mode=recalcul";

				$joli = basename($test);
				$dirTests = false;
				$section_svn = "";
				if ($base == 'tests/') {
					$dirTests = true;
					$section = basename(dirname($test));
				} else {
					$section = dirname($test);
					$section_dir = $section;
					#$section = str_replace('/tests','  ',dirname($test));
					if ($svn = version_svn_courante(dirname(dirname($test))))
						$section_svn = ' ['.abs($svn).']';
				}
				if ($section <> $sectionold) {
					if ($sectionold) echo "</dl>\n";
					$titre = $dirTests ? $section : "<a href='../$section_dir'>$section</a>$section_svn";
					echo "<dl><dt>$titre</dt>\n";
					$sectionold = $section;
				}
		
				echo "<dd>
					<a href='$url' class='joli'>".$joli.":</a> &nbsp;
					&nbsp;</dd>\n";
			}
		}
	}

	echo "</dl>\n";

	echo "<div id='count'>";
	echo "<span id='succes'>0</span> succ&#232;s, ";
	echo "<span id='echec'>0</span> &#233;chec / ";
	echo "<span id='total'>0</span> total";
	echo "<br />tests exp&#233;di&#233;s en <span id='timer'>0</span>ms";
	echo "</div>";

	echo "</body></html>";


function version_spip() {
	include_spip('inc/minipres');
	$version = $GLOBALS['spip_version_affichee'];
	if ($svn_revision = version_svn_courante(_DIR_RACINE))
		$version .= ' ' . (($svn_revision < 0) ? 'SVN ':'')
		. "[<a href='http://core.spip.org/projects/spip/repository/revisions/"
		. abs($svn_revision) . "' onclick=\"window.open(this.href); return false;\">"
		. abs($svn_revision) . "</a>]";

	return $version;
}

?>
