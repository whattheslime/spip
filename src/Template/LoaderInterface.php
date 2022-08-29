<?php

namespace Spip\Core\Testing\Template;

interface LoaderInterface
{
	public function getSourceFile(string $name): string;

}
