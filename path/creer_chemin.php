<?php

	$test = 'chemin';
	require '../test.inc';

	$n = count(explode(":",$GLOBALS['dossier_squelettes']));
	
	$chemin = creer_chemin();
	_chemin('toto');
	$chemin1 = creer_chemin();
	
	if ((count($chemin1)!=(count($chemin)+1))
	OR ('toto/'!==$chemin1[$n] AND 'toto/'!==$chemin1[$n+1]))
		die('Erreur ajout chemin par la fonction _chemin()'.var_dump($chemin).var_dump($chemin1));

	$GLOBALS['dossier_squelettes']= "titi:".$GLOBALS['dossier_squelettes'];
	$chemin2 = creer_chemin();
	if ( (count($chemin2)==count($chemin1))  OR 'titi/'!==reset($chemin2) )
		die('Erreur prise en compte dossier squelette'.var_dump($chemin1).var_dump($chemin2));

	echo "OK";

?>
