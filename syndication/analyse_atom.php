<?php
/*

objectif : http://trac.rezo.net/trac/spip/ticket/649#comment:9

Pour ce faire, copier un fichier rss 2, faire un test de non regression dessus, 
et si ca fonctionne, faire les memes tests sur la production du squelette atom 1. 

Actuellement ca teste uniquement avec la fonction analyser_backend
http://trac.rezo.net/trac/spip/browser/spip/ecrire/inc/syndic.php#analyser_backend
qui lis les donnees suivants
contenant
	rien ?
dans les items 
	url
	titre
	date
	lesauteurs = liste des auteurs
	descriptif = description
	lang = langue
	source
	url_source
	enclosures
	tags


*/



	$test = 'analyse_atom';
	require '../test.inc';

	include_spip('inc/syndic');
	$GLOBALS['controler_dates_rss'] = false;

	$rss = analyser_backend(
//		file_get_contents(dirname(__FILE__).'/data/test-rss2-1.xml')
		file_get_contents(dirname(__FILE__).'/data/test-atom1-1.xml') 
	);

	$err = array();

	if ($rss[0]['url'] != 'http://localhost/spip/spip.php?article1')
		$err[] = "erreur d'url item 0 sur test-atom1-1.xml";
	if ($rss[0]['titre'] != 'delenda carthago')
		$err[] = "erreur de titre item 0 sur test-atom1-1.xml";
	if ($rss[0]['date'] != strtotime('2007-05-13T21:33:24Z'))
		$err[] = "erreur de date item 0 sur test-atom1-1.xml";
	if ($rss[0]['lesauteurs'] != 'Caton l ancien, Caton le jeune')
		$err[] = "erreur de lesauteurs item 0 sur test-atom1-1.xml";
	if (substr($rss[0]['descriptif'], 0, 200) != 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tatio')
		$err[] = "erreur de description item 0 sur test-atom1-1.xml";
	if ($rss[0]['lang'] != 'fr')
		$err[] = "erreur de langue item 0 sur test-atom1-1.xml";
	if ($rss[0]['enclosures'] != '<a rel="enclosure" href="http://localhost/spip/IMG/txt/test-3.txt" type="text/plain" title="272">test-3.txt</a>')
		$err[] = "erreur d'enclosure item 0 sur test-atom1-1.xml";

	if (!$rss[0]['tags'][0]
	OR (extraire_attribut($rss[0]['tags'][0], 'href') != 'http://localhost/spip/rub1')
	OR (extraire_attribut($rss[0]['tags'][0], 'rel') != "directory")
	OR (supprimer_tags($rss[0]['tags'][0]) != 'Nouvelle rubrique'))
		$err[] = "erreur de tag (num 0) item 0 sur test-atom1-1.xml";
	if (!$rss[0]['tags'][1]
	OR (extraire_attribut($rss[0]['tags'][1], 'href') != 'http://localhost/spip/rubrique2')
	OR (extraire_attribut($rss[0]['tags'][1], 'rel') != "directory")
	OR (supprimer_tags($rss[0]['tags'][1]) != 'Nouvelle rubrique'))
		$err[] = "erreur de tag (num 1) item 0 sur test-atom1-1.xml";
	if (!$rss[0]['tags'][2]
	OR (extraire_attribut($rss[0]['tags'][2], 'href') != 'http://localhost/spip/toto')
	OR (extraire_attribut($rss[0]['tags'][2], 'rel') != "directory")
	OR (supprimer_tags($rss[0]['tags'][2]) != 'Nouvelle rubrique4'))
		$err[] = "erreur de tag (num 2, rubrique4) item 0 sur test-atom1-1.xml";


	if ($err)
		var_dump($err);
	else
		echo "OK";

?>
