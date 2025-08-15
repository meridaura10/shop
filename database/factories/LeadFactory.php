<?php

namespace Database\Factories;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => $this->faker->randomElement(Lead::statusesList('key')),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Lead $lead) {
            $lead->update([
                'fields' => [
                    'email' => $this->faker->unique()->safeEmail(),
                    'phone' => $this->faker->phoneNumber(),
                ]
            ]);
        });
    }
}
