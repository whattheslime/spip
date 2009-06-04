<?php

	$test = 'extraire_attribut';
	require '../test.inc';

	include_spip('inc/texte');
	lang_select('fr');

	$texte = '
Le r&#233;sultat se pr&#233;sente sous la forme suivante :
<code>root@bennybox# ls /var/state/mysql/
alternc/         spip/         truc/
zope/

root@bennybox# ls /var/state/mysql/spip/
spip_articles.sql.gz    spip_breves.sql.gz ....
</code>
';

	echo ($a = propre($texte)) == '<p>Le r&#233;sultat se pr&#233;sente sous la forme suivante&nbsp;:</p>
<div style=\'text-align: left;\' class=\'spip_code\' dir=\'ltr\'><code>root@bennybox# ls /var/state/mysql/<br />
alternc/ &nbsp; &nbsp; &nbsp; &nbsp; spip/ &nbsp; &nbsp; &nbsp; &nbsp; truc/<br />
zope/<br />
<br />
root@bennybox# ls /var/state/mysql/spip/<br />
spip_articles.sql.gz &nbsp; &nbsp;spip_breves.sql.gz ....</code></div>'
	? 'OK'
	: var_export($a,1);
	
?>
