<?php

namespace Modules\admin\app\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\admin\app\Notifications\PublishCarNotification;

class CarController extends Controller
{

    public function store($category,Request $request)
    {
        $category = Category::where('slug',$category)->firstOrFail();

        $this->authorize('create',Car::class);

        $car = $category->cars()->create([
            'name' => $request->name,
            'details' => $request->details,
            'description' => $request->description,
        ]);

        // send SMS for test user
        $user = User::find(1);
        $user->notify(new PublishCarNotification);

        return response()->json([
            'success' => true,
            'car' => $car
        ],201);
    }
}
