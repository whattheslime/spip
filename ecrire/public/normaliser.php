<?php

use Spip\Compilateur\Noeud\Champ;
use Spip\Compilateur\Noeud\Inclure;

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

function phraser_vieux_modele($p) {
 normaliser_args_inclumodel($p);
}

function phraser_vieux_inclu($p) {
 normaliser_args_inclumodel($p);
}

/**
 * Accepte la syntaxe historique {arg1=val1}{arg2=val2}... dans les INCLURE
 * au lieu de {arg1=val1,arg2=val2,...}
 *
 * @param Champ|Inclure $p
 * @return void
 */
function normaliser_args_inclumodel($p) {
	$params = $p->param;
	if (!$params) {
		return;
	}
	$args = $params[0];
	if ($args[0]) {
		return;
	} // filtre immediat
	array_shift($p->param);
	foreach ($p->param as $l) {
		if (!array_shift($l)) {
			$args = array_merge($args, $l);
			array_shift($p->param);
		} else {
			break;
		} // filtre
	}
	array_unshift($p->param, $args);
}


/**
 * Trim les arguments de <INCLURE> et repère l'argument spécial fond=
 * @param Inclure $champ
 * @return void
 */
function normaliser_inclure($champ) {
	normaliser_args_inclumodel($champ);
	$l = $champ->param[0];
	if (is_array($l) && !$l[0]) {
		foreach ($l as $k => $p) {
			if ($p && $p[0]->type == 'texte' && !strpos((string) $p[0]->texte, '=')) {
				$p[0]->texte = trim((string) $p[0]->texte);
			}
		}
		foreach ($l as $k => $p) {
			if (
				!$p || $p[0]->type != 'texte'
				|| !preg_match('/^fond\s*=\s*(.*)$/', (string) $p[0]->texte, $r)
			) {
				continue;
			}

			if ($r[1]) {
				$p[0]->texte = $r[1];
			} else {
				unset($p[0]);
			}
			$champ->texte = $p;
			unset($champ->param[0][$k]);
			if ((is_countable($champ->param[0]) ? count($champ->param[0]) : 0) == 1) {
				array_shift($champ->param);
			}

			return;
		}
	}
	spip_logger('vieilles_def')->info('inclure sans fond ni fichier');
}
