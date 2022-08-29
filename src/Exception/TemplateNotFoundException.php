<?php

namespace Spip\Core\Testing\Exception;

class TemplateNotFoundException extends \Exception
{
	public function __construct($message = '', $code = 0, \Throwable $previous = null) {
		$message = sprintf("'%s' template not found", $message);
		parent::__construct($message, $code, $previous);
	}
}
