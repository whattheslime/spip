<?php

declare(strict_types=1);

/**
 * Test unitaire de la fonction antispam du fichier inc/filtres.php
 */

namespace Spip\Test\Filtre;

use PHPUnit\Framework\TestCase;

class AntispamTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		find_in_path('inc/filtres.php', '', true);
	}

	public function testFiltresAntispam(): void
	{
		$actual = antispam('email@domain.tld');
		$this->assertStringNotContainsString('@', $actual);
	}
}
