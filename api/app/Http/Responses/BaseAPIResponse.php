<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

abstract class BaseAPIResponse extends JsonResponse
{
    public string $errMessage = "";

    public function getAllResponseData(): array
    {
        return array_merge(
            $this->baseResponseData(),
            $this->specificResponseData(),
        );
    }

    public function baseResponseData(): array
    {
        $data = [
            //"status" => $this->status(),
        ];

        if ($this->errMessage) {
            $data["err_message"] = $this->errMessage;
        }

        return $data;
    }

    abstract public function specificResponseData(): array;
}
