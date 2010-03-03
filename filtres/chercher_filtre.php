<?php
/**
 * Test unitaire de la fonction chercher_filtre
 * du fichier inc/filtres.php
 *
 * genere automatiquement par testbuilder
 * le 
 */

	$test = 'chercher_filtre';
	require '../test.inc';
	find_in_path("inc/filtres.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('chercher_filtre', essais_chercher_filtre());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_chercher_filtre(){
		$essais = array (
  0 => 
  array (
    0 => NULL,
    1 => 'identite',
  ),
  1 => 
  array (
    0 => 'identite',
    1 => 'zzhkezhkf',
    2 => 'identite',
  ),
  3 => 
  array (
    0 => 'identite',
    1 => NULL,
    2 => 'identite',
  ),
  4 => 
  array (
    0 => 'filtre_text_dist',
    1 => 'text',
  ),
  5 => 
  array (
    0 => 'filtre_implode_dist',
    1 => 'implode',
  ),
  6 => 
  array (
    0 => 'filtre_image_dist',
    1 => 'image/jpeg',
  ),
  7 => 
  array (
    0 => 'filtre_image_dist',
    1 => 'image/png',
  ),
  8 => 
  array (
    0 => 'filtre_image_dist',
    1 => 'image/gif',
  ),
  9 => 
  array (
    0 => 'filtre_image_dist',
    1 => 'image/x-ms-bmp',
  ),
  10 => 
  array (
    0 => 'filtre_image_dist',
    1 => 'image/tiff',
  ),
  11 => 
  array (
    0 => 'filtre_audio_dist',
    1 => 'audio/x-aiff',
  ),
  12 => 
  array (
    0 => 'filtre_video_dist',
    1 => 'video/x-ms-asf',
  ),
  13 => 
  array (
    0 => 'filtre_video_dist',
    1 => 'video/x-msvideo',
  ),
  14 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/annodex',
  ),
  15 => 
  array (
    0 => 'filtre_audio_dist',
    1 => 'audio/annodex',
  ),
  16 => 
  array (
    0 => 'filtre_video_dist',
    1 => 'video/annodex',
  ),
  17 => 
  array (
    0 => 'filtre_video_dist',
    1 => 'video/x-dv',
  ),
  18 => 
  array (
    0 => 'filtre_audio_dist',
    1 => 'audio/x-flac',
  ),
  19 => 
  array (
    0 => 'filtre_video_dist',
    1 => 'video/x-flv',
  ),
  20 => 
  array (
    0 => 'filtre_audio_dist',
    1 => 'audio/mp4a-latm',
  ),
  23 => 
  array (
    0 => 'filtre_video_dist',
    1 => 'video/vnd.mpegurl',
  ),
  24 => 
  array (
    0 => 'filtre_video_dist',
    1 => 'video/x-m4v',
  ),
  25 => 
  array (
    0 => 'filtre_audio_dist',
    1 => 'audio/midi',
  ),
  26 => 
  array (
    0 => 'filtre_audio_dist',
    1 => 'audio/mka',
  ),
  27 => 
  array (
    0 => 'filtre_video_dist',
    1 => 'video/mkv',
  ),
  28 => 
  array (
    0 => 'filtre_video_dist',
    1 => 'video/x-mng',
  ),
  29 => 
  array (
    0 => 'filtre_video_dist',
    1 => 'video/quicktime',
  ),
  30 => 
  array (
    0 => 'filtre_audio_dist',
    1 => 'audio/mpeg',
  ),
  31 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/mp4',
  ),
  32 => 
  array (
    0 => 'filtre_video_dist',
    1 => 'video/mpeg',
  ),
  33 => 
  array (
    0 => 'filtre_audio_dist',
    1 => 'audio/ogg',
  ),
  34 => 
  array (
    0 => 'filtre_audio_dist',
    1 => 'audio/ogg ',
  ),
  35 => 
  array (
    0 => 'filtre_video_dist',
    1 => 'video/ogg ',
  ),
  36 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/ogg ',
  ),
  38 => 
  array (
    0 => 'filtre_audio_x_pn_realaudio',
    1 => 'audio/x-pn-realaudio',
  ),
  42 => 
  array (
    0 => 'filtre_image_dist',
    1 => 'image/svg+xml',
  ),
  43 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/x-shockwave-flash',
  ),
  44 => 
  array (
    0 => 'filtre_audio_dist',
    1 => 'audio/x-wav',
  ),
  45 => 
  array (
    0 => 'filtre_video_dist',
    1 => 'video/x-ms-wmv',
  ),
  46 => 
  array (
    0 => 'filtre_video_dist',
    1 => 'video/3gpp',
  ),
  47 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/illustrator',
  ),
  48 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/abiword',
  ),
  49 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/octet-stream',
  ),
  50 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/x-blender',
  ),
  51 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/x-bzip2',
  ),
  52 => 
  array (
    0 => 'filtre_text_dist',
    1 => 'text/x-csrc',
  ),
  53 => 
  array (
    0 => 'filtre_text_dist',
    1 => 'text/css',
  ),
  54 => 
  array (
    0 => 'filtre_text_csv_dist',
    1 => 'text/csv',
  ),
  55 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/x-debian-package',
  ),
  56 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/msword',
  ),
  57 => 
  array (
    0 => 'filtre_image_dist',
    1 => 'image/vnd.djvu',
  ),
  58 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/x-dvi',
  ),
  59 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/postscript',
  ),
  60 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/x-gzip',
  ),
  61 => 
  array (
    0 => 'filtre_text_dist',
    1 => 'text/x-chdr',
  ),
  62 => 
  array (
    0 => 'filtre_text_html_dist',
    1 => 'text/html',
  ),
  63 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.google-earth.kml+xml',
  ),
  64 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.google-earth.kmz',
  ),
  65 => 
  array (
    0 => 'filtre_text_dist',
    1 => 'text/x-pascal',
  ),
  66 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/pdf',
  ),
  67 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/x-chess-pgn',
  ),
  68 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.ms-powerpoint',
  ),
  70 => 
  array (
    0 => 'filtre_image_dist',
    1 => 'image/x-photoshop',
  ),
  71 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/x-redhat-package-manager',
  ),
  72 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/rtf',
  ),
  73 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.stardivision.impress',
  ),
  74 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.stardivision.writer',
  ),
  75 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/x-stuffit',
  ),
  76 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.sun.xml.calc',
  ),
  77 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.sun.xml.impress',
  ),
  78 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.sun.xml.writer',
  ),
  79 => 
  array (
    0 => 'filtre_text_dist',
    1 => 'text/x-tex',
  ),
  80 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/x-gtar',
  ),
  81 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/x-bittorrent',
  ),
  82 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/x-font-ttf',
  ),
  83 => 
  array (
    0 => 'filtre_text_dist',
    1 => 'text/plain',
  ),
  84 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/x-xcf',
  ),
  85 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.ms-excel',
  ),
  86 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/xspf+xml',
  ),
  87 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/xml',
  ),
  88 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/zip',
  ),
  89 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.oasis.opendocument.text',
  ),
  90 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.oasis.opendocument.spreadsheet',
  ),
  91 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.oasis.opendocument.presentation',
  ),
  92 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.oasis.opendocument.graphics',
  ),
  93 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.oasis.opendocument.chart',
  ),
  94 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.oasis.opendocument.formula',
  ),
  95 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.oasis.opendocument.database',
  ),
  96 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.oasis.opendocument.image',
  ),
  97 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.oasis.opendocument.text-master',
  ),
  98 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.oasis.opendocument.text-template',
  ),
  99 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.oasis.opendocument.spreadsheet-template',
  ),
  100 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.oasis.opendocument.presentation-template',
  ),
  101 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.oasis.opendocument.graphics-template',
  ),
  104 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.ms-word.document.macroEnabled.12',
  ),
  105 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
  ),
  106 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.ms-word.template.macroEnabled.12',
  ),
  107 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.openxmlformats-officedocument.wordprocessingml.template',
  ),
  108 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.ms-powerpoint.template.macroEnabled.12',
  ),
  109 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.openxmlformats-officedocument.presentationml.template',
  ),
  110 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.ms-powerpoint.addin.macroEnabled.12',
  ),
  111 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.ms-powerpoint.slideshow.macroEnabled.12',
  ),
  112 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
  ),
  113 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.ms-powerpoint.presentation.macroEnabled.12',
  ),
  114 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
  ),
  115 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.ms-excel.addin.macroEnabled.12',
  ),
  116 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.ms-excel.sheet.binary.macroEnabled.12',
  ),
  117 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.ms-excel.sheet.macroEnabled.12',
  ),
  118 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
  ),
  119 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.ms-excel.template.macroEnabled.12',
  ),
  120 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.openxmlformats-officedocument.spreadsheetml.template',
  ),
);
		return $essais;
	}









?>