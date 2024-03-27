<?php

use Spip\Texte\Collecteur\Idiomes as CollecteurIdiomes;
use Spip\Texte\Collecteur\Liens as CollecteurLiens;
use Spip\Texte\Collecteur\Modeles as CollecteurModeles;
use Spip\Texte\Collecteur\Multis as CollecteurMultis;
use Spip\Texte\Collecteur\HtmlTag as CollecteurHtmlTag;

/***************************************************************************\
 *  SPIP, Système de publication pour l'internet                           *
 *                                                                         *
 *  Copyright © avec tendresse depuis 2001                                 *
 *  Arnaud Martin, Antoine Pitrou, Philippe Rivière, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribué sous licence GNU/GPL.     *
\***************************************************************************/

/**
 * Gestion des textes et échappements (fonctions d'usages fréquents)
 *
 * @package SPIP\Core\Texte
 **/

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}
include_spip('inc/filtres');
include_spip('inc/lang');


/**
 * Retourne une image d'une puce
 *
 * Le nom de l'image est déterminé par la globale 'puce' ou 'puce_prive'
 * ou les mêmes suffixées de '_rtl' pour ce type de langues.
 *
 * @note
 *     On initialise la puce pour éviter `find_in_path()` à chaque rencontre de `\n-`
 *     Mais attention elle depend de la direction et de X_fonctions.php, ainsi que
 *     de l'espace choisi (public/prive)
 *
 * @return string
 *     Code HTML de la puce
 **/
function definir_puce() {

	// Attention au sens, qui n'est pas defini de la meme facon dans
	// l'espace prive (spip_lang est la langue de l'interface, lang_dir
	// celle du texte) et public (spip_lang est la langue du texte)
	$dir = _DIR_RESTREINT ? lang_dir() : lang_dir($GLOBALS['spip_lang']);

	$p = 'puce' . (test_espace_prive() ? '_prive' : '');
	if ($dir == 'rtl') {
		$p .= '_rtl';
	}

	if (!isset($GLOBALS[$p])) {
		$GLOBALS[$p] = '<span class="spip-puce ' . $dir . '"><b>–</b></span>';
	}

	return $GLOBALS[$p];
}

/**
 * Preparer le markup html pour les extraits de code en ligne ou en bloc
 */
function spip_balisage_code(string $corps, bool $bloc = false, string $attributs = '', string $langage = ''): string {

	$echap = spip_htmlspecialchars($corps); // il ne faut pas passer dans entites_html, ne pas transformer les &#xxx; du code !
	$class = 'spip_code ' . ($bloc ? 'spip_code_block' : 'spip_code_inline');
	if ($attributs) {
		$attributs = ' ' . trim($attributs);
	}
	if ($langage) {
		$class .= " language-$langage";
		$attributs .= ' data-language="' . $langage . '"';
	}
	if ($bloc) {
		$html = '<div class="precode">'
		  . "<pre class=\"$class\" dir=\"ltr\" style=\"text-align: left;\"$attributs>"
		  . '<code>'
		  . $echap
		  . '</code>'
		  . '</pre>'
		  . '</div>';
	} else {
		$echap = str_replace("\t", '&nbsp; &nbsp; &nbsp; &nbsp; ', $echap);
		$echap = str_replace('  ', ' &nbsp;', $echap);
		$html = "<code class=\"$class\" dir=\"ltr\"$attributs>" . $echap . '</code>';
	}

	return $html;
}


// XHTML - Preserver les balises-bloc : on liste ici tous les elements
// dont on souhaite qu'ils provoquent un saut de paragraphe
defined('_BALISES_BLOCS') || define('_BALISES_BLOCS', implode('|', CollecteurHtmlTag::$listeBalisesBloc));
defined('_BALISES_BLOCS_REGEXP') || define('_BALISES_BLOCS_REGEXP', ',</?(' . _BALISES_BLOCS . ')[>[:space:]],iS');

/**
 * Echapper les elements perilleux en les passant en base64
 *
 * Creer un bloc base64 correspondant a $rempl ; au besoin en marquant
 * une $source differente ; le script detecte automagiquement si ce qu'on
 * echappe est un div ou un span
 *
 * @param string $rempl
 * @param string $source
 * @param bool $no_transform
 * @param string|null $mode
 * @return string
 */
function code_echappement($rempl, $source = '', $no_transform = false, $mode = null) {
	if (!is_string($rempl) || !strlen($rempl)) {
		return '';
	}

	return CollecteurHtmlTag::echappementHtmlBase64((string)$rempl, (string)$source, in_array($mode, ['div', 'span']) ? $mode === 'div' : null);
}


// Echapper les <html>...</ html>
function traiter_echap_html_dist($regs, $options = []) {
	return $regs['innerHtml'];
}

// Echapper les <pre>...</ pre>
function traiter_echap_pre_dist($regs, $options = []) {
	// echapper les <code> dans <pre>
	$pre = $regs['innerHtml'];

	// echapper les < dans <code>
	if (str_contains($pre, '<')) {
		$collecteurCode = new CollecteurHtmlTag('code');
		$collections = $collecteurCode->collecter($pre);
		$collections = array_reverse($collections);
		foreach ($collections as $c) {
			$code = $c['opening'] . spip_htmlspecialchars($c['innerHtml']) . $c['closing'];
			$pre = substr_replace($pre, $code, $c['pos'], $c['length']);
		}
	}
	return "<pre>$pre</pre>";
}

// Echapper les <code>...</ code>
function traiter_echap_code_dist($regs, $options = []) {
	$corps = $regs['innerHtml'];
	$att = $regs['attributs'];

	// ne pas mettre le <div...> s'il n'y a qu'une ligne
	if (str_contains($corps, "\n")) {
		// supprimer les sauts de ligne debut/fin
		// (mais pas les espaces => ascii art).
		$corps = preg_replace("/^[\n\r]+|[\n\r]+$/s", '', $corps);

		$echap = spip_balisage_code($corps, true, $att);
	} else {
		$echap = spip_balisage_code($corps, false, $att);
	}

	return $echap;
}

// Echapper les <cadre>...</ cadre> aka <frame>...</ frame>
function traiter_echap_cadre_dist($regs, $options = []) {
	$echap = trim(entites_html($regs['innerHtml']));
	// compter les lignes un peu plus finement qu'avec les \n
	$lignes = explode("\n", trim($echap));
	$n = 0;
	foreach ($lignes as $l) {
		$n += floor(strlen($l) / 60) + 1;
	}
	$n = max($n, 2);
	$echap = "\n<textarea readonly='readonly' cols='40' rows='$n' class='spip_cadre spip_cadre_block' dir='ltr'>$echap</textarea>";

	return $echap;
}

function traiter_echap_frame_dist($regs, $options = []) {
	return traiter_echap_cadre_dist($regs);
}

function traiter_echap_script_dist($regs, $options = []) {
	// rendre joli (et inactif) si c'est un script language=php
	if (strpos($regs['opening'], 'php')) {
		return highlight_string($regs['raw'], true);
	}

	// Cas normal : le script passe tel quel
	return $regs['raw'];
}

defined('_PROTEGE_BLOCS') || define('_PROTEGE_BLOCS', ',<(' . implode('|', CollecteurHtmlTag::$listeBalisesAProteger) . ')(\b[^>]*)?>(.*)</\1>,UimsS');

/**
 * pour $source voir commentaire infra (echappe_retour)
 *
 * @param string $letexte
 * @param string $source
 * @param bool $no_transform
 *   déprécié, cet argument ne doit plus être utilisé, utiliser directement Spip\Texte\Collecteur\HtmlTag::proteger_balisesHtml dans ce cas
 * @param ?array $html_tags
 *   le passage d'une preg au format string est déprécié
 * @param string $callback_prefix
 * @param array $callback_options
 * @return string|string[]
 */
function echappe_html(
	$letexte,
	$source = '',
	$no_transform = false,
	$html_tags = null,
	$callback_prefix = '',
	$callback_options = []
) {
	if (!is_string($letexte) || !strlen($letexte)) {
		return $letexte;
	}

	if ($no_transform !== false) {
		trigger_deprecation('spip', '5.0', 'Using "%s" arg is deprecated, use directly "%s" instead.', '$no_transform', 'Spip\Texte\Collecteur\HtmlTag::proteger_balisesHtml', __FUNCTION__);
	}

	// appels legacy avec un ''
	if (empty($html_tags)) {
		$html_tags = null;
	}

	// legacy : les appels fournissaient une preg pour repérer les balises HTML
	if ($html_tags && !is_array($html_tags)) {
		trigger_deprecation('spip', '5.0', 'Using a preg for "%s" arg is deprecated, use a tag array instead.', '$html_tags', __FUNCTION__);
		$t = explode(')', $html_tags, 2);
		$t = reset($t);
		$t = explode('(', $t, 2);
		$t = end($t);
		$html_tags = explode('|', $t);
	}

	$callbacks = [];
	if (!$no_transform) {
		$callback_secure_prefix = ($callback_options['secure_prefix'] ?? '');
		foreach ($html_tags ?: CollecteurHtmlTag::$listeBalisesAProteger as $tag) {
			if (
				function_exists($f = $callback_prefix . $callback_secure_prefix . 'traiter_echap_' . $tag)
				|| function_exists($f = $f . '_dist')
				|| $callback_secure_prefix && (
					function_exists($f = $callback_prefix . 'traiter_echap_' . $tag)
					|| function_exists($f = $f . '_dist')
				)
			) {
				$callbacks[$tag] = $f;
			}
		}
	}

	$letexte = CollecteurHtmlTag::proteger_balisesHtml($letexte, $source, $html_tags, $callbacks, $callback_options);

	if ($no_transform) {
		return $letexte;
	}

	// Echapper le php pour faire joli (ici, c'est pas pour la securite)
	// seulement si on a echappe les <script>
	// (derogatoire car on ne peut pas faire passer < ? ... ? >
	// dans une callback autonommee + la preg pour collecter est un peu spécifique
	if (in_array('script', $html_tags ?: CollecteurHtmlTag::$listeBalisesAProteger)) {
		$htmlTagCollecteur = new CollecteurHtmlTag('?', '@<[?].*($|[?]>)@UsS', '');
		$letexte = $htmlTagCollecteur->echapper_enHtmlBase64($letexte, $source, fn ($c, $o) => highlight_string($c['raw'], true));
	}

	return $letexte;
}

/**
 * Traitement final des echappements
 * Rq: $source sert a faire des echappements "a soi" qui ne sont pas nettoyes
 * par propre() : exemple dans multi et dans typo()
 *
 * @param string $letexte
 * @param string $source
 * @param string $filtre
 * @return array|mixed|string|string[]
 */
function echappe_retour($letexte, $source = '', $filtre = '') {
	if (!is_string($letexte) || !strlen($letexte)) {
		return $letexte;
	}
	return CollecteurHtmlTag::retablir_depuisHtmlBase64((string)$letexte, (string)$source, (string)$filtre);
}

// Reinserer le javascript de confiance (venant des modeles)

function echappe_retour_modeles($letexte, $interdire_scripts = false) {
	if (!is_string($letexte) || !strlen($letexte)) {
		return $letexte;
	}
	$letexte = CollecteurHtmlTag::retablir_depuisHtmlBase64((string)$letexte);

	// Dans les appels directs hors squelette, securiser aussi ici
	// c'est interdire_scripts() qui rétablit les scripts des modeles echappés avec _PROTEGE_JS_MODELES et _PROTEGE_PHP_MODELES
	if ($interdire_scripts) {
		$letexte = interdire_scripts($letexte);
	}

	return trim($letexte);
}


/**
 * Coupe un texte à une certaine longueur.
 *
 * Il essaie de ne pas couper les mots et enlève le formatage du texte.
 * Si le texte original est plus long que l’extrait coupé, alors des points
 * de suite sont ajoutés à l'extrait, tel que ` (…)`.
 *
 * @note
 *     Les points de suite ne sont pas ajoutés sur les extraits
 *     très courts.
 *
 * @filtre
 * @link https://www.spip.net/4275
 *
 * @param string $texte
 *     texte à couper
 * @param int $taille
 *     Taille de la coupe
 * @param string $suite
 *     Points de suite ajoutés.
 * @return string
 *     texte coupé
 **/
function couper($texte, $taille = 50, $suite = null) {
	if ($taille <= 0) {
		return '';
	}
	$length = spip_strlen($texte);
	if (!$length) {
		return '';
	}
	$offset = 400 + 2 * $taille;
	while (
		$offset < $length
		&& spip_strlen(preg_replace(',<(!--|\w|/)[^>]+>,Uims', '', spip_substr($texte, 0, $offset))) < $taille
	) {
		$offset *= 2;
	}
	if (
		$offset < $length
		&& ($p_tag_ouvrant = strpos($texte, '<', $offset)) !== null
	) {
		$p_tag_fermant = strpos($texte, '>', $offset);
		// prolonger la coupe jusqu'au tag fermant suivant eventuel
		if ($p_tag_fermant && ($p_tag_fermant < $p_tag_ouvrant)) {
			$offset = $p_tag_fermant + 1;
		}
	}
	// éviter de travailler sur 10ko pour extraire 150 caractères
	$texte = spip_substr($texte, 0, $offset);

	if (!function_exists('nettoyer_raccourcis_typo')) {
		include_spip('inc/lien');
	}
	$texte = nettoyer_raccourcis_typo($texte);

	// balises de sauts de ligne et paragraphe
	$texte = preg_replace('/<p( [^>]*)?' . '>/', "\r\r", $texte);
	$texte = preg_replace('/<br( [^>]*)?' . '>/', "\n", $texte);

	// on repasse les doubles \n en \r que nettoyer_raccourcis_typo() a pu modifier
	$texte = str_replace("\n\n", "\r\r", $texte);

	// supprimer les tags
	$texte = supprimer_tags($texte);
	$texte = trim(str_replace("\n", ' ', $texte));

	// tester s'il est nécessaire de couper le texte
	if (spip_strlen($texte) <= $taille) {
		$points = '';
	} else {
		// points de suite
		if (is_null($suite)) {
			$suite = (defined('_COUPER_SUITE') ? _COUPER_SUITE : '&nbsp;(…)');
		}
		$taille_suite = spip_strlen(filtrer_entites($suite));

		// couper au mot precedent (ou au début de la chaîne si c'est le premier mot)
		// on coupe avec un caractère de plus que la taille demandée afin de pouvoir
		// détecter si le dernier mot du texte coupé est complet ou non. ce caractère
		// excédentaire est ensuite supprimé par l'appel à preg_replace()
		$long = spip_substr($texte, 0, max($taille + 1 - $taille_suite, 1));
		$u = $GLOBALS['meta']['pcre_u'];
		$court = preg_replace('/(^|([^\s ])[\s ]+)([\s ]|[^\s ]+)?$/D' . $u, "\\2", $long);
		$points = $suite;

		// trop court ? ne pas faire de (…)
		if (spip_strlen($court) < max(0.75 * $taille, 2)) {
			$points = '';
			$long = spip_substr($texte, 0, $taille + 1);
			preg_match('/(^|([^\s ])[\s ]+)([\s ]|[^\s ]+)?$/D' . $u, $long, $m);
			$texte = preg_replace('/(^|([^\s ])[\s ]+)([\s ]|[^\s ]+)?$/D' . $u, "\\2", $long);
			// encore trop court ? couper au caractere
			if (spip_strlen($texte) < 0.75 * $taille) {
				$texte = spip_substr($long, 0, $taille);
			}
		} else {
			$texte = $court;
		}
	}

	// remettre les paragraphes
	$texte = preg_replace("/\r\r+/", "\n\n", $texte);

	// supprimer l'eventuelle entite finale mal coupee
	$texte = preg_replace('/&#?[a-z0-9]*$/S', '', $texte);

	return quote_amp(trim($texte)) . $points;
}


function protege_js_modeles($texte) {
	if (isset($GLOBALS['visiteur_session']) && str_contains($texte, '<')) {
		$tags = [
			'javascript' => ['tag' => 'script', 'preg' => ',<script.*?($|</script.),isS', 'c' => '_PROTEGE_JS_MODELES'],
			'php' => ['tag' => '?php', 'preg' => ',<\?php.*?($|\?' . '>),isS', 'c' => '_PROTEGE_PHP_MODELES'],
		];
		foreach ($tags as $k => $t) {
			if (stripos($texte, '<' . $t['tag']) !== false) {
				if (!defined($t['c'])) {
					include_spip('inc/acces');
					define($t['c'], creer_uniqid());
				}
				$collecteurHtmlTag = new CollecteurHtmlTag($t['tag'], $t['preg'], '');
				$texte = $collecteurHtmlTag->echapper_enHtmlBase64($texte, $k . constant($t['c']));
			}
		}
	}
	return $texte;
}


function echapper_faux_tags($letexte) {
	if (!str_contains($letexte, '<')) {
		return $letexte;
	}
	$textMatches = preg_split(',(</?[a-z!][^<>]*>),', $letexte, -1, PREG_SPLIT_DELIM_CAPTURE);

	$letexte = '';
	while (is_countable($textMatches) ? count($textMatches) : 0) {
		// un texte a echapper
		$letexte .= str_replace('<', '&lt;', array_shift($textMatches));
		// un tag html qui a servit a faite le split
		$letexte .= array_shift($textMatches);
	}

	return $letexte;
}

/**
 * Si le html contenu dans un texte ne passe pas sans transformation a travers safehtml
 * on l'echappe
 * si safehtml ne renvoie pas la meme chose on echappe les < en &lt; pour montrer le contenu brut
 *
 * @use wrap()
 *
 * @param string $texte
 * @param array $options
 *   bool strict : etre strict ou non sur la detection
 *   string wrap_suspect : si le html est suspect, on wrap l'affichage avec la balise indiquee dans cette option via la fonction wrap()
 *   string texte_source_affiche : si le html est suspect, on utilise ce texte pour l'affichage final et pas le texte utilise pour la detection
 * @param string $connect
 * @param array $env
 * @return string
 */
function echapper_html_suspect($texte, $options = [], $connect = null, $env = []) {
	static $echapper_html_suspect;
	if (!$texte || !is_string($texte)) {
		return $texte;
	}

	if (!isset($echapper_html_suspect)) {
		$echapper_html_suspect = charger_fonction('echapper_html_suspect', 'inc', true);
	}
	// si fonction personalisee, on delegue
	if ($echapper_html_suspect) {
		// on collecte le tableau d'arg minimal pour ne pas casser un appel a une fonction inc_echapper_html_suspect() selon l'ancienne signature
		$args = [$texte, $options];
		if ($connect || !empty($env)) {
			$args[] = $connect;
		}
		if (!empty($env)) {
			$args[] = $env;
		}
		return $echapper_html_suspect(...$args);
	}

	if (is_bool($options)) {
		$options = ['strict' => $options];
	}
	$strict = $options['strict'] ?? true;

	// pas de balise html ou pas d'attribut sur les balises ? c'est OK
	if (
		!str_contains($texte, '<')
		|| !str_contains($texte, '=')
	) {
		return $texte;
	}

	// dans le prive, on veut afficher tout echappé pour la moderation
	if (!isset($env['espace_prive'])) {
		// conserver le comportement historique en cas d'appel court sans env
		$env['espace_prive'] = test_espace_prive();
	}
	if (!empty($env['espace_prive']) || !empty($env['wysiwyg'])) {
		// quand c'est du texte qui passe par propre on est plus coulant tant qu'il y a pas d'attribut du type onxxx=
		// car sinon on declenche sur les modeles ou ressources
		if (
			!$strict && (!str_contains($texte, 'on') || !preg_match(",<\w+.*\bon\w+\s*=,UimsS", $texte))
		) {
			return $texte;
		}

		$collecteurModeles = new CollecteurModeles();
		$texte = $collecteurModeles->echapper($texte);
		$texte = echappe_js($texte);

		$texte_to_check = $texte;
		// si les raccourcis liens vont etre interprétés, il faut les expanser avant de vérifier que le html est safe
		// car un raccourci peut etre utilisé pour faire un lien malin
		// et un raccourci est potentiellement modifié par safehtml, ce qui fait un faux positif dans is_html_safe
		if (!empty($options['expanser_liens'])) {
			$texte_to_check = expanser_liens($texte_to_check, $connect, $env);
		}
		if (!is_html_safe($texte_to_check)) {
			$texte = $options['texte_source_affiche'] ?? $texte;
			$texte = preg_replace(",<(/?\w+\b[^>]*>),", "<tt>&lt;\\1</tt>", $texte);
			$texte = str_replace('<', '&lt;', $texte);
			$texte = str_replace('&lt;tt>', '<tt>', $texte);
			$texte = str_replace('&lt;/tt>', '</tt>', $texte);
			if (!function_exists('attribut_html')) {
				include_spip('inc/filtres');
			}
			if (!empty($options['wrap_suspect'])) {
				$texte = wrap($texte, $options['wrap_suspect']);
			}
			$texte = "<mark class='danger-js' title='" . attribut_html(_T('erreur_contenu_suspect')) . "'>⚠️</mark> " . $texte;
		}

		$texte = $collecteurModeles->retablir($texte);
	}

	// si on est là dans le public c'est le mode parano
	// on veut donc un rendu propre et secure, et virer silencieusement ce qui est dangereux
	else {
		$collecteurLiens = $collecteurModeles = null;
		if (!empty($options['expanser_liens'])) {
			$texte = expanser_liens($texte, $connect, $env);
		}
		else {
			$collecteurLiens = new CollecteurLiens();
			$texte = $collecteurLiens->echapper($texte, ['sanitize_callback' => 'safehtml']);

			$collecteurModeles = new CollecteurModeles();
			$texte = $collecteurModeles->echapper($texte);
		}
		$texte = safehtml($texte);
		if ($collecteurModeles) {
			$texte = $collecteurModeles->retablir($texte);
		}
		if ($collecteurLiens) {
			$texte = $collecteurLiens->retablir($texte);
		}
	}

	return $texte;
}


/**
 * Sécurise un texte HTML
 *
 * Échappe le code PHP et JS.
 * Applique en plus safehtml si un plugin le définit dans inc/safehtml.php
 *
 * Permet de protéger les textes issus d'une origine douteuse (forums, syndications...)
 *
 * @filtre
 * @link https://www.spip.net/4310
 *
 * @param string $t
 *      texte à sécuriser
 * @return string
 *      texte sécurisé
 **/
function safehtml($t) {
	static $safehtml;

	if (!$t || !is_string($t)) {
		return $t;
	}
	# attention safehtml nettoie deux ou trois caracteres de plus. A voir
	if (!str_contains($t, '<')) {
		return str_replace("\x00", '', $t);
	}

	$collecteurIdiomes = null;
	if (stripos($t, '<:') !== false) {
		$collecteurIdiomes = new CollecteurIdiomes();
		$t = $collecteurIdiomes->echapper($t);
	}
	$collecteurMultis = null;
	if (stripos($t, '<multi') !== false) {
		$collecteurMultis = new CollecteurMultis();
		$t = $collecteurMultis->echapper($t, ['sanitize_callback' => 'safehtml']);
	}

	if (!function_exists('interdire_scripts')) {
		include_spip('inc/texte');
	}
	$t = interdire_scripts($t); // jolifier le php
	$t = echappe_js($t);

	if (!isset($safehtml)) {
		$safehtml = charger_fonction('safehtml', 'inc', true);
	}
	if ($safehtml) {
		$t = $safehtml($t);
	}

	if ($collecteurMultis) {
		$t = $collecteurMultis->retablir($t);
	}
	if ($collecteurIdiomes) {
		$t = $collecteurIdiomes->retablir($t);
	}

	return interdire_scripts($t); // interdire le php (2 precautions)
}


/**
 * Detecter si un texte est "safe" ie non modifie significativement par safehtml()
 */
function is_html_safe(string $texte): bool {
	if ($is_html_safe = charger_fonction('is_html_safe', 'inc', true)) {
		return $is_html_safe($texte);
	}

	// simplifier les retour ligne pour etre certain de ce que l'on compare
	$texte = str_replace("\r\n", "\n", $texte);
	// safehtml reduit aussi potentiellement les &nbsp;
	$texte = str_replace('&nbsp;', ' ', $texte);
	// safehtml remplace les entités html
	if (str_contains($texte, '&') && str_contains($texte, ';')) {
		$texte = html2unicode($texte, true);
	}
	// safehtml remplace les entités numériques
	if (str_contains($texte, '&#')) {
		$texte = unicode2charset($texte);
	}

	$texte_safe = safehtml($texte);

	// on teste sur strlen car safehtml supprime le contenu dangereux
	// mais il peut aussi changer des ' en " sur les attributs html,
	// donc un test d'egalite est trop strict
	return strlen($texte_safe) === strlen($texte);
}

/**
 * Supprime les modèles d'image d'un texte
 *
 * Fonction en cas de texte extrait d'un serveur distant:
 * on ne sait pas (encore) rapatrier les documents joints
 * Sert aussi à nettoyer un texte qu'on veut mettre dans un `<a>` etc.
 *
 * @todo
 *     gérer les autres modèles ?
 *
 * @param string $letexte
 *     texte à nettoyer
 * @param string|null $message
 *     Message de remplacement pour chaque image enlevée
 * @return string
 *     texte sans les modèles d'image
 **/
function supprime_img($letexte, $message = null) {
	if ($message === null) {
		$message = '(' . _T('img_indisponible') . ')';
	}

	return preg_replace(
		',<(img|doc|emb)([0-9]+)(\|([^>]*))?' . '\s*/?' . '>,i',
		$message,
		$letexte
	);
}
