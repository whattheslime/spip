<?php

/**
 * SPIP, Système de publication pour l'internet
 *
 * Copyright © avec tendresse depuis 2001
 * Arnaud Martin, Antoine Pitrou, Philippe Rivière, Emmanuel Saint-James
 *
 * Ce programme est un logiciel libre distribué sous licence GNU/GPL.
 */

namespace Spip\Chiffrer;

/** Conteneur de clés (chiffrement, authentification) */
class Cles implements \Countable /* , ContainerInterface */
{
	public function __construct(
		private array $keys
	) {
	}

	public function has(string $name): bool {
		return array_key_exists($name, $this->keys);
	}

	public function get(string $name): ?string {
		return $this->keys[$name] ?? null;
	}

	public function generate(string $name): string {
		$key = Chiffrement::keygen();
		$this->keys[$name] = $key;
		spip_logger('chiffrer')
			->notice("Création de la cle $name");
		return $key;
	}

	public function set(string $name, #[\SensitiveParameter] string $key): void {
		$this->keys[$name] = $key;
	}

	public function delete(string $name): bool {
		if (isset($this->keys[$name])) {
			unset($this->keys[$name]);
			return true;
		}
		return false;
	}

	public function count(): int {
		return count($this->keys);
	}

	public function toJson(): string {
		$json = array_map('base64_encode', $this->keys);
		return \json_encode($json, JSON_THROW_ON_ERROR);
	}
}
