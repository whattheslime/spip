<?php

declare(strict_types=1);

namespace Spip\Test\Template\Loader;

use Spip\Test\Exception\TemplateNotFoundException;

class FileLoader implements LoaderInterface
{
	private readonly int $rootLen;

	public function __construct() {
		$this->rootLen = strlen(_SPIP_TEST_CHDIR) + 1;
	}

	public function exists(string $name): bool {
		$filepath = realpath($name);
		return ($filepath !== false) && file_exists($filepath);
	}

	public function getCacheKey(string $name): string {
		return $this->getSourceFile($name);
	}

	public function getSourceFile(string $name): string {
		$filepath = realpath($name);
		if (!$filepath || !file_exists($filepath)) {
			throw new TemplateNotFoundException($name);
		}

		$desc = pathinfo($name);
		$fond = $desc['dirname'] . '/' . $desc['filename'];

		return substr($fond, $this->rootLen);
	}
}
