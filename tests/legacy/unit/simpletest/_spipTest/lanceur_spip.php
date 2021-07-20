<?php
/**
 * Démarre SPIP afin d'obtenir ses fonctions depuis
 * les jeux de tests unitaires de type simpletest
 */
$remonte = __DIR__ . '/';
while (!is_file($remonte."test.inc"))
	$remonte = $remonte."../";
require $remonte.'test.inc';

demarrer_simpletest();
