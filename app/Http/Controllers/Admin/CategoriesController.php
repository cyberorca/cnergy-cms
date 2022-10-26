<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        // return response()->json($categories->with(["childCategory"])->get());
        return view('admin.categories.index',  [
            'categories' => $categories->with(["childCategory"])->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        $method = explode('/', URL::current());
        $parent = Category::find($id);
        return view('admin.categories.editable', ['method' => end($method), 'parent' => $parent]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->input();
        $category = new Category([
            'is_active' => '1',
            'category' => ucwords($data['category']),
            'common' => $data['category'],
            'parent_id' => $data['parent_id'] ?? null,
            'slug' => Str::slug($data['category']),
            'types' => $data['types'],
            'created_at' => now(),
            'created_by' => Auth::user()->uuid,
            'meta_title'=> $data['meta_title'],
            'meta_keywords'=> $data['meta_keywords'],
            'meta_description'=> $data['meta_description'],
        ]);
        try {
            $category->save();
            return redirect()->route('category.index')->with('status', 'Successfully Create Category');
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $method = explode('/', URL::current());
        $post = Category::where('id', $id)->first();
        return view('admin.categories.editable', ['method' => end($method)])->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->input();
        try {
            Category::where('id',$id)->update([
                'is_active' => $data['is_active'],
                'category' => ucwords($data['category']),
                'common' => $data['category'],
                'parent_id' => $data['parent_id'] ?? null,
                'slug' => Str::slug($data['category']),
                'types' => $data['types'],
                'updated_at' => now(),
                'updated_by' => Auth::user()->uuid,
                'meta_title'=> $data['meta_title'],
                'meta_keywords'=> $data['meta_keywords'],
                'meta_description'=> $data['meta_description'],

            ]);
            return redirect()->route('category.index')->with('status', 'Successfully Update Category');
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        try {
            Category::where('id',$id)->update([
                'deleted_by' => Auth::user()->uuid,
            ]);
            Category::destroy($id);
            News::where('category_id',$id)->update([
                'deleted_by' => Auth::user()->uuid,
            ]);
            News::where('category_id',$id)->delete();
            return Redirect::back()->with('status', 'Successfully Delete Category');
        } catch (\Throwable $e) {
            return Redirect::back()->withErrors($e->getMessage());
        }
    }
}
