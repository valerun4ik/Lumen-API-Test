<?php

namespace App\Http\Requests\Auth;

use App\Components\PasswordService;
use App\Http\Requests\BaseAPIRequest;
use App\Http\Responses\Auth\LoginAPIResponse;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;

class LoginAPIRequest extends BaseAPIRequest
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
            ],
            'password' => [
                'required',
                'max:255'
            ]
        ];
    }

    /**
     * @throws HttpResponseException
     */
    protected function validationPassed(): void
    {
        /** @var UserRepository $repository */
        $repository = app(UserRepositoryInterface::class);

        $user = $repository->getByEmailOrNull($this->getEmail());
        if (is_null($user)) {
            throw new HttpResponseException(
                $this->anAuthenticatedRequest(new LoginAPIResponse, 'User Not Found')
            );
        }

        // if the password not match
        if (!PasswordService::safePasswordCheck($this->get('password'), $user->password)) {
            throw new HttpResponseException(
                $this->anAuthenticatedRequest(new LoginAPIResponse, 'Password Incorrect')
            );
        }
    }

    public function getEmail(): string
    {
        return $this->get('email');
    }

}
