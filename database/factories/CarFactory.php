<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Car::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $name =  $this->faker->name,
            'slug' => Str::slug($name),
            'details' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(5),
        ];
    }
}
