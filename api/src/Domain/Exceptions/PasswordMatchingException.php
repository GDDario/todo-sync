<?php

namespace Src\Domain\Exceptions;

use Exception;
use Illuminate\Http\Response;

class PasswordMatchingException extends Exception
{
    public function __construct(
    ) {
        parent::__construct();
    }
}
