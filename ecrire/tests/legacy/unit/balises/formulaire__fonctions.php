<?php

declare(strict_types=1);

/*
 * Plugin xxx
 * (c) 2009 xxx
 * Distribue sous licence GPL
 *
 */

function formulaire_inscription_present($page) {
	if (trim($page) === '') {
		return '#FORMULAIRE_{inscription} ne renvoie rien';
	}
	return 'OK';
}
