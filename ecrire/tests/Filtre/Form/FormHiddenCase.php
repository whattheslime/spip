<?php

declare(strict_types=1);

namespace Spip\Test\Filtre\Form;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class FormHiddenCase extends TestCase
{
	public const TYPE = '';

	protected static ?int $id_rubrique;

	public static function setUpBeforeClass(): void {
		find_in_path('inc/filtres.php', '', true);
		self::backupUrls();
		if (!static::TYPE) {
			throw new RuntimeException('Subclass needs to define TYPE');
		}
		$GLOBALS['type_urls'] = static::TYPE;
		$GLOBALS['profondeur_url'] = 0;
		self::$id_rubrique = self::getIdRubrique();
	}

	public static function setTearDownAfterClass(): void {
		self::backupUrls(true);
	}

	public static function backupUrls(bool $restore = false): void {
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

	public function testHasRubrique(): void {
		$id = self::$id_rubrique;
		if (!$id) {
			$this->markTestSkipped('Needs a published rubrique');
		}
		$this->assertNotNull($id);
	}

	#[Depends('testHasRubrique')]
	#[DataProvider('providerFormHiddenRubrique')]
	public function testFormHiddenRubrique($expected, ...$args): void {
		$id = self::$id_rubrique;
		$expected = sprintf($expected, $id);
		$args[0] = sprintf($args[0], $id);
		$actual = form_hidden(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerFormHiddenRubrique(): array {
		$id = '%s';
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

	protected static function getIdRubrique(): ?int {
		include_spip('base/abstract_sql');
		$id_rubrique = sql_getfetsel(
			'id_rubrique',
			'spip_rubriques',
			['statut = ' . sql_quote('publie')],
			limit: '0, 1',
		);
		return $id_rubrique ? (int) $id_rubrique : null;
	}
}
