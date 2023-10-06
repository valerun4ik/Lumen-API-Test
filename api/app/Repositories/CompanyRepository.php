<?php

namespace App\Repositories;

use App\DTO\CompanyDTO;
use App\Models\Company;
use Illuminate\Support\Collection;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function save(CompanyDTO $companyDTO): Company
    {
        return Company::create([
            'user_id' => $companyDTO->user_id,
            'title' => $companyDTO->title,
            'description' => $companyDTO->description ?? "",
            'phone' => $companyDTO->phone,
        ]);
    }

    /**
     * @param int $userId
     *
     * @return Company[]|Collection
     */
    public function getByUserId(int $userId): array|Collection
    {
        return Company::whereUserId($userId)->get();
    }

    /**
     * @param int $userId
     * @param string $title
     *
     * @return Company|null
     */
    public function getByUserIdAndTitleOrNull(int $userId, string $title): ?Company
    {
        return Company::whereUserId($userId)->whereTitle($title)->first();
    }

}
