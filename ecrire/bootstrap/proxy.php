<?php

/**
 * Prendre en compte les proxy
 *
 * - entetes HTTP_X_FORWARDED_XX
 * - ip
 */

if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
	if (empty($_SERVER['HTTP_X_FORWARDED_HOST'])) {
		$_SERVER['HTTP_X_FORWARDED_HOST'] = $_SERVER['HTTP_HOST'];
	}
	if (empty($_SERVER['HTTP_X_FORWARDED_PORT'])) {
		$_SERVER['HTTP_X_FORWARDED_PORT'] = 443;
	}
}

if (isset($_SERVER['HTTP_X_FORWARDED_HOST'])) {
	if (isset($_SERVER['HTTP_X_FORWARDED_PORT']) && is_numeric($_SERVER['HTTP_X_FORWARDED_PORT'])) {
		$_SERVER['SERVER_PORT'] = $_SERVER['HTTP_X_FORWARDED_PORT'];
		if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
			$_SERVER['HTTPS'] = 'on';
			if (isset($_SERVER['REQUEST_SCHEME'])) {
				$_SERVER['REQUEST_SCHEME'] = 'https';
			}
		}
	}
	$host = $_SERVER['HTTP_X_FORWARDED_HOST'];
	if (str_contains((string) $host, ',')) {
		$h = explode(',', (string) $host);
		$host = trim(reset($h));
	}
	// securite sur le contenu de l'entete
	$host = strtr($host, "<>?\"\{\}\$'` \r\n", '____________');
	$_SERVER['HTTP_HOST'] = $host;
}

//
// On note le numero IP du client dans la variable $ip
//
if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	if (str_contains((string) $ip, ',')) {
		$ip = explode(',', (string) $ip);
		$ip = reset($ip);
	}
	// ecraser $_SERVER['REMOTE_ADDR'] si elle est en localhost
	if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] === '127.0.0.1') {
		$_SERVER['REMOTE_ADDR'] = $ip;
	}
}
if (isset($_SERVER['REMOTE_ADDR'])) {
	$ip = $_SERVER['REMOTE_ADDR'];
}
