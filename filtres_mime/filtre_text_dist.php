<?php
/**
 * Test unitaire de la fonction filtre_text_txt_dist
 * du fichier inc/filtres.php
 *
 * genere automatiquement par testbuilder
 * le 
 */

	$test = 'filtre_text_txt_dist';
	require '../test.inc';
	find_in_path("inc/filtres_mime.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('filtre_text_dist', essais_filtre_text_txt_dist());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_filtre_text_txt_dist(){
		$essais = array (
  0 => 
  array (
    0 => '<pre></pre>',
    1 => '',
  ),
  2 => 
  array (
    0 => '<pre>0</pre>',
    1 => '0',
  ),
  3 => 
  array (
    0 => '<pre>Un texte avec des &lt;a href="http://spip.net"&gt;liens&lt;/a&gt; [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net</pre>',
    1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->http://www.spip.net] http://www.spip.net',
  ),
  4 => 
  array (
    0 => '<pre>Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;</pre>',
    1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
  ),
  5 => 
  array (
    0 => '<pre>Un texte sans entites &&lt;&gt;"\'</pre>',
    1 => 'Un texte sans entites &<>"\'',
  ),
  6 => 
  array (
    0 => '<pre>{{{Des raccourcis}}} {italique} {{gras}} &lt;code&gt;du code&lt;/code&gt;</pre>',
    1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
  ),
  7 => 
  array (
    0 => '<pre>Un modele &lt;modeleinexistant|lien=[-&gt;http://www.spip.net]></pre>',
    1 => 'Un modele <modeleinexistant|lien=[->http://www.spip.net]>',
  ),
  8 => 
  array (
    0 => '<pre>bla bla</pre>',
    1 => 'bla bla',
  ),
  9 => 
  array (
    0 => '<pre>0</pre>',
    1 => 0,
  ),
  10 => 
  array (
    0 => '<pre>-1</pre>',
    1 => -1,
  ),
  11 => 
  array (
    0 => '<pre>1</pre>',
    1 => 1,
  ),
  12 => 
  array (
    0 => '<pre>2</pre>',
    1 => 2,
  ),
  13 => 
  array (
    0 => '<pre>3</pre>',
    1 => 3,
  ),
  14 => 
  array (
    0 => '<pre>4</pre>',
    1 => 4,
  ),
  15 => 
  array (
    0 => '<pre>5</pre>',
    1 => 5,
  ),
  16 => 
  array (
    0 => '<pre>6</pre>',
    1 => 6,
  ),
  17 => 
  array (
    0 => '<pre>7</pre>',
    1 => 7,
  ),
  18 => 
  array (
    0 => '<pre>10</pre>',
    1 => 10,
  ),
  19 => 
  array (
    0 => '<pre>20</pre>',
    1 => 20,
  ),
  20 => 
  array (
    0 => '<pre>30</pre>',
    1 => 30,
  ),
  21 => 
  array (
    0 => '<pre>50</pre>',
    1 => 50,
  ),
  22 => 
  array (
    0 => '<pre>100</pre>',
    1 => 100,
  ),
  23 => 
  array (
    0 => '<pre>1000</pre>',
    1 => 1000,
  ),
  24 => 
  array (
    0 => '<pre>10000</pre>',
    1 => 10000,
  ),
  29 => 
  array (
    0 => '<pre></pre>',
    1 => NULL,
  ),
);
		return $essais;
	}































?>