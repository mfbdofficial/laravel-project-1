<?php

namespace App\Exceptions;

use Exception;

//MATERI ERROR HANDLING - Ignore Exception (Report)
class ValidationException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
