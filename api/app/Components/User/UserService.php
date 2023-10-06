<?php

namespace App\Components\User;

use App\Components\PasswordService;
use App\Components\User\Exceptions\FailedToAddUserException;
use App\Components\User\Exceptions\UserExistException;
use App\Components\User\Exceptions\UserNotFoundException;
use App\DTO\UserDTO;
use App\Models\Company;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(
        protected UserRepositoryInterface $userRepository,
    )
    {
    }

    /**
     * @param int $userId
     *
     * @return Company|Collection
     */
    public function companies(int $userId): array|Collection
    {
        return $this->userRepository->getUserWithCompanies($userId)->companyRelation;
    }

    /**
     * @throws UserExistException
     * @throws FailedToAddUserException
     */
    public function add(UserDTO $userDTO, string $password): User
    {
        $user = $this->userRepository->getByEmailOrNull($userDTO->email);
        if (!is_null($user)) {
            throw new UserExistException(printf(
                "Cant add new user because, use with this email:%s already exist",
                $userDTO->email
            ));
        }

        try {
            $apiToken = bin2hex(random_bytes("100"));
            //TODO: skip checking for unique api_token for simplicity of test task
            // should be fixed if code is for production
        } catch (Exception $e) {
            throw new FailedToAddUserException("Failed to generate api token", 0, $e);
        }

        return $this->userRepository->save($userDTO, PasswordService::safePassword($password), $apiToken);
    }

    /**
     * @throws UserNotFoundException
     */
    public function getUserAPITokenByEmail(string $email): string
    {
        $user = $this->userRepository->getByEmailOrNull($email);
        if (is_null($user)) {
            throw new UserNotFoundException("not found user by email");
        }

        return $user->api_token;
    }


}
