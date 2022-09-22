<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        if ($request->get('inputCategory')) {
            $categories->where('category', 'like', '%' . $request->inputCategory . '%');
        } 

        if ($request->get('inputSlug')) {
            $categories-> where('slug', 'like', '%' . $request->inputSlug . '%');
        }
        
        if ($request->get('status')) {
            $status = $request->status;
            if($status == 2) {
                $categories ->where('is_active', "0");
            }else {
                $categories ->where('is_active', "1");
            }
        }

        return response()->json($categories);
    }
}
