<?php

/***************************************************************************\
 *  SPIP, Système de publication pour l'internet                           *
 *                                                                         *
 *  Copyright © avec tendresse depuis 2001                                 *
 *  Arnaud Martin, Antoine Pitrou, Philippe Rivière, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribué sous licence GNU/GPL.     *
 * \***************************************************************************/

namespace Spip\Texte\Collecteur;

abstract class AbstractCollecteur {
	protected static string $markPrefix = 'COLLECT';
	protected string $markId;

	public static array $listeBalisesBloc = [
		'address', 'applet', 'article', 'aside',
		'blockquote', 'button',
		'center',
		'dl', 'dt', 'dd', 'div',
		'fieldset', 'figure', 'figcaption', 'footer', 'form',
		'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'hr', 'hgroup', 'head', 'header',
		'iframe',
		'li',
		'map', 'marquee',
		'nav', 'noscript',
		'object', 'ol',
		'pre',
		'section',
		'table', 'tr', 'td', 'th', 'tbody', 'foot', 'textarea',
		'ul',
		'script', 'style'
	];

	/**
	 * Collecteur générique des occurences d'une preg dans un texte avec leurs positions et longueur
	 * @param string $texte
	 *   texte à analyser pour la collecte
	 * @param string $if_chars
	 *   caractere(s) à tester avant de tenter la preg
	 * @param string $start_with
	 *   caractere(s) par lesquels commencent l'expression recherchée (permet de démarrer la preg à la prochaine occurence de cette chaine)
	 * @param string $preg
	 *   preg utilisée pour la collecte
	 * @param int $max_items
	 *   pour limiter le nombre de preg collectée (pour la detection simple de présence par exemple)
	 * @return array
	 */
	protected static function collecteur(string $texte, string $if_chars, string $start_with, string $preg, int $max_items = 0): array {

		$collection = [];
		$pos = 0;
		while (
			(!$if_chars || str_contains($texte, $if_chars))
			&& ($next = ($start_with ? strpos($texte, $start_with, $pos) : $pos)) !== false
			&& preg_match($preg, $texte, $r, PREG_OFFSET_CAPTURE, $next)
		) {
			$found_pos = $r[0][1];
			$found_length = strlen($r[0][0]);
			$match = [
				'raw' => $r[0][0],
				'match' => array_column($r, 0),
				'pos' => $found_pos,
				'length' => $found_length
			];

			$collection[] = $match;

			if ($max_items && count($collection) === $max_items) {
				break;
			}

			$pos = $match['pos'] + $match['length'];
		}

		return $collection;
	}

	/**
	 * Sanitizer une collection d'occurences
	 */
	protected function sanitizer_collection(array $collection, string $sanitize_callback): array {
		foreach ($collection as &$c) {
			$c['raw'] = $sanitize_callback($c['raw']);
		}

		return $collection;
	}

	/**
	 * @return array
	 */
	public function collecter(string $texte, array $options = []): array {
		return [];
	}

	public function detecter($texte): bool {
		if (!empty($this->markId) && str_contains((string) $texte, $this->markId)) {
			return true;
		}
		return !empty($this->collecter($texte, ['detecter_presence' => true]));
	}

	/**
	 * Echapper les occurences de la collecte par un texte neutre du point de vue HTML
	 *
	 * @see retablir()
	 * @param string $texte
	 * @param array $options
	 *   string $sanitize_callback
	 * @return array
	 *   texte, marqueur utilise pour echapper les modeles
	 */
	public function echapper(string $texte, array $options = []): string {
		if (!function_exists('creer_uniqid')) {
			include_spip('inc/acces');
		}

		$collection = $this->collecter($texte, $options);
		if (!empty($options['sanitize_callback']) && is_callable($options['sanitize_callback'])) {
			$collection = $this->sanitizer_collection($collection, $options['sanitize_callback']);
		}

		if ($collection !== []) {
			if (empty($this->markId)) {
				// generer un marqueur qui n'existe pas dans le texte
				do {
					$this->markId = substr(md5(uniqid(static::class, 1)), 0, 7);
					$this->markId = '@|' . static::$markPrefix . $this->markId . '|';
				} while (str_contains($texte, $this->markId));
			}

			$offset_pos = 0;
			foreach ($collection as $c) {
				$rempl = $this->markId . base64_encode((string) $c['raw']) . '|@';
				$texte = substr_replace($texte, $rempl, $c['pos'] + $offset_pos, $c['length']);
				$offset_pos += strlen($rempl) - $c['length'];
			}
		}

		return $texte;
	}


	/**
	 * Retablir les occurences échappées précédemment
	 *
	 * @see echapper()
	 */
	function retablir(string $texte): string {

		if (!empty($this->markId)) {
			$lm = strlen($this->markId);
			$pos = 0;
			while (
				($p = strpos($texte, $this->markId, $pos)) !== false
				&& ($end = strpos($texte, '|@', $p + $lm))
			) {
				$base64 = substr($texte, $p + $lm, $end - ($p + $lm));
				if ($c = base64_decode($base64, true)) {
					$texte = substr_replace($texte, $c, $p, $end + 2 - $p);
					$pos = $p + strlen($c);
				}
				else {
					$pos = $end;
				}
			}
		}

		return $texte;
	}

	/**
	 * Detecter si un texte contient des balises bloc ou non
	 */
 	static public function echappementTexteContientBaliseBloc(string $texte): bool {
		static $pregBalisesBloc;

		if ($pregBalisesBloc === null) {
			$pregBalisesBloc = ',</?(' . implode('|', static::$listeBalisesBloc) . ')[>[:space:]],iS';
		}
		return (str_contains($texte, '<') && preg_match($pregBalisesBloc, $texte)) ? true : false;
	}

	/**
	 * Creer un bloc base64 correspondant a $texte ; au besoin en marquant
	 * une $source differente ;
	 * si $isBloc n'est pas fourni, le script detecte automagiquement si ce qu'on
	 * echappe est un div ou un span
	 */
	static public function echappementHtmlBase64(string $texte, string $source = '', ?bool $isBloc = null, array $attributs = []): string {

		if ($texte === '') {
			return '';
		}

		// Tester si on echappe en span ou en div
		$isBloc ??= self::echappementTexteContientBaliseBloc($texte);
		$tag = $isBloc ? 'div' : 'span';
		$atts = '';
		if (!empty($attributs)) {
			if (!function_exists('attribut_html')) {
				include_spip('inc/filtres');
			}
			foreach ($attributs as $k => $v) {
				$atts .= " $k=\"" . \attribut_html($v) . '"';
			}
		}

		// Decouper en morceaux, base64 a des probleme selon la taille de la pile
		$taille = 30000;
		$return = '';
		for ($i = 0; $i < strlen($texte); $i += $taille) {
			// Convertir en base64 et cacher dans un attribut
			// utiliser les " pour eviter le re-encodage de ' et &#8217
			$base64 = base64_encode(substr($texte, $i, $taille));
			$return .= "<$tag class=\"base64$source\" title=\"$base64\"{$atts}></$tag>";
		}

		return $return;
	}


	/**
	 * Rétablir les contenus échappés dans un texte en <(div|span) class="base64..."></(div|span)>
	 * Rq: $source sert a faire des echappements "a soi" qui ne sont pas nettoyes
	 * par propre() : exemple dans multi et dans typo()
	 *
	 * @see echappementHtmlBase64()
	 */
 	static public function retablir_depuisHtmlBase64(string $texte, string $source = '', string $filtre = ''): string {
		if (str_contains($texte, "base64$source")) {
			# spip_log(spip_htmlspecialchars($texte));  ## pour les curieux
			$max_prof = 5;
			$encore = true;
			while ($encore && str_contains($texte, 'base64' . $source) && $max_prof--) {
				$encore = false;
				foreach (['span', 'div'] as $tag) {
					$htmlTagCollecteur = new HtmlTag($tag,
						"@<{$tag}\s(class=['\"]base64{$source}['\"]\stitle=['\"]([^'\">]*)['\"][^>]*?)(/?)>\s*</{$tag}>@isS",
						''
					);
					$collection = $htmlTagCollecteur->collecter($texte);
					if (!empty($collection)) {
						$collection = array_reverse($collection);
						foreach ($collection as $c) {
							$title = $c['match'][2];
							if ($title && ($rempl = base64_decode($title, true))) {
								$encore = true;
								// recherche d'attributs supplementaires
								$at = [];
								foreach (['lang', 'dir'] as $attr) {
									if ($a = extraire_attribut($c['match'][0], $attr)) {
										$at[$attr] = $a;
									}
								}
								if ($at) {
									$rempl = "<$tag>$rempl</$tag>";
									foreach ($at as $attr => $a) {
										$rempl = inserer_attribut($rempl, $attr, $a);
									}
								}
								if ($filtre) {
									$rempl = $filtre($rempl);
								}
								$texte = substr_replace($texte, $rempl, $c['pos'], $c['length']);
							}
						}
					}
				}
			}
		}
		return $texte;
	}

	/**
	 * @param callable|null $callback_function
	 */
	public function echapper_enHtmlBase64(string $texte, string $source = '', $callback_function = null, array $callback_options = []): string {
		$collection = $this->collecter($texte);
		if (!empty($collection)) {
			$collection = array_reverse($collection);
			foreach ($collection as $c) {
				$echap = $c['raw'];
				if ($callback_function) {
					$echap = $callback_function($c, $callback_options);
				}
				$echap = self::echappementHtmlBase64($echap, $source);
				$texte = substr_replace($texte, $echap, $c['pos'], $c['length']);
			}
		}
		return $texte;
	}

}
