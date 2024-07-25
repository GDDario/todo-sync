<?php

namespace App\Repositories\Eloquent;

use App\Models\EmailResetToken;
use App\Models\PasswordResetToken;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Src\Adapters\Repositories\PasswordRestTokenRepository\PasswordResetTokenRepositoryInterface;
use Src\Adapters\Repositories\PasswordRestTokenRepository\ResetTokenDTO;
use Src\Domain\Exceptions\EntityNotFoundException;

class PasswordResetTokenEloquentRepository implements PasswordResetTokenRepositoryInterface
{
    public function findByToken(string $token): PasswordResetToken
    {
        if (!$data = PasswordResetToken::query()->where('token', $token)->first()) {
            throw new EntityNotFoundException('Email Reset Token not found.');
        }

        return $data;
    }

    public function store(ResetTokenDTO $dto): void
    {
        PasswordResetToken::query()->create([
            'email' => $dto->email,
            'token' => $dto->token,
            'created_at' => $dto->createdAt
        ]);
    }

    public function markMasOpened(string $token): bool
    {
        if (!$data = PasswordResetToken::query()->where('token', $token)->first()) {
            return false;
        }

        if ($data->opened) {
            Log::info('Opened!!!!!');
            $data->delete();
            return false;
        }

        $data->update(['opened' => true]);

        return true;
    }

    public function deleteByEmail(string $email): void
    {
        PasswordResetToken::query()->where('email', $email)->delete();
    }
}
