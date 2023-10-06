<?php

namespace App\Repositories;

use App\Models\RecoverPasswords;

class RecoverPasswordsRepository implements RecoverPasswordsRepositoryInterface
{
    public function getActiveByTokenOrNull(string $token): ?RecoverPasswords
    {
        return RecoverPasswords::whereRecoverToken($token)->whereExpired(false)->first();
    }

    public function save(int $userId, string $token): RecoverPasswords
    {
        $rp = new RecoverPasswords;
        $rp->user_id = $userId;
        $rp->recover_token = $token;

        $rp->save();

        return $rp;
    }

    public function expireAll(int $userId): void
    {
        RecoverPasswords::whereUserId($userId)->update([
            'expired' => true,
        ]);
    }

    public function expiryByToken(string $token): void
    {
        RecoverPasswords::whereRecoverToken($token)->update([
            'expired' => true,
        ]);
    }
}
