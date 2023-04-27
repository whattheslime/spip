<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction chercher_filtre du fichier inc/filtres.php
 */

namespace Spip\Test\Filtre;

use PHPUnit\Framework\TestCase;

class ChercherFiltreTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		find_in_path('inc/filtres.php', '', true);
	}

	/**
	 * @dataProvider providerFiltresChercherFiltre
	 */
	public function testFiltresChercherFiltre($expected, ...$args): void
	{
		$actual = chercher_filtre(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresChercherFiltre(): array
	{
		return [
			0 => [
				0 => 'filtre_identite_dist',
				1 => 'identite',
			],
			1 => [
				0 => 'identite',
				1 => 'zzhkezhkf',
				2 => 'identite',
			],
			3 => [
				0 => 'identite',
				1 => null,
				2 => 'identite',
			],
			4 => [
				0 => 'filtre_text_dist',
				1 => 'text',
			],
			5 => [
				0 => 'filtre_implode_dist',
				1 => 'implode',
			],
			6 => [
				0 => 'filtre_image_dist',
				1 => 'image/jpeg',
			],
			7 => [
				0 => 'filtre_image_dist',
				1 => 'image/png',
			],
			8 => [
				0 => 'filtre_image_dist',
				1 => 'image/gif',
			],
			9 => [
				0 => 'filtre_image_dist',
				1 => 'image/x-ms-bmp',
			],
			10 => [
				0 => 'filtre_image_dist',
				1 => 'image/tiff',
			],
			11 => [
				0 => 'filtre_audio_dist',
				1 => 'audio/x-aiff',
			],
			12 => [
				0 => 'filtre_video_dist',
				1 => 'video/x-ms-asf',
			],
			13 => [
				0 => 'filtre_video_dist',
				1 => 'video/x-msvideo',
			],
			14 => [
				0 => 'filtre_application_dist',
				1 => 'application/annodex',
			],
			15 => [
				0 => 'filtre_audio_dist',
				1 => 'audio/annodex',
			],
			16 => [
				0 => 'filtre_video_dist',
				1 => 'video/annodex',
			],
			17 => [
				0 => 'filtre_video_dist',
				1 => 'video/x-dv',
			],
			18 => [
				0 => 'filtre_audio_dist',
				1 => 'audio/x-flac',
			],
			19 => [
				0 => 'filtre_video_dist',
				1 => 'video/x-flv',
			],
			20 => [
				0 => 'filtre_audio_dist',
				1 => 'audio/mp4a-latm',
			],
			23 => [
				0 => 'filtre_video_dist',
				1 => 'video/vnd.mpegurl',
			],
			24 => [
				0 => 'filtre_video_dist',
				1 => 'video/x-m4v',
			],
			25 => [
				0 => 'filtre_audio_dist',
				1 => 'audio/midi',
			],
			26 => [
				0 => 'filtre_audio_dist',
				1 => 'audio/mka',
			],
			27 => [
				0 => 'filtre_video_dist',
				1 => 'video/mkv',
			],
			28 => [
				0 => 'filtre_video_dist',
				1 => 'video/x-mng',
			],
			29 => [
				0 => 'filtre_video_dist',
				1 => 'video/quicktime',
			],
			30 => [
				0 => 'filtre_audio_dist',
				1 => 'audio/mpeg',
			],
			31 => [
				0 => 'filtre_application_dist',
				1 => 'application/mp4',
			],
			32 => [
				0 => 'filtre_video_dist',
				1 => 'video/mpeg',
			],
			33 => [
				0 => 'filtre_audio_dist',
				1 => 'audio/ogg',
			],
			34 => [
				0 => 'filtre_audio_dist',
				1 => 'audio/ogg ',
			],
			35 => [
				0 => 'filtre_video_dist',
				1 => 'video/ogg ',
			],
			36 => [
				0 => 'filtre_application_dist',
				1 => 'application/ogg ',
			],
			38 => [
				0 => 'filtre_audio_x_pn_realaudio',
				1 => 'audio/x-pn-realaudio',
			],
			42 => [
				0 => 'filtre_image_dist',
				1 => 'image/svg+xml',
			],
			43 => [
				0 => 'filtre_application_dist',
				1 => 'application/x-shockwave-flash',
			],
			44 => [
				0 => 'filtre_audio_dist',
				1 => 'audio/x-wav',
			],
			45 => [
				0 => 'filtre_video_dist',
				1 => 'video/x-ms-wmv',
			],
			46 => [
				0 => 'filtre_video_dist',
				1 => 'video/3gpp',
			],
			47 => [
				0 => 'filtre_application_dist',
				1 => 'application/illustrator',
			],
			48 => [
				0 => 'filtre_application_dist',
				1 => 'application/abiword',
			],
			49 => [
				0 => 'filtre_application_dist',
				1 => 'application/octet-stream',
			],
			50 => [
				0 => 'filtre_application_dist',
				1 => 'application/x-blender',
			],
			51 => [
				0 => 'filtre_application_dist',
				1 => 'application/x-bzip2',
			],
			52 => [
				0 => 'filtre_text_dist',
				1 => 'text/x-csrc',
			],
			53 => [
				0 => 'filtre_text_dist',
				1 => 'text/css',
			],
			54 => [
				0 => 'filtre_text_csv_dist',
				1 => 'text/csv',
			],
			55 => [
				0 => 'filtre_application_dist',
				1 => 'application/x-debian-package',
			],
			56 => [
				0 => 'filtre_application_dist',
				1 => 'application/msword',
			],
			57 => [
				0 => 'filtre_image_dist',
				1 => 'image/vnd.djvu',
			],
			58 => [
				0 => 'filtre_application_dist',
				1 => 'application/x-dvi',
			],
			59 => [
				0 => 'filtre_application_dist',
				1 => 'application/postscript',
			],
			60 => [
				0 => 'filtre_application_dist',
				1 => 'application/x-gzip',
			],
			61 => [
				0 => 'filtre_text_dist',
				1 => 'text/x-chdr',
			],
			62 => [
				0 => 'filtre_text_html_dist',
				1 => 'text/html',
			],
			63 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.google-earth.kml+xml',
			],
			64 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.google-earth.kmz',
			],
			65 => [
				0 => 'filtre_text_dist',
				1 => 'text/x-pascal',
			],
			66 => [
				0 => 'filtre_application_dist',
				1 => 'application/pdf',
			],
			67 => [
				0 => 'filtre_application_dist',
				1 => 'application/x-chess-pgn',
			],
			68 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.ms-powerpoint',
			],
			70 => [
				0 => 'filtre_image_dist',
				1 => 'image/x-photoshop',
			],
			71 => [
				0 => 'filtre_application_dist',
				1 => 'application/x-redhat-package-manager',
			],
			72 => [
				0 => 'filtre_application_dist',
				1 => 'application/rtf',
			],
			73 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.stardivision.impress',
			],
			74 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.stardivision.writer',
			],
			75 => [
				0 => 'filtre_application_dist',
				1 => 'application/x-stuffit',
			],
			76 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.sun.xml.calc',
			],
			77 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.sun.xml.impress',
			],
			78 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.sun.xml.writer',
			],
			79 => [
				0 => 'filtre_text_dist',
				1 => 'text/x-tex',
			],
			80 => [
				0 => 'filtre_application_dist',
				1 => 'application/x-gtar',
			],
			81 => [
				0 => 'filtre_application_dist',
				1 => 'application/x-bittorrent',
			],
			82 => [
				0 => 'filtre_application_dist',
				1 => 'application/x-font-ttf',
			],
			83 => [
				0 => 'filtre_text_dist',
				1 => 'text/plain',
			],
			84 => [
				0 => 'filtre_application_dist',
				1 => 'application/x-xcf',
			],
			85 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.ms-excel',
			],
			86 => [
				0 => 'filtre_application_dist',
				1 => 'application/xspf+xml',
			],
			87 => [
				0 => 'filtre_application_dist',
				1 => 'application/xml',
			],
			88 => [
				0 => 'filtre_application_dist',
				1 => 'application/zip',
			],
			89 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.oasis.opendocument.text',
			],
			90 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.oasis.opendocument.spreadsheet',
			],
			91 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.oasis.opendocument.presentation',
			],
			92 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.oasis.opendocument.graphics',
			],
			93 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.oasis.opendocument.chart',
			],
			94 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.oasis.opendocument.formula',
			],
			95 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.oasis.opendocument.database',
			],
			96 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.oasis.opendocument.image',
			],
			97 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.oasis.opendocument.text-master',
			],
			98 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.oasis.opendocument.text-template',
			],
			99 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.oasis.opendocument.spreadsheet-template',
			],
			100 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.oasis.opendocument.presentation-template',
			],
			101 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.oasis.opendocument.graphics-template',
			],
			104 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.ms-word.document.macroEnabled.12',
			],
			105 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
			],
			106 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.ms-word.template.macroEnabled.12',
			],
			107 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.openxmlformats-officedocument.wordprocessingml.template',
			],
			108 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.ms-powerpoint.template.macroEnabled.12',
			],
			109 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.openxmlformats-officedocument.presentationml.template',
			],
			110 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.ms-powerpoint.addin.macroEnabled.12',
			],
			111 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.ms-powerpoint.slideshow.macroEnabled.12',
			],
			112 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
			],
			113 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.ms-powerpoint.presentation.macroEnabled.12',
			],
			114 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
			],
			115 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.ms-excel.addin.macroEnabled.12',
			],
			116 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.ms-excel.sheet.binary.macroEnabled.12',
			],
			117 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.ms-excel.sheet.macroEnabled.12',
			],
			118 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
			],
			119 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.ms-excel.template.macroEnabled.12',
			],
			120 => [
				0 => 'filtre_application_dist',
				1 => 'application/vnd.openxmlformats-officedocument.spreadsheetml.template',
			],
		];
	}
}
