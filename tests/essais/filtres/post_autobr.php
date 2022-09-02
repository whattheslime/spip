<?php
/**
 * Test unitaire de la fonction post_autobr
 * du fichier ./inc/filtres.php
 *
 */
namespace Spip\Core\Tests;

find_in_path("./inc/filtres.php",'',true);

/**
 * La fonction appelee pour chaque jeu de test
 * Nommage conventionnel : test_[[dossier1_][[dossier2_]...]]fichier
 * @param ...$args
 * @return mixed
 */
function test_filtres_post_autobr(...$args) {
	return post_autobr(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_filtres_post_autobr(){
		$essais =  [
  0 => 
   [
    0 => 'Texte avec un 
_ un retour simple à la ligne.',
    1 => 'Texte avec un 
un retour simple à la ligne.',
    2 => '
_ ',
  ],
  1 => 
   [
    0 => '<cadre>cadre contenant un
retour simple (doit rester inchangé)</cadre>',
    1 => '<cadre>cadre contenant un
retour simple (doit rester inchangé)</cadre>',
    2 => '
_ ',
  ],
  2 => 
   [
    0 => 'Un double saut de ligne

 ne doit pas être modifié par post_autobr.',
    1 => 'Un double saut de ligne

 ne doit pas être modifié par post_autobr.',
    2 => '
_ ',
  ],
  3 => 
   [
    0 => '<modele123|param1=un appel de modèle
  |param2=avec retour à la ligne
  ne doit pas être modifié>',
    1 => '<modele123|param1=un appel de modèle
  |param2=avec retour à la ligne
  ne doit pas être modifié>',
    2 => '
_ ',
  ],
];
		return $essais;
	}

