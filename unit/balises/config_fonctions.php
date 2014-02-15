<?php
// un filtre pour blinder les metas de test

function test_meta() {
$assoc = array('one' => 'element 1', 'two' => 'element 2');
$GLOBALS['meta'] = array(
	'zero' => 0,
	'zeroc' => '0',
	'chaine' => 'une chaine',
	'assoc' => $assoc,
	'serie' => serialize($assoc)
);

$GLOBALS['toto'] = array(
	'tzero' => 0,
	'tzeroc' => '0',
	'tchaine' => 'une chaine',
	'tassoc' => $assoc,
	'tserie' => serialize($assoc)
);

}
?>
