<?php

namespace Src\Adapters\Authentication;

use Illuminate\Support\Facades\Auth;
use Src\Domain\Exceptions\FailedLoginException;
use Src\UseCases\LoginUser\LoginUserInput;
use Src\Adapters\Authentication\AuthenticationInterface;
use Src\Domain\ValueObjects\Email;
use Src\Domain\ValueObjects\Uuid;
use Src\UseCases\LoginUser\LoginUserOutput;

class PassportAuthenticationAdapter implements AuthenticationInterface
{
    public function login(array $input): LoginUserOutput
    {
        $token = $this->attemptLogin($input);

        return $token;
    }

    private function attemptLogin(array $credentials): LoginUserOutput
    {
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $accessToken = $user->createToken('token')->accessToken;

            return new LoginUserOutput(
                uuid: new Uuid($user->uuid),
                username: $user->username,
                email: new Email($user->email),
                token: $accessToken
            );
        }

        throw new FailedLoginException();
    }
}
