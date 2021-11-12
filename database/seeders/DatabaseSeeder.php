<?php

namespace Database\Seeders;

use App\Models\About;
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
        // create fake user
        $user = User::factory()->create();
        // create fake categories
        Category::factory(5)->create()->each(function ($cat) use ($user) {
            // create fake cars
            $cat->cars()->save(Car::factory()->make())->each(function ($car) use ($user) {
                // create fake images
                $car->images()->save(Image::factory()->make());
                // create fake likes
                $car->likes()->save(Like::factory(['user_id' => $user->id])->make());
                // create fake comments for cars
                $car->comments()->save(Comment::factory(['user_id' => $user->id])->make());
            });
            // create fake comments for categories
            $cat->comments()->save(Comment::factory(['user_id' => $user->id])->make());
        });

        About::factory()->create();
    }
}
