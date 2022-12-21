<?php

namespace App\Http\Controllers\TodayTag;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TodayTag;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TodayTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tag = TodayTag::with(['categoryId']);
        $categories = Category::all();
        if ($request->get('inputTitle')) {
            $tag->where('title', 'like', '%' . $request->inputTitle . '%');
        } 

        if ($request->get('inputCategory')) {
            $tag-> where('category_id', 'like', '%' . $request->inputCategory . '%');
        }

        if ($request->get('inputId')) {
            $tag-> where('id', 'like', '%' . $request->inputId . '%');
        }

        return view("today-tag.index",  [
            'today_tag' => $tag->paginate(10)->withQueryString(),
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $method = explode('/', URL::current());
        $categories = Category::whereNull('deleted_at')
        ->where('is_active','=','1')
        ->get(); 
        $order = TodayTag::get();
        return view('today-tag.editable', [
            'method' => end($method),
            'categories' => $categories,
            'order' => $order,
        ]);
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

        if($data['type']==="external_link"){
            if($data['url']=== null){
                return redirect()->back()->withErrors('Please fill url data');
            }else{
                $tag=null;
            }
        }else{
            if(isset($data['Tag'])){
                $tag = $data['Tag'];
            }else{
                return redirect()->back()->withErrors('Please fill tag data');
            }
        }
        $result = new TodayTag([
            'order_by_no' => $data['order'],
            'title' => $data['title'],
            'types' => $data['type'],
            'category_id' => $data['category'],
            'tag_id' => implode(' ', $tag),
            'url' => $data['url'],
            'created_at' => now(),
            'created_by' => Auth::user()->uuid,
        ]);
        try {
            $result->save();
            return redirect()->route("today-tag.index")->with('status', 'Successfully Create Today Tag');
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
        $categories = Category::whereNull('deleted_at')
        ->where('is_active','=','1')
        ->get(); 
        $today_tag = TodayTag::find($id);
        $order = TodayTag::get();
        $tags = Tag::where('id','=',$today_tag->tag_id)->first();; 
            return view('today-tag.editable', [
                'method' => end($method),
                'categories' => $categories,
                'tags' => $tags,
                'order' => $order,
            ])->with('today_tag', $today_tag);
        
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

        if($data['type']==="external_link"){
            if($data['url']=== null){
                return redirect()->back()->withErrors('Please fill url data');
            }else{
                $tag=null;
            }
        }else{
            $data['url']=null;
            if(isset($data['Tag'])){
                $tag = $data['Tag'];
            }else{
                return redirect()->back()->withErrors('Please fill tag data');
            }
        }
        try {
            $today_tag = TodayTag::find($id);
            $today_tag->order_by_no = $data['order'];
            $today_tag->types = $data['type'];
            $today_tag->tag_id = implode(' ', $tag);
            $today_tag->url = $data['url'];
            $today_tag->title = $data['title'];
            $today_tag->category_id = $data["category"];
            $today_tag->updated_at = now();
            $today_tag->updated_by = Auth::user()->uuid;
            $today_tag->save();
            return redirect()->route("today-tag.index")->with('status', 'Successfully Update Today Tag');
        } catch (\Throwable $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($tag)
    {
        try {
            TodayTag::destroy($tag);
            return Redirect::back()->with('status', 'Successfully Delete Today Tag');
        } catch (\Throwable $e) {
            return Redirect::back()->withErrors($e->getMessage());
        }
    }
}
