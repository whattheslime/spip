<?php
use Psr\Log\LogLevel;

/***************************************************************************\
 *  SPIP, Système de publication pour l'internet                           *
 *                                                                         *
 *  Copyright © avec tendresse depuis 2001                                 *
 *  Arnaud Martin, Antoine Pitrou, Philippe Rivière, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribué sous licence GNU/GPL.     *
\***************************************************************************/

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

/**
 * @deprecated 5.0 Utiliser spip_logger()
 */
function inc_log_dist($message, $logname = null, $logdir = null, $logsuf = null) {
	trigger_deprecation(
		'spip',
		'5.0',
		'La fonction inc_log_dist() est déprécée.' .
			' Utilisez spip_logger() à la place.'
	);
	static $pre = [
		'HS:' => LogLevel::EMERGENCY,
		'ALERTE:' => LogLevel::ALERT,
		'CRITIQUE:' => LogLevel::CRITICAL,
		'ERREUR:' => LogLevel::ERROR,
		'WARNING:' => LogLevel::WARNING,
		'!INFO:' => LogLevel::NOTICE,
		'info:' => LogLevel::INFO,
		'debug:' => LogLevel::DEBUG,
	];
	foreach ($pre as $start => $level) {
		if (str_starts_with($message, $start)) {
			spip_logger($logname)->log($level, ltrim(substr($message, strlen($start))));
			return;
		}
	}
	spip_logger($logname)->info($message);
	return;
}
