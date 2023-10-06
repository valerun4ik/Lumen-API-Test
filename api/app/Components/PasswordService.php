<?php

namespace App\Components;

use Illuminate\Support\Facades\Hash;

class PasswordService
{
    public static function safePassword(string $password): string
    {
        return Hash::make($password);
    }

    public static function safePasswordCheck(string $coming, string $existing): bool
    {
        return Hash::check($coming, $existing);
    }

}
