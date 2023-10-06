<?php

namespace App\Http\Responses\Auth;

use App\Http\Responses\BaseAPIResponse;

class CreateRecoverPasswordAPIResponse extends BaseAPIResponse
{
    public string $recoverToken;

    public function specificResponseData(): array
    {
        return [
            'recover_token' => $this->recoverToken,
        ];
    }
}
