<?php

namespace Src\Adapters\Repositories\TodoRepository;

use stdClass;

class DashboardDTO
{
    public function __construct(
        public stdClass $todos,
        public array $commitments,
        public array $mostUsedTags
    ) {

    }
}
