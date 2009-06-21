<?php
	
	$test = 'email_valide';
	require '../test.inc';
	include_spip('inc/filtres');
?>
		
	<p>Il existe une diff&eacute;rence entre la d&eacute;finition g&eacute;n&eacute;rale (RFC 822) et l&#x27;usage r&eacute;el qui est fait des adresses de courriel.</p>
	
	<p>Les registar et h&eacute;bergeurs principaux ne respectent d&#x27;ailleurs pas cette d&eacute;finition alors m&ecirc;me que ce sont eux qui permettent &agrave; la majorit&eacute; des gens de d&eacute;finir leurs adresses mails et qui bien souvent servent de serveur SMTP. (Il ne m&#x27;est pas possible actuellement de tester d&#x27;autres serveurs SMTP).</p>
	
	<p>Selon Dreamhost :</p>
	<ul>
		<li>Un courriel commence par une lettre, un chiffre, un tiret, un tiret bas, un plus ou un &amp;,</li>
		<li>Un courriel peut contenir des caract&egrave;res alphanum, des points, des tirets, des tirets bas, des plus, des &amp;.</li>
	</ul>
	<p>L&#x27;adresse <em>&amp;-_+.spip17&amp;-_+.@domaine.com</em> est donc valide.</p>

	<p>Selon OVH :</p>
	<ul>
		<li>Un courriel commence par une lettre, un chiffre, un tiret ou un tiret bas,</li>
		<li>Un courriel peut contenir des caract&egrave;res alphanum, des points, des tirets ou des tirets bas.</li>
	</ul>
	<p>L&#x27;adresse <em>&amp;-_+.spip17&amp;-_+.@domaine.com</em> n&#x27;est donc pas valide et m&ecirc;me rejet&eacute;e par le serveur SMTP d&#x27;OVH. L&#x27;adresse -spip17_.@domaine.com est quant &agrave; elle valid&eacute;e.</p>
	
	
	<p>De plus, il convient de faire le distingo entre un usage que je pense classique et majoritaire de SPIP : Internet, et un usage limit&eacute; &agrave; une utilisation locale. Peut &ecirc;tre que SPIP devrait avoir 2 regexp diff&eacute;rentes pour ces 2 usages, deux fonctions ou 1 argument suppl&eacute;mentaire &agrave; l&#x27;actuelle.</p>
	<p>Une utilisation locale permet des noms de domaines vari&eacute;s, et sans extension.</p>

	<p>Les noms de domaines publics (qui, je pense, sont majoritairement utilis&eacute;s pour SPIP) quant &agrave; eux respectent des r&egrave;gles plus strictes :</p>
	<ul>
		<li>Un nom de domaine commence par une lettre ou un chiffre,</li>
		<li>Un nom de domaine peut contenir des caract&egrave;res alphanum&eacute;riques, des tirets ou des points (cas des sous domaines),</li>
		<li>Une extension de domaine <strong>public</strong> contient au moins 2 lettres, au plus 6. ( http://www.iana.org/domains/root/db/index.html )</li>
	</ul>
	
	<p><strong>SPIP, de part son respect &agrave; la norme RFC 822 permet donc aujourd&#x27;hui l&#x27;usage d&#x27;adresses mails qui ne sont clairement pas valides dans notre utilisation quotidienne, que je pense majoritaire, de l&#x27;outil SPIP. Il est actuellement ainsi possible de valider les adresses :</strong></p>
	<ul>
		<li>Jun 20 21:29:32 &lt;cerdic&gt;&quot;Par exemple, l&#x27;adresse compl&egrave;tement farfelue:  #+^-`&amp;%_=|/|_?=!&sect;{}$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$@mail.com  est, suivant la norme, une adresse parfaitement valide.&quot;</li>
		<li>utilisateur@domaine.f</li>
		<li>utilisateur@domaine.frfrfrfrfrfr</li>
		<li>d@d</li>
	</ul>
	<p>Qui &agrave; mon sens ne devraient pas l&#x27;&ecirc;tre.</p>
	
	<p><em>Se pose donc peut &ecirc;tre le cas des extensions de domaines arabes ou qui me seraient inconnus (et courants) de plus de 6 caract&egrave;res, mais il me semble que les dommages collat&eacute;raux caus&eacute;s par l&#x27;utilisation d&#x27;une RegExp non respectueuse des standards mais beaucoup moins permissive (appliqu&eacute;e &agrave; un usage courant) sont moins importants que ceux de la RegExp actuelle bien trop permissive utilis&eacute;e par SPIP. Je descendrais m&ecirc;me personnellement &agrave; 4 pour l&#x27;extension, tant pis pour .travel et .museum... &deg;_&deg;</em></p>
	
	
	<!-- /* Fonction d'origine de SPIP */ -->
	<h1>Fonction email_valide() de SPIP</h1>
	
	<p>Ces mails sont valides, et bien reconnus.</p>
	
	<?php
	$emails_valides = array(
						'utilisateur@domaine.com',
						'uti-lisa.teur@domai-ne.fr',
						'&-_+.spip17&-_+.@domaine.com'
					);
	echo '<ul>';
	foreach($emails_valides as $tests => $email)
		echo '<li>'.$email.' -> pass&eacute;s par email_valide() -> '.email_valide($email).'</li>';
	echo '</ul>';
	?>

	<!-- // Emails qui ne devraient pas être valides -->
	<p><strong>Ce mail est valide selon la RFC822 (mais &agrave; mon sens ne devrait pas l&#x27;&ecirc;tre), et rejet&eacute; par SPIP</strong></p>
	<?php
	$emails_non_valides_mais_valides = array(
						'#+^-`&%_=|/|_?=!§{}$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$@mail.com'
					);	
	echo '<ul style="font-weight:bold;">';
	foreach($emails_non_valides_mais_valides as $tests => $email)
		echo '<li>'.$email.' -> pass&eacute;s par email_valide() -> '.email_valide($email).'</li>';
	echo '</ul>';
	?>

	
	<!-- // Emails qui ne devraient pas être valides -->
	<p><strong>Ces mails sont valides, mais &agrave; mon sens devraient &ecirc;tre rejet&eacute;s dans un usage classique :</strong></p>
	<?php
	$emails_non_valides_mais_valides = array(
						'utilisateur@domaine.f',
						'utilisateur@domaine.frfrfrfrfrfr',
						'd@d'
					);	
	echo '<ul style="font-weight:bold;">';
	foreach($emails_non_valides_mais_valides as $tests => $email)
		echo '<li>'.$email.' -> pass&eacute;s par email_valide() -> '.email_valide($email).'</li>';
	echo '</ul>';
	?>
		
	<!-- // Emails effectivement rejetés -->
	<p>Ces mails sont non valides, et filtr&eacute;s correctement.</p>
	<?php
	$emails_non_valides_rejetes = array(
						'utilisateurdomaine.f',
						'utilis/@domaine',
						'utilisateur@',
						'@domaine.fr'
					);	
	echo '<ul>';				
	foreach($emails_non_valides_rejetes as $tests => $email)
		echo '<li>'.$email.' -> pass&eacute;s par email_valide() -> '.email_valide($email).'</li>';
	echo '</ul>';
	?>

	<!-- /* Suggestion d'expression régulière */ -->
	<h1>Suggestion d'am&eacute;lioration</h1>
	
	<p>Expression r&eacute;guli&egrave;re propos&eacute;e (respectant Dreamhost, plus permissif que OVH et excluant les extensions de domaine de plus de 4 caract&egrave;res) :</p>
	<p><strong>^([A-Za-z0-9]|&|+|_|-]){1}([A-Za-z0-9]|&|+|_|-|\.)*@[A-Za-z0-9]([A-Za-z0-9]|-|\.){2,}\.[A-Za-z]{2,4}$</strong></p>
	
	<?php
	function email_public_valide($adresses) {
		// Si c'est un spammeur autant arreter tout de suite
		if (preg_match(",[\n\r].*(MIME|multipart|Content-),i", $adresses)) {
			spip_log("Tentative d'injection de mail : $adresses");
			return false;
		}

		foreach (explode(',', $adresses) as $v) {
			// nettoyer certains formats
			// "Marie Toto <Marie@toto.com>"
			$adresse = trim(preg_replace(",^[^<>\"]*<([^<>\"]+)>$,i", "\\1", $v));
			// RFC 822 non respectée
			if (!preg_match('/^([A-Za-z0-9]|\+|&|_|-|]){1}([A-Za-z0-9]|\+|&|_|-|\.)*@[A-Za-z0-9]([A-Za-z0-9]|-|\.){2,}\.[A-Za-z]{2,4}$/', $adresse))
				return false;
		}
		return $adresse;
	}
	?>
	
	<p>Ces mails sont valides, et bien reconnus.</p>
	
	<?php
	$emails_valides = array(
						'utilisateur@domaine.com',
						'uti-lisa.teur@domai-ne.fr',
						'&-_+.spip17&-_+.@domaine.com',
						'-@domaine.fr',
					);
	echo '<ul>';
	foreach($emails_valides as $tests => $email)
		echo '<li>'.$email.' -> pass&eacute;s par email_public_valide() -> '.email_public_valide($email).'</li>';
	echo '</ul>';
	?>
		
	<!-- // Emails effectivement rejetés -->
	<p>Ces mails sont non valides, et filtr&eacute;s correctement.</p>
	<?php
	$emails_non_valides_rejetes = array(
						'#+^-`&%_=|/|_?=!§{}$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$@mail.com',
						'utilisateur@domaine.frfrfrfrfrfr',
						'd@d',
						'utilisateurdomaine.f',
						'utilis/@domaine',
						'utilisateur@',
						'@domaine.fr'
					);	
	echo '<ul>';				
	foreach($emails_non_valides_rejetes as $tests => $email)
		echo '<li>'.$email.' -> pass&eacute;s par email_public_valide() -> '.email_public_valide($email).'</li>';
	echo '</ul>';
	?>
	
	
	