<?php

declare(strict_types=1);

function fin_inclure_manquant()
{
	$debusquer = charger_fonction('debusquer', 'public');
	$erreurs = $debusquer('', '', [
		'erreurs' => 'get',
	]);

	if (! $erreurs && ! (_request('var_mode') === 'debug' && erreur_squelette(false))) {
		return "pas d'erreur declenchee";
	}

	$GLOBALS['tableau_des_erreurs'] = [];
	return 'OK';
}
