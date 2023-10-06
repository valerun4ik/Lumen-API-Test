<?php

namespace App\Components\Company;

use App\Components\Company\Exceptions\CompanyExistException;
use App\DTO\CompanyDTO;
use App\Models\Company;
use App\Repositories\CompanyRepositoryInterface;

class CompanyService
{
    public function __construct(
        protected CompanyRepositoryInterface $companyRepository,
    )
    {
    }

    /**
     * @throws CompanyExistException
     */
    public function add(CompanyDTO $companyDTO): Company
    {
        $company = $this->companyRepository->getByUserIdAndTitleOrNull($companyDTO->user_id, $companyDTO->title);
        if (!is_null($company)) {
            throw new CompanyExistException(printf(
                "Company %s exist for user with id:%d",
                $companyDTO->title,
                $companyDTO->user_id
            ));
        }

        return $this->companyRepository->save($companyDTO);
    }

}
