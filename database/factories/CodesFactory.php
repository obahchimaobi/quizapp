<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\codes>
 */
class CodesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'code' => strtoupper($this->faker->unique()->regexify('[A-Z0-9]{40}')),
            'is_used' => $this->faker->boolean(false),
        ];
    }
}
