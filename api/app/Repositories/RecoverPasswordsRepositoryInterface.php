<?php

namespace App\Repositories;

use App\Models\RecoverPasswords;

interface RecoverPasswordsRepositoryInterface
{
    public function getActiveByTokenOrNull(string $token): ?RecoverPasswords;

    public function save(int $userId, string $token): RecoverPasswords;

    public function expireAll(int $userId): void;

    public function expiryByToken(string $token): void;

}
