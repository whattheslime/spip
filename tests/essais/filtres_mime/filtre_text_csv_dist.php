<?php
/**
 * Test unitaire de la fonction filtre_text_csv_dist
 * du fichier inc/filtres_mime.php
 *
 */
namespace Spip\Core\Tests;

find_in_path("inc/filtres_mime.php",'',true);

function pretest_filtres_mime_filtre_text_csv_dist(){
	changer_langue('fr'); // ce test est en fr
}
/**
 * La fonction appelee pour chaque jeu de test
 * Nommage conventionnel : test_[[dossier1_][[dossier2_]...]]fichier
 * @param ...$args
 * @return mixed
 */
function test_filtres_mime_filtre_text_csv_dist(...$args) {
	return filtre_text_csv_dist(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_filtres_mime_filtre_text_csv_dist(){
		$essais =  [
  0 => 
   [
    0 => '<table class="table spip">
<thead><tr class=\'row_first\'><th id=\'id9b86_c0\'>A</th><th id=\'id9b86_c1\'>B</th><th id=\'id9b86_c2\'>C</th><th id=\'id9b86_c3\'>D</th><th id=\'id9b86_c4\'>E</th><th id=\'id9b86_c5\'>F</th></tr></thead>
<tbody>
<tr class=\'row_odd odd\'>
<td headers=\'id9b86_c0\'>un</td>
<td headers=\'id9b86_c1\'>tableau</td>
<td headers=\'id9b86_c2\'>csv</td>
<td headers=\'id9b86_c3\'>avec</td>
<td headers=\'id9b86_c4\'>des</td>
<td headers=\'id9b86_c5\'>valeurs</td></tr>
<tr class=\'row_even even\'>
<td headers=\'id9b86_c0\'>dans chaque</td>
<td headers=\'id9b86_c1\'>case</td>
<td headers=\'id9b86_c2\'>et aussi une</td>
<td headers=\'id9b86_c3\'>case</td>
<td headers=\'id9b86_c4\'>avec</td>
<td headers=\'id9b86_c5\'>des</td></tr>
<tr class=\'row_odd odd\'>
<td headers=\'id9b86_c0\'>"guillemets"</td>
<td headers=\'id9b86_c1\'>est-ce</td>
<td headers=\'id9b86_c2\'>que</td>
<td headers=\'id9b86_c3\'>ça</td>
<td headers=\'id9b86_c4\'>marche&nbsp;?</td>
<td headers=\'id9b86_c5\'></td></tr>
</tbody>
</table>',
    1 => 'A;B;C;D;E;F
un;tableau;csv;avec;des;valeurs
dans chaque;case;et aussi une;case;avec;des
"""guillemets""";est-ce;que;ça;marche ?;',
  ],
  1 => 
   [
    0 => '<table class="table spip">
<thead><tr class=\'row_first\'><th id=\'id5b64_c0\'>A</th><th id=\'id5b64_c1\'>B</th><th id=\'id5b64_c2\'>C</th><th id=\'id5b64_c3\'>D</th><th id=\'id5b64_c4\'>E</th><th id=\'id5b64_c5\'>F</th></tr></thead>
<tbody>
<tr class=\'row_odd odd\'>
<td headers=\'id5b64_c0\'>un</td>
<td headers=\'id5b64_c1\'>tableau</td>
<td headers=\'id5b64_c2\'>csv</td>
<td headers=\'id5b64_c3\'>avec</td>
<td headers=\'id5b64_c4\'>des</td>
<td headers=\'id5b64_c5\'>valeurs</td></tr>
<tr class=\'row_even even\'>
<td headers=\'id5b64_c0\'>dans chaque</td>
<td headers=\'id5b64_c1\'>case</td>
<td headers=\'id5b64_c2\'>et aussi une</td>
<td headers=\'id5b64_c3\'>case</td>
<td headers=\'id5b64_c4\'>avec</td>
<td headers=\'id5b64_c5\'>des</td></tr>
<tr class=\'row_odd odd\'>
<td headers=\'id5b64_c0\'>guillemets</td>
<td headers=\'id5b64_c1\'>est-ce</td>
<td headers=\'id5b64_c2\'>que</td>
<td headers=\'id5b64_c3\'>ça</td>
<td headers=\'id5b64_c4\'>marche&nbsp;?</td>
<td headers=\'id5b64_c5\'></td></tr>
</tbody>
</table>',
    1 => 'A;B;C;D;E;F
un;tableau;csv;avec;des;valeurs
dans chaque;case;et aussi une;case;avec;des
guillemets;est-ce;que;ça;marche ?;',
  ],
  2 => 
   [
    0 => '<table class="table spip">
<thead><tr class=\'row_first\'><th id=\'idee6c_c0\'>A</th><th id=\'idee6c_c1\'>B</th><th id=\'idee6c_c2\'>C</th><th id=\'idee6c_c3\'>D</th><th id=\'idee6c_c4\'>E</th><th id=\'idee6c_c5\'>F</th></tr></thead>
<tbody>
<tr class=\'row_odd odd\'>
<td headers=\'idee6c_c0\'>un</td>
<td headers=\'idee6c_c1\'>tableau</td>
<td headers=\'idee6c_c2\'>csv</td>
<td headers=\'idee6c_c3\'>avec</td>
<td headers=\'idee6c_c4\'>des</td>
<td headers=\'idee6c_c5\'>valeurs</td></tr>
<tr class=\'row_even even\'>
<td headers=\'idee6c_c0\'>dans chaque</td>
<td headers=\'idee6c_c1\'>case</td>
<td headers=\'idee6c_c2\'>et aussi une</td>
<td headers=\'idee6c_c3\'>case</td>
<td headers=\'idee6c_c4\'>avec</td>
<td headers=\'idee6c_c5\'>des</td></tr>
<tr class=\'row_odd odd\'>
<td headers=\'idee6c_c0\'>"guillemets"</td>
<td headers=\'idee6c_c1\'>est-ce</td>
<td headers=\'idee6c_c2\'>que</td>
<td headers=\'idee6c_c3\'>√ßa</td>
<td headers=\'idee6c_c4\'>marche&nbsp;?</td>
<td headers=\'idee6c_c5\'></td></tr>
</tbody>
</table>',
    1 => '"A","B","C","D","E","F"
"un","tableau","csv","avec","des","valeurs"
"dans chaque","case","et aussi une","case","avec","des"
"""guillemets""","est-ce","que","√ßa","marche ?",',
  ],
];
		return $essais;
	}

