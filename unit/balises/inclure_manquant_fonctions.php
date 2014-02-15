<?php

	function fin_inclure_manquant() {
		if (!$GLOBALS['tableau_des_erreurs'] 
			AND !(_request('var_mode') == 'debug' AND erreur_squelette(false)))
			return "pas d'erreur declenchee";

		$GLOBALS['tableau_des_erreurs'] = array();
		return 'OK';
	}
?>