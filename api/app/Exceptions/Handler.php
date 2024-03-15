<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Src\Domain\Exceptions\EntityNotFoundException;
use Src\Domain\Exceptions\InvalidValueObjectException;
use Src\Domain\Exceptions\PasswordMatchingException;
use Src\Domain\Exceptions\ValueAlreadyTakenException;
use Symfony\Component\HttpFoundation\Response;
use Src\Domain\Exceptions\FailedLoginException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * RegisterPage the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }


    public function render($request, Throwable $e)
    {
        if ($e instanceof FailedLoginException) {
            return Response(
                [
                    'Wrong credentials'
                ],
                Response::HTTP_UNAUTHORIZED
            );
        }

        if ($e instanceof EntityNotFoundException) {
            return Response(
                [
                    $e->getMessage() ?? 'Entity not found.'
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        if ($e instanceof InvalidValueObjectException) {
            return Response(
                [
                    $e->getMessage()
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

        if ($e instanceof PasswordMatchingException) {
            return Response(
                [
                    'errors' => [
                        'password' => [
                            'The passwords do not match.'
                        ]
                    ]
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

        if ($e instanceof ValueAlreadyTakenException) {
            return Response()->json(
                [
                    'errors' => [
                        strtolower($e->getMessage()) => [
                            "{$e->getMessage()} already taken."
                        ]
                    ]

                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        return parent::render($request, $e);
    }
}
