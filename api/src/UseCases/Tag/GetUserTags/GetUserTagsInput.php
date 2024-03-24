<?php

namespace Src\UseCases\Tag\GetUserTags;

class GetUserTagsInput
{
    public function __construct(
        public int $userId
    )
    {
    }
}
