<?php

namespace Src\UseCases\User\ListUsersByEmail;

class ListUsersByEmailInput
{
    public function __construct(
        public string $email
    ) {
    }
}
