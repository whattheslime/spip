<?php
/**
 * Test unitaire de la fonction affdate_debut_fin
 * du fichier ./inc/filtres.php
 *
 * genere automatiquement par TestBuilder
 * le 2011-07-27 15:46
 */

	$test = 'affdate_debut_fin';
	$remonte = "../";
	while (!is_dir($remonte."ecrire"))
		$remonte = "../$remonte";
	require $remonte.'tests/test.inc';
	find_in_path("./inc/filtres.php",'',true);

	// chercher la fonction si elle n'existe pas
	if (!function_exists($f='affdate_debut_fin')){
		find_in_path("inc/filtres.php",'',true);
		$f = chercher_filtre($f);
	}

	//
	// hop ! on y va
	//
	$err = tester_fun($f, essais_affdate_debut_fin());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_affdate_debut_fin(){
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
    0 => 'Dimanche 1er juillet 2001 12h34-13h34',
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
    0 => 'Du 1er juillet 12h34 au 2 juillet 2001',
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
    0 => 'Du 1er juillet 12h34 au 2 juillet 2001 13h34',
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
    0 => 'Du 1er juillet 12h34 au 1er août 2001 12h34',
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
    0 => 'Du 1er juillet 2001 (12h34) au 1er juillet 2011 (12h34)',
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
    0 => 'Dim. 1er juillet 2001 12h34-13h34',
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
    0 => 'Du 1er juillet 12h34 au 2 juillet 2001',
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
    0 => 'Du 1er juillet 12h34 au 1er août 2001 12h34',
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
    0 => 'Du 1er juillet 2001 (12h34) au 1er juillet 2011 (12h34)',
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
    0 => '<abbr class=\'dtstart\' title=\'2001-07-01T10:34:00Z\'>Dimanche 1er juillet 2001 12h34</abbr>-<abbr class=\'dtend\' title=\'2001-07-01T11:34:00Z\'>13h34</abbr>',
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
    0 => 'Du <abbr class=\'dtstart\' title=\'2001-07-01T10:34:00Z\'>1er juillet 12h34</abbr> au <abbr class=\'dtend\' title=\'2001-07-02T10:34:00Z\'>2 juillet 2001</abbr>',
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
    0 => 'Du <abbr class=\'dtstart\' title=\'2001-07-01T10:34:00Z\'>1er juillet 12h34</abbr> au <abbr class=\'dtend\' title=\'2001-08-01T10:34:00Z\'>1er août 2001 12h34</abbr>',
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
    0 => 'Du <abbr class=\'dtstart\' title=\'2001-07-01T10:34:00Z\'>1er juillet 2001 (12h34)</abbr> au <abbr class=\'dtend\' title=\'2011-07-01T10:34:00Z\'>1er juillet 2011 (12h34)</abbr>',
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

























































?>