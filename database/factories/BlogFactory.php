<?php

namespace Database\Factories;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $doctorId = Doctor::pluck('id')->toArray();

        return [
            'title' => fake()->text(100),
            'content' => fake()->paragraph(10),
            'smallDesc' => fake()->text(),
            'image' => "https://picsum.photos/seed/" . rand(0, 100000) . "/100",
            'doctor_id' => $doctorId[array_rand($doctorId)],
            'doctor_name' =>  Doctor::find($doctorId)->pluck('name')
        ];
    }
}
