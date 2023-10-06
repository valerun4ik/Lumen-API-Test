<?php

namespace App\Components\RecoverPassword;

use App\Components\PasswordService;
use App\Components\User\UserService;
use App\DTO\UserDTO;
use App\Models\RecoverPasswords;
use App\Models\User;
use App\Repositories\RecoverPasswordsRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class RecoverPasswordsService
{
    public function __construct(
        protected RecoverPasswordsRepositoryInterface $recoverPasswordsRepository,
        protected UserRepositoryInterface             $userRepository,
    )
    {
    }

    public function createRecoverPasswordToken(int $userId): RecoverPasswords
    {
        $newRecoverPassword = new RecoverPasswords;

        $token = bin2hex(random_bytes("100"));
        //TODO: skip checking for unique recover_token for simplicity of test task
        // should be fixed if code is for production

        DB::transaction(function () use ($userId, &$newRecoverPassword, $token) {
            $this->recoverPasswordsRepository->expireAll($userId);
            $newRecoverPassword = $this->recoverPasswordsRepository->save($userId, $token);
        });

        return $newRecoverPassword;
    }

    public function processRecoverPassword(RecoverPasswords $recover, string $newPassword): User
    {
        $user = null;

        DB::transaction(function () use ($recover, $newPassword, &$user) {
            $this->recoverPasswordsRepository->expiryByToken($recover->recover_token);
            $user = $this->userRepository->update(
                id: $recover->userRelation->id,
                password: PasswordService::safePassword($newPassword),
            );

        });

        return $user;
    }

}
