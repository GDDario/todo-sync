<?php

namespace Src\Domain\Exceptions;

use Exception;
use Illuminate\Http\Response;

class ValueAlreadyTakenException extends Exception
{
    public function __construct(
        public $value,
    )
    {
        parent::__construct();
    }
}
