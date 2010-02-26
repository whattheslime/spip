<?php
/**
 * Test unitaire de la fonction affdate_jourcourt
 * du fichier inc/filtres.php
 *
 * genere automatiquement par TestBuilder
 * le 
 */

	$test = 'affdate_jourcourt';
	require '../test.inc';
	find_in_path("inc/filtres.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('affdate_jourcourt', essais_affdate_jourcourt());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_affdate_jourcourt(){
		$essais = array (
  0 => 
  array (
    0 => '  2001',
    1 => '2001-00-00 12:33:44',
  ),
  1 => 
  array (
    0 => ' mars 2001',
    1 => '2001-03-00 09:12:57',
  ),
  2 => 
  array (
    0 => '29 f&eacute;vrier 2001',
    1 => '2001-02-29 14:12:33',
  ),
  3 => 
  array (
    0 => '0000',
    1 => '0000-00-00',
  ),
  4 => 
  array (
    0 => '0001',
    1 => '0001-01-01',
  ),
  5 => 
  array (
    0 => '1er janvier 1970',
    1 => '1970-01-01',
  ),
  6 => 
  array (
    0 => '5 juillet 2001',
    1 => '2001-07-05 18:25:24',
  ),
  7 => 
  array (
    0 => '1er janvier 2001',
    1 => '2001-01-01 00:00:00',
  ),
  8 => 
  array (
    0 => '31 d&eacute;cembre 2001',
    1 => '2001-12-31 23:59:59',
  ),
  9 => 
  array (
    0 => '1er mars 2001',
    1 => '2001-03-01 14:12:33',
  ),
  10 => 
  array (
    0 => '29 f&eacute;vrier 2004',
    1 => '2004-02-29 14:12:33',
  ),
  11 => 
  array (
    0 => '20 mars 2012',
    1 => '2012-03-20 12:00:00',
  ),
  12 => 
  array (
    0 => '21 mars 2012',
    1 => '2012-03-21 12:00:00',
  ),
  13 => 
  array (
    0 => '22 mars 2012',
    1 => '2012-03-22 12:00:00',
  ),
  14 => 
  array (
    0 => '20 juin 2012',
    1 => '2012-06-20 12:00:00',
  ),
  15 => 
  array (
    0 => '21 juin 2012',
    1 => '2012-06-21 12:00:00',
  ),
  16 => 
  array (
    0 => '22 juin 2012',
    1 => '2012-06-22 12:00:00',
  ),
  17 => 
  array (
    0 => '20 septembre 2012',
    1 => '2012-09-20 12:00:00',
  ),
  18 => 
  array (
    0 => '21 septembre 2012',
    1 => '2012-09-21 12:00:00',
  ),
  19 => 
  array (
    0 => '22 septembre 2012',
    1 => '2012-09-22 12:00:00',
  ),
  20 => 
  array (
    0 => '20 d&eacute;cembre 2012',
    1 => '2012-12-20 12:00:00',
  ),
  21 => 
  array (
    0 => '21 d&eacute;cembre 2012',
    1 => '2012-12-21 12:00:00',
  ),
  22 => 
  array (
    0 => '22 d&eacute;cembre 2012',
    1 => '2012-12-22 12:00:00',
  ),
  23 => 
  array (
    0 => '5 juillet 2001',
    1 => '2001-07-05',
  ),
  24 => 
  array (
    0 => '1er janvier 2001',
    1 => '2001-01-01',
  ),
  25 => 
  array (
    0 => '31 d&eacute;cembre 2001',
    1 => '2001-12-31',
  ),
  26 => 
  array (
    0 => '1er mars 2001',
    1 => '2001-03-01',
  ),
  27 => 
  array (
    0 => '29 f&eacute;vrier 2004',
    1 => '2004-02-29',
  ),
  28 => 
  array (
    0 => '20 mars 2012',
    1 => '2012-03-20',
  ),
  29 => 
  array (
    0 => '21 mars 2012',
    1 => '2012-03-21',
  ),
  30 => 
  array (
    0 => '22 mars 2012',
    1 => '2012-03-22',
  ),
  31 => 
  array (
    0 => '20 juin 2012',
    1 => '2012-06-20',
  ),
  32 => 
  array (
    0 => '21 juin 2012',
    1 => '2012-06-21',
  ),
  33 => 
  array (
    0 => '22 juin 2012',
    1 => '2012-06-22',
  ),
  34 => 
  array (
    0 => '20 septembre 2012',
    1 => '2012-09-20',
  ),
  35 => 
  array (
    0 => '21 septembre 2012',
    1 => '2012-09-21',
  ),
  36 => 
  array (
    0 => '22 septembre 2012',
    1 => '2012-09-22',
  ),
  37 => 
  array (
    0 => '20 d&eacute;cembre 2012',
    1 => '2012-12-20',
  ),
  38 => 
  array (
    0 => '21 d&eacute;cembre 2012',
    1 => '2012-12-21',
  ),
  39 => 
  array (
    0 => '22 d&eacute;cembre 2012',
    1 => '2012-12-22',
  ),
  40 => 
  array (
    0 => '1er juillet 2005',
    1 => '2001/07/05',
  ),
  41 => 
  array (
    0 => '1er janvier 2001',
    1 => '2001/01/01',
  ),
  42 => 
  array (
    0 => '1er d&eacute;cembre 2031',
    1 => '2001/12/31',
  ),
  43 => 
  array (
    0 => '1er mars 2001',
    1 => '2001/03/01',
  ),
  44 => 
  array (
    0 => '4 f&eacute;vrier 2029',
    1 => '2004/02/29',
  ),
  45 => 
  array (
    0 => '12 mars 2020',
    1 => '2012/03/20',
  ),
  46 => 
  array (
    0 => '12 mars 2021',
    1 => '2012/03/21',
  ),
  47 => 
  array (
    0 => '12 mars 2022',
    1 => '2012/03/22',
  ),
  48 => 
  array (
    0 => '12 juin 2020',
    1 => '2012/06/20',
  ),
  49 => 
  array (
    0 => '12 juin 2021',
    1 => '2012/06/21',
  ),
  50 => 
  array (
    0 => '12 juin 2022',
    1 => '2012/06/22',
  ),
  51 => 
  array (
    0 => '12 septembre 2020',
    1 => '2012/09/20',
  ),
  52 => 
  array (
    0 => '12 septembre 2021',
    1 => '2012/09/21',
  ),
  53 => 
  array (
    0 => '12 septembre 2022',
    1 => '2012/09/22',
  ),
  54 => 
  array (
    0 => '12 d&eacute;cembre 2020',
    1 => '2012/12/20',
  ),
  55 => 
  array (
    0 => '12 d&eacute;cembre 2021',
    1 => '2012/12/21',
  ),
  56 => 
  array (
    0 => '12 d&eacute;cembre 2022',
    1 => '2012/12/22',
  ),
  57 => 
  array (
    0 => '5 juillet 2001',
    1 => '05/07/2001',
  ),
  58 => 
  array (
    0 => '1er janvier 2001',
    1 => '01/01/2001',
  ),
  59 => 
  array (
    0 => '31 d&eacute;cembre 2001',
    1 => '31/12/2001',
  ),
  60 => 
  array (
    0 => '1er mars 2001',
    1 => '01/03/2001',
  ),
  61 => 
  array (
    0 => '29 f&eacute;vrier 2004',
    1 => '29/02/2004',
  ),
  62 => 
  array (
    0 => '20 mars 2012',
    1 => '20/03/2012',
  ),
  63 => 
  array (
    0 => '21 mars 2012',
    1 => '21/03/2012',
  ),
  64 => 
  array (
    0 => '22 mars 2012',
    1 => '22/03/2012',
  ),
  65 => 
  array (
    0 => '20 juin 2012',
    1 => '20/06/2012',
  ),
  66 => 
  array (
    0 => '21 juin 2012',
    1 => '21/06/2012',
  ),
  67 => 
  array (
    0 => '22 juin 2012',
    1 => '22/06/2012',
  ),
  68 => 
  array (
    0 => '20 septembre 2012',
    1 => '20/09/2012',
  ),
  69 => 
  array (
    0 => '21 septembre 2012',
    1 => '21/09/2012',
  ),
  70 => 
  array (
    0 => '22 septembre 2012',
    1 => '22/09/2012',
  ),
  71 => 
  array (
    0 => '20 d&eacute;cembre 2012',
    1 => '20/12/2012',
  ),
  72 => 
  array (
    0 => '21 d&eacute;cembre 2012',
    1 => '21/12/2012',
  ),
  73 => 
  array (
    0 => '22 d&eacute;cembre 2012',
    1 => '22/12/2012',
  ),
);
		return $essais;
	}



?>