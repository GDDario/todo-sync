<?php

namespace Src\UseCases\Dashboard\GenerateDashboard;

class GenerateDashboardInput
{
    public function __construct(
        public int $userId
    )
    {
    }
}
