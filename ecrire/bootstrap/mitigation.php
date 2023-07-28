<?php

/*
 * Détecteur de robot d'indexation
 */
if (!defined('_IS_BOT')) {
	define(
		'_IS_BOT',
		isset($_SERVER['HTTP_USER_AGENT'])
		&& preg_match(
			// mots generiques
			',bot|slurp|crawler|spider|webvac|yandex|'
			// MSIE 6.0 est un botnet 99,9% du temps, on traite donc ce USER_AGENT comme un bot
			. 'MSIE 6\.0|'
			// UA plus cibles
			. '80legs|accoona|AltaVista|ASPSeek|Baidu|Charlotte|EC2LinkFinder|eStyle|facebook|flipboard|hootsuite|FunWebProducts|Google|Genieo|INA dlweb|InfegyAtlas|Java VM|LiteFinder|Lycos|MetaURI|Moreover|Rambler|Scooter|ScrubbyBloglines|Yahoo|Yeti'
			. ',i',
			(string)$_SERVER['HTTP_USER_AGENT']
		)
	);
}
