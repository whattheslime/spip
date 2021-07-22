<?php
/**
 * Test unitaire de la fonction affdate_debut_fin
 * du fichier ./inc/filtres.php
 *
 */
namespace Spip\Core\Tests;

find_in_path("./inc/filtres.php",'',true);

function pretest_filtres_affdate_debut_fin() {
	// Pour que le tests soit independant de la timezone du serveur
	ini_set('date.timezone','Europe/Paris');
	changer_langue('fr'); // ce test est en fr
}

/**
 * La fonction appelee pour chaque jeu de test
 * Nommage conventionnel : test_[[dossier1_][[dossier2_]...]]fichier
 * @param ...$args
 * @return mixed
 */
function test_filtres_affdate_debut_fin(...$args) {
	return affdate_debut_fin(...$args);
}


/**
 * La fonction qui fournit les jeux de test
 * Nommage conventionnel : essais_[[dossier1_][[dossier2_]...]]fichier
 * @return array
 *  [ output, input1, input2, input3...]
 */
function essais_filtres_affdate_debut_fin(){
		$essais = array (
  0 => 
  array (
    0 => 'Dimanche 1er juillet 2001 à 12h34',
    1 => '2001-07-01 12:34:00',
    2 => '2001-07-01 12:34:00',
    3 => true,
  ),
  1 => 
  array (
    0 => 'Dimanche 1er juillet 2001',
    1 => '2001-07-01 12:34:00',
    2 => '2001-07-01 12:34:00',
    3 => false,
  ),
  2 => 
  array (
    0 => 'Dimanche 1er juillet 2001 de 12h34 à 13h34',
    1 => '2001-07-01 12:34:00',
    2 => '2001-07-01 13:34:00',
    3 => true,
  ),
  3 => 
  array (
    0 => 'Dimanche 1er juillet 2001',
    1 => '2001-07-01 12:34:00',
    2 => '2001-07-01 13:34:00',
    3 => false,
  ),
  4 => 
  array (
    0 => 'Du 1er juillet à 12h34 au 2 juillet 2001 à 12h34',
    1 => '2001-07-01 12:34:00',
    2 => '2001-07-02 12:34:00',
    3 => true,
  ),
  5 => 
  array (
    0 => 'Du 1er au 2 juillet 2001',
    1 => '2001-07-01 12:34:00',
    2 => '2001-07-02 12:34:00',
    3 => false,
  ),
  6 => 
  array (
    0 => 'Du 1er juillet à 12h34 au 2 juillet 2001 à 13h34',
    1 => '2001-07-01 12:34:00',
    2 => '2001-07-02 13:34:00',
    3 => true,
  ),
  7 => 
  array (
    0 => 'Du 1er au 2 juillet 2001',
    1 => '2001-07-01 12:34:00',
    2 => '2001-07-02 13:34:00',
    3 => false,
  ),
  8 => 
  array (
    0 => 'Du 1er juillet à 12h34 au 1er août 2001 à 12h34',
    1 => '2001-07-01 12:34:00',
    2 => '2001-08-01 12:34:00',
    3 => true,
  ),
  9 => 
  array (
    0 => 'Du 1er juillet au 1er août 2001',
    1 => '2001-07-01 12:34:00',
    2 => '2001-08-01 12:34:00',
    3 => false,
  ),
  10 => 
  array (
    0 => 'Du 1er juillet 2001 à 12h34 au 1er juillet 2011 à 12h34',
    1 => '2001-07-01 12:34:00',
    2 => '2011-07-01 12:34:00',
    3 => true,
  ),
  11 => 
  array (
    0 => 'Du 1er juillet 2001 au 1er juillet 2011',
    1 => '2001-07-01 12:34:00',
    2 => '2011-07-01 12:34:00',
    3 => false,
  ),
  12 => 
  array (
    0 => 'Dim. 1er juillet 2001 à 12h34',
    1 => '2001-07-01 12:34:00',
    2 => '2001-07-01 12:34:00',
    3 => true,
    4 => 'abbr',
  ),
  13 => 
  array (
    0 => 'Dim. 1er juillet 2001',
    1 => '2001-07-01 12:34:00',
    2 => '2001-07-01 12:34:00',
    3 => false,
    4 => 'abbr',
  ),
  14 => 
  array (
    0 => 'Dim. 1er juillet 2001 de 12h34 à 13h34',
    1 => '2001-07-01 12:34:00',
    2 => '2001-07-01 13:34:00',
    3 => true,
    4 => 'abbr',
  ),
  15 => 
  array (
    0 => 'Dim. 1er juillet 2001',
    1 => '2001-07-01 12:34:00',
    2 => '2001-07-01 13:34:00',
    3 => false,
    4 => 'abbr',
  ),
  16 => 
  array (
    0 => 'Du 1er juillet à 12h34 au 2 juillet 2001 à 12h34',
    1 => '2001-07-01 12:34:00',
    2 => '2001-07-02 12:34:00',
    3 => true,
    4 => 'abbr',
  ),
  17 => 
  array (
    0 => 'Du 1er au 2 juillet 2001',
    1 => '2001-07-01 12:34:00',
    2 => '2001-07-02 12:34:00',
    3 => false,
    4 => 'abbr',
  ),
  18 => 
  array (
    0 => 'Du 1er juillet à 12h34 au 1er août 2001 à 12h34',
    1 => '2001-07-01 12:34:00',
    2 => '2001-08-01 12:34:00',
    3 => true,
    4 => 'abbr',
  ),
  19 => 
  array (
    0 => 'Du 1er juillet au 1er août 2001',
    1 => '2001-07-01 12:34:00',
    2 => '2001-08-01 12:34:00',
    3 => false,
    4 => 'abbr',
  ),
  20 => 
  array (
    0 => 'Du 1er juillet 2001 à 12h34 au 1er juillet 2011 à 12h34',
    1 => '2001-07-01 12:34:00',
    2 => '2011-07-01 12:34:00',
    3 => true,
    4 => 'abbr',
  ),
  21 => 
  array (
    0 => 'Du 1er juillet 2001 au 1er juillet 2011',
    1 => '2001-07-01 12:34:00',
    2 => '2011-07-01 12:34:00',
    3 => false,
    4 => 'abbr',
  ),
  22 => 
  array (
    0 => '<abbr class=\'dtstart\' title=\'2001-07-01T10:34:00Z\'>Dimanche 1er juillet 2001 à 12h34</abbr>',
    1 => '2001-07-01 12:34:00',
    2 => '2001-07-01 12:34:00',
    3 => true,
    4 => 'hcal',
  ),
  23 => 
  array (
    0 => '<abbr class=\'dtstart\' title=\'2001-07-01T10:34:00Z\'>Dimanche 1er juillet 2001</abbr>',
    1 => '2001-07-01 12:34:00',
    2 => '2001-07-01 12:34:00',
    3 => false,
    4 => 'hcal',
  ),
  24 => 
  array (
    0 => '<abbr class=\'dtstart\' title=\'2001-07-01T10:34:00Z\'>Dimanche 1er juillet 2001 de 12h34</abbr> à <abbr class=\'dtend\' title=\'2001-07-01T11:34:00Z\'>13h34</abbr>',
    1 => '2001-07-01 12:34:00',
    2 => '2001-07-01 13:34:00',
    3 => true,
    4 => 'hcal',
  ),
  25 => 
  array (
    0 => '<abbr class=\'dtstart\' title=\'2001-07-01T10:34:00Z\'>Dimanche 1er juillet 2001</abbr>',
    1 => '2001-07-01 12:34:00',
    2 => '2001-07-01 13:34:00',
    3 => false,
    4 => 'hcal',
  ),
  26 => 
  array (
    0 => 'Du <abbr class=\'dtstart\' title=\'2001-07-01T10:34:00Z\'>1er juillet à 12h34</abbr> au <abbr class=\'dtend\' title=\'2001-07-02T10:34:00Z\'>2 juillet 2001 à 12h34</abbr>',
    1 => '2001-07-01 12:34:00',
    2 => '2001-07-02 12:34:00',
    3 => true,
    4 => 'hcal',
  ),
  27 => 
  array (
    0 => 'Du <abbr class=\'dtstart\' title=\'2001-07-01T10:34:00Z\'>1er</abbr> au <abbr class=\'dtend\' title=\'2001-07-02T10:34:00Z\'>2 juillet 2001</abbr>',
    1 => '2001-07-01 12:34:00',
    2 => '2001-07-02 12:34:00',
    3 => false,
    4 => 'hcal',
  ),
  28 => 
  array (
    0 => 'Du <abbr class=\'dtstart\' title=\'2001-07-01T10:34:00Z\'>1er juillet à 12h34</abbr> au <abbr class=\'dtend\' title=\'2001-08-01T10:34:00Z\'>1er août 2001 à 12h34</abbr>',
    1 => '2001-07-01 12:34:00',
    2 => '2001-08-01 12:34:00',
    3 => true,
    4 => 'hcal',
  ),
  29 => 
  array (
    0 => 'Du <abbr class=\'dtstart\' title=\'2001-07-01T10:34:00Z\'>1er juillet</abbr> au <abbr class=\'dtend\' title=\'2001-08-01T10:34:00Z\'>1er août 2001</abbr>',
    1 => '2001-07-01 12:34:00',
    2 => '2001-08-01 12:34:00',
    3 => false,
    4 => 'hcal',
  ),
  30 => 
  array (
    0 => 'Du <abbr class=\'dtstart\' title=\'2001-07-01T10:34:00Z\'>1er juillet 2001 à 12h34</abbr> au <abbr class=\'dtend\' title=\'2011-07-01T10:34:00Z\'>1er juillet 2011 à 12h34</abbr>',
    1 => '2001-07-01 12:34:00',
    2 => '2011-07-01 12:34:00',
    3 => true,
    4 => 'hcal',
  ),
  31 => 
  array (
    0 => 'Du <abbr class=\'dtstart\' title=\'2001-07-01T10:34:00Z\'>1er juillet 2001</abbr> au <abbr class=\'dtend\' title=\'2011-07-01T10:34:00Z\'>1er juillet 2011</abbr>',
    1 => '2001-07-01 12:34:00',
    2 => '2011-07-01 12:34:00',
    3 => false,
    4 => 'hcal',
  ),
);
		return $essais;
	}

