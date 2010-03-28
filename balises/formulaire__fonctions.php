<?php
/*
 * Plugin xxx
 * (c) 2009 xxx
 * Distribue sous licence GPL
 *
 */

function formulaire_inscription_present($page){
	if (!strlen(trim($page)))
		return '#FORMULAIRE_{inscription} ne renvoie rien';
	else
		return 'OK';
}

?>