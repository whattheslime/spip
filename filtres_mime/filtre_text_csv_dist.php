<?php
/**
 * Test unitaire de la fonction filtre_text_csv_dist
 * du fichier inc/filtres.php
 *
 * genere automatiquement par TestBuilder
 * le 
 */

	$test = 'filtre_text_csv_dist';
	require '../test.inc';
	find_in_path("inc/filtres_mime.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('filtre_text_csv_dist', essais_filtre_text_csv_dist());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_filtre_text_csv_dist(){
		$essais = array (
  0 => 
  array (
    0 => '<table class="spip">
<thead><tr class=\'row_first\'><th id=\'id8549_c0\'>A</th><th id=\'id8549_c1\'>B</th><th id=\'id8549_c2\'>C</th><th id=\'id8549_c3\'>D</th><th id=\'id8549_c4\'>E</th><th id=\'id8549_c5\'>F</th></tr></thead>
<tbody>
<tr class=\'row_odd odd\'>
<td headers=\'id8549_c0\'>un</td>
<td headers=\'id8549_c1\'>tableau</td>
<td headers=\'id8549_c2\'>csv</td>
<td headers=\'id8549_c3\'>avec</td>
<td headers=\'id8549_c4\'>des</td>
<td headers=\'id8549_c5\'>valeurs</td></tr>
<tr class=\'row_even even\'>
<td headers=\'id8549_c0\'>dans chaque</td>
<td headers=\'id8549_c1\'>case</td>
<td headers=\'id8549_c2\'>et aussi une</td>
<td headers=\'id8549_c3\'>case</td>
<td headers=\'id8549_c4\'>avec</td>
<td headers=\'id8549_c5\'>des</td></tr>
<tr class=\'row_odd odd\'>
<td headers=\'id8549_c0\'>&#34;guillemets&#34;</td>
<td headers=\'id8549_c1\'>est-ce</td>
<td headers=\'id8549_c2\'>que</td>
<td headers=\'id8549_c3\'>ça</td>
<td headers=\'id8549_c4\'>marche&nbsp;?</td>
<td headers=\'id8549_c5\'></td></tr>
</tbody>
</table>',
    1 => 'A;B;C;D;E;F
un;tableau;csv;avec;des;valeurs
dans chaque;case;et aussi une;case;avec;des
"""guillemets""";est-ce;que;ça;marche ?;',
  ),
  1 => 
  array (
    0 => '<table class="spip">
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
  ),
  2 => 
  array (
    0 => '<table class="spip">
<thead><tr class=\'row_first\'><th id=\'idcc66_c0\'>A</th><th id=\'idcc66_c1\'>B</th><th id=\'idcc66_c2\'>C</th><th id=\'idcc66_c3\'>D</th><th id=\'idcc66_c4\'>E</th><th id=\'idcc66_c5\'>F</th></tr></thead>
<tbody>
<tr class=\'row_odd odd\'>
<td headers=\'idcc66_c0\'>un</td>
<td headers=\'idcc66_c1\'>tableau</td>
<td headers=\'idcc66_c2\'>csv</td>
<td headers=\'idcc66_c3\'>avec</td>
<td headers=\'idcc66_c4\'>des</td>
<td headers=\'idcc66_c5\'>valeurs</td></tr>
<tr class=\'row_even even\'>
<td headers=\'idcc66_c0\'>dans chaque</td>
<td headers=\'idcc66_c1\'>case</td>
<td headers=\'idcc66_c2\'>et aussi une</td>
<td headers=\'idcc66_c3\'>case</td>
<td headers=\'idcc66_c4\'>avec</td>
<td headers=\'idcc66_c5\'>des</td></tr>
<tr class=\'row_odd odd\'>
<td headers=\'idcc66_c0\'>&#34;guillemets&#34;</td>
<td headers=\'idcc66_c1\'>est-ce</td>
<td headers=\'idcc66_c2\'>que</td>
<td headers=\'idcc66_c3\'>√ßa</td>
<td headers=\'idcc66_c4\'>marche&nbsp;?</td>
<td headers=\'idcc66_c5\'></td></tr>
</tbody>
</table>',
    1 => '"A","B","C","D","E","F"
"un","tableau","csv","avec","des","valeurs"
"dans chaque","case","et aussi une","case","avec","des"
"""guillemets""","est-ce","que","√ßa","marche ?",',
  ),
);
		return $essais;
	}









?>