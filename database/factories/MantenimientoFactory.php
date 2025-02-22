<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mantenimiento>
 */
class MantenimientoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Mantenimiento::class;
    public function definition(): array
    {
        $startAt = $this->faker->dateTime();
        $endAt = $this->faker->dateTimeBetween($startAt, '+1 week');
        return [
      
            'coche_id' => \App\Models\Coche::factory(),
            'start_at' => $startAt,
            'end_at' => $endAt,
            'description' => $this->faker->sentence(),
            'value' => $this->faker->randomFloat(2, 100, 1000),
        ];
    }
}
