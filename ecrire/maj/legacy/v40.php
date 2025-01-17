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
 * Gestion des mises à jour de bdd de SPIP
 *
 * Mises à jour en 4.0 (avant 2021)
 *
 * À partir de 2021, les numéros d'upgrade sont de la forme YYYYMMDD00 où 00 est un incrément.
 *
 * @package SPIP\Core\SQL\Upgrade
 */
if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

// adaptation des timestamp mysql
$GLOBALS['maj'][24379] = [['maj_timestamp_mysql']];

/**
 * Mise à jour des bdd Mysql pour réparer les timestamp auto-update absents
 *
 * @uses base_lister_toutes_tables()
 * @uses _mysql_remplacements_definitions_table()
 */
function maj_timestamp_mysql($tables = null) {

	include_spip('base/dump');
	if ($tables === null) {
		$tables = base_lister_toutes_tables();
	} elseif (is_string($tables)) {
		$tables = [$tables];
	} elseif (!is_array($tables)) {
		return;
	}

	// rien a faire si base non mysql
	if (!str_starts_with((string) $GLOBALS['connexions'][0]['type'], 'mysql')) {
		return;
	}

	$trouver_table = charger_fonction('trouver_table', 'base');
	// forcer le vidage de cache
	$trouver_table('');

	foreach ($tables as $table) {
		if (time() >= _TIME_OUT) {
			return;
		}
		if ($desc = $trouver_table($table)) {
			$fields_corrected = _mysql_remplacements_definitions_table($desc['field']);
			$d = array_diff($desc['field'], $fields_corrected);
			if ($d) {
				spip_logger('maj')->info("Table $table TIMESTAMP incorrect");
				foreach ($desc['field'] as $field => $type) {
					if ($desc['field'][$field] !== $fields_corrected[$field]) {
						spip_logger('maj')->notice("Adaptation TIMESTAMP table $table");
						sql_alter("table $table change $field $field " . $fields_corrected[$field]);
						$trouver_table('');
						$new_desc = $trouver_table($table);
						spip_logger('maj')
							->notice("Apres conversion $table : " . var_export($new_desc['field'], true));
					}
				}
			}
		}
	}

	// forcer le vidage de cache
	$trouver_table('');
}
