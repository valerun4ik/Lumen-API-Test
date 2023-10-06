<?php

namespace App\DTO;

/**
 * @property int $user_id
 * @property string $title
 * @property string $phone
 * @property string $description
 */
class CompanyDTO
{
    public function __construct(
        public int    $user_id,
        public string $title,
        public string $phone,
        public string $description = "",
    )
    {
    }

}
