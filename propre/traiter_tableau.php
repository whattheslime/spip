<?php

	$test = 'traiter_tableau';
	require '../test.inc';

	include_spip('inc/texte');

// trois tests un peu identiques sur <br />...
$essais['caption seul'] = array(
array('preg_match',',<caption>\s*titre de mon tableau\s*</caption>,i',true),
'|| titre de mon tableau||
|{{Colonne 0}} | {{Colonne 1}} | {{Colonne 2}} | {{Colonne 3}} | {{Colonne 4}} |
| {{Bourg-les-Valence}} | 10,39 | 20,14 | 46,02 | 15,99 |
| {{Valence}} | 16,25 | 23,31 | 49,21 | 13,43 |
| {{Romans}} | 14,09 | 20,54 | 67,85 | 17 |
| {{Montelimar}} | 20,15 | 26,43 | 70,21 | 16,82 |
| {{Bourg-de-Peage}} | 13,22 | 30 | 50 | 14,67 |'
);
$essais['caption'] = array(
array('preg_match',',<caption>\s*titre de mon tableau\s*</caption>,i',true),
'|| titre de mon tableau | resume de mon tableau ||
|{{Colonne 0}} | {{Colonne 1}} | {{Colonne 2}} | {{Colonne 3}} | {{Colonne 4}} |
| {{Bourg-les-Valence}} | 10,39 | 20,14 | 46,02 | 15,99 |
| {{Valence}} | 16,25 | 23,31 | 49,21 | 13,43 |
| {{Romans}} | 14,09 | 20,54 | 67,85 | 17 |
| {{Montelimar}} | 20,15 | 26,43 | 70,21 | 16,82 |
| {{Bourg-de-Peage}} | 13,22 | 30 | 50 | 14,67 |'
);
$essais['summary'] = array(
array('preg_match',',<table\s[^>]*summary=([\'"])\s*resume de mon tableau\s*(\\1)[^>]*>,i',true),
'|| titre de mon tableau | resume de mon tableau ||
|{{Colonne 0}} | {{Colonne 1}} | {{Colonne 2}} | {{Colonne 3}} | {{Colonne 4}} |
| {{Bourg-les-Valence}} | 10,39 | 20,14 | 46,02 | 15,99 |
| {{Valence}} | 16,25 | 23,31 | 49,21 | 13,43 |
| {{Romans}} | 14,09 | 20,54 | 67,85 | 17 |
| {{Montelimar}} | 20,15 | 26,43 | 70,21 | 16,82 |
| {{Bourg-de-Peage}} | 13,22 | 30 | 50 | 14,67 |'
);
$essais['thead simple'] = array(
array('preg_match',',<thead>\s*<tr[^>]*>(:?<th[^>]*>.*</th>){5}\s*</tr>\s*</thead>,Uims',true),
'|| titre de mon tableau | resume de mon tableau ||
|{{Colonne 0}} | {{Colonne 1}} | {{Colonne 2}} | {{Colonne 3}} | {{Colonne 4}} |
| {{Bourg-les-Valence}} | 10,39 | 20,14 | 46,02 | 15,99 |
| {{Valence}} | 16,25 | 23,31 | 49,21 | 13,43 |
| {{Romans}} | 14,09 | 20,54 | 67,85 | 17 |
| {{Montelimar}} | 20,15 | 26,43 | 70,21 | 16,82 |
| {{Bourg-de-Peage}} | 13,22 | 30 | 50 | 14,67 |'
);
$essais['thead avec une colonne vide'] = array(
array('preg_match',',<thead>\s*<tr[^>]*>(:?<th[^>]*>.*</th>){5}\s*</tr>\s*</thead>,Uims',true),
'|| titre de mon tableau | resume de mon tableau ||
| | {{Colonne 1}} | {{Colonne 2}} | {{Colonne 3}} | {{Colonne 4}} |
| {{Bourg-les-Valence}} | 10,39 | 20,14 | 46,02 | 15,99 |
| {{Valence}} | 16,25 | 23,31 | 49,21 | 13,43 |
| {{Romans}} | 14,09 | 20,54 | 67,85 | 17 |
| {{Montelimar}} | 20,15 | 26,43 | 70,21 | 16,82 |
| {{Bourg-de-Peage}} | 13,22 | 30 | 50 | 14,67 |'
);
$essais['thead avec une colonne vide et un retour ligne'] = array(
array('preg_match',',<thead>\s*<tr[^>]*>(:?<th[^>]*>.*</th>){5}\s*</tr>\s*</thead>,Uims',true),
'|| titre de mon tableau | resume de mon tableau ||
| | {{Colonne 1}} | {{Colonne 2}} | {{Colonne 3
_ avec retour ligne}} | {{Colonne 4}} |
| {{Bourg-les-Valence}} | 10,39 | 20,14 | 46,02 | 15,99 |
| {{Valence}} | 16,25 | 23,31 | 49,21 | 13,43 |
| {{Romans}} | 14,09 | 20,54 | 67,85 | 17 |
| {{Montelimar}} | 20,15 | 26,43 | 70,21 | 16,82 |
| {{Bourg-de-Peage}} | 13,22 | 30 | 50 | 14,67 |'
);
$essais['thead errone'] = array(
array('preg_match',',<thead>\s*<tr[^>]*>(:?<th[^>]*>.*</th>){5}\s*</tr>\s*</thead>,Uims',false),
'|| titre de mon tableau | resume de mon tableau ||
|{{Colonne 0}} | {Colonne 1}} | {{Colonne 2}} | {{Colonne 3}} | {{Colonne 4}} |
| {{Bourg-les-Valence}} | 10,39 | 20,14 | 46,02 | 15,99 |
| {{Valence}} | 16,25 | 23,31 | 49,21 | 13,43 |
| {{Romans}} | 14,09 | 20,54 | 67,85 | 17 |
| {{Montelimar}} | 20,15 | 26,43 | 70,21 | 16,82 |
| {{Bourg-de-Peage}} | 13,22 | 30 | 50 | 14,67 |'
);
$essais['fusion par |<|'] = array(
array('preg_match', ',colspan=.*colspan=,is',true),
'| {{Bourg-de-Peage}} | 1-2 |<|3-4|<|'
);
$essais['fusion |<| avec raccourci de liens'] = array(
array('preg_match', ',colspan=.*href=[^>;]*>,is',true),
'|autre test avec fusion dans tous les sens|<|
|test1 |[mon beau lien->http://foo.fr]|'
);


	// hop ! on y va
	$err = tester_fun('traiter_raccourcis', $essais);

	// si le tableau $err est pas vide ca va pas
	if ($err) {
		echo ('<dl>' . join('', $err) . '</dl>');
	} else {
		echo "OK";
	}

?>

