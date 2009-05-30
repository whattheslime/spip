<?php


	// calcule un test a partir d'un squelette
	$fond = preg_replace(',\.html$,', '', $_GET['test']);
	require 'test.inc';

	$flag_preserver = true;

	// recuperer le produit
	//ob_start();

    global $dossier_squelettes;
    $dossier_squelettes = 'tests/squelettes';

	$contenu = recuperer_fond($fond);
	
	//include 'spip.php';
	//$contenu = ob_get_contents();
	//ob_end_clean();

	$page = preg_replace(',^filtre:\s*.*\n?,im', '', $contenu);

	// filtres a appliquer
	if (preg_match_all(',^filtre:\s*(\w+),im', $contenu, $r, PREG_SET_ORDER))
		foreach ($r as $filtre)
			$page = $filtre[1]($page);

	$page = trim($page);

	// comme flag_preserver est on, les warning de compilation
	// ne s'affichent pas tout seuls
	if (count($tableau_des_erreurs))
		echo affiche_erreurs_page($tableau_des_erreurs);

	echo $page;

?>
