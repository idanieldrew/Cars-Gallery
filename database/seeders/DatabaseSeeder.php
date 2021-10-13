<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(5)->create()->each(function ($cat) {
            $cat->cars()->save(Car::factory()->make())->each(function ($car) {
                $car->images()->save(Image::factory()->make());
            });
        });
    }
}
