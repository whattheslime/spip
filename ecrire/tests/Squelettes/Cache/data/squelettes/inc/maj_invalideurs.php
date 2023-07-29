<?php

use Spip\Test\Squelettes\Balise\CacheSessionTest;

/**
 * Fonction chargée de faire les assertions d'erreur si l'invalideur session n'est pas comme on l'attend
 *
 * @param string $cache_key
 * @param array $page
 */
 function inc_maj_invalideurs($cache_key, $page): void {
	if (!isset($page['contexte']['assert_session'])) {
		return;
	}

	$expected_session = (bool) $page['contexte']['assert_session'];
	$has_session = $page['invalideurs']['session'] ?? false;

	if ($expected_session) {
		if (!$has_session) {
			CacheSessionTest::addError('PAS de session', $page);
		}
	} elseif ($has_session) {
		CacheSessionTest::addError(sprintf('SESSION %s', $has_session), $page);
	}
}
