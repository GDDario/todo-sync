<?php

namespace Src\UseCases\Tag\GetUserTags;

class GetUserTagsOutput
{
    public function __construct(
        public array $tags
    )
    {
    }
}
