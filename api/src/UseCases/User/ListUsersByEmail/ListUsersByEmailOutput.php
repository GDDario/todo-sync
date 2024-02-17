<?php

namespace Src\UseCases\User\ListUsersByEmail;

class ListUsersByEmailOutput
{
    public function __construct(
        public array $users
    ) {
    }
}
