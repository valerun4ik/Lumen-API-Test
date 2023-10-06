<?php

namespace App\Http\Controllers;

use App\Http\Responses\BaseAPIResponse;
use Laravel\Lumen\Routing\Controller as BaseController;

class BaseAPIController extends BaseController
{
    protected function response(BaseAPIResponse $responseDTO): BaseAPIResponse
    {
        $responseDTO->setData($responseDTO->getAllResponseData());

        return $responseDTO;
    }
}
