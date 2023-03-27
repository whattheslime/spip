<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction identifiant_slug du fichier ./inc/filtres.php
 */

namespace Spip\Core\Tests\Filtre;

use PHPUnit\Framework\TestCase;

class IdentifiantSlugTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		find_in_path('./inc/filtres.php', '', true);
	}

	/**
	 * @dataProvider providerFiltresIdentifiantSlug
	 */
	public function testFiltresIdentifiantSlug($expected, ...$args): void
	{
		$actual = identifiant_slug(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFiltresIdentifiantSlug(): array
	{
		return [
			0 => [
				0 => '1',
				1 => true,
			],
			1 => [
				0 => '',
				1 => false,
			],
			2 => [
				0 => '0',
				1 => 0,
			],
			3 => [
				0 => '1',
				1 => -1,
			],
			4 => [
				0 => '1',
				1 => 1,
			],
			5 => [
				0 => '2',
				1 => 2,
			],
			6 => [
				0 => '3',
				1 => 3,
			],
			7 => [
				0 => '4',
				1 => 4,
			],
			8 => [
				0 => '5',
				1 => 5,
			],
			9 => [
				0 => '6',
				1 => 6,
			],
			10 => [
				0 => '7',
				1 => 7,
			],
			11 => [
				0 => '10',
				1 => 10,
			],
			12 => [
				0 => '20',
				1 => 20,
			],
			13 => [
				0 => '30',
				1 => 30,
			],
			14 => [
				0 => '50',
				1 => 50,
			],
			15 => [
				0 => '100',
				1 => 100,
			],
			16 => [
				0 => '1000',
				1 => 1000,
			],
			17 => [
				0 => '10000',
				1 => 10000,
			],
			18 => [
				0 => '0',
				1 => 0.0,
			],
			19 => [
				0 => '0_25',
				1 => 0.25,
			],
			20 => [
				0 => '0_5',
				1 => 0.5,
			],
			21 => [
				0 => '0_75',
				1 => 0.75,
			],
			22 => [
				0 => '1',
				1 => 1.0,
			],
			23 => [
				0 => '',
				1 => '',
			],
			24 => [
				0 => '0',
				1 => '0',
			],
			25 => [
				0 => 'un_texte_avec_des_liens_article_1_art1_spip_https_www_spip_n',
				1 => 'Un texte avec des <a href="http://spip.net">liens</a> [Article 1->art1] [spip->https://www.spip.net] https://www.spip.net',
			],
			26 => [
				0 => 'un_texte_avec_des_entites',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot;',
			],
			27 => [
				0 => 'un_texte_avec_des_entit_eacute_s_echap_eacute_amp',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot;',
			],
			28 => [
				0 => 'un_texte_avec_des_entites_numeriques_38_60_62',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot;',
			],
			29 => [
				0 => 'un_texte_avec_des_entites_numeriques_echapees_38_60_62',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot;',
			],
			30 => [
				0 => 'un_texte_sans_entites',
				1 => 'Un texte sans entites &<>"\'',
			],
			31 => [
				0 => 'des_raccourcis_italique_gras_du_code',
				1 => '{{{Des raccourcis}}} {italique} {{gras}} <code>du code</code>',
			],
			32 => [
				0 => 'un_modele_https_www_spip_net',
				1 => 'Un modele <modeleinexistant|lien=[->https://www.spip.net]>',
			],
			33 => [
				0 => 'un_texte_avec_des_retour_a_la_ligne_et_meme_des_paragraphes',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes',
			],
			34 => [
				0 => 'un_texte_avec_des_liens_avec_des_accents_iso_a_e_i_o_u_artic',
				1 => "Un texte avec des <a href=\"http://spip.net\">liens avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC</a> [Article 1 avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC->art1] [spip avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC->https://www.spip.net] https://www.spip.net",
			],
			35 => [
				0 => 'un_texte_avec_des_entites_et_avec_des_accents_iso_a_e_i_o_u',
				1 => "Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
			],
			36 => [
				0 => 'un_texte_avec_des_entit_eacute_s_echap_eacute_amp_et_avec_de',
				1 => "Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
			],
			37 => [
				0 => 'un_texte_avec_des_entites_numeriques_38_60_62_et_avec_des_ac',
				1 => "Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
			],
			38 => [
				0 => 'un_texte_avec_des_entites_numeriques_echapees_38_60_62_et_av',
				1 => "Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
			],
			39 => [
				0 => 'un_texte_sans_entites_et_avec_des_accents_iso_a_e_i_o_u',
				1 => "Un texte sans entites &<>\"' et avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC",
			],
			40 => [
				0 => 'des_raccourcis_avec_des_accents_iso_a_e_i_o_u_italique_avec_',
				1 => "{{{Des raccourcis avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC}}} {italique avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC} {{gras avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC}} <code>du code avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC</code>",
			],
			41 => [
				0 => 'un_modele_avec_des_accents_iso_a_e_i_o_u_https_www_spip_net',
				1 => "Un modele avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC <modeleinexistant|lien=[avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC->https://www.spip.net]>",
			],
			42 => [
				0 => 'un_texte_avec_des_retour_a_la_ligne_et_meme_des_paragraphes_',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents ISO a\xE0\xE2\xE4 e\xE9\xE8\xEA\xEB i\xEE\xEF o\xF4 u\xF9\xFC',
			],
			43 => [
				0 => 'un_texte_avec_des_liens_avec_des_accents_utf_8_aaaa_eeeee_ii',
				1 => 'Un texte avec des <a href="http://spip.net">liens avec des accents UTF-8 aàâä eéèêë iîï oô uùü</a> [Article 1 avec des accents UTF-8 aàâä eéèêë iîï oô uùü->art1] [spip avec des accents UTF-8 aàâä eéèêë iîï oô uùü->https://www.spip.net] https://www.spip.net',
			],
			44 => [
				0 => 'un_texte_avec_des_entites_et_avec_des_accents_utf_8_aaaa_eee',
				1 => 'Un texte avec des entit&eacute;s &amp;&lt;&gt;&quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
			],
			45 => [
				0 => 'un_texte_avec_des_entit_eacute_s_echap_eacute_amp_et_avec_de',
				1 => 'Un texte avec des entit&amp;eacute;s echap&amp;eacute; &amp;amp;&amp;lt;&amp;gt;&amp;quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
			],
			46 => [
				0 => 'un_texte_avec_des_entites_numeriques_38_60_62_et_avec_des_ac',
				1 => 'Un texte avec des entit&#233;s num&#233;riques &#38;&#60;&#62;&quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
			],
			47 => [
				0 => 'un_texte_avec_des_entites_numeriques_echapees_38_60_62_et_av',
				1 => 'Un texte avec des entit&amp;#233;s num&amp;#233;riques echap&amp;#233;es &amp;#38;&amp;#60;&amp;#62;&amp;quot; et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
			],
			48 => [
				0 => 'un_texte_sans_entites_et_avec_des_accents_utf_8_aaaa_eeeee_i',
				1 => 'Un texte sans entites &<>"\' et avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
			],
			49 => [
				0 => 'des_raccourcis_avec_des_accents_utf_8_aaaa_eeeee_iii_oo_uuu_',
				1 => '{{{Des raccourcis avec des accents UTF-8 aàâä eéèêë iîï oô uùü}}} {italique avec des accents UTF-8 aàâä eéèêë iîï oô uùü} {{gras avec des accents UTF-8 aàâä eéèêë iîï oô uùü}} <code>du code avec des accents UTF-8 aàâä eéèêë iîï oô uùü</code>',
			],
			50 => [
				0 => 'un_modele_avec_des_accents_utf_8_aaaa_eeeee_iii_oo_uuu_https',
				1 => 'Un modele avec des accents UTF-8 aàâä eéèêë iîï oô uùü <modeleinexistant|lien=[avec des accents UTF-8 aàâä eéèêë iîï oô uùü->https://www.spip.net]>',
			],
			51 => [
				0 => 'un_texte_avec_des_retour_a_la_ligne_et_meme_des_paragraphes_',
				1 => 'Un texte avec des retour
a la ligne et meme des

paragraphes avec des accents UTF-8 aàâä eéèêë iîï oô uùü',
			],
			52 => [
				0 => 'c0',
				1 => 0,
				2 => 'class',
			],
			53 => [
				0 => 'c1',
				1 => -1,
				2 => 'class',
			],
			54 => [
				0 => 'c1',
				1 => 1,
				2 => 'class',
			],
			55 => [
				0 => 'c2',
				1 => 2,
				2 => 'class',
			],
			56 => [
				0 => 'c3',
				1 => 3,
				2 => 'class',
			],
			57 => [
				0 => 'c4',
				1 => 4,
				2 => 'class',
			],
			58 => [
				0 => 'c5',
				1 => 5,
				2 => 'class',
			],
			59 => [
				0 => 'c6',
				1 => 6,
				2 => 'class',
			],
			60 => [
				0 => 'c7',
				1 => 7,
				2 => 'class',
			],
			61 => [
				0 => 'c10',
				1 => 10,
				2 => 'class',
			],
			62 => [
				0 => 'c20',
				1 => 20,
				2 => 'class',
			],
			63 => [
				0 => 'c30',
				1 => 30,
				2 => 'class',
			],
			64 => [
				0 => 'c50',
				1 => 50,
				2 => 'class',
			],
			65 => [
				0 => 'c100',
				1 => 100,
				2 => 'class',
			],
			66 => [
				0 => 'c1000',
				1 => 1000,
				2 => 'class',
			],
			67 => [
				0 => 'c10000',
				1 => 10000,
				2 => 'class',
			],
			68 => [
				0 => 'i0',
				1 => 0,
				2 => 'id',
			],
			69 => [
				0 => 'i1',
				1 => -1,
				2 => 'id',
			],
			70 => [
				0 => 'i1',
				1 => 1,
				2 => 'id',
			],
			71 => [
				0 => 'i2',
				1 => 2,
				2 => 'id',
			],
			72 => [
				0 => 'i3',
				1 => 3,
				2 => 'id',
			],
			73 => [
				0 => 'i4',
				1 => 4,
				2 => 'id',
			],
			74 => [
				0 => 'i5',
				1 => 5,
				2 => 'id',
			],
			75 => [
				0 => 'i6',
				1 => 6,
				2 => 'id',
			],
			76 => [
				0 => 'i7',
				1 => 7,
				2 => 'id',
			],
			77 => [
				0 => 'i10',
				1 => 10,
				2 => 'id',
			],
			78 => [
				0 => 'i20',
				1 => 20,
				2 => 'id',
			],
			79 => [
				0 => 'i30',
				1 => 30,
				2 => 'id',
			],
			80 => [
				0 => 'i50',
				1 => 50,
				2 => 'id',
			],
			81 => [
				0 => 'i100',
				1 => 100,
				2 => 'id',
			],
			82 => [
				0 => 'i1000',
				1 => 1000,
				2 => 'id',
			],
			83 => [
				0 => 'i10000',
				1 => 10000,
				2 => 'id',
			],
			84 => [
				0 => 'a0',
				1 => 0,
				2 => 'anchor',
			],
			85 => [
				0 => 'a1',
				1 => -1,
				2 => 'anchor',
			],
			86 => [
				0 => 'a1',
				1 => 1,
				2 => 'anchor',
			],
			87 => [
				0 => 'a2',
				1 => 2,
				2 => 'anchor',
			],
			88 => [
				0 => 'a3',
				1 => 3,
				2 => 'anchor',
			],
			89 => [
				0 => 'a4',
				1 => 4,
				2 => 'anchor',
			],
			90 => [
				0 => 'a5',
				1 => 5,
				2 => 'anchor',
			],
			91 => [
				0 => 'a6',
				1 => 6,
				2 => 'anchor',
			],
			92 => [
				0 => 'a7',
				1 => 7,
				2 => 'anchor',
			],
			93 => [
				0 => 'a10',
				1 => 10,
				2 => 'anchor',
			],
			94 => [
				0 => 'a20',
				1 => 20,
				2 => 'anchor',
			],
			95 => [
				0 => 'a30',
				1 => 30,
				2 => 'anchor',
			],
			96 => [
				0 => 'a50',
				1 => 50,
				2 => 'anchor',
			],
			97 => [
				0 => 'a100',
				1 => 100,
				2 => 'anchor',
			],
			98 => [
				0 => 'a1000',
				1 => 1000,
				2 => 'anchor',
			],
			99 => [
				0 => 'a10000',
				1 => 10000,
				2 => 'anchor',
			],
			100 => [
				0 => '0',
				1 => 0,
				2 => 'name',
			],
			101 => [
				0 => '1',
				1 => -1,
				2 => 'name',
			],
			102 => [
				0 => '1',
				1 => 1,
				2 => 'name',
			],
			103 => [
				0 => '2',
				1 => 2,
				2 => 'name',
			],
			104 => [
				0 => '3',
				1 => 3,
				2 => 'name',
			],
			105 => [
				0 => '4',
				1 => 4,
				2 => 'name',
			],
			106 => [
				0 => '5',
				1 => 5,
				2 => 'name',
			],
			107 => [
				0 => '6',
				1 => 6,
				2 => 'name',
			],
			108 => [
				0 => '7',
				1 => 7,
				2 => 'name',
			],
			109 => [
				0 => '10',
				1 => 10,
				2 => 'name',
			],
			110 => [
				0 => '20',
				1 => 20,
				2 => 'name',
			],
			111 => [
				0 => '30',
				1 => 30,
				2 => 'name',
			],
			112 => [
				0 => '50',
				1 => 50,
				2 => 'name',
			],
			113 => [
				0 => '100',
				1 => 100,
				2 => 'name',
			],
			114 => [
				0 => '1000',
				1 => 1000,
				2 => 'name',
			],
			115 => [
				0 => '10000',
				1 => 10000,
				2 => 'name',
			],
			116 => [
				0 => 's0_cfcd208',
				1 => 0,
				2 => '',
				3 => [
					'longueur_mini' => 10,
				],
			],
			117 => [
				0 => 's1_6bb61e3',
				1 => -1,
				2 => '',
				3 => [
					'longueur_mini' => 10,
				],
			],
			118 => [
				0 => 's1_c4ca423',
				1 => 1,
				2 => '',
				3 => [
					'longueur_mini' => 10,
				],
			],
			119 => [
				0 => 's2_c81e728',
				1 => 2,
				2 => '',
				3 => [
					'longueur_mini' => 10,
				],
			],
			120 => [
				0 => 's3_eccbc87',
				1 => 3,
				2 => '',
				3 => [
					'longueur_mini' => 10,
				],
			],
			121 => [
				0 => 's4_a87ff67',
				1 => 4,
				2 => '',
				3 => [
					'longueur_mini' => 10,
				],
			],
			122 => [
				0 => 's5_e4da3b7',
				1 => 5,
				2 => '',
				3 => [
					'longueur_mini' => 10,
				],
			],
			123 => [
				0 => 's6_1679091',
				1 => 6,
				2 => '',
				3 => [
					'longueur_mini' => 10,
				],
			],
			124 => [
				0 => 's7_8f14e45',
				1 => 7,
				2 => '',
				3 => [
					'longueur_mini' => 10,
				],
			],
			125 => [
				0 => 's10_d3d944',
				1 => 10,
				2 => '',
				3 => [
					'longueur_mini' => 10,
				],
			],
			126 => [
				0 => 's20_98f137',
				1 => 20,
				2 => '',
				3 => [
					'longueur_mini' => 10,
				],
			],
			127 => [
				0 => 's30_34173c',
				1 => 30,
				2 => '',
				3 => [
					'longueur_mini' => 10,
				],
			],
			128 => [
				0 => 's50_c0c7c7',
				1 => 50,
				2 => '',
				3 => [
					'longueur_mini' => 10,
				],
			],
			129 => [
				0 => 's100_f8991',
				1 => 100,
				2 => '',
				3 => [
					'longueur_mini' => 10,
				],
			],
			130 => [
				0 => 's1000_a9b7',
				1 => 1000,
				2 => '',
				3 => [
					'longueur_mini' => 10,
				],
			],
			131 => [
				0 => 's10000_b7a',
				1 => 10000,
				2 => '',
				3 => [
					'longueur_mini' => 10,
				],
			],
		];
	}
}
