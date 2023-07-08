<?php

declare(strict_types=1);

namespace Spip\Test\Squelettes\Balise;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;
use Spip\Test\SquelettesTestCase;

class CacheSessionTest extends SquelettesTestCase
{
	private static array $errors = [];
	private static string $squelettes;

	public static function setUpBeforeClass(): void {
		self::$squelettes = self::relativePath(__DIR__ . '/data/squelettes');
		$GLOBALS['dossier_squelettes'] = self::$squelettes;
		$GLOBALS['delais'] = 3600; // See boostrap.php qui met delais = 0 (inhibe le cache)
		include_spip('inc/invalideur');
		purger_repertoire(_DIR_CACHE . 'calcul/', ['subdir' => true]);
	}

	public static function tearDownAfterClass(): void {
		$GLOBALS['dossier_squelettes'] = '';
		$GLOBALS['delais'] = 0;
	}

	protected function setUp(): void {
		$this->resetErrors();
	}

	public function testVerifierPathMajInvalideurs(): void {
		$this->assertEquals(self::$squelettes, $GLOBALS['dossier_squelettes'] ?? null);
		$this->assertTrue(file_exists(__DIR__ . '/data/squelettes/inc/maj_invalideurs.php'));
		$this->assertNotFalse(find_in_path('inc/maj_invalideurs.php'));
		$this->assertNotFalse(include_spip('inc/maj_invalideurs'));
		$this->assertEquals('inc_maj_invalideurs', charger_fonction('maj_invalideurs', 'inc', true));
	}

	/** Vérifier qu’on sait attraper les données de cache */
	#[Depends('testVerifierPathMajInvalideurs')]
	#[DataProvider('providerVerifierCaptureMajInvalideurs')]
	public function testVerifierCaptureMajInvalideurs(int $expectedCountErrors, string $squelette, bool $session_attendue): void {
		$this->runWithSquelette($squelette, $session_attendue);
		$this->assertCount($expectedCountErrors, $this->getErrors(), $this->showErrors());
	}

	public static function providerVerifierCaptureMajInvalideurs(): array {
		return [
			[0, 'inclure/A_session_wo', false],
			[2, 'inclure/A_session_wo', true],
			[2, 'inclure/A_session_w', false],
			[0, 'inclure/A_session_w', true],
		];
	}

	#[Depends('testVerifierCaptureMajInvalideurs')]
	#[DataProvider('providerCachesSessionnes')]
	public function testCachesSessionnes(int $expectedCountErrors, string $squelette, bool $session_attendue): void {
		$this->runWithSquelette($squelette, $session_attendue);
		$this->assertCount($expectedCountErrors, $this->getErrors(), $this->showErrors());
	}

	public static function providerCachesSessionnes(): array {
		return [
			[0, 'cache_session_wo_1', false],
			[0, 'cache_session_wo_2', false],
			[0, 'cache_session_wo_3', false],
			[0, 'cache_session_wo_4', false],
			[0, 'cache_session_wo_5', false],
			[0, 'cache_session_wo_6', false],
			[0, 'cache_session_wo_7', false],
			[0, 'cache_session_w_1', true],
			[0, 'cache_session_w_2', true],
			[0, 'cache_session_w_3', true],
		];
	}

	private function runWithSquelette(string $fond, bool $session_attendue) {
		unset($GLOBALS['cache_utilise_session']);
		recuperer_fond($fond, [
			'assert_session' => $session_attendue,
			'caller' => 'none',
			'salt' => $this->saltContext(),
		]);
		unset($GLOBALS['cache_utilise_session']);
		recuperer_fond('root', [
			'sousfond' => $fond,
			'inc_assert_session' => $session_attendue,
			'salt' => $this->saltContext(),
		]);
	}

	private function saltContext(): string {
		return (string) time() . ':' . uniqid();
	}

	private function getErrors(): array {
		return self::$errors;
	}

	private function showErrors(): string {
		return "Errors:\n" . implode("\n", array_map(fn ($e) => "- $e", self::getErrors()));
	}

	private function resetErrors(): void {
		self::$errors = [];
	}

	public static function addError(string $msg, array $page): void {
		self::$errors[] = sprintf(
			'%s pour %s: %s',
			$msg,
			$page['source'],
			self::trace_contexte($page['contexte'])
		);
	}

	private static function trace_contexte(array $contexte): string {
		foreach ($contexte as $k => $v) {
			if (str_starts_with($k, 'date_') || $k === 'salt') {
				unset($contexte[$k]);
			}
		}
		if (isset($contexte['caller']) && str_starts_with($contexte['caller'], 'tests/squelettes/')) {
			$contexte['caller'] = substr($contexte['caller'], 17);
		}

		return json_encode($contexte, JSON_THROW_ON_ERROR);
	}
}
