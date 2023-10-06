<?php

namespace App\Http\Requests\Entities;

use App\DTO\CompanyDTO;
use App\Http\Requests\BaseAPIRequest;
use App\Models\Company;
use App\Rules\PhoneNumber;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;

class StoreCompanyRequest extends BaseAPIRequest
{
    protected function rules(): array
    {
        $companiesTable = (new Company)->getTable();

        return [
            'title' => [
                'required',
                'max:255',
                'min:1',
                Rule::unique($companiesTable)->where(
                    fn(Builder|\Illuminate\Database\Query\Builder $query) => $query->where('user_id', $this->user()->id)
                )
            ],
            'phone' => [
                'required',
                new PhoneNumber,
            ],
            'description' => [
                'string',
            ]
        ];
    }

    public function getCompanyDTO(): CompanyDTO
    {
        $validated = $this->validated();
        $validated['user_id'] = $this->user()->id;

        return (new CompanyDTO(...$validated));
    }

}
