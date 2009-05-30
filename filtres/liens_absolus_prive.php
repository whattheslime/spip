<?php
/*
 * Le meme que liens_absolus.php mais on hacke _SPIP_TEST_INC
 * pour que le chdir() au debut de test.inc nous transporte dans ecrire/
 * ceci avant que inc_version.php soit inclus ...
 */
// let's go ecrire/
define('_SPIP_TEST_CHDIR', dirname(dirname(dirname(__FILE__))) . '/ecrire');
$test = 'liens_absolus_prive';

// si on rajoute ça ...
// ça serait presque mieux , mais generer_url_public fait pas de resolv_path()
//define('_SPIP_SCRIPT', '../../');

include dirname(__FILE__) . '/liens_absolus.php';
?>
