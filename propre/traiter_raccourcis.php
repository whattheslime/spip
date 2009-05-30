<?php

	$test = 'traiter_raccourcis';
	require '../test.inc';

	// ces tests sont prevus pour la variable de personnalisation :
	$GLOBALS['toujours_paragrapher'] = false;

	include_spip('inc/texte');

// trois tests un peu identiques sur <br />...
$essais['div'] = array(
	'<div>titi<br />toto</div><br />tata',  
	'<div>titi<br />toto</div><br />tata'
);
$essais['span'] = array(
	'<span>titi<br />toto</span><br />tata',  
	'<span>titi<br />toto</span><br />tata'
);
$essais['table'] = array(
	'<table><tr><td>titi<br />toto</td></tr></table><br />tata',  
	'<table><tr><td>titi<br />toto</td></tr></table><br />tata'
);

// melanges de \n et de <br />
$essais['\n_x1_mixte1'] = array(
	"titi\n<br />toto<br />",  
	"titi\n<br />toto<br />"
);
$essais['\n_x1_mixte2'] = array(
	"titi\n<br />\ntoto<br />",  
	"titi\n<br />\ntoto<br />"
);

// des tirets en debut de texte
$essais['tirets1'] = array(
	"&mdash;&nbsp;chose\n<br />&mdash;&nbsp;truc",
	"-- chose\n-- truc"
);
$GLOBALS['puce'] = '-';
$essais['tirets2'] = array(
	"-&nbsp;chose\n<br />-&nbsp;truc",
	"- chose\n- truc"
);
// ligne horizontale
$essais['lignehorizontale'] = array(
	"\n<hr class=\"spip\" />\n",
	"\n----\n"
);



// hop ! on y va
$err = tester_fun('traiter_raccourcis', $essais);


if (!preg_match($c = ",<p\b.*?>titi</p>\n\n<p\b.*?>toto</p>,",
$b = propre( $a = "titi\n\ntoto")))
	$err[] = htmlentities ("$a -- $b -- $c");

if (!preg_match(",<p\b.*?>titi</p>\n\n<p\b.*?>toto<br /></p>,",
propre("titi\n\n<br />toto<br />")))
	$err[] = 'erreur 2';


if (!strpos(propre("Ligne\n\n<br class=\"n\" />\n\nAutre"), '<br class="n" />'))
	$err[] = "erreur le &lt;br class='truc'> n'est pas preserve";

// si le tableau $err est pas vide ca va pas
if ($err) {
	foreach($err as $i=>$val) $err[$i] = str_replace("\n", '\n', $val);
	echo ('<dl>' . join('', $err) . '</dl>');
} else {
	echo "OK";
}

?>
