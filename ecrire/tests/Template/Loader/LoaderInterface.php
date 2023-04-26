<?php

declare(strict_types=1);

namespace Spip\Test\Template\Loader;

interface LoaderInterface
{
	public function exists(string $name): bool;

	public function getSourceFile(string $name): string;

	public function getCacheKey(string $name): string;
}
