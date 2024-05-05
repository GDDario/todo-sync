<?php

namespace Src\UseCases\User\UpdateUsernameAndProfilePicture;

use File;
use Log;
use Src\Adapters\Repositories\UserRepository\UpdateUsernameAndPictureDTO;
use Src\Adapters\Repositories\UserRepository\UserRepositoryInterface;
use Storage;

class UpdateUsernameAndProfilePicture
{
    public function __construct(
        private UserRepositoryInterface $repository
    )
    {

    }

    public function handle(UpdateUsernameAndProfilePictureInput $input): UpdateUsernameAndProfilePictureOutput
    {
        $user = $this->repository->findById($input->userId);

        $picturePath = null;

        if ($input->profilePicture) {
            Log::info('Extension', [$input->profilePicture->getClientOriginalExtension()]);

            $file = $input->profilePicture;

            $extension = $file->getClientOriginalExtension();

            $picturePath = 'uploads/users/'.  $user->uuid->__toString() . '.' . $extension;
            if (File::exists($picturePath)) {
                File::delete($picturePath);
            }

            $file->move('uploads/users/', $picturePath);
        }

        $dto = new  UpdateUsernameAndPictureDTO(
            userId: $input->userId,
            username: $input->username,
            picturePath: $picturePath
        );

        $user = $this->repository->updateUsernameAndPicture($dto);

        return new UpdateUsernameAndProfilePictureOutput(
            $user
        );
    }
}
