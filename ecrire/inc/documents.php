<?php

/**
 * SPIP, Système de publication pour l'internet
 *
 * Copyright © avec tendresse depuis 2001
 * Arnaud Martin, Antoine Pitrou, Philippe Rivière, Emmanuel Saint-James
 *
 * Ce programme est un logiciel libre distribué sous licence GNU/GPL.
 */

/**
 * Gestion des documents et de leur emplacement sur le serveur
 *
 * @package SPIP\Core\Documents
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

/**
 * Donne le chemin du fichier relatif à `_DIR_IMG`
 * pour stockage 'tel quel' dans la base de données
 *
 * @uses _DIR_IMG
 *
 * @param string $fichier
 * @return string
 */
function set_spip_doc(?string $fichier): string {
	if ($fichier && str_starts_with($fichier, (string) _DIR_IMG)) {
		return substr($fichier, strlen((string) _DIR_IMG));
	} else {
		// ex: fichier distant
		return $fichier ?? '';
	}
}

/**
 * Donne le chemin complet du fichier
 *
 * @uses _DIR_IMG
 *
 * @param string $fichier
 * @return bool|string
 */
function get_spip_doc(?string $fichier) {
	if ($fichier === null) {
		return false;
	}

	// fichier distant
	if (tester_url_absolue($fichier)) {
		return $fichier;
	}

	// gestion d'erreurs, fichier=''
	if (!strlen($fichier)) {
		return false;
	}

	if (!str_starts_with($fichier, (string) _DIR_IMG)) {
		$fichier = _DIR_IMG . $fichier;
	}

	// fichier normal
	return $fichier;
}

/**
 * Créer un sous-répertoire IMG/$ext/ tel que IMG/pdf
 *
 * @uses sous_repertoire()
 * @uses _DIR_IMG
 * @uses verifier_htaccess()
 *
 * @param string $ext
 * @return string
 */
function creer_repertoire_documents($ext) {
	$rep = sous_repertoire(_DIR_IMG, $ext);

	if (!$ext || !$rep) {
		spip_logger()->info("creer_repertoire_documents '$rep' interdit");
		exit;
	}

	// Cette variable de configuration peut etre posee par un plugin
	// par exemple acces_restreint
	// sauf pour logo/ utilise pour stocker les logoon et logooff
	if (
		isset($GLOBALS['meta']['creer_htaccess'])
		&& $GLOBALS['meta']['creer_htaccess'] == 'oui'
		&& $ext !== 'logo'
	) {
		include_spip('inc/acces');
		verifier_htaccess($rep);
	}

	return $rep;
}

/**
 * Efface le répertoire de manière récursive !
 *
 * @param string $nom
 */
function effacer_repertoire_temporaire($nom) {
	if ($d = opendir($nom)) {
		while (($f = readdir($d)) !== false) {
			if (is_file("$nom/$f")) {
				spip_unlink("$nom/$f");
			} else {
				if ($f != '.' && $f != '..' && is_dir("$nom/$f")) {
					effacer_repertoire_temporaire("$nom/$f");
				}
			}
		}
	}
	closedir($d);
	@rmdir($nom);
}

//
/**
 * Copier un document `$source`
 * dans un dossier `IMG/$ext/$orig.$ext` ou `IMG/$subdir/$orig.$ext` si `$subdir` est fourni
 * en numérotant éventuellement si un fichier de même nom existe déjà
 *
 * @param string $ext
 * @param string $orig
 * @param string $source
 * @param string $subdir
 * @return bool|mixed|string
 */
function copier_document($ext, $orig, $source, $subdir = null) {

	$orig = preg_replace(',\.\.+,', '.', $orig); // pas de .. dans le nom du doc
	$dir = creer_repertoire_documents($subdir ?: $ext);

	$dest = preg_replace('/<[^>]*>/', '', basename($orig));
	$dest = preg_replace('/\.([^.]+)$/', '', $dest);
	$dest = translitteration($dest);
	$dest = preg_replace('/[^.=\w-]+/', '_', (string) $dest);

	// ne pas accepter de noms de la forme -r90.jpg qui sont reserves
	// pour les images transformees par rotation (action/documenter)
	$dest = preg_replace(',-r(90|180|270)$,', '', $dest);

	while (preg_match(',\.(\w+)$,', $dest, $m)) {
		if (
			!function_exists('verifier_upload_autorise')
			|| !($r = verifier_upload_autorise($dest))
			|| !empty($r['autozip'])
		) {
			$dest = substr($dest, 0, -strlen($m[0])) . '_' . $m[1];
			break;
		} else {
			$dest = substr($dest, 0, -strlen($m[0]));
			$ext = $m[1] . '.' . $ext;
		}
	}

	// Si le document "source" est deja au bon endroit, ne rien faire
	if ($source == ($dir . $dest . '.' . $ext)) {
		return $source;
	}

	// sinon tourner jusqu'a trouver un numero correct
	$n = 0;
	while (@file_exists($newFile = $dir . $dest . ($n++ ? ('-' . $n) : '') . '.' . $ext)) {
		;
	}

	return deplacer_fichier_upload($source, $newFile);
}

/**
 * Trouver le dossier utilisé pour upload un fichier
 *
 * @uses autoriser()
 * @uses _DIR_TRANSFERT
 * @uses _DIR_TMP
 * @uses sous_repertoire()
 *
 * @param string $type
 * @return bool|string
 */
function determine_upload($type = '') {
	if (!function_exists('autoriser')) {
		include_spip('inc/autoriser');
	}

	if (
		!autoriser('chargerftp')
		|| $type == 'logos'
	) { # on ne le permet pas pour les logos
	return false;
	}

	$repertoire = _DIR_TRANSFERT;
	if (!@is_dir($repertoire)) {
		$repertoire = str_replace(_DIR_TMP, '', (string) $repertoire);
		$repertoire = sous_repertoire(_DIR_TMP, $repertoire);
	}

	if (!$GLOBALS['visiteur_session']['restreint']) {
		return $repertoire;
	} else {
		return sous_repertoire($repertoire, $GLOBALS['visiteur_session']['login']);
	}
}

/**
 * Déplacer ou copier un fichier
 *
 * @uses _DIR_RACINE
 * @uses spip_unlink()
 *
 * @param string $source
 *     Fichier source à copier
 * @param string $dest
 *     Fichier de destination
 * @param bool $move
 *     - `true` : on déplace le fichier source vers le fichier de destination
 *     - `false` : valeur par défaut. On ne fait que copier le fichier source vers la destination.
 * @return bool|mixed|string
 */
function deplacer_fichier_upload($source, $dest, $move = false) {
	// Securite
	if (str_starts_with($dest, (string) _DIR_RACINE)) {
		$dest = _DIR_RACINE . preg_replace(',\.\.+,', '.', substr($dest, strlen((string) _DIR_RACINE)));
	} else {
		$dest = preg_replace(',\.\.+,', '.', $dest);
	}

	$ok = $move ? @rename($source, $dest) : @copy($source, $dest);
	if (!$ok) {
		$ok = @move_uploaded_file($source, $dest);
	}
	if ($ok) {
		@chmod($dest, _SPIP_CHMOD & ~0111);
	} else {
		$f = @fopen($dest, 'w');
		if ($f) {
			fclose($f);
		} else {
			include_spip('inc/flock');
			raler_fichier($dest);
		}
		spip_unlink($dest);
	}

	return $ok ? $dest : false;
}


/**
 * Erreurs d'upload
 *
 * Renvoie `false` si pas d'erreur
 * et `true` s'il n'y a pas de fichier à uploader.
 * Pour les autres erreurs, on affiche le message d'erreur et on arrête l'action.
 *
 * @link http://php.net/manual/fr/features.file-upload.errors.php
 *     Explication sur les messages d'erreurs de chargement de fichiers.
 * @uses propre()
 * @uses minipres()
 *
 * @global string $spip_lang_right
 * @param integer $error
 * @param string $msg
 * @param bool $return
 * @return boolean|string
 */
function check_upload_error($error, $msg = '', $return = false) {

	if (!$error) {
		return false;
	}

	spip_logger()->info("Erreur upload $error -- cf. http://php.net/manual/fr/features.file-upload.errors.php");

	switch ($error) {
		case 4: /* UPLOAD_ERR_NO_FILE */
			return true;

		# on peut affiner les differents messages d'erreur
		case 1: /* UPLOAD_ERR_INI_SIZE */
			$msg = _T(
				'upload_limit',
				['max' => ini_get('upload_max_filesize')]
			);
			break;
		case 2: /* UPLOAD_ERR_FORM_SIZE */
			$msg = _T(
				'upload_limit',
				['max' => ini_get('upload_max_filesize')]
			);
			break;
		case 3: /* UPLOAD_ERR_PARTIAL  */
			$msg = _T(
				'upload_limit',
				['max' => ini_get('upload_max_filesize')]
			);
			break;

		default: /* autre */
			if (!$msg) {
				$msg = _T('pass_erreur') . ' ' . $error
					. '<br />' . propre('[->http://php.net/manual/fr/features.file-upload.errors.php]');
			}
			break;
	}

	spip_logger()->info("erreur upload $error");
	if ($return) {
		return $msg;
	}

	if (_request('iframe') == 'iframe') {
		echo "<div class='upload_answer upload_error'>$msg</div>";
		exit;
	}

	include_spip('inc/minipres');
	echo minipres(
		$msg,
		"<div style='text-align: " . $GLOBALS['spip_lang_right'] . "'><a href='" . attribut_url(rawurldecode((string) $GLOBALS['redirect'])) . "'><button type='button'>" . _T('ecrire:bouton_suivant') . '</button></a></div>'
	);
	exit;
}

/**
 * Corrige l'extension du fichier dans quelques cas particuliers
 *
 * @note
 *     Une extension 'pdf ' passe dans la requête de contrôle
 *     mysql> SELECT * FROM spip_types_documents WHERE extension="pdf ";
 *
 * @todo
 *     À passer dans base/typedoc
 *
 * @param string $ext
 * @return string
 */
function corriger_extension($ext) {
	$ext = preg_replace(',[^a-z0-9],i', '', $ext);

	return match ($ext) {
		'htm' => 'html',
		'jpeg' => 'jpg',
		'tiff' => 'tif',
		'aif' => 'aiff',
		'mpeg' => 'mpg',
		default => $ext,
	};
}
