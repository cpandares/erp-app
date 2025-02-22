<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coche>
 */

class CocheFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Coche::class;
   
    public function definition(): array
    {
        $year = $this->faker->numberBetween(2000, 2021);
        return [
      
            'marca' => $this->faker->word(),
            'model' => $this->faker->word(),
            'color' => $this->faker->colorName(),
            'placa' => $this->faker->unique()->regexify('[0-9]{4}[A-Z]{3}'),
            'year' => $year,
            'cliente_id' => \App\Models\Cliente::factory(),
        ];
    }
}
