<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrontEndMenuRequest;
use App\Models\FrontEndMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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
        // if(!Cache::has("front_end_menu")){
        //     Cache::forever("front_end_menu", FrontEndMenu::getAll());
        // }
        $fe_menus = FrontEndMenu::getAll();
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
            if($input['type'] == 'anchor') {
                if($input['slug'] === null){
                    $input['slug'] = Str::slug($input['title']);
                }
                $input['target'] = 'self';
            }
            if($input['type'] == 'label') {
                $input['target'] = 'self';
                $input['slug'] = '#';
            }
            if($input['type'] == 'link') {
                if($input['slug'] === null){
                    $input['slug'] = Str::slug($input['title']);
                }
            }
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
            return redirect()->route('front-end-menu.index')->with('status', 'Successfully Create Frontend Menu');
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
            if($input['type'] == 'anchor') {
                $input['slug'] = Str::slug($input['slug']);
                $input['target'] = 'self';
            }
            if($input['type'] == 'label') {
                $input['target'] = 'self';
                $input['slug'] = '#';
            }
            if($input['type'] == 'link') {
                $input['slug'] = Str::slug($input['slug']);
            }
            // $input['slug'] = Str::slug($input['title']);
            $input['position'] = json_encode($input['position']);
            // return response()->json($input);
            $fe_menu = FrontEndMenu::find($id);
            $fe_menu->title = $input['title'];
            $fe_menu->slug = $input['slug'];
            $fe_menu->type = $input['type'];
            $fe_menu->target = $input['target'];
            $fe_menu->position = $input['position'];
            $fe_menu->save();

            return redirect()->route('front-end-menu.index')->with('status', 'Successfully Update Frontend Menu');
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
            return redirect()->back()->with('status', 'Successfully Delete Frontend Menu');
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    
    public function changeOrderMenu(Request $request)
    {
        try {
            $input = $request->sortedData;
            $fe_menu = array();
            foreach ($input as $item) {
                $item['type'] = json_encode(['anchor']);
                $item['target'] = json_encode(['same tab']);
                $item['position'] = json_encode(['header', 'footer']);
                array_push($fe_menu, $item);
            }
            FrontEndMenu::upsert($fe_menu, ['id'], ['parent_id', 'order']);
            return response()->json([
                'message' => 'Successfully to change categories data'
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
