<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseAPIRequest;
use App\Models\User;

class CreateRecoverPasswordAPIRequest extends BaseAPIRequest
{
    protected function rules(): array
    {
        $usersTable = (new User)->getTable();

        return [
            'email' => [
                'required',
                'email',
                'max:255',
                "exists:$usersTable,email"
            ]
        ];
    }

    public function getEmail(): string
    {
        return $this->get('email');
    }

}
