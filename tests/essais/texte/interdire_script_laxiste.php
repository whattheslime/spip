<?php
/**
 * Test unitaire de la fonction interdire_script
 * du fichier inc/texte.php
 *
 */
namespace Spip\Core\Tests;

find_in_path("inc/texte.php",'',true);

function pretest_texte_interdire_script_laxiste() {
	$GLOBALS['filtrer_javascript'] = 1;
}

/**
 * La fonction appelee pour chaque jeu de test
 * Nommage conventionnel : test_[[dossier1_][[dossier2_]...]]fichier
 * @param ...$args
 * @return mixed
 */
function test_texte_interdire_script_laxiste(...$args) {
	return interdire_scripts(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_texte_interdire_script_laxiste()
{
    return [["<script type='text/javascript' src='toto.js'></script>", "<script type='text/javascript' src='toto.js'></script>"], ["<script type='text/javascript' src='spip.php?page=toto'></script>", "<script type='text/javascript' src='spip.php?page=toto'></script>"], ["<script type='text/javascript'>var php=5;</script>", "<script type='text/javascript'>var php=5;</script>"], ["<script language='javascript' src='spip.php?page=toto'></script>", "<script language='javascript' src='spip.php?page=toto'></script>"], ["&lt;script language='php'>die();</script>", "<script language='php'>die();</script>"], ["&lt;script language=php>die();</script>", "<script language=php>die();</script>"], ["&lt;script language = php >die();</script>", "<script language = php >die();</script>"]];
}

