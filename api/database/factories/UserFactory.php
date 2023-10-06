<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => Str::random(10),
            'last_name' => Str::random(10),
            'email' => 'test'.random_int(1, 10).'@gmail.com',
            'password' => Hash::make('password'),
            'phone' => "0955819384",
            'api_token' => Str::random(40),
        ];
    }
}
