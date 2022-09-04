<?php

	$test = 'affdate';
	$remonte = __DIR__ . '/';
	while (!is_file($remonte."test.inc"))
		$remonte .= "../";

	require $remonte.'test.inc';

	include_spip('inc/filtres');
	include_spip('inc/lang');

	$lang = $GLOBALS['spip_lang'];

	$GLOBALS['spip_lang'] = 'ca';
	$essais["nc-01-2010"] = ['gener de 2010', "2010-01-00 01:00:00"];
	$essais["nc-nc-2010"] = ['2010', "2010-00-00 01:00:00"];
	$err[$GLOBALS['spip_lang']] = tester_fun('affdate', $essais);

	$GLOBALS['spip_lang'] = 'de';
	$essais["nc-01-2010"] = ['Januar 2010', "2010-01-00 01:00:00"];
	$essais["nc-nc-2010"] = ['2010', "2010-00-00 01:00:00"];
	$err[$GLOBALS['spip_lang']] = tester_fun('affdate', $essais);

	$GLOBALS['spip_lang'] = 'en';
	$essais["nc-01-2010"] = ['January 2010', "2010-01-00 01:00:00"];
	$essais["nc-nc-2010"] = ['2010', "2010-00-00 01:00:00"];
	$err[$GLOBALS['spip_lang']] = tester_fun('affdate', $essais);

	$GLOBALS['spip_lang'] = 'es';
	$essais["nc-01-2010"] = ['enero de 2010', "2010-01-00 01:00:00"];
	$essais["nc-nc-2010"] = ['2010', "2010-00-00 01:00:00"];
	$err[$GLOBALS['spip_lang']] = tester_fun('affdate', $essais);

	$GLOBALS['spip_lang'] = 'fr';
	$essais["nc-01-2010"] = ['janvier 2010', "2010-01-00 01:00:00"];
	$essais["nc-nc-2010"] = ['2010', "2010-00-00 01:00:00"];
	$err[$GLOBALS['spip_lang']] = tester_fun('affdate', $essais);

	$GLOBALS['spip_lang'] = 'it';
	$essais["nc-01-2010"] = ['Gennaio 2010', "2010-01-00 01:00:00"];
	$essais["nc-nc-2010"] = ['2010', "2010-00-00 01:00:00"];
	$err[$GLOBALS['spip_lang']] = tester_fun('affdate', $essais);

	$GLOBALS['spip_lang'] = 'nl';
	$essais["nc-01-2010"] = ['januari 2010', "2010-01-00 01:00:00"];
	$essais["nc-nc-2010"] = ['2010', "2010-00-00 01:00:00"];
	$err[$GLOBALS['spip_lang']] = tester_fun('affdate', $essais);

	$GLOBALS['spip_lang'] = 'pl';
	$essais["nc-01-2010"] = ['Styczeń 2010', "2010-01-00 01:00:00"];
	$essais["nc-nc-2010"] = ['2010', "2010-00-00 01:00:00"];
	$err[$GLOBALS['spip_lang']] = tester_fun('affdate', $essais);

	$GLOBALS['spip_lang'] = 'pt';
	$essais["nc-01-2010"] = ['Janeiro de 2010', "2010-01-00 01:00:00"];
	$essais["nc-nc-2010"] = ['2010', "2010-00-00 01:00:00"];
	$err[$GLOBALS['spip_lang']] = tester_fun('affdate', $essais);

	$GLOBALS['spip_lang'] = $lang;

	// si le tableau $err est pas vide ca va pas
	$ok = true;
	foreach ($err as $l=>$e) {
		if (count($e) > 0){
			$ok = false;
			echo $l;
			echo '<dl>' . implode('', $e) . '</dl>';
		}
	}

	if ($ok)
		echo "OK";


