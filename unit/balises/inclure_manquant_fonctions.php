<?php
	function fin_inclure_manquant() {


var_dump(erreur_squelette(false));
return "mince";

		if (!(isset($GLOBALS['tableau_des_erreurs']) AND $GLOBALS['tableau_des_erreurs'])
			AND !(_request('var_mode') == 'debug' AND erreur_squelette(false)))
			return "pas d'erreur declenchee";

		$GLOBALS['tableau_des_erreurs'] = array();
		return 'OK';
	}
?>
