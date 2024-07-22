<?php

namespace Src\UseCases\User\UpdateUsernameAndProfilePicture;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Src\Adapters\Repositories\UserRepository\UpdateUsernameAndPictureDTO;
use Src\Adapters\Repositories\UserRepository\UserRepositoryInterface;
use Src\Domain\Entities\User;
use Src\Domain\ValueObjects\Uuid;
use Storage;

class UpdateUsernameAndProfilePicture
{
    private const DIRECTORY_PATH = 'uploads/users/';

    public function __construct(
        private UserRepositoryInterface $repository
    )
    {

    }

    public function handle(UpdateUsernameAndProfilePictureInput $input): UpdateUsernameAndProfilePictureOutput
    {
        $user = $this->repository->findById($input->userId);

        $picturePath = null;

        if ($input->changingPicture && $input->profilePicture) {
            $file = $input->profilePicture;

            $extension = $file->getClientOriginalExtension();
            $date = date('Y-m-d_H-i-s');
            $picturePath = self::DIRECTORY_PATH . $user->uuid . '_' . $date . '.' . $extension;

            $this->deleteUserPreviousFiles($user->uuid);
            $file->move(self::DIRECTORY_PATH, $picturePath);
        }

        $dto = new  UpdateUsernameAndPictureDTO(
            userId: $input->userId,
            username: $input->username,
            changingPicture: $input->changingPicture,
            picturePath: $picturePath
        );

        $user = $this->repository->updateUsernameAndPicture($dto);

        return new UpdateUsernameAndProfilePictureOutput(
            $user
        );
    }

    private function deleteUserPreviousFiles(Uuid $uuid): void
    {
        $files = File::files(self::DIRECTORY_PATH);

        // Filtrar os arquivos para encontrar aqueles que começam com "queijo"
        $filteredFiles = array_filter($files, function ($file) use ($uuid) {
            return strpos($file->getFilename(), $uuid) === 0;
        });

        // Exibir os arquivos filtrados
        foreach ($filteredFiles as $file) {
            File::delete($file->getPathname());
        }
    }
}
