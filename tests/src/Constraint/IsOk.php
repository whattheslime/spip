<?php

declare(strict_types=1);

namespace Spip\Core\Testing\Constraint;

use PHPUnit\Framework\Constraint\Constraint;

final class IsOk extends Constraint
{
	/**
	 * Returns a string representation of the constraint.
	 */
	public function toString(): string
	{
		return 'is OK';
	}

	/**
	 * Evaluates the constraint for parameter $other. Returns true if the constraint is met, false otherwise.
	 *
	 * @param mixed $other value or object to evaluate
	 */
	protected function matches($other): bool
	{
		return substr(strtolower(trim($other)), 0, 2) === 'ok';
	}

	/**
	 * Returns the description of the failure.
	 *
	 * The beginning of failure messages is "Failed asserting that" in most cases. This method should return the second
	 * part of that sentence.
	 *
	 * @param mixed $other evaluated value or object
	 */
	protected function failureDescription($other): string
	{
		return sprintf('"%s" is OK', $other);
	}
}
