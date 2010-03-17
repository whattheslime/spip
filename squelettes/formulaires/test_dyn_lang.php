<?php
/*
 * Plugin xxx
 * (c) 2009 xxx
 * Distribue sous licence GPL
 *
 */

function formulaires_test_dyn_lang_charger_dist($lang_skel){

	return array('message_ok'=>$lang_skel==$GLOBALS['spip_lang']?'OK':"NOK : La langue dans le squelette appelant est $lang_skel mais la langue dans charger() est ".$GLOBALS['spip_lang']);
}


?>