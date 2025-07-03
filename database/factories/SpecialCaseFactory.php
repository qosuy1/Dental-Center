<?php

namespace Database\Factories;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SpecialCase>
 */
class SpecialCaseFactory extends Factory
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
            'patient_age' => fake()->numberBetween(4, 88),
            'treatment_duration' => fake()->numberBetween(1, 12) . 'monthe',
            'procedures' => fake()->text(),
            'overview' => fake()->paragraph(3),
            'treatment_plan' => fake()->paragraph(7),
            'result' => fake()->text(),
            'feedback' => fake()->text(),
            'before_image'=>"https://picsum.photos/seed/" . rand(0, 100000) . "/100",
            'after_image'=> "https://picsum.photos/seed/" . rand(0, 100000) . "/100",
            'is_special_case' => rand(0, 1),
            'doctor_id' => $doctorId[array_rand($doctorId)],
            'doctor_name' =>  Doctor::find($doctorId)->pluck('name')
        ];
    }
}
