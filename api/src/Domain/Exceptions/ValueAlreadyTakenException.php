<?php

namespace Src\Domain\Exceptions;

use Exception;
use Illuminate\Http\Response;

class ValueAlreadyTakenException extends Exception
{
    public function __construct(
        public $value,
    ) {
        parent::__construct();
    }

    public function render($request)
    {
        return Response(
            [
                'errors' => [
                    strtolower($this->value) => [
                        "$this->value already taken."
                    ]
                ]

            ],
            Response::HTTP_UNPROCESSABLE_ENTITY
        );
    }
}
