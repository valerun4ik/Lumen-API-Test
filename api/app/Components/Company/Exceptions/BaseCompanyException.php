<?php

namespace App\Components\Company\Exceptions;

use Exception;
use Throwable;

class BaseCompanyException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct(
            printf("Company Exception. Error: %s", $message),
            $code,
            $previous
        );
    }

}
