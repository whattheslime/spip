<?php

	$test = 'extraire_balise';
	require '../test.inc';

	include_spip('inc/filtres');

	// extraire une balise ouvrante
	$essais[] = array('<a href="truc">chose</a>', 'allo <a href="truc">chose</a>');

	// extraire une balise autofermante
	$essais[] = array('<a href="truc" />', 'allo <a href="truc" />');

	// peu importent les \n
	$essais[] = array("<a\nhref='truc' />", 'allo'."\n"." <a\nhref='truc' />");

	// extraire plusieurs balises (array => array)
	$essais[] = array(
		array('<a href="1">', '<a href="2">'),
		array('allo <a href="1">', 'allo <a href="2">')
	);

	$err = tester_fun('extraire_balise', $essais);

	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}



	$essais = array();

	// un tag
	$essais[] = array(
		array('<a href="truc">chose</a>'),
		'bonjour <a href="truc">chose</a> machin'
	);

	// deux tags
	$essais[] = array(
		array('<a href="truc">chose</a>', '<A href="truc">machin</a>'),
		'bonjour <a href="truc">chose</a> machin <A href="truc">machin</a>'
	);

	// tag mal forme
	$essais[] = array(
		array('<a href="truc">'),
		'bonjour <a href="truc">chose'
	);

	// piege
	$essais[] = array(
		array('<a href="truc"/>'),
		'<a href="truc"/>chose</a>'
	);

	// sans attributs
	$essais[] = array(
		array('<a>chose</a>'),
		'<a>chose</a>'
	);



	$err = tester_fun('extraire_balises', $essais);

	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	// un exemple d'utilisation sympa du mode "array" de ces fonctions:
	// aller chercher toutes les images d'un texte (img/src) ou encore
	// tous les url des balises media:content :
	lire_fichier('tests/syndication/data/dailymotion.rss', $rss);
	$flux = extraire_attribut(extraire_balises($rss, 'media:content'), 'url');
	# var_dump($flux);
	if (!is_array($flux) OR !count($flux)==39)
		echo "pas vu les 39 media:content de dailymotion.rss !\n";

	// en objet on ecrirait
	// $rss->extraire_balises('media:content')->extraire_attribut('url');

	echo "OK";

?>
