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

    public function render($request) {
        return Response(
            [
                'The password do not match.'
            ],
            Response::HTTP_BAD_REQUEST
        );
    }
}
