<?php

namespace Src\UseCases\Tag\GetUserTags;

use Src\Adapters\Repositories\TagRepository\TagRepositoryInterface;

class GetUserTags
{
    public function __construct(
        private TagRepositoryInterface $repository
    )
    {
    }

    public function handle(GetUserTagsInput $input): GetUserTagsOutput
    {
        $response = $this->repository->findByUserId($input->userId);

        return new GetUserTagsOutput(
            $response
        );
    }
}
