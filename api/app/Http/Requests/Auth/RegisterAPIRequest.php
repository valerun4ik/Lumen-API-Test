<?php

namespace App\Http\Requests\Auth;

use App\DTO\UserDTO;
use App\Http\Requests\BaseAPIRequest;
use App\Models\User;
use App\Rules\PhoneNumber;

/**
 * @property string first_name
 * @property string last_name
 * @property string email
 * @property string password
 * @property string phone
 */
class RegisterAPIRequest extends BaseAPIRequest
{
    public function rules(): array
    {
        $usersTable = (new User)->getTable();

        return [
            'first_name' => [
                'required',
                'min:2',
                'max:255',
            ],
            'last_name' => [
                'min:2',
                'max:255',
                'required',
            ],
            'email' => [
                'required',
                'email',
                "unique:$usersTable,email"
            ],
            'password' => [
                'required',
                'min:8',
                'max:255'
            ],
            'phone' => [
                'required',
                new PhoneNumber
            ]
        ];
    }

    public function getUserDTO(): UserDTO
    {
        $validated = $this->validated();
        if (isset($validated['password'])) {
            unset($validated['password']);
        }

        return (new UserDTO(...$validated));
    }

    public function getPassword(): string
    {
        return $this->get('password');
    }

}
