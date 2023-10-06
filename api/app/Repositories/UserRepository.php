<?php

namespace App\Repositories;

use App\DTO\UserDTO;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getByEmailOrNull(string $email): ?User
    {
        return User::whereEmail($email)->first();
    }

    public function save(UserDTO $userDTO, string $password, string $apiToken): User
    {
        $user = new User;
        $user->first_name = $userDTO->first_name;
        $user->last_name = $userDTO->last_name;
        $user->email = $userDTO->email;
        $user->phone = $userDTO->phone;
        $user->password = $password;
        $user->api_token = $apiToken;

        $user->save();

        return $user;
    }

    public function update(int $id, UserDTO $userDTO = null, string $password = "", string $apiToken = ""): User
    {
        $update = [];

        if (!empty($password)) {
            $update['password'] = $password;
        }
        if (!empty($apiToken)) {
            $update['api_token'] = $apiToken;
        }

        if (!is_null($userDTO)) {
            foreach (array($userDTO) as $key => $value) {
                if (!empty($value)) {
                    $update[$key] = $value;
                }
            }
        }

        User::whereId($id)->update($update);

        return User::findOrFail($id);
    }

    /**
     * @param int $userId
     *
     * @return User
     *
     * @throws ModelNotFoundException
     */
    public function getUserWithCompanies(int $userId): User
    {
        return User::whereId($userId)->with('companyRelation')->firstOrFail();
    }


}
