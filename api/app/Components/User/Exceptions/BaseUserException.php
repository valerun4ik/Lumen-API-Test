<?php

namespace App\Components\User\Exceptions;

use Exception;
use Throwable;

class BaseUserException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct(
            printf("User Exception. Error: %s", $message),
            $code,
            $previous
        );
    }

}
