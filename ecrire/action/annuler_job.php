<?php

/**
 * SPIP, Système de publication pour l'internet
 *
 * Copyright © avec tendresse depuis 2001
 * Arnaud Martin, Antoine Pitrou, Philippe Rivière, Emmanuel Saint-James
 *
 * Ce programme est un logiciel libre distribué sous licence GNU/GPL.
 */

/**
 * Gestion de l'action annuler_job
 *
 * @package SPIP\Core\Job
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

/**
 * Annuler un travail
 */
function action_annuler_job_dist() {
	$securiser_action = charger_fonction('securiser_action', 'inc');
	$id_job = $securiser_action();

	if (
		($id_job = (int) $id_job)
		&& autoriser('annuler', 'job', $id_job)
	) {
		job_queue_remove($id_job);
	}
}
