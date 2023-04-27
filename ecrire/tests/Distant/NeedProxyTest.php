<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction need_proxy du fichier ./inc/distant.php
 */

namespace Spip\Test\Distant;

use PHPUnit\Framework\TestCase;

class NeedProxyTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		find_in_path('./inc/distant.php', '', true);
	}

	/**
	 * @dataProvider providerDistantNeedProxy
	 */
	public function testDistantNeedProxy($expected, ...$args): void
	{
		$actual = need_proxy(...$args);
		$this->assertSame($expected, $actual);
	}

	public static function providerDistantNeedProxy(): array
	{
		return [
			0 => [
				0 => 'http://monproxy.example.org',
				1 => 'sous.domaine.spip.net',
				2 => 'http://monproxy.example.org',
				3 => 'spip.net',
			],
			1 => [
				0 => '',
				1 => 'sous.domaine.spip.net',
				2 => 'http://monproxy.example.org',
				3 => '.spip.net',
			],
			2 => [
				0 => '',
				1 => 'sous.domaine.spip.net',
				2 => 'http://monproxy.example.org',
				3 => '.spip.net
.net',
			],
			3 => [
				0 => '',
				1 => 'sous.domaine.spip.net',
				2 => 'http://monproxy.example.org',
				3 => 'sous.domaine.spip.net',
			],
			4 => [
				0 => 'http://monproxy.example.org',
				1 => 'sous.domaine.spip.net',
				2 => 'http://monproxy.example.org',
				3 => '.sous.domaine.spip.net',
			],
		];
	}
}
