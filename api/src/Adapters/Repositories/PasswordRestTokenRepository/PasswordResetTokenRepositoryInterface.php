<?php

namespace Src\Adapters\Repositories\PasswordRestTokenRepository;

use App\Models\PasswordResetToken;

interface PasswordResetTokenRepositoryInterface
{
    public function findByToken(string $token): PasswordResetToken;

    public function store(ResetTokenDTO $dto): void;

    public function markMasOpened(string $token): bool;

    public function deleteByEmail(string $email): void;}
