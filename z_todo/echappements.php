<?php

	$test = 'echapper';
	require '../test.inc';
	include_spip('inc/texte');

// liste de codes qui doivent etre preserves par des allers-retours d'echappement
// $essai[][0] : texte original
// $essai[][1] : resultat $no_transform=false
// $essai[][2] : resultat $no_transform=true
$essais = array(
array(
	'avant<code>toto</code>apres', 
	',^avant<code[^>]*>toto</code>apres$,',
	',^avant<code>toto</code>apres$,', 
),array(
	'avant<script>toto</script>\n\napres',  
	',^avant<script>toto</script>\n\napres$,',
	',^avant<script>toto</script>\n\napres$,',
),array(
	"toto<code>titi</code>tata<br>toto<script>titi</script>tata",  
	",^toto<code[^>]*>titi</code>tata<br>toto<script>titi</script>\n\ntata$,",
	",^toto<code>titi</code>tata<br>toto<script>titi</script>tata$,",
),array(
	"avant<script language=\"JavaScript\" type=\"text/javascript\">titi</script><noscript>notiti</noscript>apres",
	",^avant<script language=\"JavaScript\" type=\"text/javascript\">titi</script>\n\n<noscript>notiti</noscript>apres$,",
	",^avant<script language=\"JavaScript\" type=\"text/javascript\">titi</script>\n\n<noscript>notiti</noscript>apres$,",
),array(
	"avant <html>toto</html> apres",
	",^avant toto apres$,",
	",^avant <html>toto</html> apres$,",
),array(
	"avant<html><div>toto</div></html>apres",
	",^avant<div>toto</div>\n\napres$,",
	",^avant<html><div>toto</div></html>apres$,",
));

// une fonction de callback qui echappe les balises contenant des guillemets
function echappe_balises_callback($matches) {
 return str_replace('"', "'", code_echappement($matches[1], 'GUILL'));
}

// hop ! on y va

// Batterie 1
foreach($essais as $i=>$e) for($no_transform=0; $no_transform<=1; $no_transform++) {
	$a = echappe_html($e[0], 'TEST', $no_transform);
	$b = echappe_retour($a, 'TEST');
	if (!preg_match($c = $e[1 + $no_transform], $b))
		$err[] = "<strong><br />Batterie 1.$no_transform #$i</strong>. Le code d'origine n'est pas pr&eacute;serv&eacute; (\$no_transform=$no_transform) :" 
			. htmlentities (" @--> $e[0] @--> $a @--> $b @--> ne vérifie pas : $c");
}

// Batterie 2
foreach($essais as $i=>$e) for($no_transform=0; $no_transform<=1; $no_transform++) {
	$a = echappe_html($e[0], 'TEST', $no_transform);
	$x = preg_replace_callback('/(<[^>]+"[^>]*>)/Ums', 'echappe_balises_callback', $a);
	$y = echappe_retour($x, 'GUILL');
	$b = echappe_retour($y, 'TEST');
	if (!preg_match($c = $e[1 + $no_transform], $b))
		$err[] = "<strong><br />Batterie 2.$no_transform #$i</strong>. Le code d'origine n'est pas pr&eacute;serv&eacute; (\$no_transform=$no_transform) :"
			. htmlentities(" @--> $e[0] @--> $a @--> $x @--> $y @--> $b @--> ne vérifie pas : $c");
}

// si le tableau $err n'est pas vide ca va pas
if ($err) { // 
	foreach($err as $i=>$val) $err[$i] = str_replace("\n", '\n', $val);
	echo ('<dl>' . str_replace(htmlentities(' @--> '), "<br />--&gt; ", join("\n", $err)) . '</dl>');
} else
	echo "OK";

?>
