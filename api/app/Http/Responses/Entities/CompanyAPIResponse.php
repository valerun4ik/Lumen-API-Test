<?php

namespace App\Http\Responses\Entities;

use App\Http\Responses\BaseAPIResponse;
use App\Models\Company;

class CompanyAPIResponse extends BaseAPIResponse
{
    public Company $company;

    public function specificResponseData(): array
    {
        return [
            'company' => $this->company->toArray()
        ];
    }
}
