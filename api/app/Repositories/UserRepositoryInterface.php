<?php

namespace App\Repositories;

use App\DTO\UserDTO;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    /**
     * @param int $userId
     *
     * @return User
     *
     * @throws ModelNotFoundException
     */
    public function getUserWithCompanies(int $userId): User;

    public function getByEmailOrNull(string $email): ?User;

    /**
     * Create new user to db
     */
    public function save(UserDTO $userDTO, string $password, string $apiToken): User;

    public function update(int $id, UserDTO $userDTO = null, string $password = "", string $apiToken = ""): User;

}
