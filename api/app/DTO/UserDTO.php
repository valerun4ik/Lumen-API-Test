<?php

namespace App\DTO;

/**
 * @property  string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property int $id
 */
class UserDTO
{
    public function __construct(
        public string $first_name,
        public string $last_name,
        public string $email,
        public string $phone,
        public int    $id = 0,
    )
    {
    }

}
