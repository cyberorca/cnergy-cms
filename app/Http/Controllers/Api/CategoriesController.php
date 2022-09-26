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
            $categories->where('slug', 'like', '%' . $request->inputSlug . '%');
        }

        if ($request->get('status')) {
            $status = $request->status;
            if ($status == 2) {
                $categories->where('is_active', "0");
            } else {
                $categories->where('is_active', "1");
            }
        }

        $empty = "";
        $result = $categories->with(["children"])->get()->makeHidden(['is_active', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by']);
        foreach ($result as $data) {
            $res["data"][] = [
                "id" => $data["id"],
                "parent" => $data["parent_id"],
                "name" => $data["category"],
                "common" => strtolower($data["category"]),
                "url" => $data["slug"],
                "type" => json_decode($data["types"]),
                "meta_name" => $empty,
                "meta_description" => $empty,
                "children" => $data["children"],
            ];
        }

        return response()->json($res);
    }
}
