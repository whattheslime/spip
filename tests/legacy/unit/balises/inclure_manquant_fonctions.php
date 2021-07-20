<?php
	function fin_inclure_manquant() {

		$debusquer = charger_fonction('debusquer', 'public');
		$erreurs = $debusquer('', '', array('erreurs' => 'get'));

		if (!$erreurs
			AND !(_request('var_mode') == 'debug' AND erreur_squelette(false)))
			return "pas d'erreur declenchee";

		$GLOBALS['tableau_des_erreurs'] = array();
		return 'OK';
	}

