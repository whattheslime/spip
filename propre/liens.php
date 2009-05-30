<?php

	$test = 'liens';
	require '../test.inc';

	include_spip('inc/texte');
	include_spip('inc/lang');

	$s = spip_query("SELECT * FROM spip_articles WHERE statut='publie' AND lang>'' LIMIT 0,1");
	$t = sql_fetch($s);
	if ($t['lang'] == 'eo')
		lang_select('fa');
	else
		lang_select('eo');
	$p0 = '[->'.$t['id_article'].']';

	$p1 = '[bla {blabla}->url]'; // blabla ne peut pas etre un hreflang
	$p2 = '[bla{en}->url]';
	$p3 = '[bla|bulle de savon{eo}->url]';
	$p4 = '[bla|fa->url]'; // fa est hreflang ET title
	$p5 = '[bla|bulle de savon->url]';
	$p6 = '[<multi>[fr]X[eo]Y[fa]Z</multi>->url]';
	$p7 = '[uneancre<-] a [->www.monsite.tld]';
	$p8 = 'un superbe www.monsite.tld, pas mal';
	$p9 = 'un superbe http://www.monsite.tld, pas mal';
	$p10 = 'un superbe https://www.monsite.tld, pas mal';
	$p11 = '<flv|url=http://rezo.net/>';


	if (extraire_attribut(propre($p0), 'hreflang') !== $t['lang'])
		$err[] = "hreflang automatique errone dans $p0 : ".PtoBR(propre($p0));

	if (extraire_attribut(propre($p1), 'href') !== 'url')
		$err[] = "url mal extrait de $p1";
	if (extraire_attribut(propre($p1), 'hreflang') == 'blabla')
		$err[] = "hreflang errone dans $p1";
	if (supprimer_tags(propre($p1)) !== 'bla blabla')
		$err[] = "texte du lien abime dans $p1";

	if (extraire_attribut(propre($p2), 'href') !== 'url')
		$err[] = "url mal extrait de $p2";
	if (extraire_attribut(propre($p2), 'hreflang') !== 'en')
		$err[] = "hreflang errone dans $p2";
	if (supprimer_tags(propre($p2)) !== 'bla')
		$err[] = "texte du lien abime dans $p2";

	if (extraire_attribut(propre($p3), 'href') !== 'url')
		$err[] = "url mal extrait de $p3";
	if (extraire_attribut(propre($p3), 'hreflang') !== 'eo')
		$err[] = "hreflang errone dans $p3";
	if (extraire_attribut(propre($p3), 'title') !== 'bulle de savon')
		$err[] = "title errone dans $p3";
	if (supprimer_tags(propre($p3)) !== 'bla')
		$err[] = "texte du lien abime dans $p3";

	if (extraire_attribut(propre($p4), 'href') !== 'url')
		$err[] = "url mal extrait de $p4";
	if (extraire_attribut(propre($p4), 'hreflang') !== 'fa')
		$err[] = "hreflang errone dans $p4";
	if (extraire_attribut(propre($p4), 'title') !== 'fa')
		$err[] = "title errone dans $p4";
	if (supprimer_tags(propre($p4)) !== 'bla')
		$err[] = "texte du lien abime dans $p4";

	if (extraire_attribut(propre($p5), 'href') !== 'url')
		$err[] = "url mal extrait de $p5";
	if (extraire_attribut(propre($p5), 'hreflang') !== NULL)
		$err[] = "hreflang errone dans $p5";
	if (extraire_attribut(propre($p5), 'title') !== 'bulle de savon')
		$err[] = "title errone dans $p5";
	if (supprimer_tags(propre($p5)) !== 'bla')
		$err[] = "texte du lien abime dans $p5";
	if (supprimer_tags(propre($p6)) !== 'Y')
		$err[] = "multi abime dans $p6";

	# (('<multi>[fr]X[en]Y</multi>')); => pre_typo

	if ('http://www.monsite.tld'
	!== $a = extraire_attribut(array_pop(extraire_balises(propre($p7), 'a')), 'href'))
		$err[] = $a.': erreur sur le lien '.$p7;

	if ('http://www.monsite.tld'
	!== $a =extraire_attribut(extraire_balise(propre($p8), 'a'), 'href'))
		$err[] = $a.': erreur sur le lien '.$p8;

	if ('http://www.monsite.tld'
	!== $a =extraire_attribut(extraire_balise(propre($p9), 'a'), 'href'))
		$err[] = $a.': erreur sur le lien '.$p9;

	if ('https://www.monsite.tld'
	!== $a =extraire_attribut(extraire_balise(propre($p10), 'a'), 'href'))
		$err[] = $a.': erreur sur le lien '.$p10;

	if ('https://www.monsite.tld'
	!== $a =extraire_attribut(extraire_balise(propre($p10), 'a'), 'href'))
		$err[] = $a.': erreur sur le lien '.$p10;

	if ("<p><flv|url=http://rezo.net/></p>"
	!== $a = propre($p11))
		$err[] = $a.': erreur sur le modele '.$p11;


	if ($err)
		var_dump($err);
	else
		echo "OK";

?>
