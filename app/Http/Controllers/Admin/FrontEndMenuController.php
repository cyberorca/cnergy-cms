<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrontEndMenuRequest;
use App\Models\FrontEndMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FrontEndMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fe_menus = FrontEndMenu::whereNull('parent_id')->with(["childMenus"])->get();
        return view('admin.menu.front-end.index', compact('fe_menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        $parent = FrontEndMenu::find($id);
        return view('admin.menu.front-end.editable', compact('parent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FrontEndMenuRequest $request)
    {
        try {
            $input = $request->validated();
            $input['slug'] = Str::slug($input['title']);
            $input['position'] = json_encode($input['position']);
            if (array_key_exists("parent_id", $input)) {
                $order = FrontEndMenu::select('id')->where('id', $input['parent_id'])
                ->with(['child_desc' => function ($query) {
                    return $query
                    ->select('order', 'parent_id')
                    ->first();
                }])->first();
                $input['order'] = count($order->child_desc) === 0 ? 0 : $order->child_desc[0]->order + 1;
            } else {
                $order = FrontEndMenu::select('order')->orderBy('order', 'desc')->first();
                $input['order'] = $order->order + 1;
            }

            FrontEndMenu::create($input);

            return redirect('front-end-menu')->with('status', 'Successfully save frontend menu');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
