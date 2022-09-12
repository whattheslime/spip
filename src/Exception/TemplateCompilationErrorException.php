<?php

declare(strict_types=1);

namespace Spip\Core\Testing\Exception;

class TemplateCompilationErrorException extends \Exception
{
	public function __construct($message = '', $code = 0, \Throwable $previous = null)
	{
		$message = sprintf("Compilation error '%s'", $message);
		parent::__construct($message, $code, $previous);
	}
}
