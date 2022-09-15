<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.create', compact('categories'));
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
            'category' => $data['category'],
            'common' => $data['category'],
            'parent_id' => '0',
            'slug' => $data['slug'],
            'types' => '["news", "video", "photonews"]',
            'created_at' => now(),
            // ganti uuid user login nanti
            'created_by' => '013ef5af-6f7b-4437-b9d2-51cd4e000aa7',
        ]);
        try {
            $category->save();
            return redirect('categories')->with('status', 'SUCCESS');
        } catch (\Throwable $e) {
            return redirect('categories')->withErrors($e->getMessage());
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
        $post = Category::where('id', $id);
        return view('admin.categories.update', compact('post'));
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
                'category' => $data['category'],
                'common' => $data['category'],
                'parent_id' => '0',
                'slug' => $data['slug'],
                'types' => '["news", "video", "photonews"]',
                'updated_at' => now(),
                // ganti uuid user login nanti
                'updated_by' => '013ef5af-6f7b-4437-b9d2-51cd4e000aa7',
            ]);
            return redirect('categories')->with('status', 'SUCCESS');
        } catch (\Throwable $e) {
            return Redirect::back()->withErrors($e);
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
            Category::destroy($id);
            return Redirect::back()->with('status', 'SUCCESS');
        } catch (\Throwable $e) {
            return Redirect::back()->withErrors($e->getMessage());
        }
    }
}
