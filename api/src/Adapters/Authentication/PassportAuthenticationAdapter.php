<?php

namespace Src\Adapters\Authentication;

use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Token;
use Src\Domain\Exceptions\FailedLoginException;
use Src\Domain\ValueObjects\Email;
use Src\Domain\ValueObjects\Uuid;
use Src\UseCases\User\GetUserByToken\GetUserByTokenOutput;
use Src\UseCases\User\LoginUser\LoginUserOutput;

class PassportAuthenticationAdapter implements AuthenticationInterface
{
    public function login(array $input): LoginUserOutput
    {
        $token = $this->attemptLogin($input);

        return $token;
    }

    public function logout()
    {
        $token = Auth::user()->token();
        $token->revoke();
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
                token: $accessToken,
                picturePath: $user->picture_path
            );
        }

        throw new FailedLoginException();
    }

    public function extractCredentialsFromToken(string $token): GetUserByTokenOutput
    {
        $jti = json_decode(base64_decode(explode('.', $token)[1]))->jti;
        $token = Token::find($jti);
        $user = $token->user;

        return new GetUserByTokenOutput(
            id: $user->id,
            uuid: new Uuid($user->uuid),
            username: $user->username,
            email: new Email($user->email),
            picturePath: $user->picture_path,
        );
    }
}
