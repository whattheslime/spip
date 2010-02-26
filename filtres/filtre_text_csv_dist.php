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
	find_in_path("inc/filtres.php",'',true);

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
<thead><tr class=\'row_first\'><th scope=\'col\'><strong>A</strong></th><th scope=\'col\'><strong>B</strong></th><th scope=\'col\'><strong>C</strong></th><th scope=\'col\'><strong>D</strong></th><th scope=\'col\'><strong>E</strong></th><th scope=\'col\'><strong>F</strong></th></tr></thead>
<tbody>
<tr class=\'row_even\'>
<td>un</td>
<td>tableau</td>
<td>csv</td>
<td>avec</td>
<td>des</td>
<td>valeurs</td></tr>
<tr class=\'row_odd\'>
<td>dans chaque</td>
<td>case</td>
<td>et aussi une</td>
<td>case</td>
<td>avec</td>
<td>des</td></tr>
<tr class=\'row_even\'>
<td>&#34;guillemets&#34;</td>
<td>est-ce</td>
<td>que</td>
<td>ça</td>
<td>marche&nbsp;?</td>
<td></td></tr>
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
<thead><tr class=\'row_first\'><th scope=\'col\'><strong>A</strong></th><th scope=\'col\'><strong>B</strong></th><th scope=\'col\'><strong>C</strong></th><th scope=\'col\'><strong>D</strong></th><th scope=\'col\'><strong>E</strong></th><th scope=\'col\'><strong>F</strong></th></tr></thead>
<tbody>
<tr class=\'row_even\'>
<td>un</td>
<td>tableau</td>
<td>csv</td>
<td>avec</td>
<td>des</td>
<td>valeurs</td></tr>
<tr class=\'row_odd\'>
<td>dans chaque</td>
<td>case</td>
<td>et aussi une</td>
<td>case</td>
<td>avec</td>
<td>des</td></tr>
<tr class=\'row_even\'>
<td>guillemets</td>
<td>est-ce</td>
<td>que</td>
<td>ça</td>
<td>marche&nbsp;?</td>
<td></td></tr>
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
<thead><tr class=\'row_first\'><th scope=\'col\'><strong>A</strong></th><th scope=\'col\'><strong>B</strong></th><th scope=\'col\'><strong>C</strong></th><th scope=\'col\'><strong>D</strong></th><th scope=\'col\'><strong>E</strong></th><th scope=\'col\'><strong>F</strong></th></tr></thead>
<tbody>
<tr class=\'row_even\'>
<td>un</td>
<td>tableau</td>
<td>csv</td>
<td>avec</td>
<td>des</td>
<td>valeurs</td></tr>
<tr class=\'row_odd\'>
<td>dans chaque</td>
<td>case</td>
<td>et aussi une</td>
<td>case</td>
<td>avec</td>
<td>des</td></tr>
<tr class=\'row_even\'>
<td>&#34;guillemets&#34;</td>
<td>est-ce</td>
<td>que</td>
<td>√ßa</td>
<td>marche&nbsp;?</td>
<td></td></tr>
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