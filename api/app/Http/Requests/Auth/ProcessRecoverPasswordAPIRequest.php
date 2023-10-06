<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseAPIRequest;
use App\Http\Responses\Auth\ProcessRecoverPasswordAPIResponse;
use App\Models\RecoverPasswords;
use App\Repositories\RecoverPasswordsRepository;
use App\Repositories\RecoverPasswordsRepositoryInterface;
use HttpResponseException;

class ProcessRecoverPasswordAPIRequest extends BaseAPIRequest
{
    protected RecoverPasswords $recover;

    protected function rules(): array
    {
        return [
            'recover_token' => [
                'required',
                'string',
                'max:255',
            ],
            'new_password' => [
                'required',
                'min:8',
                'max:255'
            ],
        ];
    }

    /**
     * @throws HttpResponseException
     */
    protected function validationPassed(): void
    {
        /** @var RecoverPasswordsRepository $repository */
        $repository = app(RecoverPasswordsRepositoryInterface::class);

        $recover = $repository->getActiveByTokenOrNull($this->getRecoverToken());
        if (is_null($recover)) {
            throw new HttpResponseException(
                $this->badRequest(new ProcessRecoverPasswordAPIResponse, 'Recover not correct')
            );
        }

        $this->recover = $recover;
    }

    public function getRecoverToken(): string
    {
        return $this->get('recover_token');
    }

    public function getNewPassword(): string
    {
        return $this->get('new_password');
    }

    public function getRecover(): RecoverPasswords
    {
        return $this->recover;
    }

}
