<?php

namespace Modules\admin\app\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class ManageCategoryController extends Controller
{
    use HasFactory;

    public function store(Request $request)
    {
        $category = Category::create([
            'name' => $request->name
        ]);

        return response()->json([
            'success' => true,
            'category' => $category
        ],201);
    }
}
