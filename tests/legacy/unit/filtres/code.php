<?php

$test = 'code';
$remonte = __DIR__ . '/';
while (!is_file($remonte."test.inc"))
	$remonte = $remonte."../";
require $remonte.'test.inc';
find_in_path("./inc/texte.php",'',true);


//
// hop ! on y va
//
$err = tester_fun('propre', essais_code_dist());

// si le tableau $err est pas vide ca va pas
if ($err) {
	die ('<dl>' . join('', $err) . '</dl>');
}

echo "OK";


function essais_code_dist(){
	$essais = [
		[
			0 =>
				'<p>Le r&#233;sultat se pr&#233;sente sous la forme suivante&nbsp;:</p>
<div style=\'text-align: left;\' class=\'spip_code\' dir=\'ltr\'><code>root@bennybox# ls /var/state/mysql/<br />
alternc/ &nbsp; &nbsp; &nbsp; &nbsp; spip/ &nbsp; &nbsp; &nbsp; &nbsp; truc/<br />
zope/<br />
<br />
root@bennybox# ls /var/state/mysql/spip/<br />
spip_articles.sql.gz &nbsp; &nbsp;spip_breves.sql.gz ....</code></div>',
			1 => '
Le r&#233;sultat se pr&#233;sente sous la forme suivante :
<code>root@bennybox# ls /var/state/mysql/
alternc/         spip/         truc/
zope/

root@bennybox# ls /var/state/mysql/spip/
spip_articles.sql.gz    spip_breves.sql.gz ....
</code>
'
		],
	];

	return $essais;
}

