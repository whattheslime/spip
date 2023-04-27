<?php

declare(strict_types=1);

namespace Spip\Test\Filtre\Date;

use PHPUnit\Framework\TestCase;

/**
 * Test unitaire de la fonction affdate_debut_fin du fichier ./inc/filtres.php
 */
class AffDateDebutFinTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		find_in_path('./inc/filtres.php', '', true);
		// Pour que le tests soit independant de la timezone du serveur
		ini_set('date.timezone', 'Europe/Paris');
		changer_langue('fr'); // ce test est en fr
	}

	/**
	 * @dataProvider providerAffdateDebutFin
	 */
	public function testAffdateDebutFin($expected, ...$args): void
	{
		$this->assertEquals($expected, affdate_debut_fin(...$args));
	}

	public static function providerAffdateDebutFin(): array
	{
		return [
			0 =>
			[
				0 => 'Dimanche 1er juillet 2001 à 12h34',
				1 => '2001-07-01 12:34:00',
				2 => '2001-07-01 12:34:00',
				3 => true,
			],
			1 =>
			[
				0 => 'Dimanche 1er juillet 2001',
				1 => '2001-07-01 12:34:00',
				2 => '2001-07-01 12:34:00',
				3 => false,
			],
			2 =>
			[
				0 => 'Dimanche 1er juillet 2001 de 12h34 à 13h34',
				1 => '2001-07-01 12:34:00',
				2 => '2001-07-01 13:34:00',
				3 => true,
			],
			3 =>
			[
				0 => 'Dimanche 1er juillet 2001',
				1 => '2001-07-01 12:34:00',
				2 => '2001-07-01 13:34:00',
				3 => false,
			],
			4 =>
			[
				0 => 'Du 1er juillet à 12h34 au 2 juillet 2001 à 12h34',
				1 => '2001-07-01 12:34:00',
				2 => '2001-07-02 12:34:00',
				3 => true,
			],
			5 =>
			[
				0 => 'Du 1er au 2 juillet 2001',
				1 => '2001-07-01 12:34:00',
				2 => '2001-07-02 12:34:00',
				3 => false,
			],
			6 =>
			[
				0 => 'Du 1er juillet à 12h34 au 2 juillet 2001 à 13h34',
				1 => '2001-07-01 12:34:00',
				2 => '2001-07-02 13:34:00',
				3 => true,
			],
			7 =>
			[
				0 => 'Du 1er au 2 juillet 2001',
				1 => '2001-07-01 12:34:00',
				2 => '2001-07-02 13:34:00',
				3 => false,
			],
			8 =>
			[
				0 => 'Du 1er juillet à 12h34 au 1er août 2001 à 12h34',
				1 => '2001-07-01 12:34:00',
				2 => '2001-08-01 12:34:00',
				3 => true,
			],
			9 =>
			[
				0 => 'Du 1er juillet au 1er août 2001',
				1 => '2001-07-01 12:34:00',
				2 => '2001-08-01 12:34:00',
				3 => false,
			],
			10 =>
			[
				0 => 'Du 1er juillet 2001 à 12h34 au 1er juillet 2011 à 12h34',
				1 => '2001-07-01 12:34:00',
				2 => '2011-07-01 12:34:00',
				3 => true,
			],
			11 =>
			[
				0 => 'Du 1er juillet 2001 au 1er juillet 2011',
				1 => '2001-07-01 12:34:00',
				2 => '2011-07-01 12:34:00',
				3 => false,
			],
			12 =>
			[
				0 => 'Dim. 1er juillet 2001 à 12h34',
				1 => '2001-07-01 12:34:00',
				2 => '2001-07-01 12:34:00',
				3 => true,
				4 => 'abbr',
			],
			13 =>
			[
				0 => 'Dim. 1er juillet 2001',
				1 => '2001-07-01 12:34:00',
				2 => '2001-07-01 12:34:00',
				3 => false,
				4 => 'abbr',
			],
			14 =>
			[
				0 => 'Dim. 1er juillet 2001 de 12h34 à 13h34',
				1 => '2001-07-01 12:34:00',
				2 => '2001-07-01 13:34:00',
				3 => true,
				4 => 'abbr',
			],
			15 =>
			[
				0 => 'Dim. 1er juillet 2001',
				1 => '2001-07-01 12:34:00',
				2 => '2001-07-01 13:34:00',
				3 => false,
				4 => 'abbr',
			],
			16 =>
			[
				0 => 'Du 1er juillet à 12h34 au 2 juillet 2001 à 12h34',
				1 => '2001-07-01 12:34:00',
				2 => '2001-07-02 12:34:00',
				3 => true,
				4 => 'abbr',
			],
			17 =>
			[
				0 => 'Du 1er au 2 juillet 2001',
				1 => '2001-07-01 12:34:00',
				2 => '2001-07-02 12:34:00',
				3 => false,
				4 => 'abbr',
			],
			18 =>
			[
				0 => 'Du 1er juillet à 12h34 au 1er août 2001 à 12h34',
				1 => '2001-07-01 12:34:00',
				2 => '2001-08-01 12:34:00',
				3 => true,
				4 => 'abbr',
			],
			19 =>
			[
				0 => 'Du 1er juillet au 1er août 2001',
				1 => '2001-07-01 12:34:00',
				2 => '2001-08-01 12:34:00',
				3 => false,
				4 => 'abbr',
			],
			20 =>
			[
				0 => 'Du 1er juillet 2001 à 12h34 au 1er juillet 2011 à 12h34',
				1 => '2001-07-01 12:34:00',
				2 => '2011-07-01 12:34:00',
				3 => true,
				4 => 'abbr',
			],
			21 =>
			[
				0 => 'Du 1er juillet 2001 au 1er juillet 2011',
				1 => '2001-07-01 12:34:00',
				2 => '2011-07-01 12:34:00',
				3 => false,
				4 => 'abbr',
			],
			22 =>
			[
				0 => "<abbr class='dtstart' title='2001-07-01T10:34:00Z'>Dimanche 1er juillet 2001 à 12h34</abbr>",
				1 => '2001-07-01 12:34:00',
				2 => '2001-07-01 12:34:00',
				3 => true,
				4 => 'hcal',
			],
			23 =>
			[
				0 => "<abbr class='dtstart' title='2001-07-01T10:34:00Z'>Dimanche 1er juillet 2001</abbr>",
				1 => '2001-07-01 12:34:00',
				2 => '2001-07-01 12:34:00',
				3 => false,
				4 => 'hcal',
			],
			24 =>
			[
				0 => "<abbr class='dtstart' title='2001-07-01T10:34:00Z'>Dimanche 1er juillet 2001 de 12h34</abbr> à <abbr class='dtend' title='2001-07-01T11:34:00Z'>13h34</abbr>",
				1 => '2001-07-01 12:34:00',
				2 => '2001-07-01 13:34:00',
				3 => true,
				4 => 'hcal',
			],
			25 =>
			[
				0 => "<abbr class='dtstart' title='2001-07-01T10:34:00Z'>Dimanche 1er juillet 2001</abbr>",
				1 => '2001-07-01 12:34:00',
				2 => '2001-07-01 13:34:00',
				3 => false,
				4 => 'hcal',
			],
			26 =>
			[
				0 => 'Du <abbr class="dtstart" title="2001-07-01T10:34:00Z">1er juillet à 12h34</abbr> au <abbr class="dtend" title="2001-07-02T10:34:00Z">2 juillet 2001 à 12h34</abbr>',
				1 => '2001-07-01 12:34:00',
				2 => '2001-07-02 12:34:00',
				3 => true,
				4 => 'hcal',
			],
			27 =>
			[
				0 => 'Du <abbr class="dtstart" title="2001-07-01T10:34:00Z">1er</abbr> au <abbr class="dtend" title="2001-07-02T10:34:00Z">2 juillet 2001</abbr>',
				1 => '2001-07-01 12:34:00',
				2 => '2001-07-02 12:34:00',
				3 => false,
				4 => 'hcal',
			],
			28 =>
			[
				0 => 'Du <abbr class="dtstart" title="2001-07-01T10:34:00Z">1er juillet à 12h34</abbr> au <abbr class="dtend" title="2001-08-01T10:34:00Z">1er août 2001 à 12h34</abbr>',
				1 => '2001-07-01 12:34:00',
				2 => '2001-08-01 12:34:00',
				3 => true,
				4 => 'hcal',
			],
			29 =>
			[
				0 => 'Du <abbr class="dtstart" title="2001-07-01T10:34:00Z">1er juillet</abbr> au <abbr class="dtend" title="2001-08-01T10:34:00Z">1er août 2001</abbr>',
				1 => '2001-07-01 12:34:00',
				2 => '2001-08-01 12:34:00',
				3 => false,
				4 => 'hcal',
			],
			30 =>
			[
				0 => 'Du <abbr class="dtstart" title="2001-07-01T10:34:00Z">1er juillet 2001 à 12h34</abbr> au <abbr class="dtend" title="2011-07-01T10:34:00Z">1er juillet 2011 à 12h34</abbr>',
				1 => '2001-07-01 12:34:00',
				2 => '2011-07-01 12:34:00',
				3 => true,
				4 => 'hcal',
			],
			31 =>
			[
				0 => 'Du <abbr class="dtstart" title="2001-07-01T10:34:00Z">1er juillet 2001</abbr> au <abbr class="dtend" title="2011-07-01T10:34:00Z">1er juillet 2011</abbr>',
				1 => '2001-07-01 12:34:00',
				2 => '2011-07-01 12:34:00',
				3 => false,
				4 => 'hcal',
			],
		];
	}
}
