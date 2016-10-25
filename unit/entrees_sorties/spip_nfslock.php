<?php

	$test = 'spip_nfslock';
	$remonte = "../";
	while (!is_dir($remonte."ecrire"))
		$remonte = "../$remonte";
	require $remonte.'tests/test.inc';
	include_spip("inc/nfslock");

	$verrou = spip_nfslock('monfichier');
	$verrou_ok = spip_nfslock_test('monfichier',$verrou);
	$verrou_absent = spip_nfslock_test('un autre',$verrou);
	
	$deverrouille = spip_nfsunlock('monfichier',$verrou);
	$birth = false;
	$verrou_absent2 = spip_nfslock_test('monfichier',$birth);
	
	if ($verrou AND $verrou_ok AND !$verrou_absent AND $deverrouille AND !$verrou_absent2){
		echo "OK";
		exit;
	}
	
	echo "<ul><li>Erreur NFSLock :";
	echo "<ul>";
	echo "<li>verrou sur 'monfichier':$verrou</li>";
	echo "<li>test du verrou sur 'monfichier':$verrou_ok</li>";
	echo "<li>test du verrou sur 'un autre':$verrou_absent</li>";
	echo "<li>deverrouille 'monfichier':$deverrouille</li>";
	echo "<li>test du verrou sur 'monfichier':$verrou_absent2</li>";
	echo "</ul></li></ul>";


