<?php

namespace Src\Domain\Exceptions;

use Exception;
use Illuminate\Http\Response;

class EntityNotFoundException extends Exception
{
    public function __construct(
        protected $message = null
    ) {
        parent::__construct();
    }
}
