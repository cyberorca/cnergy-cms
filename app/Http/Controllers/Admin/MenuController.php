<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::getAllPage();
        // return response()->json($menus);
        return view('admin.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        $menu = Menu::find($id);
        $method = explode('/', URL::current());
        return view('admin.menu.editable', ['menu' => $menu, 'method' => end($method)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        try {
            $data = $request->validated();
            $data['slug'] = isset($data['parent_slug']) ? $data['parent_slug'] . Str::slug($data['menu_name']) . "/" : Str::slug($data['menu_name']) . "/";
            $data['created_at'] = now();
            Menu::create($data);
            // return response()->json($data);
            return redirect()->route('menu.index')->with('status', 'Successfully Create Menu');
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
        $menu = Menu::find($id);
        return view('admin.menu.editable',  ['menu' => $menu, 'method' => end($method)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $menu = Menu::find($id);
            $menu->menu_name = $data["menu_name"];
            if($menu->parent_id){
                $slug = explode('/', $menu->slug);
                array_splice($slug, 1, count($slug));
                $menu->slug = implode('/', $slug) . "/" . Str::slug($data['menu_name']) . "/";
            } else {
                $menu->slug = Str::slug($data['menu_name']) . "/";
            }
            $menu->save();
            return redirect()->route('menu.index')->with("status", "Successfully Update Menu");
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
            Menu::destroy($id);
            return redirect()->back()->with('status', 'Successfully Delete Menu');
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
