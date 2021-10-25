<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\CarCollection;
use App\Http\Resources\v1\CarResource;
use App\Models\Car;
use App\Models\Category;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        $cars = Car::all();

        return new CarCollection($cars);
    }

    public function show($car)
    {
        $car = Car::where('slug', $car)->firstOrFail();

        return new CarResource($car);
    }

    public function delete($car)
    {
        $car = Car::where('slug', $car)->firstOrFail();

        $car->delete();

        return response()->json([
            'success' => true
        ], 202);
    }

    public function filter()
    {
        $categories = Category::all();
        if (request()->category) {
            $cars = Car::with('category')->whereHas('category', function ($query) {
                $query->where('slug', request()->category);
            })->get();
        } else {
            $cars = Car::paginate(10);
        }
        return new CarCollection($cars);
    }
}
