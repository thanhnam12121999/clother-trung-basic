<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class AccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Account::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => $this->faker->safeEmail(),
            'username' => $this->faker->userName(),
            'password' => Hash::make('123456'),
            'phone_number' => $this->faker->phoneNumber(),
            'name' => $this->faker->name(),
            'gender' => Arr::random(['0', '1']),
            'date_of_birth' => $this->faker->date('Y-m-d', '2001-12-31'),
            'avatar' => '',
            'accountable_id' => '',
            'accountable_type' => '',
        ];
    }
}
