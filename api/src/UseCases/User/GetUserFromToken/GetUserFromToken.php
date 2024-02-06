<?php

namespace Src\UseCases\User\GetUserFromToken;

use Src\Adapters\Authentication\AuthenticationInterface;

class GetUserFromToken {

    public function __construct(private AuthenticationInterface $authenticationAdapter)
    {

    }

    public function handle(GetUserFromTokenInput $input): GetUserFromTokenOutput {
        return $this->authenticationAdapter->extractCredentialsFromToken($input->token);
    }
}
