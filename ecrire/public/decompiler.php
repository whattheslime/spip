<?php

/**
 * SPIP, Système de publication pour l'internet
 *
 * Copyright © avec tendresse depuis 2001
 * Arnaud Martin, Antoine Pitrou, Philippe Rivière, Emmanuel Saint-James
 *
 * Ce programme est un logiciel libre distribué sous licence GNU/GPL.
 */

use Spip\Compilateur\Noeud\Texte;

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

// Decompilation de l'arbre de syntaxe abstraite d'un squelette SPIP

function decompiler_boucle($struct, $fmt = '', $prof = 0) {
	$nom = $struct->id_boucle;
	$preaff = decompiler_($struct->preaff, $fmt, $prof);
	$avant = decompiler_($struct->avant, $fmt, $prof);
	$apres = decompiler_($struct->apres, $fmt, $prof);
	$altern = decompiler_($struct->altern, $fmt, $prof);
	$milieu = decompiler_($struct->milieu, $fmt, $prof);
	$postaff = decompiler_($struct->postaff, $fmt, $prof);

	$type = $struct->sql_serveur ? "$struct->sql_serveur:" : '';
	$type .= ($struct->type_requete ?: $struct->type_table_optionnelle);

	if ($struct->jointures_explicites) {
		$type .= ' ' . $struct->jointures_explicites;
	}
	if ($struct->table_optionnelle) {
		$type .= '?';
	}
	// Revoir le cas de la boucle recursive

	$crit = $struct->param;
	if ($crit && !is_array($crit[0])) {
		$type = strtolower($type) . array_shift($crit);
	}
	$crit = decompiler_criteres($struct, $fmt, $prof);

	$f = 'format_boucle_' . $fmt;

	return $f($preaff, $avant, $nom, $type, $crit, $milieu, $apres, $altern, $postaff, $prof);
}

function decompiler_include($struct, $fmt = '', $prof = 0) {
	$res = [];
	foreach ($struct->param ?: [] as $couple) {
		array_shift($couple);
		foreach ($couple as $v) {
			$res[] = decompiler_($v, $fmt, $prof);
		}
	}
	$file = is_string($struct->texte) ? $struct->texte :
		decompiler_($struct->texte, $fmt, $prof);
	$f = 'format_inclure_' . $fmt;

	return $f($file, $res, $prof);
}

function decompiler_texte($struct, $fmt = '', $prof = 0) {
	$f = 'format_texte_' . $fmt;

	return strlen((string) $struct->texte) ? $f($struct->texte, $prof) : '';
}

function decompiler_polyglotte($struct, $fmt = '', $prof = 0) {
	$f = 'format_polyglotte_' . $fmt;

	return $f($struct->traductions, $prof);
}

function decompiler_idiome($struct, $fmt = '', $prof = 0) {
	$args = [];
	foreach ($struct->arg as $k => $v) {
		$args[$k] = public_decompiler($v, $fmt, $prof);
	}

	$filtres = decompiler_liste($struct->param, $fmt, $prof);

	$f = 'format_idiome_' . $fmt;

	return $f($struct->nom_champ, $struct->module, $args, $filtres, $prof);
}

function decompiler_champ($struct, $fmt = '', $prof = 0) {
	$avant = decompiler_($struct->avant, $fmt, $prof);
	$apres = decompiler_($struct->apres, $fmt, $prof);
	$args = $filtres = '';
	if ($p = $struct->param) {
		if ($p[0][0] === '') {
			$args = decompiler_liste([array_shift($p)], $fmt, $prof);
		}
		$filtres = decompiler_liste($p, $fmt, $prof);
	}
	$f = 'format_champ_' . $fmt;

	return $f($struct->nom_champ, $struct->nom_boucle, $struct->etoile, $avant, $apres, $args, $filtres, $prof);
}

function decompiler_liste($sources, $fmt = '', $prof = 0) {
	if (!is_array($sources)) {
		return '';
	}
	$f = 'format_liste_' . $fmt;
	$res = '';
	foreach ($sources as $arg) {
		if (!is_array($arg)) {
			continue; // ne devrait pas arriver.
		}
		$r = array_shift($arg);

		$args = [];
		foreach ($arg as $v) {
			// cas des arguments entoures de ' ou "
			if (
				(is_countable($v) ? count($v) : 0) == 1
				&& $v[0]->type == 'texte'
				&& strlen((string) $v[0]->apres) == 1
				&& $v[0]->apres == $v[0]->avant
			) {
				$args[] = $v[0]->avant . $v[0]->texte . $v[0]->apres;
			} else {
				$args[] = decompiler_($v, $fmt, 0 - $prof);
			}
		}
		if ($r !== '' || $args) {
			$res .= $f($r, $args, $prof);
		}
	}

	return $res;
}

// Decompilation des criteres: on triche et on deroge:
// - le phraseur fournit un bout du source en plus de la compil
// - le champ apres signale le critere {"separateur"} ou {'separateur'}
// - les champs sont implicitement etendus (crochets implicites mais interdits)
function decompiler_criteres($boucle, $fmt = '', $prof = 0) {
	$sources = $boucle->param;
	if (!is_array($sources)) {
		return '';
	}
	$res = '';
	$f = 'format_critere_' . $fmt;
	foreach ($sources as $crit) {
		if (!is_array($crit)) {
			continue;
		} // boucle recursive
		array_shift($crit);
		$args = [];
		foreach ($crit as $i => $v) {
			if (
				(is_countable($v) ? count($v) : 0) == 1
				&& $v[0]->type == 'texte'
				&& $v[0]->apres
			) {
				$args[] = [['texte', ($v[0]->apres . $v[0]->texte . $v[0]->apres)]];
			} else {
				$res2 = [];
				foreach ($v as $k => $p) {
					if (
						isset($p->type)
						&& function_exists($d = 'decompiler_' . $p->type)
					) {
						$r = $d($p, $fmt, (0 - $prof));
						$res2[] = [$p->type, $r];
					} else {
						spip_logger()->info("critere $i / $k mal forme");
					}
				}
				$args[] = $res2;
			}
		}
		$res .= $f($args);
	}

	return $res;
}

function decompiler_($liste, $fmt = '', $prof = 0) {
	if (!is_array($liste)) {
		return '';
	}
	$prof2 = ($prof < 0) ? ($prof - 1) : ($prof + 1);
	$contenu = [];
	foreach ($liste as $k => $p) {
		if (!isset($p->type)) {
			continue;
		} #??????
		$d = 'decompiler_' . $p->type;
		$next = $liste[$k + 1] ?? false;
		// Forcer le champ etendu si son source (pas les reecritures)
		// contenait des args et s'il est suivi d'espaces,
		// le champ simple les eliminant est un bug helas perenne.

		if (
			$next
			&& $next->type == 'texte'
			&& $p->type == 'champ'
			&& !$p->apres
			&& !$p->avant
			&& $p->fonctions
		) {
			$n = strlen((string) $next->texte) - strlen(ltrim((string) $next->texte));
			if ($n) {
				$champ = new Texte();
				$champ->texte = substr((string) $next->texte, 0, $n);
				$champ->ligne = $p->ligne;
				$p->apres = [$champ];
				$next->texte = substr((string) $next->texte, $n);
			}
		}
		$contenu[] = [$d($p, $fmt, $prof2), $p->type];
	}
	$f = 'format_suite_' . $fmt;

	return $f($contenu);
}

function public_decompiler($liste, $fmt = '', $prof = 0, $quoi = '') {
	if (!include_spip('public/format_' . $fmt)) {
		return "'$fmt'?";
	}
	$f = 'decompiler_' . $quoi;

	return $f($liste, $fmt, $prof);
}
