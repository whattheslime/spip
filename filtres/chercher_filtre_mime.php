<?php
/**
 * Test unitaire de la fonction chercher_filtre_mime
 * du fichier ./inc/filtres.php
 *
 * genere automatiquement par TestBuilder
 * le 2010-03-03 09:43
 */

	$test = 'chercher_filtre_mime';
	$remonte = "../";
	while (!is_dir($remonte."ecrire"))
		$remonte = "../$remonte";
	require $remonte.'tests/test.inc';
	find_in_path("./inc/filtres.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('chercher_filtre_mime', essais_chercher_filtre_mime());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_chercher_filtre_mime(){
		$essais = array (
  0 => 
  array (
    0 => 'filtre_image_dist',
    1 => 'image/jpeg',
  ),
  1 => 
  array (
    0 => 'filtre_image_dist',
    1 => 'image/png',
  ),
  2 => 
  array (
    0 => 'filtre_image_dist',
    1 => 'image/gif',
  ),
  3 => 
  array (
    0 => 'filtre_image_dist',
    1 => 'image/x-ms-bmp',
  ),
  4 => 
  array (
    0 => 'filtre_image_dist',
    1 => 'image/tiff',
  ),
  5 => 
  array (
    0 => 'filtre_audio_dist',
    1 => 'audio/x-aiff',
  ),
  6 => 
  array (
    0 => 'filtre_video_dist',
    1 => 'video/x-ms-asf',
  ),
  7 => 
  array (
    0 => 'filtre_video_dist',
    1 => 'video/x-msvideo',
  ),
  8 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/annodex',
  ),
  9 => 
  array (
    0 => 'filtre_audio_dist',
    1 => 'audio/annodex',
  ),
  10 => 
  array (
    0 => 'filtre_video_dist',
    1 => 'video/annodex',
  ),
  11 => 
  array (
    0 => 'filtre_video_dist',
    1 => 'video/x-dv',
  ),
  12 => 
  array (
    0 => 'filtre_audio_dist',
    1 => 'audio/x-flac',
  ),
  13 => 
  array (
    0 => 'filtre_video_dist',
    1 => 'video/x-flv',
  ),
  14 => 
  array (
    0 => 'filtre_audio_dist',
    1 => 'audio/mp4a-latm',
  ),
  17 => 
  array (
    0 => 'filtre_video_dist',
    1 => 'video/vnd.mpegurl',
  ),
  18 => 
  array (
    0 => 'filtre_video_dist',
    1 => 'video/x-m4v',
  ),
  19 => 
  array (
    0 => 'filtre_audio_dist',
    1 => 'audio/midi',
  ),
  20 => 
  array (
    0 => 'filtre_audio_dist',
    1 => 'audio/mka',
  ),
  21 => 
  array (
    0 => 'filtre_video_dist',
    1 => 'video/mkv',
  ),
  22 => 
  array (
    0 => 'filtre_video_dist',
    1 => 'video/x-mng',
  ),
  23 => 
  array (
    0 => 'filtre_video_dist',
    1 => 'video/quicktime',
  ),
  24 => 
  array (
    0 => 'filtre_audio_dist',
    1 => 'audio/mpeg',
  ),
  25 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/mp4',
  ),
  26 => 
  array (
    0 => 'filtre_video_dist',
    1 => 'video/mpeg',
  ),
  27 => 
  array (
    0 => 'filtre_audio_dist',
    1 => 'audio/ogg',
  ),
  28 => 
  array (
    0 => 'filtre_audio_dist',
    1 => 'audio/ogg ',
  ),
  29 => 
  array (
    0 => 'filtre_video_dist',
    1 => 'video/ogg ',
  ),
  30 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/ogg ',
  ),
  32 => 
  array (
    0 => 'filtre_audio_x_pn_realaudio',
    1 => 'audio/x-pn-realaudio',
  ),
  36 => 
  array (
    0 => 'filtre_image_dist',
    1 => 'image/svg+xml',
  ),
  37 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/x-shockwave-flash',
  ),
  38 => 
  array (
    0 => 'filtre_audio_dist',
    1 => 'audio/x-wav',
  ),
  39 => 
  array (
    0 => 'filtre_video_dist',
    1 => 'video/x-ms-wmv',
  ),
  40 => 
  array (
    0 => 'filtre_video_dist',
    1 => 'video/3gpp',
  ),
  41 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/illustrator',
  ),
  42 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/abiword',
  ),
  43 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/octet-stream',
  ),
  44 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/x-blender',
  ),
  45 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/x-bzip2',
  ),
  46 => 
  array (
    0 => 'filtre_text_dist',
    1 => 'text/x-csrc',
  ),
  47 => 
  array (
    0 => 'filtre_text_dist',
    1 => 'text/css',
  ),
  48 => 
  array (
    0 => 'filtre_text_csv_dist',
    1 => 'text/csv',
  ),
  49 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/x-debian-package',
  ),
  50 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/msword',
  ),
  51 => 
  array (
    0 => 'filtre_image_dist',
    1 => 'image/vnd.djvu',
  ),
  52 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/x-dvi',
  ),
  53 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/postscript',
  ),
  54 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/x-gzip',
  ),
  55 => 
  array (
    0 => 'filtre_text_dist',
    1 => 'text/x-chdr',
  ),
  56 => 
  array (
    0 => 'filtre_text_html_dist',
    1 => 'text/html',
  ),
  57 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.google-earth.kml+xml',
  ),
  58 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.google-earth.kmz',
  ),
  59 => 
  array (
    0 => 'filtre_text_dist',
    1 => 'text/x-pascal',
  ),
  60 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/pdf',
  ),
  61 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/x-chess-pgn',
  ),
  62 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.ms-powerpoint',
  ),
  64 => 
  array (
    0 => 'filtre_image_dist',
    1 => 'image/x-photoshop',
  ),
  65 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/x-redhat-package-manager',
  ),
  66 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/rtf',
  ),
  67 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.stardivision.impress',
  ),
  68 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.stardivision.writer',
  ),
  69 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/x-stuffit',
  ),
  70 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.sun.xml.calc',
  ),
  71 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.sun.xml.impress',
  ),
  72 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.sun.xml.writer',
  ),
  73 => 
  array (
    0 => 'filtre_text_dist',
    1 => 'text/x-tex',
  ),
  74 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/x-gtar',
  ),
  75 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/x-bittorrent',
  ),
  76 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/x-font-ttf',
  ),
  77 => 
  array (
    0 => 'filtre_text_dist',
    1 => 'text/plain',
  ),
  78 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/x-xcf',
  ),
  79 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.ms-excel',
  ),
  80 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/xspf+xml',
  ),
  81 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/xml',
  ),
  82 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/zip',
  ),
  83 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.oasis.opendocument.text',
  ),
  84 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.oasis.opendocument.spreadsheet',
  ),
  85 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.oasis.opendocument.presentation',
  ),
  86 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.oasis.opendocument.graphics',
  ),
  87 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.oasis.opendocument.chart',
  ),
  88 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.oasis.opendocument.formula',
  ),
  89 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.oasis.opendocument.database',
  ),
  90 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.oasis.opendocument.image',
  ),
  91 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.oasis.opendocument.text-master',
  ),
  92 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.oasis.opendocument.text-template',
  ),
  93 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.oasis.opendocument.spreadsheet-template',
  ),
  94 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.oasis.opendocument.presentation-template',
  ),
  95 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.oasis.opendocument.graphics-template',
  ),
  98 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.ms-word.document.macroEnabled.12',
  ),
  99 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
  ),
  100 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.ms-word.template.macroEnabled.12',
  ),
  101 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.openxmlformats-officedocument.wordprocessingml.template',
  ),
  102 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.ms-powerpoint.template.macroEnabled.12',
  ),
  103 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.openxmlformats-officedocument.presentationml.template',
  ),
  104 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.ms-powerpoint.addin.macroEnabled.12',
  ),
  105 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.ms-powerpoint.slideshow.macroEnabled.12',
  ),
  106 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
  ),
  107 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.ms-powerpoint.presentation.macroEnabled.12',
  ),
  108 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
  ),
  109 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.ms-excel.addin.macroEnabled.12',
  ),
  110 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.ms-excel.sheet.binary.macroEnabled.12',
  ),
  111 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.ms-excel.sheet.macroEnabled.12',
  ),
  112 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
  ),
  113 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.ms-excel.template.macroEnabled.12',
  ),
  114 => 
  array (
    0 => 'filtre_application_dist',
    1 => 'application/vnd.openxmlformats-officedocument.spreadsheetml.template',
  ),
);
		return $essais;
	}






?>