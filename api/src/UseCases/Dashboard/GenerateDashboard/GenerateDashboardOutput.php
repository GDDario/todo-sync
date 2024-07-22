<?php

namespace Src\UseCases\Dashboard\GenerateDashboard;

class GenerateDashboardOutput
{
    public function __construct(
        public array $todos,
        public array $commitments,
        public array $mostUsedTags
    )
    {
    }
}
