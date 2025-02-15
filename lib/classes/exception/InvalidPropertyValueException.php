<?php
declare(strict_types=1);

namespace iutnc\deefy\exception;
use Exception;
use Throwable;

class  InvalidPropertyValueException extends Exception
{
    public function __construct($message = "Propriété inexistante", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}