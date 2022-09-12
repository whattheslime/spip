<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction affdate_court du fichier inc/filtres.php
 */

namespace Spip\Core\Tests\Filtre\Form;

use PHPUnit\Framework\TestCase;

class FormHiddenCase extends TestCase
{
	public const TYPE = '';

	public static function setUpBeforeClass(): void
	{
		find_in_path('inc/filtres.php', '', true);
		self::backupUrls();
		if (!static::TYPE) {
			throw new \RuntimeException("Subclass needs to define TYPE");
		}
		$GLOBALS['type_urls'] = static::TYPE;
		$GLOBALS['profondeur_url'] = 0;
	}

	public static function setTearDownAfterClass(): void
	{
		self::backupUrls(true);
	}

	public static function backupUrls(bool $restore = false): void
	{
		static $type = null;
		static $profondeur_url = 0;
		if ($restore) {
			$GLOBALS['type_urls'] = $type;
			$GLOBALS['profondeur_url'] = $profondeur_url;
		} else {
			$type = $GLOBALS['type_urls'] ?? null;
			$profondeur_url = $GLOBALS['profondeur_url'] ?? 0;
		}
	}

	protected function getIdRubrique(): ?int {
		include_spip('base/abstract_sql');
		$id_rubrique = sql_getfetsel(
			'id_rubrique',
			'spip_rubriques',
			['statut = ' . sql_quote('publie')]
		);
		return $id_rubrique ? (int) $id_rubrique : null;
	}

	public function testHasRubrique(): void
	{
		$id = $this->getIdRubrique();
		if (!$id) {
			$this->markTestSkipped("Needs a published rubrique");
		}
		$this->assertNotNull($this->getIdRubrique());
	}

	/**
	 * @depends testHasRubrique
	 * @dataProvider providerFormHiddenRubrique
	 */
	public function testFormHiddenRubrique($expected, ...$args): void
	{
		$actual = form_hidden(...$args);
		$this->assertSame($expected, $actual);
		$this->assertEquals($expected, $actual);
	}

	public function providerFormHiddenRubrique(): array
	{
		$id = $this->getIdRubrique();
		return [
			0 =>
			[
				0 => '<input name="id_rubrique" value="' . $id . '" type="hidden"
/><input name="page" value="rubrique" type="hidden"
/>',
				1 => './?rubrique' . $id,
			],
			1 =>
			[
				0 => '<input name="calendrier" value="1" type="hidden"
/><input name="id_rubrique" value="' . $id . '" type="hidden"
/><input name="page" value="rubrique" type="hidden"
/>',
				1 => './?rubrique' . $id . '&calendrier=1',
			],
			2 =>
			[
				0 => '<input name="id_rubrique" value="' . $id . '" type="hidden"
/><input name="page" value="rubrique" type="hidden"
/>',
				1 => './rubrique' . $id . '.html',
			],
			3 =>
			[
				0 => '<input name="calendrier" value="1" type="hidden"
/><input name="id_rubrique" value="' . $id . '" type="hidden"
/><input name="page" value="rubrique" type="hidden"
/>',
				1 => './rubrique' . $id . '.html?calendrier=1',
			],
			4 =>
			[
				0 => '<input name="calendrier" value="1" type="hidden"
/><input name="id_rubrique" value="' . $id . '" type="hidden"
/><input name="page" value="rubrique" type="hidden"
/>',
				1 => './?rubrique' . $id . '&amp;calendrier=1',
			],
			5 =>
			[
				0 => '<input name="calendrier" value="1" type="hidden"
/><input name="toto" value="2" type="hidden"
/><input name="id_rubrique" value="' . $id . '" type="hidden"
/><input name="page" value="rubrique" type="hidden"
/>',
				1 => './rubrique' . $id . '.html?calendrier=1&amp;toto=2',
			],
		];
	}
}
