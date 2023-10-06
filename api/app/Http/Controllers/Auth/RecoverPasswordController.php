<?php

namespace App\Http\Controllers\Auth;

use App\Components\RecoverPassword\RecoverPasswordsService;
use App\Components\User\Exceptions\UserNotFoundException;
use App\Components\User\UserService;
use App\Http\Controllers\BaseAPIController;
use App\Http\Requests\Auth\CreateRecoverPasswordAPIRequest;
use App\Http\Requests\Auth\ProcessRecoverPasswordAPIRequest;
use App\Http\Responses\Auth\CreateRecoverPasswordAPIResponse;
use App\Http\Responses\Auth\ProcessRecoverPasswordAPIResponse;
use App\Http\Responses\BaseAPIResponse;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Auth\AuthenticationException;

class RecoverPasswordController extends BaseAPIController
{
    public function createRecoverPassword(
        CreateRecoverPasswordAPIRequest $request,
        RecoverPasswordsService         $recoverPasswordService,
        UserRepositoryInterface         $userRepository,
    ): BaseAPIResponse
    {
        $createRecoverResponse = new CreateRecoverPasswordAPIResponse;

        $user = $userRepository->getByEmailOrNull($request->getEmail());
        if (is_null($user)) {
            return $request->badRequest($createRecoverResponse, "user not found");
        }

        $recoverPasswordsModel = $recoverPasswordService->createRecoverPasswordToken($user->id);

        $createRecoverResponse->recoverToken = $recoverPasswordsModel->recover_token;

        return $this->response($createRecoverResponse);
    }

    public function processRecoverPassword(
        ProcessRecoverPasswordAPIRequest $request,
        RecoverPasswordsService $recoverPasswordsService,
    ): BaseAPIResponse
    {
        $response = new ProcessRecoverPasswordAPIResponse;

        $user = $recoverPasswordsService->processRecoverPassword($request->getRecover(), $request->getNewPassword());

        $response->apiToken = $user->api_token;

        return $this->response($response);
    }

}
