<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrontEndMenuRequest;
use App\Models\FrontEndMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
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
        $fe_menus = FrontEndMenu::whereNull('parent_id')->with(["childMenus"])->orderBy('order', 'ASC')->get();
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
        $url = explode('/', URL::current());
        $method = end($url);
        $url_count = count($url);
        $methode = $url[$url_count - 2];
        return view('admin.menu.front-end.editable', compact('parent', 'methode', 'method'));
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
            // return response()->json($input);
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
        $url = explode('/', URL::current());
        $method = end($url);
        $fe_menu = FrontEndMenu::find($id);
        return view('admin.menu.front-end.editable', compact('fe_menu', 'method'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FrontEndMenuRequest $request, $id)
    {
        try {
            $input = $request->validated();
            $input['slug'] = Str::slug($input['title']);
            $input['position'] = json_encode($input['position']);

            $fe_menu = FrontEndMenu::find($id);
            $fe_menu->title = $input['title'];
            $fe_menu->slug = $input['slug'];
            $fe_menu->position = $input['position'];
            $fe_menu->save();

            return redirect('front-end-menu')->with('status', 'Successfully to edit frontend menu');
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
            FrontEndMenu::destroy($id);
            return redirect()->back()->with('status', 'Successfully to delete frontend menu');
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function changeOrderMenu(Request $request)
    {
        try {
            // return json_decode(json_encode($request->get('data')),true) ;
            FrontEndMenu::upsert($request->get('data'), ['id', 'title', 'slug'], ['order', 'parent_id']);
            return [
                'message' => 'success'
            ];
            // return response()->json($request->get("data"));
        } catch (\Throwable $e) {
            return [
                'message' => $e->getMessage()
            ];
        }
    }
}
