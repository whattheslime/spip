<?php

declare(strict_types=1);

namespace Spip\Core\Testing;

use Spip\Core\Testing\Template\Loader\FileLoader;
use Spip\Core\Testing\Template\Loader\LoaderInterface;
use Spip\Core\Testing\Template\Loader\StringLoader;

class Templating
{
	private LoaderInterface $loader;

	public function __construct(LoaderInterface $loader)
	{
		$this->loader = $loader;
	}

	public static function fromString(array $options = []): self
	{
		return new static(new StringLoader($options));
	}

	public static function fromFile(): self
	{
		return new static(new FileLoader());
	}

	public function getLoader(): LoaderInterface
	{
		return $this->loader;
	}

	public function load(string $name): Template
	{
		$source = $this->loader->getSourceFile($name);
		return new Template($source);
	}

	public function render(string $name, array $contexte = [], string $connect = ''): string
	{
		return $this->load($name)
			->render($contexte, $connect);
	}

	public function rawRender(string $name, array $contexte = [], string $connect = ''): array
	{
		return $this->load($name)
			->rawRender($contexte, $connect);
	}
}
