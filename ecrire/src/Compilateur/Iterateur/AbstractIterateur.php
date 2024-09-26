<?php

namespace Spip\Compilateur\Iterateur;

abstract class AbstractIterateur
{
	/**
	 * Calcul du total des elements
	 *
	 * @var int|null
	 */
	public $total = null;

	/**
	 * Erreur presente ?
	 */
	public bool $err = false;

	protected string $type;

	public function __construct(
		protected array $command,
		protected array $info = []
	) {
	}
}
