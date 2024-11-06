<?php

namespace iutnc\deefy\exception;

class AuthzException extends \Exception
{

    /**
     * @param string $string
     */
    public function __construct($message = "Erreur d'autorisation", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}