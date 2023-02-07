<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GuestbookEntry>
 */
class GuestbookEntryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'                  => fake()->words(),
            'content'                => fake()->sentence(),
            'submitter_email'        => fake()->unique()->safeEmail(),
            'submitter_display_name' => fake()->userName(),
            'submitter_real_name'    => fake()->name(),
        ];
    }
}
