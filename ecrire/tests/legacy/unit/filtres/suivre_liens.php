<?php

declare(strict_types=1);

if (!(isset($test) && $test)) {
	$test = 'suivre_liens';
}

$remonte = __DIR__ . '/';

while (!is_file($remonte . 'test.inc')) {
	$remonte .= '../';
}

require $remonte . 'test.inc';

include_spip('inc/filtres');

# source   # lien    # resultat

$tests = [
	['http://host/', 'http://tata/', 'http://tata/'],
	['//host/', 'http://tata/', 'http://tata/'],
	['http://host/', '//tata/', '//tata/'],
	['http://host/', '/tata/', 'http://host/tata/'],
	['//host/', '/tata/', '//host/tata/'],
	['http://host/', '#tata', 'http://host/#tata'],
	['//host/', '#tata', '//host/#tata'],
	['http://host/', '', 'http://host/'],
	['//host/', '', '//host/'],
	['http://host/', 'tata', 'http://host/tata'],
	['//host/', 'tata', '//host/tata'],
	['http://host/', '?par=value', 'http://host/?par=value'],
	['//host/', '?par=value', '//host/?par=value'],
	['http://host/', 'tata?par=value', 'http://host/tata?par=value'],
	['//host/', 'tata?par=value', '//host/tata?par=value'],
	['http://host/', 'tata#ancre', 'http://host/tata#ancre'],
	['//host/', 'tata#ancre', '//host/tata#ancre'],
	['http://host/', 'tata?par=value#ancre', 'http://host/tata?par=value#ancre'],
	['//host/', 'tata?par=value#ancre', '//host/tata?par=value#ancre'],

	['http://host/page', 'http://tata/', 'http://tata/'],
	['//host/page', 'http://tata/', 'http://tata/'],
	['http://host/page', '//tata/', '//tata/'],
	['http://host/page', '/tata/', 'http://host/tata/'],
	['//host/page', '/tata/', '//host/tata/'],
	['http://host/page', '#tata', 'http://host/page#tata'],
	['//host/page', '#tata', '//host/page#tata'],
	['http://host/page', '', 'http://host/page'],
	['//host/page', '', '//host/page'],
	['http://host/page', 'tata', 'http://host/tata'],
	['//host/page', 'tata', '//host/tata'],
	['http://host/page', '?par=value', 'http://host/?par=value'],
	['//host/page', '?par=value', '//host/?par=value'],
	['http://host/page', 'tata?par=value', 'http://host/tata?par=value'],
	['//host/page', 'tata?par=value', '//host/tata?par=value'],
	['http://host/page', 'tata#ancre', 'http://host/tata#ancre'],
	['//host/page', 'tata#ancre', '//host/tata#ancre'],
	['http://host/page', 'tata?par=value#ancre', 'http://host/tata?par=value#ancre'],
	['//host/page', 'tata?par=value#ancre', '//host/tata?par=value#ancre'],

	['http://host/rep/page', 'http://tata/', 'http://tata/'],
	['//host/rep/page', 'http://tata/', 'http://tata/'],
	['http://host/rep/page', '//tata/', '//tata/'],
	['http://host/rep/page', '/tata/', 'http://host/tata/'],
	['//host/rep/page', '/tata/', '//host/tata/'],
	['http://host/rep/page', '#tata', 'http://host/rep/page#tata'],
	['//host/rep/page', '#tata', '//host/rep/page#tata'],
	['http://host/rep/page', '', 'http://host/rep/page'],
	['//host/rep/page', '', '//host/rep/page'],
	['http://host/rep/page', 'tata', 'http://host/rep/tata'],
	['//host/rep/page', 'tata', '//host/rep/tata'],
	['http://host/rep/page', '?par=value', 'http://host/rep/?par=value'],
	['//host/rep/page', '?par=value', '//host/rep/?par=value'],
	['http://host/rep/page', 'tata?par=value', 'http://host/rep/tata?par=value'],
	['//host/rep/page', 'tata?par=value', '//host/rep/tata?par=value'],
	['http://host/rep/page', 'tata#ancre', 'http://host/rep/tata#ancre'],
	['//host/rep/page', 'tata#ancre', '//host/rep/tata#ancre'],
	['http://host/rep/page', 'tata?par=value#ancre', 'http://host/rep/tata?par=value#ancre'],
	['//host/rep/page', 'tata?par=value#ancre', '//host/rep/tata?par=value#ancre'],

	['http://host/rep/page#anchor', 'http://tata/', 'http://tata/'],
	['http://host/rep/page#anchor', '/tata/', 'http://host/tata/'],
	['http://host/rep/page#anchor', '#tata', 'http://host/rep/page#tata'],
	['http://host/rep/page#anchor', '', 'http://host/rep/page#anchor'],
	['http://host/rep/page#anchor', 'tata', 'http://host/rep/tata'],
	['http://host/rep/page#anchor', '?par=value', 'http://host/rep/?par=value'],
	['http://host/rep/page#anchor', 'tata?par=value', 'http://host/rep/tata?par=value'],
	['http://host/rep/page#anchor', 'tata#ancre', 'http://host/rep/tata#ancre'],
	['http://host/rep/page#anchor', 'tata?par=value#ancre', 'http://host/rep/tata?par=value#ancre'],

	['http://host/rep/page?titi=valeur&bidule=chose/truc', 'http://tata/', 'http://tata/'],
	['http://host/rep/page?titi=valeur&bidule=chose/truc', '/tata/', 'http://host/tata/'],
	[
		'http://host/rep/page?titi=valeur&bidule=chose/truc', '#tata', 'http://host/rep/page?titi=valeur&bidule=chose/truc#tata',
	],
	['http://host/rep/page?titi=valeur&bidule=chose/truc', '', 'http://host/rep/page?titi=valeur&bidule=chose/truc'],
	['http://host/rep/page?titi=valeur&bidule=chose/truc', 'tata', 'http://host/rep/tata'],
	['http://host/rep/page?titi=valeur&bidule=chose/truc', '?par=value', 'http://host/rep/?par=value'],
	['http://host/rep/page?titi=valeur&bidule=chose/truc', 'tata?par=value', 'http://host/rep/tata?par=value'],
	['http://host/rep/page?titi=valeur&bidule=chose/truc', 'tata#ancre', 'http://host/rep/tata#ancre'],
	[
		'http://host/rep/page?titi=valeur&bidule=chose/truc', 'tata?par=value#ancre', 'http://host/rep/tata?par=value#ancre',
	],

	['http://host/rep/page?titi=valeur&bidule=chose/truc#anchor', 'http://tata/', 'http://tata/'],
	['http://host/rep/page?titi=valeur&bidule=chose/truc#anchor', '/tata/', 'http://host/tata/'],
	[
		'http://host/rep/page?titi=valeur&bidule=chose/truc#anchor', '#tata', 'http://host/rep/page?titi=valeur&bidule=chose/truc#tata',
	],
	[
		'http://host/rep/page?titi=valeur&bidule=chose/truc#anchor', '', 'http://host/rep/page?titi=valeur&bidule=chose/truc#anchor',
	],
	['http://host/rep/page?titi=valeur&bidule=chose/truc#anchor', 'tata', 'http://host/rep/tata'],
	['http://host/rep/page?titi=valeur&bidule=chose/truc#anchor', '?par=value', 'http://host/rep/?par=value'],
	['http://host/rep/page?titi=valeur&bidule=chose/truc#anchor', 'tata?par=value', 'http://host/rep/tata?par=value'],
	['http://host/rep/page?titi=valeur&bidule=chose/truc#anchor', 'tata#ancre', 'http://host/rep/tata#ancre'],
	[
		'http://host/rep/page?titi=valeur&bidule=chose/truc#anchor', 'tata?par=value#ancre', 'http://host/rep/tata?par=value#ancre',
	],

	['http://toto/ad?hic', '?hoc', 'http://toto/?hoc'],
	['http://toto/./', '#hup', 'http://toto/#hup'],
	['http://toto/fleche/de/tout', '/bois/', 'http://toto/bois/'],
	['http://toto/du/lac#1', 'yop', 'http://toto/du/yop'],
	['http://toto/', 'http://tata/', 'http://tata/'],
	['http://toto/allo', '#3', 'http://toto/allo#3'],
	['http://toto/', 'http://tata/./', 'http://tata/'],
	['http://toto/et#lui', '', 'http://toto/et#lui'],
	['http://toto', './', 'http://toto/'],
	['http://toto/hop/a', './', 'http://toto/hop/'],
];

//

// hop ! on y va
//

$err = 0;

foreach ($tests as $c => $u) {
	if (($s = suivre_lien($u[0], $u[1])) !== $u[2]) {
		echo "test {$c}: suivre_lien("
		. htmlspecialchars($u[0])
		. ','
		. htmlspecialchars($u[1])
		. ') = '
		. htmlspecialchars($s) . ' mais =! ' . htmlspecialchars($u[2]) . "<br />\n";
		++$err;
	}
}

if ($err !== 0) {
	exit;
}

echo 'OK';
