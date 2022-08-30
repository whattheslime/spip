<?php

namespace Spip\Core\Testing\Template\Loader;

use Spip\Core\Testing\Exception\TemplateNotFoundException;

class ChainLoader implements LoaderInterface
{
	/** @var LoaderInterface[] */
	private array $loaders = [];
	private array $cache = [];

	public function __construct(array $loaders) {
		foreach ($loaders as $loader) {
            $this->addLoader($loader);
        }
	}

	private function addLoader(LoaderInterface $loader) {
		$this->loaders[] = $loader;
		$this->cache = [];
	}

	public function exists(string $name): bool {
        if (isset($this->cache[$name])) {
            return $this->cache[$name];
        }

        foreach ($this->loaders as $loader) {
            if ($loader->exists($name)) {
                return $this->cache[$name] = true;
            }
        }

        return $this->cache[$name] = false;
    }

	public function getCacheKey(string $name): string {
		foreach ($this->loaders as $loader) {
			if (!$loader->exists($name)) {
				continue;
			}

			return $loader->getCacheKey($name);
		}
		throw new TemplateNotFoundException($name);
	}

	public function getSourceFile(string $name): string {
		foreach ($this->loaders as $loader) {
            if (!$loader->exists($name)) {
                continue;
            }

            return $loader->getSourceFile($name);
        }
		throw new TemplateNotFoundException($name);
	}
}
