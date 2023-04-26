<?php

declare(strict_types=1);

/*
 * Plugin xxx
 * (c) 2009 xxx
 * Distribue sous licence GPL
 *
 */

function strip_non($texte)
{
	return str_replace('NON', '', $texte);
}

function strip_on($texte)
{
	return str_replace('ON', '', $texte);
}
