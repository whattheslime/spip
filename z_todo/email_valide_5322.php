<?php

	/**
	 * Lance la suite de tests de Dominic Sayers
	 * @author Gilles Vincent
	 * @link http://www.dominicsayers.com/isemail
	 * @link Norme 5322 : http://www.dominicsayers.com/isemail/isemail/RFC5322BNF.html
	 */
	
	$test = 'email_valider_5322';
	require '../test.inc';

	include_spip('inc/filtres');

	$err = false;
	$nb_positifs = 0;

	function unitTest ($email, $expected, $source = '', $comment = '') {
		$diagnosis	= email_valide($email);
		$valid		= ($diagnosis != '');
		$not		= ($valid) ? 'Valide' : "Non valide";
		$comment	= ($comment === '') ? "&nbsp;" : stripslashes("$comment");

		$class = 'ok';
		if ($valid !== $expected) {
			$GLOBALS['err'] = true;
			$class = 'erreur';
		} else {
		    $GLOBALS['nb_positifs']++;
		}
		return "<dd class='".$class."'><span class=\"address\"><em>$email</em></span> <br />\n" .
				"<span class=\"valid\">$not (".(($valid === $expected)?'OK':'erreur').")</span>" .
				($source ? "<span class=\"source\">Source : $source</span>":'') .
				(($comment != '&nbsp;') ? "<span class=\"comment\">($comment)</span>":'') .
				"</dd>\n";
	}

	$style = '<style type="text/css">' .
		'.valid,.comment,.source {margin-left:20px;}' .
		'.valid {display:inline-block;width:150px;}' .
		'</style>';

	$document = new DOMDocument();
	$document->load(dirname(__FILE__).'/email_valide_5322.xml');

	// Get version
	$suite = $document->getElementsByTagName('tests')->item(0);

	if ($suite->hasAttribute('version')) {
		$version = $suite->getAttribute('version');
		$entete = "<h3>Suite de tests de validit&eacute; des adresses email -- version $version</h3>\n";
	}

	$testList = $document->getElementsByTagName('test');

	for ($i = 0; $i < $testList->length; $i++) {
		$tagList = $testList->item($i)->childNodes;

		$address	= '';
		$valid		= '';
		$comment	= '';

		for ($j = 0; $j < $tagList->length; $j++) {
			$node = $tagList->item($j);
			if ($node->nodeType === XML_ELEMENT_NODE) {
				$name	= $node->nodeName;
				$$name	= $node->nodeValue;
			}
		}

		$expected	= ($valid === 'true') ? true : false;
		$needles	= array('\\0'	, '\\'		, '"'	, '$'	, chr(9)	,chr(10)	,chr(13));
		$substitutes	= array(chr(0)	, '\\\\'	, '\\"'	, '\\$'	, '\t'		,'\n'		,'\r');
		$address	= str_replace($needles, $substitutes, $address);
		$comment	= str_replace($needles, $substitutes, $comment);
		$source		= str_replace($needles, $substitutes, $source);

		$php .= "\$tests[] = unitTest(\"$address\", $valid, \"$source\", \"$comment\");\n";
	}

	eval($php);
	
	// si le tableau $err n'est pas vide ca va pas
	if ($GLOBALS['err']) { 
		echo $style;
		echo $entete;
		echo "<p><strong>Taux de succ&egrave;s</strong> : ".(intval(100 * $nb_positifs / $testList->length))." %</p>";
		echo ("<dl>\n".implode("\n", $tests)."</dl>");
	} else
		echo "OK";

?>
