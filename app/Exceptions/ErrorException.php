<?php

namespace App\Exceptions;

use Exception;

final class ErrorException extends Exception
{
    protected $errors = [];

    public function __construct($message = '', $code = 500, array $errors = [])
    {

        parent::__construct($message, $code);
        $this->errors = $errors;
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
