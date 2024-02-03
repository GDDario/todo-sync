<?php

namespace Src\Domain\Exceptions;

use Exception;
use Illuminate\Http\Response;

class FailedLoginException extends Exception
{
    public function __construct(
    ) {
        parent::__construct();
    }

    public function render($request) {
        return Response(
            [
                'Wrong credentials.'
            ],
            Response::HTTP_UNAUTHORIZED
        );
    }
}
