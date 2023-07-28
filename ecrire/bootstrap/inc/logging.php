<?php

/**
 * Enregistrement des événements
 *
 * Signature : `spip_log(message[,niveau|type|type.niveau])`
 *
 * Le niveau de log par défaut est la valeur de la constante `_LOG_INFO`
 *
 * Les différents niveaux possibles sont :
 *
 * - `_LOG_HS` : écrira 'HS' au début de la ligne logguée
 * - `_LOG_ALERTE_ROUGE` : 'ALERTE'
 * - `_LOG_CRITIQUE` :  'CRITIQUE'
 * - `_LOG_ERREUR` : 'ERREUR'
 * - `_LOG_AVERTISSEMENT` : 'WARNING'
 * - `_LOG_INFO_IMPORTANTE` : '!INFO'
 * - `_LOG_INFO` : 'info'
 * - `_LOG_DEBUG` : 'debug'
 *
 * @example
 *   ```
 *   spip_log($message)
 *   spip_log($message, 'recherche')
 *   spip_log($message, _LOG_DEBUG)
 *   spip_log($message, 'recherche.'._LOG_DEBUG)
 *   ```
 *
 * @api
 * @link https://programmer.spip.net/spip_log
 * @uses inc_log_dist()
 *
 * @param string $message
 *     Message à loger
 * @param string|int $name
 *
 *     - int indique le niveau de log, tel que `_LOG_DEBUG`
 *     - string indique le type de log
 *     - `string.int` indique les 2 éléments.
 *     Cette dernière notation est controversée mais le 3ème
 *     paramètre est planté pour cause de compatibilité ascendante.
 */
function spip_log($message = null, $name = null) {
	static $pre = [];
	static $log;
	preg_match('/^([a-z_]*)\.?(\d)?$/iS', (string)$name, $regs);
	if (!isset($regs[1]) || !$logname = $regs[1]) {
		$logname = null;
	}
	if (!isset($regs[2])) {
		$niveau = _LOG_INFO;
	}
	else {
		$niveau = intval($regs[2]);
	}

	if ($niveau <= (defined('_LOG_FILTRE_GRAVITE') ? _LOG_FILTRE_GRAVITE : _LOG_INFO_IMPORTANTE)) {
		if (!$pre) {
			$pre = [
				_LOG_HS => 'HS:',
				_LOG_ALERTE_ROUGE => 'ALERTE:',
				_LOG_CRITIQUE => 'CRITIQUE:',
				_LOG_ERREUR => 'ERREUR:',
				_LOG_AVERTISSEMENT => 'WARNING:',
				_LOG_INFO_IMPORTANTE => '!INFO:',
				_LOG_INFO => 'info:',
				_LOG_DEBUG => 'debug:'
			];
			$log = charger_fonction('log', 'inc');
		}
		if (!is_string($message)) {
			$message = print_r($message, true);
		}
		$log($pre[$niveau] . ' ' . $message, $logname);
	}
}


/**
 * Enregistrement des journaux
 *
 * @uses inc_journal_dist()
 * @param string $phrase texte du journal
 * @param array $opt Tableau d'options
 **/
function journal($phrase, $opt = []) {
	$journal = charger_fonction('journal', 'inc');
	$journal($phrase, $opt);
}
