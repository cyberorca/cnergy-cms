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
        $category = Category::whereNull('parent_id')->with(["children"])->get();

        if ($request->get('name')) {
            $category->where('category', 'like', '%' . $request->name . '%');
        } 

        if ($request->get('common')) {
            $category-> where('common', 'like', '%' . $request->common . '%');
        }
        
        if ($request->get('status')) {
            $status = $request->status;
            $category ->where('is_active', $status);
        }

        $data = $this->convertDataToResponse($category);

        return response()->json($data);
    }

    private function convertDataToResponse($dataRaw){
        
        return $dataRaw->transform(function ($data, $key) {
            return [
                "id" => $data->id,
                "parent" => $data->parent_id,
                "name" => $data->category,
                "common" => strtolower($data->category),
                "url" => $data->slug,
                "type" => $data->types,
                "meta_title"=> $data->meta_title,
                "meta_keywords"=> $data->meta_keywords,
                "meta_description"=> $data->meta_description,
                "children" => $this->convertDataToResponse($data->children),
            ];
        });
    }

}
