<?php

declare(strict_types=1);

namespace Spip\Test\Exception;

use Exception;
use Throwable;

class TemplateCompilationErrorException extends Exception
{
	public function __construct($message = '', $code = 0, Throwable $previous = null) {
		$message = sprintf("Compilation error '%s'", $message);
		parent::__construct($message, $code, $previous);
	}
}
