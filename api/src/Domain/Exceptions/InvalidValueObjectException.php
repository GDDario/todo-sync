<?php

namespace Src\Domain\Exceptions;

use Exception;
use Illuminate\Http\Response;

class InvalidValueObjectException extends Exception
{
    protected $message;

    public function __construct(
        $message
    ) {
        parent::__construct();
        $this->message = $message;
    }
}
