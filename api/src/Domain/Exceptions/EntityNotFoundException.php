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

    public function render($request) {
        return Response(
            [
                $this->message ??  'Entity not found.'
            ],
            Response::HTTP_NOT_FOUND
        );
    }
}
