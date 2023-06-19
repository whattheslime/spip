<?php

declare(strict_types=1);

$err = [];

$test = 'liens_classes';

$remonte = __DIR__ . '/';

while (! is_file($remonte . 'test.inc')) {
	$remonte .= '../';
}

require $remonte . 'test.inc';

include_spip('inc/texte');

include_spip('inc/lang');

$id = sql_getfetsel('id_article', 'spip_articles', "statut='publie'", '', '', '0,1');

if (! $id) {
	echo 'NA Necessite un article publie<br />';
}

$p0 = "[->art{$id}]";

if (
	!($c = extraire_attribut(propre($p0), 'class'))
	|| !str_contains($c, 'spip_in')
	|| str_contains($c, 'spip_out')
) {
	$err[] = "Classe {$c} errone dans {$p0} : " . PtoBR(propre($p0));
}

$id = sql_getfetsel('id_rubrique', 'spip_rubriques', "statut='publie'", '', '', '0,1');

if (! $id) {
	echo 'NA Necessite une rubrique publiee<br />';
}

$p0 = "[->rub{$id}]";

if (
	!($c = extraire_attribut(propre($p0), 'class'))
	|| !str_contains($c, 'spip_in')
	|| str_contains($c, 'spip_out')
) {
	$err[] = "Classe {$c} errone dans {$p0} : " . PtoBR(propre($p0));
}

$id = sql_getfetsel('id_syndic', 'spip_syndic', "statut='publie'", '', '', '0,1');

if (! $id) {
	echo 'NA Necessite un site publie<br />';
}

$p0 = "[->site{$id}]";

if (
	!($c = extraire_attribut(propre($p0), 'class'))
	|| str_contains($c, 'spip_in')
	|| !str_contains($c,'spip_out')
) {
	$err[] = "Classe {$c} errone dans {$p0} : " . PtoBR(propre($p0));
}

// si le tableau $err est pas vide ca va pas

if (count($err) > 0) {
	echo '<dl><dt>' . implode('</dt><dt>', $err) . '</dt></dl>';
} else {
	echo 'OK';
}
