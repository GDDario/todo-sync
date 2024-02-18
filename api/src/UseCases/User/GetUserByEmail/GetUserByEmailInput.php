<?php

namespace Src\UseCases\User\GetUserByEmail;

class GetUserByEmailInput
{
    public function __construct(
        public string $email
    ) {
    }
}
