<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Models\Menu;
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
        $menus = Menu::whereNull('parent_id')->with("childMenus")->get();
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
        $parent = Menu::find($id);
        return view('admin.menu.create', compact('parent'));
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
            $data['slug'] = Str::slug($data['menu_name']);
            Menu::create($data);
            // return response()->json($data);
            return redirect("menu")->with('status', 'Successfully add new menu');
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
        $menu = Menu::find($id);
        return view('admin.menu.update', compact('menu'));
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
            $menu->save();

            return redirect("menu")->with("status", "Successfully to edit menu");
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
            return redirect()->back()->with('status', 'Successfully to delete menu');
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
