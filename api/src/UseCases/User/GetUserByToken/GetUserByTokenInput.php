<?php

namespace Src\UseCases\User\GetUserByToken;

class GetUserByTokenInput
{
    public function __construct(
        public string $token
    ) {
    }
}
