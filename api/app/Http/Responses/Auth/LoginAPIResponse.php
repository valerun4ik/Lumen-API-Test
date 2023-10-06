<?php

namespace App\Http\Responses\Auth;

use App\Http\Responses\BaseAPIResponse;

class LoginAPIResponse extends BaseAPIResponse
{
    public string $apiToken;

    public function specificResponseData(): array
    {
        return [
            "api_token" => $this->apiToken
        ];
    }

}
