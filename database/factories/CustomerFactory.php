<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $baseLatitude = 30.3753;
        $baseLongitude = 69.3451;

        return [
            'username' => $this->faker->userName,
            'shopname' => $this->faker->company,
            'email' => $this->faker->unique()->safeEmail,
            'mobile' => $this->faker->unique()->phoneNumber,
            'city' => $this->faker->city,
            'address' => $this->faker->address,
            'lng' => $this->faker->randomFloat(15, $baseLongitude - 0.1, $baseLongitude + 0.1),
            'lat' => $this->faker->randomFloat(15, $baseLatitude - 0.1, $baseLatitude + 0.1),
            'avatar' => '4.jpg',
            'status' => 'inactive',
            'email_verified_at' => null,
            'password' => Hash::make('password'), // Replace 'password' with the desired default password
            'remember_token' => null,
            'created_by' => $this->faker->numberBetween(1,2), // Assuming the admin user with ID 1 is the creator
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ];
}
}
