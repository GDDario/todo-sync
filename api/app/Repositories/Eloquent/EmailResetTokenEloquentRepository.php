<?php

namespace App\Repositories\Eloquent;

use App\Models\EmailResetToken;
use Illuminate\Support\Facades\Log;
use Src\Adapters\Repositories\EmailResetTokenRepository\EmailResetTokenRepositoryInterface;
use Src\Adapters\Repositories\EmailResetTokenRepository\ResetTokenDTO;
use Src\Domain\Exceptions\EntityNotFoundException;

class EmailResetTokenEloquentRepository implements EmailResetTokenRepositoryInterface
{
    public function findByToken(string $token): EmailResetToken
    {
        if (!$data = EmailResetToken::query()->where('token', $token)->first()) {
            throw new EntityNotFoundException('Email Reset Token not found.');
        }

        return $data;
    }

    public function store(ResetTokenDTO $dto): void
    {
        EmailResetToken::query()->create([
            'user_id' => $dto->userId,
            'token' => $dto->token,
            'created_at' => $dto->createdAt
        ]);
    }

    public function markMasOpened(string $token): bool
    {
        if (!$data = EmailResetToken::query()->where('token', $token)->first()) {
            return false;
        }

        if ($data->opened) {
            Log::info('Opened');
            $data->delete();
            return false;
        }

        $data->update(['opened' => true]);

        return true;
    }

    public function deleteByUserId(int $userId): void
    {
        EmailResetToken::query()->where('user_id', $userId)->delete();
    }
}
