<?php

namespace App\Http\Responses\Auth;

use App\Http\Responses\BaseAPIResponse;

class ProcessRecoverPasswordAPIResponse extends BaseAPIResponse
{
    public string $apiToken;

    public function specificResponseData(): array
    {
        return [
            'api_token' => $this->apiToken,
        ];
    }
}
