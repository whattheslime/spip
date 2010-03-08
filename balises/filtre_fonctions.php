<?php
/*
 * Plugin xxx
 * (c) 2009 xxx
 * Distribue sous licence GPL
 *
 */

function strip_non($texte){
	$texte = str_replace('NON','',$texte);
	return $texte;
}

function strip_on($texte){
	$texte = str_replace('ON','',$texte);
	return $texte;
}

?>