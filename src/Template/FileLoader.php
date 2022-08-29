<?php

namespace Spip\Core\Testing\Template;

use Spip\Core\Testing\Exception\TemplateNotFoundException;

class FileLoader implements LoaderInterface
{
	private int $rootLen;

	public function __construct() {
		$this->rootLen = strlen(_SPIP_TEST_CHDIR) + 1;
	}

	public function getSourceFile(string $name): string {
		$filepath = realpath($name);
		if (!file_exists($filepath)) {
			throw new TemplateNotFoundException($name);
		}
		$desc = pathinfo($name);
		$fond = $desc['dirname'] . '/' . $desc['filename'];
		$fond = substr($fond, $this->rootLen);

		return $fond;
	}
}
