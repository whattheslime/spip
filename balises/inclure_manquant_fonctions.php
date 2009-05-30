<?php

	function fin_inclure_manquant() {
		if (!$GLOBALS['tableau_des_erreurs'])
			return "pas d'erreur declenchee";

		$GLOBALS['tableau_des_erreurs'] = array();
		return 'OK';
	}
?>