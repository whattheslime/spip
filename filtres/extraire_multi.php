<?php
/**
 * Test unitaire de la fonction extraire_multi
 * du fichier ./inc/filtres.php
 *
 * genere automatiquement par TestBuilder
 * le 2010-04-02 18:21
 */

	$test = 'extraire_multi';
	$remonte = "../";
	while (!is_dir($remonte."ecrire"))
		$remonte = "../$remonte";
	require $remonte.'tests/test.inc';
	find_in_path("./inc/filtres.php",'',true);
	find_in_path("./inc/lang.php",'',true);
	//
	// hop ! on y va
	//
	$err = tester_fun('extraire_multi', essais_extraire_multi());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_extraire_multi(){
		$essais = array (
  0 => 
  array (
    0 => 'english',
    1 => '<multi>[fr]francais[en]english[de]deutsch</multi>',
    2 => 'en',
  ),
  1 => 
  array (
    0 => 'deutsch',
    1 => '<multi>[fr]francais[en]english[de]deutsch</multi>',
    2 => 'de',
  ),
  2 => 
  array (
    0 => 'francais',
    1 => '<multi>[fr]francais[en]english[de]deutsch</multi>',
    2 => 'fr',
  ),
  3 => 
  array (
    0 => '<span lang=\'fr\'>francais</span>',
    1 => '<multi>[fr]francais[en]english[de]deutsch</multi>',
    2 => 'it',
  ),
  4 => 
  array (
    0 => '<span lang=\'fr\' dir=\'ltr\'>francais</span>',
    1 => '<multi>[fr]francais[en]english[de]deutsch</multi>',
    2 => 'ar',
  ),
  5 => 
  array (
    0 => 'english',
    1 => '<multi>[fr]francais[en]english[de]deutsch</multi>',
    2 => 'en',
    3 => true,
  ),
  6 => 
  array (
    0 => 'deutsch',
    1 => '<multi>[fr]francais[en]english[de]deutsch</multi>',
    2 => 'de',
    3 => true,
  ),
  7 => 
  array (
    0 => 'francais',
    1 => '<multi>[fr]francais[en]english[de]deutsch</multi>',
    2 => 'fr',
    3 => true,
  ),
  8 => 
  array (
    0 => '<span class="base64multi" title="ZnJhbmNhaXM=" lang="fr"></span>',
    1 => '<multi>[fr]francais[en]english[de]deutsch</multi>',
    2 => 'it',
    3 => true,
  ),
  9 => 
  array (
    0 => '<span class="base64multi" title="ZnJhbmNhaXM=" lang="fr" dir="ltr"></span>',
    1 => '<multi>[fr]francais[en]english[de]deutsch</multi>',
    2 => 'ar',
    3 => true,
  ),
);
		return $essais;
	}












?>