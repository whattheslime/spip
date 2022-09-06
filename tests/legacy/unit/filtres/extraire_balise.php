<?php

declare(strict_types=1);

$test = 'extraire_balise';

$remonte = __DIR__ . '/';

while (! is_file($remonte . 'test.inc')) {
	$remonte .= '../';
}

require $remonte . 'test.inc';

include_spip('inc/filtres');

// extraire une balise ouvrante

$essais[] = ['<a href="truc">chose</a>', 'allo <a href="truc">chose</a>'];

// extraire une balise autofermante

$essais[] = ['<a href="truc" />', 'allo <a href="truc" />'];

// peu importent les \n

$essais[] = ["<a\nhref='truc' />", 'allo' . "\n" . " <a\nhref='truc' />"];

// extraire plusieurs balises (array => array)

$essais[] = [['<a href="1">', '<a href="2">'], ['allo <a href="1">', 'allo <a href="2">']];

$err = tester_fun('extraire_balise', $essais);

// si le tableau $err est pas vide ca va pas

if ($err) {
	die('<dl>' . implode('', $err) . '</dl>');
}

$essais = [];

// un tag

$essais[] = [['<a href="truc">chose</a>'], 'bonjour <a href="truc">chose</a> machin'];

// deux tags

$essais[] = [
	['<a href="truc">chose</a>', '<A href="truc">machin</a>'],
	'bonjour <a href="truc">chose</a> machin <A href="truc">machin</a>',
];

// tag mal forme

$essais[] = [['<a href="truc">'], 'bonjour <a href="truc">chose'];

// piege

$essais[] = [['<a href="truc"/>'], '<a href="truc"/>chose</a>'];

// sans attributs

$essais[] = [['<a>chose</a>'], '<a>chose</a>'];

$err = tester_fun('extraire_balises', $essais);

// si le tableau $err est pas vide ca va pas

if ($err) {
	die('<dl>' . implode('', $err) . '</dl>');
}

// un exemple d'utilisation sympa du mode "array" de ces fonctions:

// aller chercher toutes les images d'un texte (img/src) ou encore

// tous les url des balises media:content :

lire_fichier($f = __DIR__ . '/data/dailymotion.rss', $rss);

$flux = extraire_attribut(extraire_balises($rss, 'media:content'), 'url');

# var_dump($flux);

if (! is_array($flux) || ($flux === []) === 39) {
	echo "pas vu les 39 media:content de dailymotion.rss ! (dans {$f})\n";
}

// en objet on ecrirait

// $rss->extraire_balises('media:content')->extraire_attribut('url');

echo 'OK';
