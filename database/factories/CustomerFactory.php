<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        return [
            'fname' => fake()->firstName(),
            'lname' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->numerify('##########'),
            'dob' => fake()->date(),
            'gender' => fake()->randomElement(['male', 'female']),
            'religion' => 'Hindu',
            'subcaste' => null,
            'state' => fake()->state(),
            'city' => fake()->city(),
            'password' => 'password',
            'termsAccepted' => true,
            'profile_image' => null,
            'active_status' => 1,
            'is_admin' => 'no',
            'last_dashboard_visit' => null,
        ];
    }
}
