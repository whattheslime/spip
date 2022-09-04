<?php

namespace Spip\Core\Tests\Squelettes\Filtre;

use Spip\Core\Testing\SquelettesTestCase;

class LogiquesTest extends SquelettesTestCase {

	public function testOui(): void {
		$this->assertNotOkCode("[(#VAL|oui)ok]");
		$this->assertOkCode("[(#VAL{1}|oui)ok]");
		$this->assertOkCode("[(#VAL{' '}|oui)ok]");
	}

	public function testYes(): void {
		$this->assertNotOkCode("[(#VAL|yes)ok]");
		$this->assertOkCode("[(#VAL{1}|yes)ok]");
		$this->assertOkCode("[(#VAL{' '}|yes)ok]");
	}

	public function testNon(): void {
		$this->assertOkCode("[(#VAL|non)ok]");
		$this->assertNotOkCode("[(#VAL{1}|non)ok]");
		$this->assertNotOkCode("[(#VAL{' '}|non)ok]");
	}

	public function testNot(): void {
		$this->assertOkCode("[(#VAL|not)ok]");
		$this->assertNotOkCode("[(#VAL{1}|not)ok]");
		$this->assertNotOkCode("[(#VAL{' '}|not)ok]");
	}

	public function testEt(): void {
		$this->assertOkCode("[(#VAL{1}|et{#VAL{1}})ok]");
		$this->assertOkCode("[(#VAL{0}|et{#VAL{0}}|non)ok]");
		$this->assertOkCode("[(#VAL{1}|et{#VAL{0}}|non)ok]");
		$this->assertOkCode("[(#VAL{0}|et{#VAL{1}}|non)ok]");
	}

	public function testAnd(): void {
		$this->assertOkCode("[(#VAL{1}|and{#VAL{1}})ok]");
		$this->assertOkCode("[(#VAL{0}|and{#VAL{0}}|non)ok]");
		$this->assertOkCode("[(#VAL{1}|and{#VAL{0}}|non)ok]");
		$this->assertOkCode("[(#VAL{0}|and{#VAL{1}}|non)ok]");
	}

	public function testOu(): void {
		$this->assertOkCode("[(#VAL{1}|ou{#VAL{1}})ok]");
		$this->assertOkCode("[(#VAL{0}|ou{#VAL{0}}|non)ok]");
		$this->assertOkCode("[(#VAL{1}|ou{#VAL{0}})ok]");
		$this->assertOkCode("[(#VAL{0}|ou{#VAL{1}})ok]");
	}

	public function testOr(): void {
		$this->assertOkCode("[(#VAL{1}|or{#VAL{1}})ok]");
		$this->assertOkCode("[(#VAL{0}|or{#VAL{0}}|non)ok]");
		$this->assertOkCode("[(#VAL{1}|or{#VAL{0}})ok]");
		$this->assertOkCode("[(#VAL{0}|or{#VAL{1}})ok]");
	}

	public function testXou(): void {
		$this->assertOkCode("[(#VAL{1}|xou{#VAL{1}}|non)ok]");
		$this->assertOkCode("[(#VAL{0}|xou{#VAL{0}}|non)ok]");
		$this->assertOkCode("[(#VAL{1}|xou{#VAL{0}})ok]");
		$this->assertOkCode("[(#VAL{0}|xou{#VAL{1}})ok]");
	}

	public function testXor(): void {
		$this->assertOkCode("[(#VAL{1}|xor{#VAL{1}}|non)ok]");
		$this->assertOkCode("[(#VAL{0}|xor{#VAL{0}}|non)ok]");
		$this->assertOkCode("[(#VAL{1}|xor{#VAL{0}})ok]");
		$this->assertOkCode("[(#VAL{0}|xor{#VAL{1}})ok]");
	}
}
