<?php

namespace App\Http\Controllers\Auth;

use App\Components\User\Exceptions\FailedToAddUserException;
use App\Components\User\Exceptions\UserExistException;
use App\Components\User\Exceptions\UserNotFoundException;
use App\Components\User\UserService;
use App\Http\Controllers\BaseAPIController;
use App\Http\Requests\Auth\LoginAPIRequest;
use App\Http\Requests\Auth\RegisterAPIRequest;
use App\Http\Responses\Auth\LoginAPIResponse;
use App\Http\Responses\BaseAPIResponse;
use Illuminate\Auth\AuthenticationException;

class LoginController extends BaseAPIController
{
    public function register(RegisterAPIRequest $request, UserService $userService): BaseAPIResponse
    {
        $responseDTO = new LoginAPIResponse;

        try {
            $newUser = $userService->add($request->getUserDTO(), $request->getPassword());
        } catch (UserExistException|FailedToAddUserException $e) {
            return $request->badRequest($responseDTO, $e->getMessage());
        }

        $responseDTO->apiToken = $newUser->api_token;

        return $this->response($responseDTO);
    }

    /**
     * @throws AuthenticationException
     */
    public function signIn(LoginAPIRequest $request, UserService $userService): BaseAPIResponse
    {
        $responseDTO = new LoginAPIResponse;

        try {
            $token = $userService->getUserAPITokenByEmail($request->getEmail());
        } catch (UserNotFoundException $e) {
            throw new AuthenticationException($e->getMessage());
        }

        $responseDTO->apiToken = $token;

        return $this->response($responseDTO);
    }

}
