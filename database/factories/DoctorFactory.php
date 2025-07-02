<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'experince' => fake()->jobTitle(),
            'phone'=>fake()->phoneNumber,
            'email' => fake()->unique()->safeEmail(),
            'linkedin' =>fake()->unique()->url(),
            'facebook' => fake()->unique()->url(),
            'image'=> "https://picsum.photos/seed/" . rand(0, 100000) . "/100",
            'department_id'=> Department::factory()->create()
        ];
    }
}
