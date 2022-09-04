<?php
/**
 * Test unitaire de la fonction echappe_html
 * du fichier inc/texte.php
 *
 *
 */

namespace Spip\Core\Tests;

function test_propre_echappe_html_echappe($regs) {
	return 'A';
}

function test_propre_echappe_html_traiter_echap_html($regs) {
	return test_propre_echappe_html_echappe($regs);
}

function test_propre_echappe_html_traiter_echap_code($regs) {
	return test_propre_echappe_html_echappe($regs);
}

function test_propre_echappe_html_traiter_echap_cadre($regs) {
	return test_propre_echappe_html_echappe($regs);
}

function test_propre_echappe_html_traiter_echap_frame($regs) {
	return test_propre_echappe_html_echappe($regs);
}

function test_propre_echappe_html_traiter_echap_script($regs) {
	return test_propre_echappe_html_echappe($regs);
}


find_in_path("inc/texte.php", '', true);


/**
 * La fonction appelee pour chaque jeu de test
 * Nommage conventionnel : test_[[dossier1_][[dossier2_]...]]fichier
 * @param ...$args
 * @return mixed
 */
function test_propre_echappe_html(...$args){
	return echappe_html($args[0], $args[1] ?? '', $args[2] ?? false, $args[3] ?? '', 'Spip\\Core\\Tests\\test_propre_echappe_html_');
}

/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_propre_echappe_html(){
	$essais = [];

	$marque = '<span class="base64" title="QQ=="></span>';

	$essais['simple imbriqué'] = [
		'avant 1' . $marque . 'apres 1</code>apres 2',
		'avant 1<code class="php"> avant 2<code>le code</code>apres 1</code>apres 2'
	];
	$essais['complexe imbriqué'] = [
			<<<EOT
{{{code class="php"}}}
avant blah
{$marque}
apres blah et avant php
{$marque}
{{{code tout court}}}
{$marque}
{{{Tu vois ?}}}
Voilà , {$marque}</code>

On peut croire que c'est embétant , faut mettre une div autour pour encadrer , mais cela permet d'orienter geshi en cours de route comme dans [Compte à rebours (revisited)->article6]
EOT
		,
			<<<EOT
{{{code class="php"}}}
avant blah
<code class="blah">
blah in
balh 2
</code>
apres blah et avant php
<code class="php telecharge">
<?php
function uncomment(\$source) {
	return preg_replace(
		'#(?:/\*(?:(?R)|.)*\*/|//.*$)|(([\'"])(?:.*)(?<!\\\\)\2|([^\'"/]+))#msU',
		"$1", \$source);
}
?>
</code>
{{{code tout court}}}
<code>
<?php
function uncomment(\$source) {
	return preg_replace(
		'#(?:/\*(?:(?R)|.)*\*/|//.*$)|(([\'"])(?:.*)(?<!\\\\)\2|([^\'"/]+))#msU',
		"$1", \$source);
}
?>
</code>
{{{Tu vois ?}}}
Voilà , <code><code class="xxx">insere tout avec des <br /> , pas de <div class="spip_code"></code></code>

On peut croire que c'est embétant , faut mettre une div autour pour encadrer , mais cela permet d'orienter geshi en cours de route comme dans [Compte à rebours (revisited)->article6]
EOT
	];
	$essais['unicode sans rien'] = [
		"azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-"
	,
		"azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-"
	];
	$essais['sans rien'] = [
		"astuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolos"
	,
		"astuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolos"
	];
	$essais['code sans imbrication'] = [
		'avant 1' . $marque . 'apres 2'
	,
		'avant 1<code class="php"> avant 2 code le code code apres 1</code>apres 2'
	];
	$essais['pourriture'] = [
<<<EOT
Le code mis en {$marque} ou en {$marque} peut lui même contenir  {$marque} ou {$marque} ...
{$marque}
Je voudrais présenter l'usage du plugin coloration_code qui fournit une extension à geshi : la classe "spip".
Je mets donc :
{$marque}
Ici présenté avec le {$marque} d'origine de spip

Mais si je mets le même texte dans {$marque} , voilà le résultat:
{$marque}

Voilà c'est corrigé, [->http://trac.rezo.net/trac/spip-zone/changeset/3823] , mais on s'est aperçu que le problème est le même pour le &lt;code> d'origine de spip. (voir plus bas)

En fait, l'expression régulière (regexp) utilisée par le plugin pour récupérer les morceaux de code à colorer devrait être récursive !

{$marque} est insuffisant.

Il faut un truc comme:
<div style="color: red;">
{$marque}
</div>
Les différences:
- la balise de fermeture est recherchée avec \1 , c'est à dire cadre ou code comme trouvé en début d'espression
- pour l'intérieur (le code en lui-même) on ne cherche pas seulement .* (n'importe quoi) mais (?:((?R))|.)* : le motif complet recherché , soit un &lt;code>...&lt/code> ou cadre imbriqué , ou n'importe quoi (.) . C'est une regexp récursive.
- une amélioration supplémentaire : le paramètre class peut être donné entre simple ou double apostrophes.
- le texte dans le tag après class="xxx" est capté ce qui pourra permettre des extensions futures, comme insérer des attributs supplémentaires au code html fabriqué.

Essai de code dans code (au lieu de cadre comme tout en haut)

{$marque}
et le tour est joué
</code>

Donc comme l'ancien coloration_code, le  &lt;/code> est mangé et "et le tour est joué" apparait hors-code.
EOT
	,
<<<EOT
Le code mis en <code><code></code> ou en <code><cadre></code> peut lui même contenir  <code><code></code> ou <code><cadre></code> ...
<code class="xxx">
ça 'xiste pô
</code>
Je voudrais présenter l'usage du plugin coloration_code qui fournit une extension à geshi : la classe "spip".
Je mets donc :
<cadre>
Pour insérer du code coloré, il suffit de rajouter {class="xxx"} au tag code de spip:
<code class="php">
// mon morceau de php
\$variable = "blah";
// ...
</code>
et le tour est joué
</cadre>
Ici présenté avec le <code><cadre></code> d'origine de spip

Mais si je mets le même texte dans <code><cadre class="spip"></code> , voilà le résultat:
<cadre class="spip">
Pour insérer du code coloré, il suffit de rajouter {class="xxx"} au tag code de spip:
<code class="php">
// mon morceau de php
\$variable = "blah";
// ...
</code>
et le tour est joué
</cadre>

Voilà c'est corrigé, [->http://trac.rezo.net/trac/spip-zone/changeset/3823] , mais on s'est aperçu que le problème est le même pour le &lt;code> d'origine de spip. (voir plus bas)

En fait, l'expression régulière (regexp) utilisée par le plugin pour récupérer les morceaux de code à colorer devrait être récursive !

<code>
',<(cadre|code)[[:space:]]+class="(.*)"[[:space:]]*>(.*)</(cadre|code)>,Uims'
</code> est insuffisant.

Il faut un truc comme:
<div style="color: red;">
<code>
',<(cadre|code)[[:space:]]+class=("|\')(.*)\2([^>])*>((?:((?R))|.)*)</\1>,Uims'
</code>
</div>
Les différences:
- la balise de fermeture est recherchée avec \1 , c'est à dire cadre ou code comme trouvé en début d'espression
- pour l'intérieur (le code en lui-même) on ne cherche pas seulement .* (n'importe quoi) mais (?:((?R))|.)* : le motif complet recherché , soit un &lt;code>...&lt/code> ou cadre imbriqué , ou n'importe quoi (.) . C'est une regexp récursive.
- une amélioration supplémentaire : le paramètre class peut être donné entre simple ou double apostrophes.
- le texte dans le tag après class="xxx" est capté ce qui pourra permettre des extensions futures, comme insérer des attributs supplémentaires au code html fabriqué.

Essai de code dans code (au lieu de cadre comme tout en haut)

<code>
Pour insérer du code coloré, il suffit de rajouter {class="xxx"} au tag code de spip:
<code class="php">
// mon morceau de php
\$variable = "blah";
// ...
</code>
et le tour est joué
</code>

Donc comme l'ancien coloration_code, le  &lt;/code> est mangé et "et le tour est joué" apparait hors-code.
EOT
	];
	return $essais;
}
