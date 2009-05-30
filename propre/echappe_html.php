<?php

	$test = 'echappe_html';
	require '../test.inc';

	include_spip('inc/texte');

$marque = '<span class="base64" title=\'QQ==\' ></span>';

$essais['simple imbriqué'] = array(
'avant 1' . $marque . 'apres 1</code>apres 2',  
'avant 1<code class="php"> avant 2<code>le code</code>apres 1</code>apres 2'
);
$essais['complexe imbriqué'] = array(
<<<EOT
{{{code class="php"}}}
avant blah
$marque
apres blah et avant php
$marque
{{{code tout court}}}
$marque
{{{Tu vois ?}}}
Voilà , $marque</code>

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
);
$essais['unicode sans rien'] = array(
"azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-"
,
"azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-azerty小さくてもグローバルなケベックの村-"
);
$essais['sans rien'] = array(
"astuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolos"
,
"astuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolosastuce & travaux de mode rigolos"
);
$essais['code sans imbrication'] = array(
'avant 1' . $marque . 'apres 2'
,
'avant 1<code class="php"> avant 2 code le code code apres 1</code>apres 2'
);
$essais['pourriture'] = array(
<<<EOT
Le code mis en $marque ou en $marque peut lui même contenir  $marque ou $marque ...
$marque
Je voudrais présenter l'usage du plugin coloration_code qui fournit une extension à geshi : la classe "spip".
Je mets donc :
$marque
Ici présenté avec le $marque d'origine de spip

Mais si je mets le même texte dans $marque , voilà le résultat:
$marque

Voilà c'est corrigé, [->http://trac.rezo.net/trac/spip-zone/changeset/3823] , mais on s'est aperçu que le problème est le même pour le &lt;code> d'origine de spip. (voir plus bas)

En fait, l'expression régulière (regexp) utilisée par le plugin pour récupérer les morceaux de code à colorer devrait être récursive !

$marque est insuffisant.

Il faut un truc comme:
<div style="color: red;">
$marque
</div>
Les différences:
- la balise de fermeture est recherchée avec \1 , c'est à dire cadre ou code comme trouvé en début d'espression
- pour l'intérieur (le code en lui-même) on ne cherche pas seulement .* (n'importe quoi) mais (?:((?R))|.)* : le motif complet recherché , soit un &lt;code>...&lt/code> ou cadre imbriqué , ou n'importe quoi (.) . C'est une regexp récursive.
- une amélioration supplémentaire : le paramètre class peut être donné entre simple ou double apostrophes.
- le texte dans le tag après class="xxx" est capté ce qui pourra permettre des extensions futures, comme insérer des attributs supplémentaires au code html fabriqué.

Essai de code dans code (au lieu de cadre comme tout en haut)

$marque
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
);

function echappe($regs) {
	return 'A';
}
function traiter_echap_html($regs) {
	return echappe($regs);
}
function traiter_echap_code($regs) {
	return echappe($regs);
}
function traiter_echap_cadre($regs) {
	return echappe($regs);
}
function traiter_echap_frame($regs) {
	return echappe($regs);
}
function traiter_echap_script($regs) {
	return echappe($regs);
}

// hop ! on y va
	$err = tester_fun('echappe_html', $essais);

	// si le tableau $err est pas vide ca va pas
	if ($err) {
		echo ('<dl>' . join('', $err) . '</dl>');
	} else {
		echo "OK";
	}

// essai de perf simple
	$repeter = _request('repeter');
	while ($repeter--) {
		foreach ($essais as $ess) {
			extraire_attribut($ess[1], $ess[2]);
		}
	}
?>
