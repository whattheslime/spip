<?php
/**
 * Test unitaire de la fonction spip_version_compare
 * du fichier ./inc/plugin.php
 *
 * genere automatiquement par TestBuilder
 * le 2010-03-14 16:16
 */

	$test = 'spip_version_compare';
	$remonte = "../";
	while (!is_dir($remonte."ecrire"))
		$remonte = "../$remonte";
	require $remonte.'tests/test.inc';
	find_in_path("./inc/plugin.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('spip_version_compare', essais_spip_version_compare());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_spip_version_compare(){
		$essais = array (
  0 => 
  array (
    0 => false,
    1 => '2',
    2 => '2',
    3 => '>',
  ),
  1 => 
  array (
    0 => false,
    1 => '2',
    2 => '2.0',
    3 => '>',
  ),
  2 => 
  array (
    0 => false,
    1 => '2',
    2 => '2.0.0',
    3 => '>',
  ),
  3 => 
  array (
    0 => true,
    1 => '2',
    2 => '2.0.0dev',
    3 => '>',
  ),
  4 => 
  array (
    0 => true,
    1 => '2',
    2 => '2.0.0alpha',
    3 => '>',
  ),
  5 => 
  array (
    0 => true,
    1 => '2',
    2 => '2.0.0beta',
    3 => '>',
  ),
  6 => 
  array (
    0 => true,
    1 => '2',
    2 => '2.0.0rc',
    3 => '>',
  ),
  8 => 
  array (
    0 => false,
    1 => '2',
    2 => '2.0.0pl',
    3 => '>',
  ),
  9 => 
  array (
    0 => false,
    1 => '2',
    2 => '2.0.1',
    3 => '>',
  ),
  10 => 
  array (
    0 => false,
    1 => '2.0',
    2 => '2',
    3 => '>',
  ),
  11 => 
  array (
    0 => false,
    1 => '2.0',
    2 => '2.0',
    3 => '>',
  ),
  12 => 
  array (
    0 => false,
    1 => '2.0',
    2 => '2.0.0',
    3 => '>',
  ),
  13 => 
  array (
    0 => true,
    1 => '2.0',
    2 => '2.0.0dev',
    3 => '>',
  ),
  14 => 
  array (
    0 => true,
    1 => '2.0',
    2 => '2.0.0alpha',
    3 => '>',
  ),
  15 => 
  array (
    0 => true,
    1 => '2.0',
    2 => '2.0.0beta',
    3 => '>',
  ),
  16 => 
  array (
    0 => true,
    1 => '2.0',
    2 => '2.0.0rc',
    3 => '>',
  ),
  18 => 
  array (
    0 => false,
    1 => '2.0',
    2 => '2.0.0pl',
    3 => '>',
  ),
  19 => 
  array (
    0 => false,
    1 => '2.0',
    2 => '2.0.1',
    3 => '>',
  ),
  20 => 
  array (
    0 => false,
    1 => '2.0.0',
    2 => '2',
    3 => '>',
  ),
  21 => 
  array (
    0 => false,
    1 => '2.0.0',
    2 => '2.0',
    3 => '>',
  ),
  22 => 
  array (
    0 => false,
    1 => '2.0.0',
    2 => '2.0.0',
    3 => '>',
  ),
  23 => 
  array (
    0 => true,
    1 => '2.0.0',
    2 => '2.0.0dev',
    3 => '>',
  ),
  24 => 
  array (
    0 => true,
    1 => '2.0.0',
    2 => '2.0.0alpha',
    3 => '>',
  ),
  25 => 
  array (
    0 => true,
    1 => '2.0.0',
    2 => '2.0.0beta',
    3 => '>',
  ),
  26 => 
  array (
    0 => true,
    1 => '2.0.0',
    2 => '2.0.0rc',
    3 => '>',
  ),
  28 => 
  array (
    0 => false,
    1 => '2.0.0',
    2 => '2.0.0pl',
    3 => '>',
  ),
  29 => 
  array (
    0 => false,
    1 => '2.0.0',
    2 => '2.0.1',
    3 => '>',
  ),
  30 => 
  array (
    0 => false,
    1 => '2.0.0dev',
    2 => '2',
    3 => '>',
  ),
  31 => 
  array (
    0 => false,
    1 => '2.0.0dev',
    2 => '2.0',
    3 => '>',
  ),
  32 => 
  array (
    0 => false,
    1 => '2.0.0dev',
    2 => '2.0.0',
    3 => '>',
  ),
  33 => 
  array (
    0 => false,
    1 => '2.0.0dev',
    2 => '2.0.0dev',
    3 => '>',
  ),
  34 => 
  array (
    0 => false,
    1 => '2.0.0dev',
    2 => '2.0.0alpha',
    3 => '>',
  ),
  35 => 
  array (
    0 => false,
    1 => '2.0.0dev',
    2 => '2.0.0beta',
    3 => '>',
  ),
  36 => 
  array (
    0 => false,
    1 => '2.0.0dev',
    2 => '2.0.0rc',
    3 => '>',
  ),
  38 => 
  array (
    0 => false,
    1 => '2.0.0dev',
    2 => '2.0.0pl',
    3 => '>',
  ),
  39 => 
  array (
    0 => false,
    1 => '2.0.0dev',
    2 => '2.0.1',
    3 => '>',
  ),
  40 => 
  array (
    0 => false,
    1 => '2.0.0alpha',
    2 => '2',
    3 => '>',
  ),
  41 => 
  array (
    0 => false,
    1 => '2.0.0alpha',
    2 => '2.0',
    3 => '>',
  ),
  42 => 
  array (
    0 => false,
    1 => '2.0.0alpha',
    2 => '2.0.0',
    3 => '>',
  ),
  43 => 
  array (
    0 => true,
    1 => '2.0.0alpha',
    2 => '2.0.0dev',
    3 => '>',
  ),
  44 => 
  array (
    0 => false,
    1 => '2.0.0alpha',
    2 => '2.0.0alpha',
    3 => '>',
  ),
  45 => 
  array (
    0 => false,
    1 => '2.0.0alpha',
    2 => '2.0.0beta',
    3 => '>',
  ),
  46 => 
  array (
    0 => false,
    1 => '2.0.0alpha',
    2 => '2.0.0rc',
    3 => '>',
  ),
  48 => 
  array (
    0 => false,
    1 => '2.0.0alpha',
    2 => '2.0.0pl',
    3 => '>',
  ),
  49 => 
  array (
    0 => false,
    1 => '2.0.0alpha',
    2 => '2.0.1',
    3 => '>',
  ),
  50 => 
  array (
    0 => false,
    1 => '2.0.0beta',
    2 => '2',
    3 => '>',
  ),
  51 => 
  array (
    0 => false,
    1 => '2.0.0beta',
    2 => '2.0',
    3 => '>',
  ),
  52 => 
  array (
    0 => false,
    1 => '2.0.0beta',
    2 => '2.0.0',
    3 => '>',
  ),
  53 => 
  array (
    0 => true,
    1 => '2.0.0beta',
    2 => '2.0.0dev',
    3 => '>',
  ),
  54 => 
  array (
    0 => true,
    1 => '2.0.0beta',
    2 => '2.0.0alpha',
    3 => '>',
  ),
  55 => 
  array (
    0 => false,
    1 => '2.0.0beta',
    2 => '2.0.0beta',
    3 => '>',
  ),
  56 => 
  array (
    0 => false,
    1 => '2.0.0beta',
    2 => '2.0.0rc',
    3 => '>',
  ),
  58 => 
  array (
    0 => false,
    1 => '2.0.0beta',
    2 => '2.0.0pl',
    3 => '>',
  ),
  59 => 
  array (
    0 => false,
    1 => '2.0.0beta',
    2 => '2.0.1',
    3 => '>',
  ),
  60 => 
  array (
    0 => false,
    1 => '2.0.0rc',
    2 => '2',
    3 => '>',
  ),
  61 => 
  array (
    0 => false,
    1 => '2.0.0rc',
    2 => '2.0',
    3 => '>',
  ),
  62 => 
  array (
    0 => false,
    1 => '2.0.0rc',
    2 => '2.0.0',
    3 => '>',
  ),
  63 => 
  array (
    0 => true,
    1 => '2.0.0rc',
    2 => '2.0.0dev',
    3 => '>',
  ),
  64 => 
  array (
    0 => true,
    1 => '2.0.0rc',
    2 => '2.0.0alpha',
    3 => '>',
  ),
  65 => 
  array (
    0 => true,
    1 => '2.0.0rc',
    2 => '2.0.0beta',
    3 => '>',
  ),
  66 => 
  array (
    0 => false,
    1 => '2.0.0rc',
    2 => '2.0.0rc',
    3 => '>',
  ),
  68 => 
  array (
    0 => false,
    1 => '2.0.0rc',
    2 => '2.0.0pl',
    3 => '>',
  ),
  69 => 
  array (
    0 => false,
    1 => '2.0.0rc',
    2 => '2.0.1',
    3 => '>',
  ),
  80 => 
  array (
    0 => true,
    1 => '2.0.0pl',
    2 => '2',
    3 => '>',
  ),
  81 => 
  array (
    0 => true,
    1 => '2.0.0pl',
    2 => '2.0',
    3 => '>',
  ),
  82 => 
  array (
    0 => true,
    1 => '2.0.0pl',
    2 => '2.0.0',
    3 => '>',
  ),
  83 => 
  array (
    0 => true,
    1 => '2.0.0pl',
    2 => '2.0.0dev',
    3 => '>',
  ),
  84 => 
  array (
    0 => true,
    1 => '2.0.0pl',
    2 => '2.0.0alpha',
    3 => '>',
  ),
  85 => 
  array (
    0 => true,
    1 => '2.0.0pl',
    2 => '2.0.0beta',
    3 => '>',
  ),
  86 => 
  array (
    0 => true,
    1 => '2.0.0pl',
    2 => '2.0.0rc',
    3 => '>',
  ),
  88 => 
  array (
    0 => false,
    1 => '2.0.0pl',
    2 => '2.0.0pl',
    3 => '>',
  ),
  89 => 
  array (
    0 => false,
    1 => '2.0.0pl',
    2 => '2.0.1',
    3 => '>',
  ),
  90 => 
  array (
    0 => true,
    1 => '2.0.1',
    2 => '2',
    3 => '>',
  ),
  91 => 
  array (
    0 => true,
    1 => '2.0.1',
    2 => '2.0',
    3 => '>',
  ),
  92 => 
  array (
    0 => true,
    1 => '2.0.1',
    2 => '2.0.0',
    3 => '>',
  ),
  93 => 
  array (
    0 => true,
    1 => '2.0.1',
    2 => '2.0.0dev',
    3 => '>',
  ),
  94 => 
  array (
    0 => true,
    1 => '2.0.1',
    2 => '2.0.0alpha',
    3 => '>',
  ),
  95 => 
  array (
    0 => true,
    1 => '2.0.1',
    2 => '2.0.0beta',
    3 => '>',
  ),
  96 => 
  array (
    0 => true,
    1 => '2.0.1',
    2 => '2.0.0rc',
    3 => '>',
  ),
  98 => 
  array (
    0 => true,
    1 => '2.0.1',
    2 => '2.0.0pl',
    3 => '>',
  ),
  99 => 
  array (
    0 => false,
    1 => '2.0.1',
    2 => '2.0.1',
    3 => '>',
  ),
  100 => 
  array (
    0 => true,
    1 => '2',
    2 => '2.0',
    3 => '=',
  ),
  101 => 
  array (
    0 => true,
    1 => '2.0',
    2 => '2.0.0',
    3 => '=',
  ),
  102 => 
  array (
    0 => true,
    1 => '2.0.0alpha',
    2 => '2.0.0 alpha',
    3 => '=',
  ),
  103 => 
  array (
    0 => true,
    1 => '2.0.0alpha',
    2 => '2.0.0-alpha',
    3 => '=',
  ),
  104 => 
  array (
    0 => true,
    1 => '2.0.0alpha',
    2 => '2.0.0a',
    3 => '=',
  ),
  105 => 
  array (
    0 => true,
    1 => '2.0.0beta',
    2 => '2.0.0b',
    3 => '=',
  ),
  106 => 
  array (
    0 => true,
    1 => '2.0.0pl',
    2 => '2.0.0p',
    3 => '=',
  ),
);
		return $essais;
	}






















?>