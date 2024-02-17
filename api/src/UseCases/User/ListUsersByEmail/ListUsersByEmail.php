<?php

namespace Src\UseCases\User\ListUsersByEmail;

use Src\Adapters\Repositories\UserRepository\UserRepositoryInterface;
use Src\Domain\ValueObjects\Email;

class ListUsersByEmail
{
    public function __construct(
        public UserRepositoryInterface $repository
    ) {
    }

    public function handle(ListUsersByEmailInput $input): ListUsersByEmailOutput {
        $users = $this->repository->findByEmail($input->email);

        return new ListUsersByEmailOutput($users);
    }
}
