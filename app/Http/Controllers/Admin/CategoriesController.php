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
<<<<<<< HEAD:app/Http/Controllers/Admin/UsersController.php
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
=======
        return view('admin.categories.create');
>>>>>>> de8d8739d6f810befd2540c81a97bd5e5b034594:app/Http/Controllers/Admin/CategoriesController.php
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->input();
        $category = new Category([
            'category' => $data['category'],
            'slug' => $data['slug'],
            'type' => $data['type'],
        ]);
        try {
            $user->save();
            return redirect('users')->with('status', 'SUCCESS');
        } catch (\Throwable $e) {
            return redirect('users')->withErrors($e->getMessage());
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
<<<<<<< HEAD:app/Http/Controllers/Admin/UsersController.php
        $post   = User::where('uuid', $id)->with(['roles'])->first();
        $roles = Role::all();
        return view('admin.users.update', compact('roles'))->with('post', $post);
=======
        $post   = Post::whereId($id)->first();
        return view('admin.categories.update')->with('post', $post);
>>>>>>> de8d8739d6f810befd2540c81a97bd5e5b034594:app/Http/Controllers/Admin/CategoriesController.php
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
<<<<<<< HEAD:app/Http/Controllers/Admin/UsersController.php
        
            try {
                User::where('uuid',$id)->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'role_id' => $data['role'],
                    'is_active' => $data['is_active'],
=======
        $validator = Validator::make($data, [
            'category' => 'required|unique:categories'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return Redirect::back()->withErrors($errors);
        } else {
            try {
                Categories::where('id',$id)->update([
                    'category' => $data['category'],
                    'slug' => $data['slug'],
                    'type' => $data['type'],
>>>>>>> de8d8739d6f810befd2540c81a97bd5e5b034594:app/Http/Controllers/Admin/CategoriesController.php
                ]);
                return redirect('users')->with('status', 'SUCCESS');
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
            User::destroy($id);
            return Redirect::back()->with('status', 'SUCCESS');
        } catch (\Throwable $e) {
            return Redirect::back()->withErrors($e->getMessage());
        }
    }
}
