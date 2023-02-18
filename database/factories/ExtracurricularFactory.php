<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Extracurricular>
 */
class ExtracurricularFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $eksul = fake()->randomElement(['basket', 'sepakbola', 'futsal', 'pramuka', 'takraw', 'voli', 'mapala', 'seni', 'kewirausahaan', 'robotik']);
        return [
            'name' => $eksul
        ];
    }
}
