<?php

# Ces tests sont invalides, cf.
# http://trac.rezo.net/trac/spip/ticket/778#comment:5


	$test = 'parametre_url';
	require '../test.inc';
	
	$url = "/ecrire/?exec=exec&id_obj=id_obj&no_val";
	$amp = str_replace('&', '&amp;', $url);

	$essais["ajout_parametre"] =
	 array($amp . '&amp;ajout=valajout', $url, 'ajout', 'valajout');

	$essais["enleve_parametre"] =
	 array('/ecrire/?exec=exec&amp;no_val', $url, 'id_obj', '');
	
	$essais["change_parametre"] =
	 array('/ecrire/?exec=exec&amp;id_obj=changobj&amp;no_val', $url, 'id_obj', 'changobj');
	
	$essais["change_noval"] =
	 array('/ecrire/?exec=exec&amp;id_obj=id_obj&amp;no_val=yesval', $url, 'no_val', 'yesval');
	
	$essais["enleve_parametre_no_val"] =
	 array('/ecrire/?exec=exec&amp;id_obj=id_obj', $url, 'no_val', '');
	
	$essais["enleve_parametre_no_amp"] =
	 array('/ecrire/?exec=exec&no_val',$url,'id_obj','','&');
	
	$essais["enleve_parametre_no_valamp"] =
	 array('/ecrire/?exec=exec&id_obj=id_obj', $url, 'no_val','','&');
	 
	$essais["recupere_parametre_id_obj"] =
	 array('id_obj', $url, 'id_obj');
	 
	$essais["recupere_parametre_no_val"] =
	 array('', $url, 'no_val');

 	$essais["recupere_parametre_absent"] =
	 array(NULL, $url, 'toto');

	
//
// hop ! on y va
//
	$err = tester_fun('parametre_url', $essais);

	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";

?>
