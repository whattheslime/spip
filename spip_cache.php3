<?php

include ("ecrire/inc_version.php3");

include_ecrire("inc_meta.php3");
include_ecrire("inc_admin.php3");

include_local("inc-cache.php3");

if ($purger_cache == "oui") {
	if (verifier_action_auteur("purger_cache", $hash, $id_auteur)) {
		purger_repertoire('CACHE', 0);
		spip_query("DELETE FROM spip_forum_cache");
	}
 }

 else if ($purger_squelettes == "oui") {
	if (verifier_action_auteur("purger_squelettes", $hash, $id_auteur)) {
		purger_repertoire('CACHE', 0, '^skel_');
	}
 }
 else
   { include("ecrire/Include/MySQL3/spip_cache.php");
     if ($supp_forum) 
       changer_statut_forum($supp_forum, 'off');
     else if ($supp_forum_priv) changer_statut_forum($supp_forum_priv, 'privoff');
     else if ($valid_forum) changer_statut_forum($valid_forum, 'publie');
   }

@header ("Location: ./ecrire/" . $redirect);

?>
