<?php

declare(strict_types=1);

namespace Spip\Core\Testing\Template\Loader;

use Spip\Core\Testing\Exception\TemplateNotFoundException;

class FileLoader implements LoaderInterface
{
	private int $rootLen;

	public function __construct()
	{
		$this->rootLen = strlen(_SPIP_TEST_CHDIR) + 1;
	}

	public function exists(string $name): bool
	{
		$filepath = realpath($name);
		return file_exists($filepath);
	}

	public function getCacheKey(string $name): string
	{
		return $this->getSourceFile($name);
	}

	public function getSourceFile(string $name): string
	{
		$filepath = realpath($name);
		if (! file_exists($filepath)) {
			throw new TemplateNotFoundException($name);
		}

		$desc = pathinfo($name);
		$fond = $desc['dirname'] . '/' . $desc['filename'];

		return substr($fond, $this->rootLen);
	}
}
