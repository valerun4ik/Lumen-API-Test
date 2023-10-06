<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;
use App\Http\Responses\BaseAPIResponse;

abstract class BaseAPIRequest extends FormRequest
{
    public function badRequest(BaseAPIResponse $response, string $message): BaseAPIResponse
    {
        $response->errMessage = $message;
        $response->setData($response->baseResponseData());
        $response->setStatusCode(400);

        return $response;
    }

    public function anAuthenticatedRequest(BaseAPIResponse $response, string $message): BaseAPIResponse
    {
        $response->errMessage = $message;
        $response->setData($response->baseResponseData());
        $response->setStatusCode(401);

        return $response;
    }
}
