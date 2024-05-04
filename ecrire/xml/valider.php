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

/**
 * Validateur XML en deux passes, fondé sur SAX pour la première
 *
 * @note
 *     Faudrait faire deux classes car pour la première passe
 *     on a les memes methodes et variables que l'indenteur
 */
class ValidateurXML
{
	public function validerElement($phraseur, $name, $attrs) {
		if (!($p = isset($this->dtc->elements[$name]))) {
			if ($p = strpos((string) $name, ':')) {
				$name = substr((string) $name, $p + 1);
				$p = isset($this->dtc->elements[$name]);
			}
			if (!$p) {
				coordonnees_erreur($this, " <b>$name</b>&nbsp;: "
					. _T('zxml_inconnu_balise'));

				return;
			}
		}
		// controler les filles illegitimes, ca suffit
		$depth = $this->depth;
		$ouvrant = $this->ouvrant;
		#spip_logger()->info("trouve $name apres " . $ouvrant[$depth]);
		if (isset($ouvrant[$depth]) && preg_match('/^\s*(\w+)/', (string) $ouvrant[$depth], $r)) {
			$pere = $r[1];
			#spip_logger()->info("pere $pere");
			if (isset($this->dtc->elements[$pere])) {
				$fils = $this->dtc->elements[$pere];
				#spip_logger()->info("rejeton $name fils " . @join(',',$fils));
				if (!($p = @in_array($name, $fils)) && ($p = strpos((string) $name, ':'))) {
					$p = substr((string) $name, $p + 1);
					$p = @in_array($p, $fils);
				}
				if (!$p) {
					$bons_peres = @implode('</b>, <b>', $this->dtc->peres[$name]);
					coordonnees_erreur($this, " <b>$name</b> "
						. _T('zxml_non_fils')
						. ' <b>'
						. $pere
						. '</b>'
						. ($bons_peres ? '<p style="font-size: 80%"> ' . _T('zxml_mais_de') . ' <b>' . $bons_peres . '</b></p>' : ''));
				} elseif ($this->dtc->regles[$pere][0] == '/') {
					$frat = substr((string) $depth, 2);
					if (!isset($this->fratrie[$frat])) {
						$this->fratrie[$frat] = '';
					}
					$this->fratrie[$frat] .= "$name ";
				}
			}
		}
		// Init de la suite des balises a memoriser si regle difficile
		if ($this->dtc->regles[$name] && $this->dtc->regles[$name][0] == '/') {
			$this->fratrie[$depth] = '';
		}
		if (isset($this->dtc->attributs[$name])) {
			foreach ($this->dtc->attributs[$name] as $n => $v) {
				if ($v[1] == '#REQUIRED' && !isset($attrs[$n])) {
					coordonnees_erreur($this, " <b>$n</b>"
						. '&nbsp;:&nbsp;'
						. _T('zxml_obligatoire_attribut')
						. " <b>$name</b>");
				}
			}
		}
	}

	public function validerAttribut($phraseur, $name, $val, $bal) {
		// Si la balise est inconnue, eviter d'insister
		if (!isset($this->dtc->attributs[$bal])) {
			return;
		}

		$a = $this->dtc->attributs[$bal];
		if (!isset($a[$name])) {
			$bons = implode(', ', array_keys($a));
			if ($bons) {
				$bons = " title=' " .
					_T('zxml_connus_attributs') .
					'&nbsp;: ' .
					$bons .
					"'";
			}
			$bons .= " style='font-weight: bold'";
			coordonnees_erreur($this, " <b>$name</b> "
				. _T('zxml_inconnu_attribut') . ' ' . _T('zxml_de')
				. " <a$bons>$bal</a> ("
				. _T('zxml_survoler')
				. ')');
		} else {
			$type = $a[$name][0];
			if (!preg_match('/^\w+$/', (string) $type)) {
				$this->valider_motif($phraseur, $name, $val, $bal, $type);
			} else {
				if (method_exists($this, $f = 'validerAttribut_' . $type)) {
					$this->$f($phraseur, $name, $val, $bal);
				}
			}
			#		else spip_logger()->info("$type type d'attribut inconnu");
		}
	}

	public function validerAttribut_NMTOKEN($phraseur, $name, $val, $bal) {
		$this->valider_motif($phraseur, $name, $val, $bal, _REGEXP_NMTOKEN);
	}

	public function validerAttribut_NMTOKENS($phraseur, $name, $val, $bal) {
		$this->valider_motif($phraseur, $name, $val, $bal, _REGEXP_NMTOKENS);
	}

	public function validerAttribut_ID($phraseur, $name, $val, $bal) {
		if (isset($this->ids[$val])) {
			[$l, $c] = $this->ids[$val];
			coordonnees_erreur($this, " <p><b>$val</b> "
				. _T('zxml_valeur_attribut')
				. " <b>$name</b> "
				. _T('zxml_de')
				. " <b>$bal</b> "
				. _T('zxml_vu')
				. " (L$l,C$c)");
		} else {
			$this->valider_motif($phraseur, $name, $val, $bal, _REGEXP_ID);
			$this->ids[$val] = [xml_get_current_line_number($phraseur), xml_get_current_column_number($phraseur)];
		}
	}

	public function validerAttribut_IDREF($phraseur, $name, $val, $bal) {
		$this->idrefs[] = [$val, xml_get_current_line_number($phraseur), xml_get_current_column_number($phraseur)];
	}

	public function validerAttribut_IDREFS($phraseur, $name, $val, $bal) {
		$this->idrefss[] = [$val, xml_get_current_line_number($phraseur), xml_get_current_column_number($phraseur)];
	}

	public function valider_motif($phraseur, $name, $val, $bal, $motif) {
		if (!preg_match($motif, (string) $val)) {
			coordonnees_erreur($this, "<b>$val</b> "
				. _T('zxml_valeur_attribut')
				. " <b>$name</b> "
				. _T('zxml_de')
				. " <b>$bal</b> "
				. _T('zxml_non_conforme')
				. '</p><p>'
				. '<b>' . $motif . '</b>');
		}
	}

	public function valider_idref($nom, $ligne, $col) {
		if (!isset($this->ids[$nom])) {
			$this->err[] = [" <p><b>$nom</b> " . _T('zxml_inconnu_id'), $ligne, $col];
		}
	}

	public function valider_passe2() {
		if (!$this->err) {
			foreach ($this->idrefs as $idref) {
				[$nom, $ligne, $col] = $idref;
				$this->valider_idref($nom, $ligne, $col);
			}
			foreach ($this->idrefss as $idref) {
				[$noms, $ligne, $col] = $idref;
				foreach (preg_split('/\s+/', (string) $noms) as $nom) {
					$this->valider_idref($nom, $ligne, $col);
				}
			}
		}
	}

	public function debutElement($phraseur, $name, $attrs) {
		if ($this->dtc->elements) {
			$this->validerElement($phraseur, $name, $attrs);
		}

		if ($f = $this->process['debut']) {
			$f($this, $name, $attrs);
		}
		$depth = $this->depth;
		$this->debuts[$depth] = strlen((string) $this->res);
		foreach ($attrs as $k => $v) {
			$this->validerAttribut($phraseur, $k, $v, $name);
		}
	}

	public function finElement($phraseur, $name) {
		$depth = $this->depth;
		$contenu = $this->contenu;

		$n = strlen((string) $this->res);
		$c = strlen(trim((string) $contenu[$depth]));
		$k = $this->debuts[$depth];

		$regle = $this->dtc->regles[$name] ?? false;
		$vide = ($regle == 'EMPTY');
		// controler que les balises devant etre vides le sont
		if ($vide) {
			if ($n != $k + $c) {
				coordonnees_erreur($this, " <p><b>$name</b> " . _T('zxml_nonvide_balise'));
			}
			// pour les regles PCDATA ou iteration de disjonction, tout est fait
		} elseif ($regle && $regle != '*') {
			if ($regle == '+') {
				// iteration de disjonction non vide: 1 balise au -
				if ($n == $k) {
					coordonnees_erreur($this, "<p>\n<b>$name</b> "
						. _T('zxml_vide_balise'));
				}
			} else {
				$f = $this->fratrie[substr((string) $depth, 2)] ?? null;
				if (is_null($f) || !preg_match($regle, (string) $f)) {
					coordonnees_erreur(
						$this,
						" <p>\n<b>$name</b> "
						. _T('zxml_succession_fils_incorrecte')
						. '&nbsp;: <b>'
						. $f
						. '</b>'
					);
				}
			}
		}
		if ($f = $this->process['fin']) {
			$f($this, $name, $vide);
		}
	}

	public function textElement($phraseur, $data) {
		if (trim((string) $data)) {
			$d = $this->depth;
			$d = $this->ouvrant[$d];
			preg_match('/^\s*(\S+)/', (string) $d, $m);
			if (isset($this->dtc->pcdata[$m[1]]) && $this->dtc->pcdata[$m[1]]) {
				coordonnees_erreur($this, ' <p><b>' . $m[1] . '</b> '
					. _T('zxml_nonvide_balise')); // message a affiner
			}
		}
		if ($f = $this->process['text']) {
			$f($this, $data);
		}
	}

	public function piElement($phraseur, $target, $data) {
		if ($f = $this->process['pi']) {
			$f($this, $target, $data);
		}
	}

	// Denonciation des entitees XML inconnues
	// Pour contourner le bug de conception de SAX qui ne signale pas si elles
	// sont dans un attribut, les  entites les plus frequentes ont ete
	// transcodees au prealable  (sauf & < > " que SAX traite correctement).
	// On ne les verra donc pas passer a cette etape, contrairement a ce que
	// le source de la page laisse legitimement supposer.

	public function defaultElement($phraseur, $data) {
		if (
			!preg_match('/^<!--/', (string) $data)
			&& preg_match_all('/&([^;]*)?/', (string) $data, $r, PREG_SET_ORDER)
		) {
			foreach ($r as $m) {
				[$t, $e] = $m;
				if (!isset($this->dtc->entites[$e])) {
					coordonnees_erreur($this, " <b>$e</b> "
						. _T('zxml_inconnu_entite')
						. ' ');
				}
			}
		}
		if (isset($this->process['default']) && ($f = $this->process['default'])) {
			$f($this, $data);
		}
	}

	public function phraserTout($phraseur, $data) {
		xml_parsestring($this, $data);

		if (!$this->dtc || preg_match(',^' . _MESSAGE_DOCTYPE . ',', (string) $data)) {
			$this->err[] = ['DOCTYPE ?', 0, 0];
		} else {
			$this->valider_passe2();
		}
	}

	/**
	 * Constructeur
	 *
	 * @param array $process ?
	 */
	public function __construct($process = []) {
		if (is_array($process)) {
			$this->process = $process;
		}
	}

	public $ids = [];
	public $idrefs = [];
	public $idrefss = [];
	public $debuts = [];
	public $fratrie = [];

	public $dtc = null;
	public $sax = null;
	public $depth = '';
	public $entete = '';
	public $page = '';
	public $res = '';
	public array $err = [];
	public array $contenu = [];
	public array $versions = [];

	public array $ouvrant = [];
	public array $reperes = [];
	public array $process = [
		'debut' => 'xml_debutElement',
		'fin' => 'xml_finElement',
		'text' => 'xml_textElement',
		'pi' => 'xml_piElement',
		'default' => 'xml_defaultElement'
	];
}


/**
 * Retourne une structure ValidateurXML, dont le champ "err" est un tableau
 * ayant comme entrees des sous-tableaux [message, ligne, colonne]
 *
 */
function xml_valider_dist($page, $apply = false, $process = false, $doctype = '', $charset = null) {
	$f = new ValidateurXML($process);
	$sax = charger_fonction('sax', 'xml');

	return $sax($page, $apply, $f, $doctype, $charset);
}
