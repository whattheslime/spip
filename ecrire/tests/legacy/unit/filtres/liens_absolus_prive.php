<?php

declare(strict_types=1);

/*
 * Le meme que liens_absolus.php mais on hacke _SPIP_TEST_INC
 * pour que le chdir() au debut de test.inc nous transporte dans ecrire/
 * ceci avant que inc_version.php soit inclus ...
 */
// let's go ecrire/
$dir_racine = dirname(__DIR__, 2);
while (!is_dir($dir_racine . '/ecrire')) {
	$dir_racine = dirname($dir_racine);
}

define('_SPIP_TEST_CHDIR', $dir_racine . '/ecrire');
$test = 'liens_absolus_prive';

// si on rajoute ça ...
// ça serait presque mieux , mais generer_url_public fait pas de resolv_path()
//define('_SPIP_SCRIPT', '../../');

include __DIR__ . '/liens_absolus.php';
