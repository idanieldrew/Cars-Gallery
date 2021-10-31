<?php

namespace Database\Factories;

use App\Models\Like;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
      /**
       * The name of the factory's corresponding model.
       *
       * @var string
       */
      protected $model = Like::class;

      /**
       * Define the model's default state.
       *
       * @return array
       */
      public function definition()
      {
            return [
                  'like' => $this->faker->boolean(),
                  'count' => $this->faker->numberBetween(1,2222)
            ];
      }
}
