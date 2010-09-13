<?php

	// nom du test
	$test = 'expliquer_config';

	// recherche test.inc qui nous ouvre au monde spip
	$deep = 1;
	$include = '../tests/test.inc';
	while (!defined('_SPIP_TEST_INC') && $deep++ < 6) {
		$include = '../' . $include;
		@include $include;
	}
	if (!defined('_SPIP_TEST_INC')) {
		die("Pas de $include");
	}

	include_spip('inc/config');

### expliquer_config ###


	$essais[] = array(array('meta',null,array()), '');
	$essais[] = array(array('meta','casier',array()), 'casier');
	$essais[] = array(array('meta','casier',array('sous')), 'casier/sous');
	$essais[] = array(array('meta','casier',array('sous','plus','bas','encore')), 'casier/sous/plus/bas/encore');

	$essais[] = array(array('meta',null,array()), '/meta');
	$essais[] = array(array('meta','casier',array()), '/meta/casier');
	$essais[] = array(array('meta','casier',array('sous')), '/meta/casier/sous');
	$essais[] = array(array('meta','casier',array('sous','plus','bas','encore')), '/meta/casier/sous/plus/bas/encore');

	$essais[] = array(array('toto',null,array()), '/toto');
	$essais[] = array(array('toto','casier',array()), '/toto/casier');
	$essais[] = array(array('toto','casier',array('sous')), '/toto/casier/sous');
	$essais[] = array(array('toto','casier',array('sous','plus','bas','encore')), '/toto/casier/sous/plus/bas/encore');

	$err = tester_fun('expliquer_config', $essais);
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<b>expliquer_config</b><dl>' . join('', $err) . '</dl>');
	}

	echo "OK";

?>
