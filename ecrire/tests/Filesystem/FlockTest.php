<?php

declare(strict_types=1);

namespace Spip\Test\Filesystem;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class FlockTest extends TestCase
{
	public static function setUpBeforeClass(): void {
		include_spip('inc/flock');
	}

	public function testSousRepertoire(): void {
		$sous_repertoire = 'test' . md5(strval(random_int(0, mt_getrandmax())));
		$this->assertSame(
			sous_repertoire(_DIR_VAR, $sous_repertoire),
			_DIR_VAR . $sous_repertoire . '/'
		);
		$this->assertTrue(file_exists(_DIR_VAR . $sous_repertoire));
		$this->assertTrue(is_dir(_DIR_VAR . $sous_repertoire));

		// Nettoyage
		@unlink(_DIR_VAR . $sous_repertoire . '/.ok');
		@rmdir(_DIR_VAR . $sous_repertoire);
	}
}
