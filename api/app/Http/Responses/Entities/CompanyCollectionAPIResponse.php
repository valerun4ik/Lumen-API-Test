<?php

namespace App\Http\Responses\Entities;

use App\Http\Responses\BaseAPIResponse;
use App\Models\Company;
use Illuminate\Support\Collection;

class CompanyCollectionAPIResponse extends BaseAPIResponse
{
    /**
     * @var Company[]|Collection
     */
    public array|Collection $companies;

    public function specificResponseData(): array
    {
        return [
            "companies" => $this->companies
        ];
    }
}
