#!/usr/bin/env php
<?php

// les args a passer a phpUnit
$args = $argv;
array_shift($args);

$dir_tests = dirname(__DIR__) . '/';
// charger SPIP
require_once $dir_tests . 'tests/spip.inc';

// Lister les repertoires du path qui contiennent des dossier tests/ avec des tests PHPUnit

$dirs = [];
foreach (creer_chemin() as $d) {
	if ($d and
		is_dir("${d}tests")
		and count(glob("${d}tests/*Test.php"))
	) {
		$bases[] = "${d}tests";
	}
}

$prefixe_dir = '../';
while (!is_dir($dir_tests . $prefixe_dir . 'ecrire')) {
	$prefixe_dir .= '../';
}

$testsuites = [];
foreach ($bases as $base) {
	$name = dirname($base);
	$testsuites[] = "<testsuite name=\"$name\"><directory>{$prefixe_dir}{$base}/</directory></testsuite>";
}

$testsuites = "\t\t" . implode("\n\t\t", $testsuites) . "\n";

// generer le phpunit.xml a jour
$config = file_get_contents($dir_tests .  'phpunit.xml.dist');
$p = strpos($config, "\t</testsuites>");
$config = substr_replace($config, $testsuites, $p, 0);

file_put_contents($dir_tests . "phpunit.xml", $config);
