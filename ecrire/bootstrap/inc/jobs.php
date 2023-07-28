<?php

/**
 * Action qui déclenche une tache de fond
 *
 * @see  queue_affichage_cron()
 * @uses cron()
 **/
function action_cron() {
	include_spip('inc/headers');
	http_response_code(204); // No Content
	header('Connection: close');
	define('_DIRECT_CRON_FORCE', true);
	cron();
}

/**
 * Exécution des tâches de fond
 *
 * @uses inc_genie_dist()
 *
 * @param array $taches
 *     Tâches forcées
 * @param array $taches_old
 *     Tâches forcées, pour compat avec ancienne syntaxe
 * @return bool
 *     True si la tache a pu être effectuée
 */
function cron($taches = [], $taches_old = []) {
	// si pas en mode cron force, laisser tomber.
	if (!defined('_DIRECT_CRON_FORCE')) {
		return false;
	}
	if (!is_array($taches)) {
		$taches = $taches_old;
	} // compat anciens appels
	// si taches a inserer en base et base inaccessible, laisser tomber
	// sinon on ne verifie pas la connexion tout de suite, car si ca se trouve
	// queue_sleep_time_to_next_job() dira qu'il n'y a rien a faire
	// et on evite d'ouvrir une connexion pour rien (utilisation de _DIRECT_CRON_FORCE dans mes_options.php)
	if ($taches && count($taches) && !spip_connect()) {
		return false;
	}
	spip_log('cron !', 'jq' . _LOG_DEBUG);
	if ($genie = charger_fonction('genie', 'inc', true)) {
		return $genie($taches);
	}

	return false;
}

/**
 * Ajout d'une tache dans la file d'attente
 *
 * @param string $function
 *     Le nom de la fonction PHP qui doit être appelée.
 * @param string $description
 *     Une description humainement compréhensible de ce que fait la tâche
 *     (essentiellement pour l’affichage dans la page de suivi de l’espace privé)
 * @param array $arguments
 *     Facultatif, vide par défaut : les arguments qui seront passés à la fonction, sous forme de tableau PHP
 * @param string $file
 *     Facultatif, vide par défaut : nom du fichier à inclure, via `include_spip($file)`
 *     exemple : `'inc/mail'` : il ne faut pas indiquer .php
 *     Si le nom finit par un '/' alors on considère que c’est un répertoire et SPIP fera un `charger_fonction($function, $file)`
 * @param bool $no_duplicate
 *     Facultatif, `false` par défaut
 *
 *     - si `true` la tâche ne sera pas ajoutée si elle existe déjà en file d’attente avec la même fonction et les mêmes arguments.
 *     - si `function_only` la tâche ne sera pas ajoutée si elle existe déjà en file d’attente avec la même fonction indépendamment de ses arguments
 * @param int $time
 *     Facultatif, `0` par défaut : indique la date sous forme de timestamp à laquelle la tâche doit être programmée.
 *     Si `0` ou une date passée, la tâche sera exécutée aussitôt que possible (en général en fin hit, en asynchrone).
 * @param int $priority
 *     Facultatif, `0` par défaut : indique un niveau de priorité entre -10 et +10.
 *     Les tâches sont exécutées par ordre de priorité décroissante, une fois leur date d’exécution passée. La priorité est surtout utilisée quand une tâche cron indique qu’elle n’a pas fini et doit être relancée : dans ce cas SPIP réduit sa priorité pour être sûr que celle tâche ne monopolise pas la file d’attente.
 * @return int
 *     Le numéro de travail ajouté ou `0` si aucun travail n’a été ajouté.
 */
function job_queue_add(
	$function,
	$description,
	$arguments = [],
	$file = '',
	$no_duplicate = false,
	$time = 0,
	$priority = 0
) {
	include_spip('inc/queue');

	return queue_add_job($function, $description, $arguments, $file, $no_duplicate, $time, $priority);
}

/**
 * Supprimer une tache de la file d'attente
 *
 * @param int $id_job
 *  id of jonb to delete
 * @return bool
 */
function job_queue_remove($id_job) {
	include_spip('inc/queue');

	return queue_remove_job($id_job);
}

/**
 * Associer une tache a un/des objets de SPIP
 *
 * @param int $id_job
 *     id of job to link
 * @param array $objets
 *     can be a simple array('objet'=>'article', 'id_objet'=>23)
 *     or an array of simple array to link multiples objet in one time
 */
function job_queue_link($id_job, $objets) {
	include_spip('inc/queue');

	return queue_link_job($id_job, $objets);
}


/**
 * Renvoyer le temps de repos restant jusqu'au prochain job
 *
 * @staticvar int $queue_next_job_time
 * @see queue_set_next_job_time()
 * @param int|bool $force
 *    Utilisée par `queue_set_next_job_time()` pour mettre à jour la valeur :
 *
 *    - si `true`, force la relecture depuis le fichier
 *    - si int, affecte la static directement avec la valeur
 * @return int|null
 *  - `0` si un job est à traiter
 *  - `null` si la queue n'est pas encore initialisée
 */
function queue_sleep_time_to_next_job($force = null) {
	static $queue_next_job_time = -1;
	if ($force === true) {
		$queue_next_job_time = -1;
	} elseif ($force) {
		$queue_next_job_time = $force;
	}

	if ($queue_next_job_time == -1) {
		if (!defined('_JQ_NEXT_JOB_TIME_FILENAME')) {
			define('_JQ_NEXT_JOB_TIME_FILENAME', _DIR_TMP . 'job_queue_next.txt');
		}
		// utiliser un cache memoire si dispo
		if (function_exists('cache_get') && defined('_MEMOIZE_MEMORY') && _MEMOIZE_MEMORY) {
			$queue_next_job_time = cache_get(_JQ_NEXT_JOB_TIME_FILENAME);
		} else {
			$queue_next_job_time = null;
			$contenu = null;
			if (lire_fichier(_JQ_NEXT_JOB_TIME_FILENAME, $contenu)) {
				$queue_next_job_time = intval($contenu);
			}
		}
	}

	if (is_null($queue_next_job_time)) {
		return null;
	}
	if (!$_SERVER['REQUEST_TIME']) {
		$_SERVER['REQUEST_TIME'] = time();
	}

	return $queue_next_job_time - $_SERVER['REQUEST_TIME'];
}
