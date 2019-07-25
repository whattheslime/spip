<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2019                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

/**
 * Gestion de l'API de modification/suppression des logos
 *
 * @package SPIP\Core\Logo\Edition
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}


/**
 * Supprimer le logo d'un objet
 *
 * @param string $objet
 * @param int $id_objet
 * @param string $etat
 *     `on` ou `off`
 */
function logo_supprimer($objet, $id_objet, $etat) {
	$chercher_logo = charger_fonction('chercher_logo', 'inc');
	$objet = objet_type($objet);
	$primary = id_table_objet($objet);
	include_spip('inc/chercher_logo');

	// existe-t-il deja un logo ?
	$logo = $chercher_logo($id_objet, $primary, $etat);
	if ($logo) {
		# TODO : deprecated, a supprimer -> anciens logos IMG/artonxx.png pas en base
		if (count($logo) < 6) {
			spip_unlink($logo[0]);
		}
		elseif ($doc = $logo[5]
			and isset($doc['id_document'])
		  and $id_document = $doc['id_document']) {

			include_spip('action/editer_liens');
			// supprimer le lien dans la base
			objet_dissocier(array('document' => $id_document), array($objet => $id_objet), array('role' => '*'));

			// verifier si il reste des liens avec d'autres objets et sinon supprimer
			$liens = objet_trouver_liens(array('document' => $id_document), '*');
			if (!count($liens)) {
				$supprimer_document = charger_fonction('supprimer_document', 'action');
				$supprimer_document($doc['id_document']);
			}
		}
	}
}

/**
 * Modifier le logo d'un objet
 *
 * @param string $objet
 * @param int $id_objet
 * @param string $etat
 *     `on` ou `off`
 * @param string|array $source
 *     - array : sous tableau de `$_FILE` issu de l'upload
 *     - string : fichier source (chemin complet ou chemin relatif a `tmp/upload`)
 * @return string
 *     Erreur, sinon ''
 */
function logo_modifier($objet, $id_objet, $etat, $source) {
	$chercher_logo = charger_fonction('chercher_logo', 'inc');
	$objet = objet_type($objet);
	$primary = id_table_objet($objet);
	include_spip('inc/chercher_logo');

	$mode = preg_replace(",\W,", '', $etat);
	if (!$mode){
		spip_log("logo_modifier : etat $etat invalide", 'logo');
		$erreur = 'etat invalide';

		return $erreur;
	}
	// chercher dans la base
	$mode_document = 'logo' . $mode;

	// supprimer le logo eventueel existant
	// TODO : si un logo existe, le modifier plutot que supprimer + reinserer (mais il faut gerer le cas ou il est utilise par plusieurs objets, donc pas si simple)
	// mais de toute facon l'interface actuelle oblige a supprimer + reinserer
	logo_supprimer($objet, $id_objet, $etat);


	include_spip('inc/documents');
	$erreur = '';

	if (!$source) {
		spip_log('spip_image_ajouter : source inconnue', 'logo');
		$erreur = 'source inconnue';

		return $erreur;
	}

	// fichier dans upload/
	if (is_string($source)) {
		$tmp_name = false;
		if (file_exists($source)) {
			$tmp_name = $source;
		} elseif (file_exists($f = determine_upload() . $source)) {
			$tmp_name = $f;
		}
		if (!$tmp_name) {
			spip_log('spip_image_ajouter : source inconnue', 'logo');
			$erreur = 'source inconnue';

			return $erreur;
		}
		$source = array(
			'tmp_name' => $tmp_name,
			'name' => basename($tmp_name),
		);
	} elseif ($erreur = check_upload_error($source['error'], '', true)) {
		return $erreur;
	}

	$source['mode'] = $mode_document;
	$ajouter_documents = charger_fonction('ajouter_documents', 'action');
	$ajoutes = $ajouter_documents('new', [$source], $objet, $id_objet, $mode_document);

	$id_document = reset($ajoutes);

	if (!is_numeric($id_document)) {
		$erreur = ($id_document ? $id_document : 'Erreur inconnue');
		spip_log("Erreur ajout logo : $erreur pour source=".json_encode($source), 'logo');
		return $erreur;
	}

	return ''; // tout est bon, pas d'erreur

}


/**
 * Convertit le type numerique retourne par getimagesize() en extension fichier
 * doublon de la fonction presente dans metadata/image du plugin medias
 * a fusionner avec les logos en documents
 *
 * @param int $type
 * @param bool $strict
 * @return string
 */
// https://code.spip.net/@decoder_type_image
function logo_decoder_type_image($type, $strict = false) {
	switch ($type) {
		case IMAGETYPE_GIF:
			return 'gif';
		case IMAGETYPE_JPEG:
			return 'jpg';
		case IMAGETYPE_PNG:
			return 'png';
		case IMAGETYPE_SWF:
			return $strict ? '' : 'swf';
		case IMAGETYPE_PSD:
			return 'psd';
		case IMAGETYPE_BMP:
			return 'bmp';
		case IMAGETYPE_TIFF_II:
		case IMAGETYPE_TIFF_MM:
			return 'tif';
		case IMAGETYPE_WEBP:
			return 'webp';
		case IMAGETYPE_SVG:
			return $strict ? '' : 'svg';
		default:
			return '';
	}
}
