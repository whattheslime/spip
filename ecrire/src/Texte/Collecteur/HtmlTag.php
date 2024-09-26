<?php

/**
 * SPIP, Système de publication pour l'internet
 *
 * Copyright © avec tendresse depuis 2001
 * Arnaud Martin, Antoine Pitrou, Philippe Rivière, Emmanuel Saint-James
 *
 * Ce programme est un logiciel libre distribué sous licence GNU/GPL.
 */

namespace Spip\Texte\Collecteur;

/**
 * Collecter de balises html `<xx> ... </xx>` d'un texte
 *
 * @see extraire_balises()
 */
class HtmlTag extends AbstractCollecteur
{
	public static array $listeBalisesAProteger = ['html', 'pre', 'code', 'cadre', 'frame', 'script', 'style'];

	protected static string $markPrefix = 'HTMLTAG';

	/**
	 * La preg pour découper et collecter les modèles
	 */
	protected string $preg_openingtag;

	protected string $preg_closingtag;

	protected string $tag;

	public function __construct(string $tag, ?string $preg_openingtag = null, ?string $preg_closingtag = null) {

		$tag = strtolower($tag);
		$this->tag = $tag;
		$this->preg_openingtag = ($preg_openingtag ?: "@<{$tag}\b([^>]*?)(/?)>@isS");
		$this->preg_closingtag = ($preg_closingtag ?? "@</{$tag}\b[^>]*>@isS");
	}

	/**
	 * @param array $options
	 *   bool $detecter_presence
	 *   bool $nb_max
	 *   int  $profondeur
	 */
	public function collecter(string $texte, array $options = []): array {
		if (!$texte) {
			return [];
		}

		$upperTag = strtoupper($this->tag);
		$hasUpperCaseTags = ($upperTag !== $this->tag && (str_contains($texte, '<' . $upperTag) || str_contains(
			$texte,
			'</' . $upperTag
		)));

		// collecter les balises ouvrantes
		$opening = static::collecteur(
			$texte,
			'',
			$hasUpperCaseTags ? '<' : '<' . $this->tag,
			$this->preg_openingtag,
			empty($options['detecter_presence']) ? 0 : 1
		);
		if (!$opening) {
			return [];
		}

		// si c'est un tag autofermant ou vide qui se repère avec une seule regexp, on va plus vite
		if (!$this->preg_closingtag) {
			return $opening;
		}

		// collecter les balises fermantes
		$closing = static::collecteur($texte, '', $hasUpperCaseTags ? '</' : '</' . $this->tag, $this->preg_closingtag);

		$profondeur = ($options['profondeur'] ?? 1);
		$tags = [];
		while (!empty($opening)) {
			$first_opening = array_shift($opening);
			// self closing ?
			if (str_contains($first_opening['raw'], '/>')) {
				$tag = $first_opening;
				$tag['opening'] = $tag['raw'];
				$tag['closing'] = '';
				$tag['innerHtml'] = '';
				$tag['attributs'] = trim(substr($tag['opening'], strlen($this->tag) + 1, -2));
				$tags[] = $tag;
			} else {
				// enlever les closing qui sont avant le premier opening, car ils n'ont pas de sens
				while (
					!empty($closing)
					&& ($first_closing = reset($closing))
					&& $first_closing['pos'] < $first_opening['pos']
				) {
					array_shift($closing);
				}

				$need_closing = 0;
				$next_closing = reset($closing);
				$next_opening = reset($opening);
				// certaines balises comme <code> neutralisent le contenant, donc tout ce qui est avant le prochain closing doit etre ignoré
				if (in_array($this->tag, ['code'])) {
					while ($next_opening && $next_closing && $next_opening['pos'] < $next_closing['pos']) {
						array_shift($opening);
						$next_opening = reset($opening);
					}
				} else {
					while ($next_opening && $next_closing && $next_opening['pos'] < $next_closing['pos']) {
						while ($next_opening && $next_opening['pos'] < $next_closing['pos']) {
							// si pas self closing, il faut un closing de plus
							if (!str_contains($next_opening['raw'], '/>')) {
								$need_closing++;
							}
							array_shift($opening);
							$next_opening = reset($opening);
						}
						// il faut depiler les balises fermantes autant de fois que nécessaire et tant qu'on a pas une nouvelle balise ouvrante
						while ($need_closing && $next_closing && (!$next_opening || $next_closing['pos'] < $next_opening['pos'])) {
							array_shift($closing);
							$need_closing--;
							$next_closing = reset($closing);
						}
					}
				}
				// si pas de fermeture, c'est une autofermante mal fermée...
				if (!$next_closing || $need_closing) {
					$tag = $first_opening;
					$tag['opening'] = $tag['raw'];
					$tag['closing'] = '';
					$tag['innerHtml'] = '';
					$tag['attributs'] = trim(substr($tag['opening'], strlen($this->tag) + 1, -1));
					$tags[] = $tag;
				} else {
					$tag = $first_opening;
					$next_closing = array_shift($closing);
					$innerHtml = substr($texte, $tag['pos'] + $tag['length'], $next_closing['pos'] - $tag['pos'] - $tag['length']);
					$tag['length'] = $next_closing['pos'] - $tag['pos'] + $next_closing['length'];
					$tag['opening'] = $tag['raw'];
					$tag['raw'] = substr($texte, $tag['pos'], $tag['length']);
					$tag['innerHtml'] = $innerHtml;
					$tag['closing'] = $next_closing['raw'];
					$tag['attributs'] = trim(substr($tag['opening'], strlen($this->tag) + 1, -1));
					$tags[] = $tag;
				}
			}
			if ((!empty($options['detecter_presence']) && count($tags))) {
				return $tags;
			}
			if (($profondeur == 1 && !empty($options['nb_max']) && count($tags) >= $options['nb_max'])) {
				break;
			}
		}

		while (--$profondeur > 0) {
			$outerTags = $tags;
			$tags = [];
			$options['profondeur'] = 1;
			foreach ($outerTags as $outerTag) {
				if (!empty($outerTag['innerHtml'])) {
					$offsetPos = $outerTag['pos'] + strlen($outerTag['opening']);
					$innerTags = $this->collecter($outerTag['innerHtml'], $options);
					if (!empty($innerTags)) {
						foreach ($innerTags as $tag) {
							$tag['pos'] += $offsetPos;
							$tags[] = $tag;
						}
						if (($profondeur == 1 && !empty($options['nb_max']) && count($tags) >= $options['nb_max'])) {
							return $tags;
						}
					}
				}
			}
		}

		return $tags;
	}

	/**
	 * @param callable|null $callback_function
	 */
	public function echapper_enHtmlBase64(
		string $texte,
		string $source = '',
		$callback_function = null,
		array $callback_options = []
	): string {
		if ($callback_function) {
			$legacy_callback = $callback_function;
			// si on est dans un cas evident de preg perso, ne pas essayer de mapper le match car on ne sait pas ce qu'il contient
			// et on aura pas non plus de innerHtml si pas de preg_closingtag
			if ($this->preg_closingtag) {
				$tag = $this->tag;
				$legacy_callback = function ($c, $options) use ($tag, $callback_function) {
					// legacy : renseigner les infos correspondantes aux matchs de l'ancienne regexp
					$regs = [
						0 => $c['raw'],
						1 => $tag,
						2 => $c['match'][1] . $c['match'][2],
						3 => $c['innerHtml'],
						'tag' => $this->tag,
					] + $c;
					return $callback_function($regs, $options);
				};
			}
		}
		return parent::echapper_enHtmlBase64(
			$texte,
			$source,
			$callback_function ? $legacy_callback : null,
			$callback_options
		);
	}

	/**
	 * pour $source voir commentaire infra (echappe_retour)
	 * pour $no_transform voir le filtre post_autobr dans inc/filtres
	 */
	public static function proteger_balisesHtml(
		string $texte,
		string $source = '',
		?array $html_tags = null,
		array $callbacks_function = [],
		array $callback_options = []
	): string {
		if ($texte === '') {
			return '';
		}

		$html_tags = $html_tags ?: self::$listeBalisesAProteger;

		$tags_todo = $html_tags;
		while (
			!empty($tags_todo)
			&& ($tag = array_shift($tags_todo))
			&& str_contains($texte, '<')
		) {
			$htmlTagCollecteur = new self($tag);
			$texte = $htmlTagCollecteur->echapper_enHtmlBase64(
				$texte,
				$source,
				$callbacks_function[$tag] ?? null,
				$callback_options
			);
		}

		return $texte;
	}
}
