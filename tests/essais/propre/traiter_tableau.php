<?php
/**
 * Test unitaire de la fonction traiter_raccourcis
 * du fichier inc/texte.php
 *
 *
 */

namespace Spip\Core\Tests;

find_in_path("inc/texte.php", '', true);

/**
 * La fonction appelee pour chaque jeu de test
 * Nommage conventionnel : test_[[dossier1_][[dossier2_]...]]fichier
 * @param ...$args
 * @return mixed
 */
function test_propre_traiter_tableau(...$args){
	// on appelle traiter_raccourcis qui ensuite appelle traiter_tableau
	return traiter_raccourcis(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_propre_traiter_tableau(){
	$essais = [];

// trois tests un peu identiques sur <br />...
	$essais['caption seul'] = [
		['preg_match', ',<caption>\s*titre de mon tableau\s*</caption>,i', true],
		'|| titre de mon tableau||
|{{Colonne 0}} | {{Colonne 1}} | {{Colonne 2}} | {{Colonne 3}} | {{Colonne 4}} |
| {{Bourg-les-Valence}} | 10,39 | 20,14 | 46,02 | 15,99 |
| {{Valence}} | 16,25 | 23,31 | 49,21 | 13,43 |
| {{Romans}} | 14,09 | 20,54 | 67,85 | 17 |
| {{Montelimar}} | 20,15 | 26,43 | 70,21 | 16,82 |
| {{Bourg-de-Peage}} | 13,22 | 30 | 50 | 14,67 |'
	];
	$essais['caption'] = [
		['preg_match', ',<caption>\s*titre de mon tableau.*</caption>,i', true],
		'|| titre de mon tableau | resume de mon tableau ||
|{{Colonne 0}} | {{Colonne 1}} | {{Colonne 2}} | {{Colonne 3}} | {{Colonne 4}} |
| {{Bourg-les-Valence}} | 10,39 | 20,14 | 46,02 | 15,99 |
| {{Valence}} | 16,25 | 23,31 | 49,21 | 13,43 |
| {{Romans}} | 14,09 | 20,54 | 67,85 | 17 |
| {{Montelimar}} | 20,15 | 26,43 | 70,21 | 16,82 |
| {{Bourg-de-Peage}} | 13,22 | 30 | 50 | 14,67 |'
	];
	$essais['summary'] = [
		['preg_match', ',<table[^>]*aria-describedby="([^"]*)"[^>]*>.*<caption>.* id="(\\1)"[^>]*>\s*resume de mon tableau.*</caption>,is', true],
		'|| titre de mon tableau | resume de mon tableau ||
|{{Colonne 0}} | {{Colonne 1}} | {{Colonne 2}} | {{Colonne 3}} | {{Colonne 4}} |
| {{Bourg-les-Valence}} | 10,39 | 20,14 | 46,02 | 15,99 |
| {{Valence}} | 16,25 | 23,31 | 49,21 | 13,43 |
| {{Romans}} | 14,09 | 20,54 | 67,85 | 17 |
| {{Montelimar}} | 20,15 | 26,43 | 70,21 | 16,82 |
| {{Bourg-de-Peage}} | 13,22 | 30 | 50 | 14,67 |'
	];
	$essais['thead simple'] = [
		['preg_match', ',<thead>\s*<tr[^>]*>(:?<th[^>]*>.*</th>){5}\s*</tr>\s*</thead>,Uims', true],
		'|| titre de mon tableau | resume de mon tableau ||
|{{Colonne 0}} | {{Colonne 1}} | {{Colonne 2}} | {{Colonne 3}} | {{Colonne 4}} |
| {{Bourg-les-Valence}} | 10,39 | 20,14 | 46,02 | 15,99 |
| {{Valence}} | 16,25 | 23,31 | 49,21 | 13,43 |
| {{Romans}} | 14,09 | 20,54 | 67,85 | 17 |
| {{Montelimar}} | 20,15 | 26,43 | 70,21 | 16,82 |
| {{Bourg-de-Peage}} | 13,22 | 30 | 50 | 14,67 |'
	];
	$essais['thead avec une colonne vide'] = [
		['preg_match', ',<thead>\s*<tr[^>]*>(:?<th[^>]*>.*</th>){5}\s*</tr>\s*</thead>,Uims', true],
		'|| titre de mon tableau | resume de mon tableau ||
| | {{Colonne 1}} | {{Colonne 2}} | {{Colonne 3}} | {{Colonne 4}} |
| {{Bourg-les-Valence}} | 10,39 | 20,14 | 46,02 | 15,99 |
| {{Valence}} | 16,25 | 23,31 | 49,21 | 13,43 |
| {{Romans}} | 14,09 | 20,54 | 67,85 | 17 |
| {{Montelimar}} | 20,15 | 26,43 | 70,21 | 16,82 |
| {{Bourg-de-Peage}} | 13,22 | 30 | 50 | 14,67 |'
	];
	$essais['thead avec une colonne vide et un retour ligne'] = [
		['preg_match', ',<thead>\s*<tr[^>]*>(:?<th[^>]*>.*</th>){5}\s*</tr>\s*</thead>,Uims', true],
		'|| titre de mon tableau | resume de mon tableau ||
| | {{Colonne 1}} | {{Colonne 2}} | {{Colonne 3
_ avec retour ligne}} | {{Colonne 4}} |
| {{Bourg-les-Valence}} | 10,39 | 20,14 | 46,02 | 15,99 |
| {{Valence}} | 16,25 | 23,31 | 49,21 | 13,43 |
| {{Romans}} | 14,09 | 20,54 | 67,85 | 17 |
| {{Montelimar}} | 20,15 | 26,43 | 70,21 | 16,82 |
| {{Bourg-de-Peage}} | 13,22 | 30 | 50 | 14,67 |'
	];
	$essais['thead errone'] = [
		['preg_match', ',<thead>\s*<tr[^>]*>(:?<th[^>]*>.*</th>){5}\s*</tr>\s*</thead>,Uims', false],
		'|| titre de mon tableau | resume de mon tableau ||
|{{Colonne 0}} | {Colonne 1}} | {{Colonne 2}} | {{Colonne 3}} | {{Colonne 4}} |
| {{Bourg-les-Valence}} | 10,39 | 20,14 | 46,02 | 15,99 |
| {{Valence}} | 16,25 | 23,31 | 49,21 | 13,43 |
| {{Romans}} | 14,09 | 20,54 | 67,85 | 17 |
| {{Montelimar}} | 20,15 | 26,43 | 70,21 | 16,82 |
| {{Bourg-de-Peage}} | 13,22 | 30 | 50 | 14,67 |'
	];
	$essais['fusion par |<|'] = [
		['preg_match', ',colspan=.*colspan=,is', true],
		'| {{Bourg-de-Peage}} | 1-2 |<|3-4|<|'
	];
	$essais['fusion |<| avec conservation d\'URL dans un raccourci de liens'] = [
		['preg_match', ',colspan=.*->,is', true],
		'|test avec fusion dans tous les sens|<|
|test1 |[mon beau lien->http://foo.fr]|'
	];

	return $essais;
}

