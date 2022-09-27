<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::whereNull("parent_id");

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

        $result = $categories->with(["children"])->get(['id', 'parent_id as parent','category as name','category as common', 'slug as url', 'types']);
        // $data = [
        //     "id" => $result["id"],
        //     "parent" => $result["parent_id"],
        //     "name" => $result["category"],
        //     "common" => strtolower($result["category"]),
        //     "url" => $result["slug"],
        //     "type" => json_decode($result["types"]),
        //     "" => $result[""], 
        // ];

        return response()->json($result);
    }
}
