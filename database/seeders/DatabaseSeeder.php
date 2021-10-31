<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Like;
use App\Models\User;
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
        $user = User::factory()->create();
        Category::factory(5)->create()->each(function ($cat) use ($user) {
            $cat->cars()->save(Car::factory()->make())->each(function ($car) use ($user) {
                $car->images()->save(Image::factory()->make());
                $car->likes()->save(Like::factory(['user_id' => $user->id])->make());
                $car->comments()->save(Comment::factory(['user_id' => $user->id])->make());
            });
        });
    }
}
