<?php

namespace Src\Domain\Exception;

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

    public function render($request) {
        return Response(
            [
                $this->message
            ],
            Response::HTTP_BAD_REQUEST
        );
    }
}
