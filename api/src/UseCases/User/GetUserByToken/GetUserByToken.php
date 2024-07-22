<?php

namespace Src\UseCases\User\GetUserByToken;

use Src\Adapters\Authentication\AuthenticationInterface;

class GetUserByToken {

    public function __construct(private AuthenticationInterface $authenticationAdapter)
    {

    }

    public function handle(GetUserByTokenInput $input): GetUserByTokenOutput {
        return $this->authenticationAdapter->extractCredentialsFromToken($input->token);
    }
}
