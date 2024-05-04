<?php

/**
 * SPIP, Système de publication pour l'internet
 *
 * Copyright © avec tendresse depuis 2001
 * Arnaud Martin, Antoine Pitrou, Philippe Rivière, Emmanuel Saint-James
 *
 * Ce programme est un logiciel libre distribué sous licence GNU/GPL.
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

function job_queue_block_and_watch() {
	// bloquer la queue sur ce hit
	// pour avoir coherence entre l'affichage de la liste de jobs
	// et les jobs en base en fin de hit
	define('_DEBUG_BLOCK_QUEUE', true);
	include_spip('inc/genie');
	genie_queue_watch_dist();
}

/**
 * Prévisu d'un appel à une fonction avec ses arguments
 */
function job_queue_display_call(string $function, string $args): string {
	$args = unserialize($args);
	$args = array_map(fn ($arg) => is_scalar($arg) ? $arg : get_debug_type($arg), $args);

	return sprintf('%s(%s)', $function, implode(', ', $args));
}
