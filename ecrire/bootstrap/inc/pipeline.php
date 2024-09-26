<?php

/**
 * Exécute une fonction (appellée par un pipeline) avec la donnée transmise.
 *
 * Un pipeline est lie a une action et une valeur
 * chaque element du pipeline est autorise a modifier la valeur
 * le pipeline execute les elements disponibles pour cette action,
 * les uns apres les autres, et retourne la valeur finale
 *
 * Cf. compose_filtres dans references.php, qui est la
 * version compilee de cette fonctionnalite
 * appel unitaire d'une fonction du pipeline
 * utilisee dans le script pipeline precompile
 *
 * on passe $val par reference pour limiter les allocations memoire
 *
 * @param string $fonc
 *     Nom de la fonction appelée par le pipeline
 * @param string|array $val
 *     Les paramètres du pipeline, son environnement
 * @return string|array
 *     Les paramètres du pipeline modifiés
 */
function minipipe($fonc, &$val) {
	// fonction
	if (function_exists($fonc)) {
		$val = $fonc($val);
	} // Class::Methode
	else {
		if (
			preg_match('/^(\w*)::(\w*)$/S', $fonc, $regs)
			&& ($methode = [$regs[1], $regs[2]])
			&& is_callable($methode)
		) {
			$val = $methode($val);
		} else {
			spip_logger()->info("Erreur - '$fonc' non definie !");
		}
	}

	return $val;
}

/**
 * Appel d’un pipeline
 *
 * Exécute le pipeline souhaité, éventuellement avec des données initiales.
 * Chaque plugin qui a demandé à voir ce pipeline vera sa fonction spécifique appelée.
 * Les fonctions (des plugins) appelées peuvent modifier à leur guise le contenu.
 *
 * Deux types de retours. Si `$val` est un tableau de 2 éléments, avec une clé `data`
 * on retourne uniquement ce contenu (`$val['data']`) sinon on retourne tout `$val`.
 *
 * @example
 *     Appel du pipeline `pre_insertion`
 *     ```
 *     $champs = pipeline('pre_insertion', array(
 *         'args' => array('table' => 'spip_articles'),
 *         'data' => $champs
 *     ));
 *     ```
 *
 * @param string $action
 *     Nom du pipeline
 * @param mixed $val
 *     Données à l’entrée du pipeline
 * @return mixed|null
 *     Résultat
 */
function pipeline($action, $val = null) {
	static $charger;

	// chargement initial des fonctions mises en cache, ou generation du cache
	if (!$charger) {
		if (!($ok = @is_readable($charger = _CACHE_PIPELINES))) {
			include_spip('inc/plugin');
			// generer les fichiers php precompiles
			// de chargement des plugins et des pipelines
			actualise_plugins_actifs();
			if (!($ok = @is_readable($charger))) {
				spip_logger()->info("fichier $charger pas cree");
			}
		}

		if ($ok) {
			include_once $charger;
		}
	}

	// appliquer notre fonction si elle existe
	$fonc = 'execute_pipeline_' . strtolower($action);
	if (function_exists($fonc)) {
		$val = $fonc($val);
	} else {
		// plantage ?
		spip_logger()
			->error("fonction $fonc absente : pipeline desactive");
	}

	// si le flux est une table avec 2 cle args&data
	// on ne ressort du pipe que les donnees dans 'data'
	// array_key_exists pour php 4.1.0
	if (
		is_array($val)
		&& count($val) == 2
		&& array_key_exists('data', $val)
	) {
		$val = $val['data'];
	}

	return $val;
}
