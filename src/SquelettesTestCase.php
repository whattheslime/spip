<?php

namespace Spip\Core\Testing;

use PHPUnit\Framework\TestCase;
use Spip\Core\Testing\Constraint\IsOk;
use PHPUnit\Framework\Constraint\LogicalNot;

abstract class SquelettesTestCase extends TestCase
{

	/**
	 * Determine si une chaine est de type NA (non applicable)
	 */
	public function isNa(string $chaine): bool {
		return substr(strtolower(trim($chaine)), 0, 2) === 'na';
	}

	public static function assertOk($actual, string $message = ''): void
    {
        $constraint = new IsOk($actual);

        static::assertThat($actual, $constraint, $message);
    }

	public static function assertNotOk($actual, string $message = ''): void
    {
        $constraint = new LogicalNot(new IsOk($actual));

        static::assertThat($actual, $constraint, $message);
    }


	/**
	 * Assertion qui verifie si le retour vaut 'ok' (casse indifferente)
	 * la fonction appelle recuperer_code avec les arguments.
	 *
	 * L'appel
	 * 		$this->assertOkCode('[(#CONFIG{pasla}|non)ok]');
	 * est equivalent de :
	 * 		$this->assertOk($this->recuperer_code('[(#CONFIG{pasla}|non)ok]'));
	 *
	 * @uses Code
	 * @param string $code : code du squelette
	 * @param array $contexte : contexte de calcul du squelette
	 * @param string $message : message pour une eventuelle erreur
	 *
	 * @return true/false
	 */
	public static function assertOkCode(string $code, array $contexte = [], string $message = "%s"): void {

		$actual = (new Code())->render($code, $contexte);

		static::assertOk($actual, $message);
	}

	/**
	 * Assertion qui verifie si le retour ne vaut pas 'ok' (casse indifferente)
	 * la fonction appelle recuperer_code avec les arguments.
	 *
	 * L'appel
	 * 		$this->assertNotOkCode('[(#CONFIG{pasla}|oui)ok]');
	 * est equivalent de :
	 * 		$this->assertNotOk($this->recuperer_code('[(#CONFIG{pasla}|oui)ok]'));
	 *
	 * @uses Code
	 * @param string $code : code du squelette
	 * @param array $contexte : contexte de calcul du squelette
	 * @param string $message : message pour une eventuelle erreur
	 *
	 * @return true/false
	 */
	function assertNotOkCode(string $code, array $contexte = [], $message = "%s") {

		$actual = (new Code())->render($code, $contexte);

		static::assertNotOk($actual, $message);
	}


	/**
	 * Assertion qui verifie si le retour vaut $value
	 * la fonction appelle recuperer_code avec les arguments.
	 *
	 * L'appel
	 * 		$this->assertEqualsCode('ok','[(#CONFIG{pasla}|non)ok]');
	 * est equivalent de :
	 * 		$this->assertEquals('ok',$this->recuperer_code('[(#CONFIG{pasla}|non)ok]'));
	 *
	 * @uses Code
	 * @param string $expected : chaine a comparer au resultat du code
	 * @param string $code : code du squelette
	 * @param array $contexte : contexte de calcul du squelette
	 * @param string $message : message pour une eventuelle erreur
	 *
	 * @return true/false
	 */
	function assertEqualsCode(string $expected, string $code, array $contexte = [], $message = "%s") {

		$actual = (new Code())->render($code, $contexte);

		static::assertEquals($expected, $actual, $message);
	}


	/**
	 * Assertion qui verifie si le retour ne vaut pas $value
	 * la fonction appelle recuperer_code avec les arguments.
	 *
	 * L'appel
	 * 		$this->assertNotEqualsCode('ok','[(#CONFIG{pasla}|non)ok]');
	 * est equivalent de :
	 * 		$this->assertNotEquals('ok',$this->recuperer_code('[(#CONFIG{pasla}|non)ok]'));
	 *
	 * @uses Code
	 * @param string $value : chaine a comparer au resultat du code
	 * @param string $code : code du squelette
	 * @param array $contexte : contexte de calcul du squelette
	 * @param string $message : message pour une eventuelle erreur
	 *
	 * @return true/false
	 */
	function assertNotEqualsCode(string $expected, string $code, array $contexte = [], $message = "%s") {

		$actual = (new Code())->render($code, $contexte);

		static::assertNotEquals($expected, $actual, $message);
	}

}
