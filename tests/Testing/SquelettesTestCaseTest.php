<?php

declare(strict_types=1);

namespace Spip\Core\Tests\Testing;

use PHPUnit\Framework\AssertionFailedError;
use Spip\Core\Testing\SquelettesTestCase;

class SquelettesTestCaseTest extends SquelettesTestCase
{
	public function testAssertOk(): void
	{
		$this->assertOk('ok');
		$this->assertOk('Ok');
		$this->assertOk('OK');
		$this->assertOk('OK NOK NA');
	}

	public function testAssertOkExceptionNok(): void
	{
		$this->expectException(AssertionFailedError::class);
		$this->assertOk('NOK');
	}

	public function testAssertOkExceptionNa(): void
	{
		$this->expectException(AssertionFailedError::class);
		$this->assertOk('NA');
	}

	public function testAssertNotOk()
	{
		$this->assertNotOk('nOK');
		$this->assertNotOk('NOK');
		$this->assertNotOk('Nok');
		$this->assertNotOk('Nok OK NA');
	}

	public function testAssertNotOkExceptionOk(): void
	{
		$this->expectException(AssertionFailedError::class);
		$this->assertNotOk('OK');
	}

	public function testAssertNotOkExceptionNa(): void
	{
		$this->expectException(AssertionFailedError::class);
		$this->assertOk('Na');
	}

	public function testIsNa(): void
	{
		$this->assertTrue($this->isNa(' NA texte'));
		$this->assertTrue($this->isNa('na texte'));
		$this->assertfalse($this->isNa('texte NA'));
		$this->assertfalse($this->isNa('texte'));
	}
}
