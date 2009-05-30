<?php

	(isset($test) && $test) || ($test = 'suivre_liens');
	require '../test.inc';
	include_spip('inc/filtres');

		# source   # lien    # resultat
$tests = array(
array(
	suivre_lien('http://toto/', 'http://tata/'), 'http://tata/'
),
array(
	suivre_lien('http://toto/', 'tata'), 'http://toto/tata'
),
array(
	suivre_lien('http://toto/ad?hic', '?hoc'), 'http://toto/?hoc'
),
array(
	suivre_lien('http://toto/./', '#hup'), 'http://toto/#hup'
),
array(
	suivre_lien('http://toto/fleche/de/tout', '/bois/'), 'http://toto/bois/'
),
array(
	suivre_lien('http://toto/du/lac#1', 'yop'), 'http://toto/du/yop'
),
array(
	suivre_lien('http://toto/', 'http://tata/'), 'http://tata/'
),
array(
	suivre_lien('http://toto/allo', '#3'), 'http://toto/allo#3'
),
array(
	suivre_lien('http://toto/', 'http://tata/./'), 'http://tata/'
),
array(
	suivre_lien('http://toto/et#lui', ''), 'http://toto/et#lui'
),
array(
	suivre_lien('http://toto', './'), 'http://toto/'
),
array(
	suivre_lien('http://toto/hop/a', './'), 'http://toto/hop/'
)
);

	//
	// hop ! on y va
	//

	foreach ($tests as $c => $u)
		if ($u[0] !== $u[1]) {
			echo "test $c: ".htmlspecialchars($u[0]).' =! '.htmlspecialchars($u[1])."<br />\n";
			$err++;
		}

	if ($err)
		exit;

	echo "OK";

?>
