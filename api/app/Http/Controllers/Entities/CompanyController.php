<?php

namespace App\Http\Controllers\Entities;

use App\Components\Company\CompanyService;
use App\Components\Company\Exceptions\CompanyExistException;
use App\Components\User\UserService;
use App\Http\Controllers\BaseAPIController;
use App\Http\Requests\Entities\StoreCompanyRequest;
use App\Http\Responses\BaseAPIResponse;
use App\Http\Responses\Entities\CompanyAPIResponse;
use App\Http\Responses\Entities\CompanyCollectionAPIResponse;
use Illuminate\Http\Request;

class CompanyController extends BaseAPIController
{
    public function get(Request $request, UserService $userService): BaseAPIResponse
    {
        $companiesCollectionResponse = new CompanyCollectionAPIResponse;
        $companiesCollectionResponse->companies = $userService->companies($request->user()->id);

        return $this->response($companiesCollectionResponse);
    }


    /**
     * @throws CompanyExistException
     */
    public function store(StoreCompanyRequest $request, CompanyService $companyService): BaseAPIResponse
    {
        $companyResponse = new CompanyAPIResponse;

        $newCompany = $companyService->add($request->getCompanyDTO());

        $companyResponse->company = $newCompany;

        return $this->response($companyResponse);
    }

}
