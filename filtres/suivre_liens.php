<?php

	(isset($test) && $test) || ($test = 'suivre_liens');
	require '../test.inc';
	include_spip('inc/filtres');

		# source   # lien    # resultat
$tests = array(
array(
	'http://host/', 'http://tata/', 'http://tata/'
),
array(
	'http://host/', '/tata/', 'http://host/tata/'
),
array(
	'http://host/', '#tata', 'http://host/#tata'
),
array(
	'http://host/', '', 'http://host/'
),
array(
	'http://host/', 'tata', 'http://host/tata'
),
array(
	'http://host/', '?par=value', 'http://host/?par=value'
),
array(
	'http://host/', 'tata?par=value', 'http://host/tata?par=value'
),
array(
	'http://host/', 'tata#ancre', 'http://host/tata#ancre'
),
array(
	'http://host/', 'tata?par=value#ancre', 'http://host/tata?par=value#ancre'
),



array(
	'http://host/page', 'http://tata/', 'http://tata/'
),
array(
	'http://host/page', '/tata/', 'http://host/tata/'
),
array(
	'http://host/page', '#tata', 'http://host/page#tata'
),
array(
	'http://host/page', '', 'http://host/page'
),
array(
	'http://host/page', 'tata', 'http://host/tata'
),
array(
	'http://host/page', '?par=value', 'http://host/?par=value'
),
array(
	'http://host/page', 'tata?par=value', 'http://host/tata?par=value'
),
array(
	'http://host/page', 'tata#ancre', 'http://host/tata#ancre'
),
array(
	'http://host/page', 'tata?par=value#ancre', 'http://host/tata?par=value#ancre'
),


array(
	'http://host/rep/page', 'http://tata/', 'http://tata/'
),
array(
	'http://host/rep/page', '/tata/', 'http://host/tata/'
),
array(
	'http://host/rep/page', '#tata', 'http://host/rep/page#tata'
),
array(
	'http://host/rep/page', '', 'http://host/rep/page'
),
array(
	'http://host/rep/page', 'tata', 'http://host/rep/tata'
),
array(
	'http://host/rep/page', '?par=value', 'http://host/rep/?par=value'
),
array(
	'http://host/rep/page', 'tata?par=value', 'http://host/rep/tata?par=value'
),
array(
	'http://host/rep/page', 'tata#ancre', 'http://host/rep/tata#ancre'
),
array(
	'http://host/rep/page', 'tata?par=value#ancre', 'http://host/rep/tata?par=value#ancre'
),



array(
	'http://host/rep/page#anchor', 'http://tata/', 'http://tata/'
),
array(
	'http://host/rep/page#anchor', '/tata/', 'http://host/tata/'
),
array(
	'http://host/rep/page#anchor', '#tata', 'http://host/rep/page#tata'
),
array(
	'http://host/rep/page#anchor', '', 'http://host/rep/page#anchor'
),
array(
	'http://host/rep/page#anchor', 'tata', 'http://host/rep/tata'
),
array(
	'http://host/rep/page#anchor', '?par=value', 'http://host/rep/?par=value'
),
array(
	'http://host/rep/page#anchor', 'tata?par=value', 'http://host/rep/tata?par=value'
),
array(
	'http://host/rep/page#anchor', 'tata#ancre', 'http://host/rep/tata#ancre'
),
array(
	'http://host/rep/page#anchor', 'tata?par=value#ancre', 'http://host/rep/tata?par=value#ancre'
),


array(
	'http://host/rep/page?titi=valeur&bidule=chose/truc', 'http://tata/', 'http://tata/'
),
array(
	'http://host/rep/page?titi=valeur&bidule=chose/truc', '/tata/', 'http://host/tata/'
),
array(
	'http://host/rep/page?titi=valeur&bidule=chose/truc', '#tata', 'http://host/rep/page?titi=valeur&bidule=chose/truc#tata'
),
array(
	'http://host/rep/page?titi=valeur&bidule=chose/truc', '', 'http://host/rep/page?titi=valeur&bidule=chose/truc'
),
array(
	'http://host/rep/page?titi=valeur&bidule=chose/truc', 'tata', 'http://host/rep/tata'
),
array(
	'http://host/rep/page?titi=valeur&bidule=chose/truc', '?par=value', 'http://host/rep/?par=value'
),
array(
	'http://host/rep/page?titi=valeur&bidule=chose/truc', 'tata?par=value', 'http://host/rep/tata?par=value'
),
array(
	'http://host/rep/page?titi=valeur&bidule=chose/truc', 'tata#ancre', 'http://host/rep/tata#ancre'
),
array(
	'http://host/rep/page?titi=valeur&bidule=chose/truc', 'tata?par=value#ancre', 'http://host/rep/tata?par=value#ancre'
),



array(
	'http://host/rep/page?titi=valeur&bidule=chose/truc#anchor', 'http://tata/', 'http://tata/'
),
array(
	'http://host/rep/page?titi=valeur&bidule=chose/truc#anchor', '/tata/', 'http://host/tata/'
),
array(
	'http://host/rep/page?titi=valeur&bidule=chose/truc#anchor', '#tata', 'http://host/rep/page?titi=valeur&bidule=chose/truc#tata'
),
array(
	'http://host/rep/page?titi=valeur&bidule=chose/truc#anchor', '', 'http://host/rep/page?titi=valeur&bidule=chose/truc#anchor'
),
array(
	'http://host/rep/page?titi=valeur&bidule=chose/truc#anchor', 'tata', 'http://host/rep/tata'
),
array(
	'http://host/rep/page?titi=valeur&bidule=chose/truc#anchor', '?par=value', 'http://host/rep/?par=value'
),
array(
	'http://host/rep/page?titi=valeur&bidule=chose/truc#anchor', 'tata?par=value', 'http://host/rep/tata?par=value'
),
array(
	'http://host/rep/page?titi=valeur&bidule=chose/truc#anchor', 'tata#ancre', 'http://host/rep/tata#ancre'
),
array(
	'http://host/rep/page?titi=valeur&bidule=chose/truc#anchor', 'tata?par=value#ancre', 'http://host/rep/tata?par=value#ancre'
),



array(
	'http://toto/ad?hic', '?hoc', 'http://toto/?hoc'
),
array(
	'http://toto/./', '#hup', 'http://toto/#hup'
),
array(
	'http://toto/fleche/de/tout', '/bois/', 'http://toto/bois/'
),
array(
	'http://toto/du/lac#1', 'yop', 'http://toto/du/yop'
),
array(
	'http://toto/', 'http://tata/', 'http://tata/'
),
array(
	'http://toto/allo', '#3', 'http://toto/allo#3'
),
array(
	'http://toto/', 'http://tata/./', 'http://tata/'
),
array(
	'http://toto/et#lui', '', 'http://toto/et#lui'
),
array(
	'http://toto', './', 'http://toto/'
),
array(
	'http://toto/hop/a', './', 'http://toto/hop/'
)
);

	//
	// hop ! on y va
	//

	foreach ($tests as $c => $u)
		if (($s=suivre_lien($u[0],$u[1])) !== $u[2]) {
			echo "test $c: suivre_lien("
			.htmlspecialchars($u[0])
			.','
			.htmlspecialchars($u[1])
			.') = '
			.htmlspecialchars($s).' mais =! '.htmlspecialchars($u[2])."<br />\n";
			$err++;
		}

	if ($err)
		exit;

	echo "OK";

?>
