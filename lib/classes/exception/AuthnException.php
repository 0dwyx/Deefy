<?php

namespace iutnc\deefy\exception;

use Exception;
use Throwable;

class AuthnException extends Exception
{
    public function __construct($message = "Erreur d'authentification", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}