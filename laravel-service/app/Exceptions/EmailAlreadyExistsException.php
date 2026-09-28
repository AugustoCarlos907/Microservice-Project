<?php

namespace App\Exceptions;

use Exception;

class EmailAlreadyExistsException extends Exception
{
    public function __construct(string $email)
    {
        parent::__construct("O e-mail [{$email}] já está em uso.");
    }
}