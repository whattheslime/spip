<?php
/**
 * Test unitaire de la fonction commuter_class
 * du fichier ./inc/filtres.php
 *
 * genere automatiquement par TestBuilder
 * le 2021-02-19 14:56
 */

	$test = 'commuter_class';
	$remonte = __DIR__ . '/';
	while (!is_file($remonte."test.inc"))
		$remonte = $remonte."../";
	require $remonte.'test.inc';
	find_in_path("./inc/filtres.php",'',true);

	// chercher la fonction si elle n'existe pas
	if (!function_exists($f='commuter_class')){
		find_in_path("inc/filtres.php",'',true);
		$f = chercher_filtre($f);
	}

	//
	// hop ! on y va
	//
	$err = tester_fun($f, essais_commuter_class());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_commuter_class(){
		$essais = array (
  0 => 
  array (
    0 => '<span class=\'maclasse-prefixe suffixe-maclasse maclasse--bem\'>toto</span>',
    1 => '<span class="maclasse maclasse-prefixe suffixe-maclasse maclasse--bem">toto</span>',
    2 => 'maclasse',
  ),
  1 => 
  array (
    0 => '<span class=\'maclasse maclasse-prefixe suffixe-maclasse maclasse--bem autreclass\'>toto</span>',
    1 => '<span class="maclasse maclasse-prefixe suffixe-maclasse maclasse--bem">toto</span>',
    2 => 'autreclass',
  ),
  2 => 
  array (
    0 => '<span class=\'maclasse-prefixe suffixe-maclasse maclasse--bem maclasse1 maclasse2\'>toto</span>',
    1 => '<span class="maclasse maclasse-prefixe suffixe-maclasse maclasse--bem">toto</span>',
    2 => 'maclasse1 maclasse maclasse2',
  ),
  3 => 
  array (
    0 => '<span class="maclasse maclasse-prefixe suffixe-maclasse maclasse--bem">toto</span>',
    1 => '<span class="maclasse maclasse-prefixe suffixe-maclasse maclasse--bem">toto</span>',
    2 => '<span class="maclasse maclasse-prefixe suffixe-maclasse maclasse--bem">toto</span>',
  ),
);
		return $essais;
	}





?>