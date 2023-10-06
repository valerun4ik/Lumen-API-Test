<?php

namespace App\Repositories;

use App\DTO\CompanyDTO;
use App\Models\Company;
use Illuminate\Support\Collection;

interface CompanyRepositoryInterface
{
    public function save(CompanyDTO $companyDTO): Company;

    /**
     * @param int $userId
     *
     * @return Company[]|Collection
     */
    public function getByUserId(int $userId): array|Collection;

    /**
     * @param int $userId
     * @param string $title
     *
     * @return Company|null
     */
    public function getByUserIdAndTitleOrNull(int $userId, string $title): ?Company;

}
