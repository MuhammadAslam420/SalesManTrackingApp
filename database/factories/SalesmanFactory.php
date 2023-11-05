<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Models\Salesman>
 */
class SalesmanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'username' => null,
            'employee_no' => $this->faker->unique()->randomNumber(),
            'email' => $this->faker->unique()->safeEmail,
            'mobile' => $this->faker->unique()->phoneNumber,
            'city' => null,
            'address' => null,
            'lng' => null,
            'lat' => null,
            'avatar' => '2.jpg',
            'status' => 'inactive',
            'email_verified_at' => null,
            'password' => Hash::make('password'), // Replace 'password' with the desired default password
            'remember_token' => Str::random(10),
            'created_by' => $this->faker->numberBetween(1,2),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'deleted_at' => null,
        ];
    }
}
