<?php

namespace Modules\admin\app\Http\Controllers\api\v1;

use App\Http\Resources\v1\CarResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CarController
{
    public function store($category,Request $request)
    {
        $category = Category::where('slug',$category)->firstOrFail();

        $car = $category->cars()->create([
            'name' => $request->name,
            'details' => $request->details,
            'description' => $request->description,
        ]);

        return response()->json([
            'success' => true,
            'car' => $car
        ],201);
    }
}
