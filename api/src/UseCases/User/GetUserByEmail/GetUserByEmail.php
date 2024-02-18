<?php

namespace Src\UseCases\User\GetUserByEmail;

use Src\Adapters\Repositories\UserRepository\UserRepositoryInterface;

class GetUserByEmail
{
    public function __construct(
        public UserRepositoryInterface $repository
    ) {
    }

    public function handle(GetUserByEmailInput $input): GetUserByEmailOutput {
        $user = $this->repository->findByEmail($input->email);

        return new GetUserByEmailOutput($user);
    }
}
