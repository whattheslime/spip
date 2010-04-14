<?php

	$test = 'affdate';
	require '../test.inc';

	include_spip('inc/filtres');
	include_spip('inc/lang');
	
	$lang = $GLOBALS['spip_lang'];

	$GLOBALS['spip_lang'] = 'ca';
	$essais["nc-01-2010"] = array('gener de 2010', "2010-01-00 01:00:00");
	$essais["nc-nc-2010"] = array('2010', "2010-00-00 01:00:00");
	$err[$GLOBALS['spip_lang']] = tester_fun('affdate', $essais);

	$GLOBALS['spip_lang'] = 'de';
	$essais["nc-01-2010"] = array('Januar 2010', "2010-01-00 01:00:00");
	$essais["nc-nc-2010"] = array('2010', "2010-00-00 01:00:00");
	$err[$GLOBALS['spip_lang']] = tester_fun('affdate', $essais);
	
	$GLOBALS['spip_lang'] = 'en';
	$essais["nc-01-2010"] = array('January 2010', "2010-01-00 01:00:00");
	$essais["nc-nc-2010"] = array('2010', "2010-00-00 01:00:00");
	$err[$GLOBALS['spip_lang']] = tester_fun('affdate', $essais);

	$GLOBALS['spip_lang'] = 'es';
	$essais["nc-01-2010"] = array('enero de 2010', "2010-01-00 01:00:00");
	$essais["nc-nc-2010"] = array('2010', "2010-00-00 01:00:00");
	$err[$GLOBALS['spip_lang']] = tester_fun('affdate', $essais);

	$GLOBALS['spip_lang'] = 'fr';
	$essais["nc-01-2010"] = array('janvier 2010', "2010-01-00 01:00:00");
	$essais["nc-nc-2010"] = array('2010', "2010-00-00 01:00:00");
	$err[$GLOBALS['spip_lang']] = tester_fun('affdate', $essais);

	$GLOBALS['spip_lang'] = 'it';
	$essais["nc-01-2010"] = array('Gennaio 2010', "2010-01-00 01:00:00");
	$essais["nc-nc-2010"] = array('2010', "2010-00-00 01:00:00");
	$err[$GLOBALS['spip_lang']] = tester_fun('affdate', $essais);

	$GLOBALS['spip_lang'] = 'nl';
	$essais["nc-01-2010"] = array('Januari 2010', "2010-01-00 01:00:00");
	$essais["nc-nc-2010"] = array('2010', "2010-00-00 01:00:00");
	$err[$GLOBALS['spip_lang']] = tester_fun('affdate', $essais);

	$GLOBALS['spip_lang'] = 'pl';
	$essais["nc-01-2010"] = array('Stycze&#324; 2010', "2010-01-00 01:00:00");
	$essais["nc-nc-2010"] = array('2010', "2010-00-00 01:00:00");
	$err[$GLOBALS['spip_lang']] = tester_fun('affdate', $essais);

	$GLOBALS['spip_lang'] = 'pt';
	$essais["nc-01-2010"] = array('Janeiro de 2010', "2010-01-00 01:00:00");
	$essais["nc-nc-2010"] = array('2010', "2010-00-00 01:00:00");
	$err[$GLOBALS['spip_lang']] = tester_fun('affdate', $essais);

	$GLOBALS['spip_lang'] = $lang;

	// si le tableau $err est pas vide ca va pas
	$ok = true;
	foreach ($err as $l=>$e) {
		if (count($e)){
			$ok = false;
			echo $l;
			echo '<dl>' . join('', $e) . '</dl>';
		}
	}

	if ($ok)
		echo "OK";

?>
