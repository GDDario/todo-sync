<?php

namespace Src\UseCases\User\GetUserFromToken;

class GetUserFromTokenInput
{
    public function __construct(
        public string $token
    ) {
    }
}
