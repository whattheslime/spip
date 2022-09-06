<?php

declare(strict_types=1);

/**
 * Tests unitaires de sous_repertoire() du fichier ecrire/inc/flock.php
 */

$test = 'sous_repertoire';
$remonte = __DIR__ . '/';
while (! is_file($remonte . 'test.inc')) {
	$remonte .= '../';
}

require $remonte . 'test.inc';

$ok = true;

$sous_repertoire = 'test' . md5(random_int(0, mt_getrandmax()));

include_spip('inc/flock');

$ok = (sous_repertoire(
	_NOM_TEMPORAIRES_ACCESSIBLES,
	$sous_repertoire
) === _NOM_TEMPORAIRES_ACCESSIBLES . $sous_repertoire . '/');

// Nettoyage
@unlink(_NOM_TEMPORAIRES_ACCESSIBLES . $sous_repertoire . '/.ok');
@rmdir(_NOM_TEMPORAIRES_ACCESSIBLES . $sous_repertoire);

if ($ok) {
	echo 'OK';
}
