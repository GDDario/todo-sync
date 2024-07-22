<?php

namespace Src\Adapters\Repositories\EmailResetTokenRepository;

use App\Models\EmailResetToken;

interface EmailResetTokenRepositoryInterface
{
    public function findByToken(string $token): EmailResetToken;

    public function store(ResetTokenDTO $dto): void;

    public function markMasOpened(string $token): bool;

    public function deleteByUserId(int $userId): void;
}
