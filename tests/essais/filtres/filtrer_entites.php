<?php
/**
 * Test unitaire de la fonction filtrer_entites
 * du fichier inc/filtres.php
 *
 */
namespace Spip\Core\Tests;

find_in_path("inc/filtres.php",'',true);

/**
 * La fonction appelee pour chaque jeu de test
 * Nommage conventionnel : test_[[dossier1_][[dossier2_]...]]fichier
 * @param ...$args
 * @return mixed
 */
function test_filtres_filtrer_entites(...$args) {
	return filtrer_entites(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_filtres_filtrer_entites(){
		$essais = array (
  0 => 
  array (
    0 => '',
    1 => '',
  ),
  1 => 
  array (
    0 => '0',
    1 => '0',
  ),
  2 => 
  array (
    0 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
  ),
  3 => 
  array (
    0 => 'Un texte avec des entités &<>"',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ),
	4 =>
  array (
    0 => 'Un texte avec des entités numériques &<>"\'',
    1 => 'Un texte avec des entit&#233;s num&#233;riques &amp;&lt;&gt;&#034;&#039;',
  ),
  5 =>
  array (
    0 => 'Un texte sans entites &<>"\'',
    1 => 'Un texte sans entites &<>"\'',
  ),
  6 =>
  array (
    0 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ),
  7 =>
  array (
    0 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
  ),
);
		return $essais;
	}

