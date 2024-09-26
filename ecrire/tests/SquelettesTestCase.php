<?php

declare(strict_types=1);

namespace Spip\Test;

use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use Spip\Test\Constraint\IsOk;

abstract class SquelettesTestCase extends TestCase
{
	/**
	 * Determine si une chaine débute par 'NA' (non applicable)
	 */
	public static function isNa(string $chaine): bool {
		return str_starts_with(strtolower(trim($chaine)), 'na');
	}

	/**
	 * Retourne le chemin relatif depuis la racine de SPIP
	 */
	public static function relativePath(string $fullDirectory): string {
		if (!defined('_SPIP_TEST_CHDIR')) {
			throw new RuntimeException('_SPIP_TEST_CHDIR needs to be defined');
		}

		return substr($fullDirectory, strlen(_SPIP_TEST_CHDIR) + 1);
	}

	/**
	 * Determine si une chaine débute par 'OK'
	 */
	public static function assertOk($actual, string $message = ''): void {
		$constraint = new IsOk($actual);

		static::assertThat($actual, $constraint, $message);
	}

	/**
	 * Determine si une chaine ne débute pas par 'OK'
	 */
	public static function assertNotOk($actual, string $message = ''): void {
		$constraint = new LogicalNot(new IsOk($actual));

		static::assertThat($actual, $constraint, $message);
	}

	/**
	 * Assertion qui vérifie que le résultat d’un template est 'OK'
	 *
	 * @example
	 * $templating = new Templating(new StringLoader());
	 * $this->assertOkTemplate($templating, '[(#CONFIG{pasla}|non)ok]');
	 *
	 * $templating = new Templating(new FileLoader());
	 * $this->assertOkTemplate($templating, __DIR__ . '/data/truc.html');
	 *
	 * @param string $code Code ou chemin du squelette
	 * @param array $contexte Contexte de calcul du squelette
	 * @param string $message Message pour une eventuelle erreur
	 */
	public static function assertOkTemplate(
		Templating $templating,
		string $code,
		array $contexte = [],
		string $message = ''
	): void {
		$actual = $templating->render($code, $contexte);

		static::assertOk($actual, $message);
	}

	/**
	 * Assertion qui vérifie que le résultat d’un template est vide
	 *
	 * @see assertOkTemplate()
	 */
	public static function assertNotOkTemplate(
		Templating $templating,
		string $code,
		array $contexte = [],
		string $message = ''
	): void {
		$actual = $templating->render($code, $contexte);

		static::assertNotOk($actual, $message);
	}

	/**
	 * Assertion qui vérifie que le résultat d’un template est vide
	 *
	 * @see assertOkTemplate()
	 */
	public static function assertEmptyTemplate(
		Templating $templating,
		string $code,
		array $contexte = [],
		string $message = ''
	): void {
		$actual = $templating->render($code, $contexte);

		static::assertEmpty($actual, $message);
	}

	/**
	 * Assertion qui vérifie que le résultat d’un template n’est pas vide
	 *
	 * @see assertOkTemplate()
	 */
	public static function assertNotEmptyTemplate(
		Templating $templating,
		string $code,
		array $contexte = [],
		string $message = ''
	): void {
		$actual = $templating->render($code, $contexte);

		static::assertNotEmpty($actual, $message);
	}

	/**
	 * Assertion qui vérifie le résultat d’un template
	 *
	 * @see assertOkTemplate()
	 */
	public static function assertEqualsTemplate(
		string $expected,
		Templating $templating,
		string $code,
		array $contexte = [],
		string $message = ''
	): void {
		$actual = $templating->render($code, $contexte);

		static::assertEquals($expected, $actual, $message);
	}

	/**
	 * Assertion qui vérifie le résultat d’un template
	 *
	 * @see assertOkTemplate()
	 */
	public static function assertNotEqualsTemplate(
		string $expected,
		Templating $templating,
		string $code,
		array $contexte = [],
		string $message = ''
	): void {
		$actual = $templating->render($code, $contexte);

		static::assertNotEquals($expected, $actual, $message);
	}

	/**
	 * Assertion qui vérifie que le résultat d’un code de squelette est 'OK'
	 *
	 * @example $this->assertOkCode('[(#CONFIG{pasla}|non)ok]');
	 *
	 * @param string $code Code ou chemin du squelette
	 * @param array $contexte Contexte de calcul du squelette
	 * @param string $message Message pour une eventuelle erreur
	 */
	public static function assertOkCode(string $code, array $contexte = [], string $message = ''): void {
		static::assertOkTemplate(Templating::fromString(), $code, $contexte);
	}

	/**
	 * Assertion qui vérifie que le résultat d’un code de squelette n’est pas 'OK'
	 *
	 * @see assertOkCode()
	 */
	public function assertNotOkCode(string $code, array $contexte = [], $message = ''): void {
		static::assertNotOkTemplate(Templating::fromString(), $code, $contexte);
	}

	/**
	 * Assertion qui vérifie que le résultat d’un code de squelette est vide
	 *
	 * @see assertOkCode()
	 */
	public static function assertEmptyCode(string $code, array $contexte = [], string $message = ''): void {
		static::assertEmptyTemplate(Templating::fromString(), $code, $contexte);
	}

	/**
	 * Assertion qui vérifie que le résultat d’un code de squelette n’est pas vide
	 *
	 * @see assertOkCode()
	 */
	public static function assertNotEmptyCode(string $code, array $contexte = [], string $message = ''): void {
		static::assertNotEmptyTemplate(Templating::fromString(), $code, $contexte);
	}

	/**
	 * Assertion qui vérifie le résultat d’un code de squelette
	 *
	 * @see assertOkCode()
	 */
	public function assertEqualsCode(string $expected, string $code, array $contexte = [], $message = ''): void {
		static::assertEqualsTemplate($expected, Templating::fromString(), $code, $contexte);
	}

	/**
	 * Assertion qui vérifie le résultat d’un code de squelette
	 *
	 * @see assertOkCode()
	 */
	public function assertNotEqualsCode(string $expected, string $code, array $contexte = [], $message = '') {
		static::assertNotEqualsTemplate($expected, Templating::fromString(), $code, $contexte);
	}

	/**
	 * Assertion qui vérifie que le résultat d’un fichier de squelette est 'OK'
	 *
	 * @example $this->assertOkSquelette(__DIR__ . '/data/squelette.html');
	 *
	 * @param string $code Code ou chemin du squelette
	 * @param array $contexte Contexte de calcul du squelette
	 * @param string $message Message pour une eventuelle erreur
	 */
	public static function assertOkSquelette(string $code, array $contexte = [], string $message = ''): void {
		static::assertOkTemplate(Templating::fromFile(), $code, $contexte);
	}

	/**
	 * Assertion qui vérifie que le résultat d’un fichier de squelette n’est pas 'OK'
	 *
	 * @see assertOkSquelette()
	 */
	public function assertNotOkSquelette(string $code, array $contexte = [], $message = ''): void {
		static::assertNotOkTemplate(Templating::fromFile(), $code, $contexte);
	}

	/**
	 * Assertion qui vérifie que le résultat d’un fichier de squelette est vide
	 *
	 * @see assertOkSquelette()
	 */
	public static function assertEmptySquelette(string $code, array $contexte = [], string $message = ''): void {
		static::assertEmptyTemplate(Templating::fromFile(), $code, $contexte);
	}

	/**
	 * Assertion qui vérifie que le résultat d’un fichier de squelette n’est pas vide
	 *
	 * @see assertOkSquelette()
	 */
	public static function assertNotEmptySquelette(string $code, array $contexte = [], string $message = ''): void {
		static::assertNotEmptyTemplate(Templating::fromFile(), $code, $contexte);
	}

	/**
	 * Assertion qui vérifie le résultat d’un fichier de squelette
	 *
	 * @see assertOkSquelette()
	 */
	public function assertEqualsSquelette(string $expected, string $code, array $contexte = [], $message = ''): void {
		static::assertEqualsTemplate($expected, Templating::fromFile(), $code, $contexte);
	}

	/**
	 * Assertion qui vérifie le résultat d’un fichier de squelette
	 *
	 * @see assertOkSquelette()
	 */
	public function assertNotEqualsSquelette(string $expected, string $code, array $contexte = [], $message = '') {
		static::assertNotEqualsTemplate($expected, Templating::fromFile(), $code, $contexte);
	}
}
