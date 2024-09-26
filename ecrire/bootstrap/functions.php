<?php

/**
 * Différentes fonctions chargées au démarrage de SPIP
 *
 * Ces fichiers ne peuvent pas être surchargés dans des plugins
 */

include_once __DIR__ . '/inc/auth.php';
include_once __DIR__ . '/inc/form.php';
include_once __DIR__ . '/inc/initialization.php';
include_once __DIR__ . '/inc/i18n.php';
include_once __DIR__ . '/inc/jobs.php';
include_once __DIR__ . '/inc/loading.php';
include_once __DIR__ . '/inc/logging.php';
include_once __DIR__ . '/inc/path.php';
include_once __DIR__ . '/inc/pipeline.php';
include_once __DIR__ . '/inc/request.php';
include_once __DIR__ . '/inc/sanitize.php';
include_once __DIR__ . '/inc/templating.php';
include_once __DIR__ . '/inc/utils.php';
include_once __DIR__ . '/inc/urls.php';
require_once dirname(__DIR__) . '/base/connect_sql.php';
