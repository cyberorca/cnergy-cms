<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Tag;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $news = News::with(['categories', 'tags']);
        // $tag_news = Tag::get();
        // $news = News::latest();

        if ($request->get('inputCategory')) {
            $news->where('category', 'like', '%' . $request->inputCategory . '%');
        } 
        
        if ($request->get('inputTitle')) {
            $news-> where('title', 'like', '%' . $request->inputTitle . '%');
        }
        
        if ($request->get('startDate') && $request->get('endDate')) {
            $news-> whereBetween('created_at',[$request->get('startDate'), $request->get('endDate')]);
        }

        if ($request->get('headline')) {
            $headline = $request->headline;
            if($headline == 2) {
                $news ->where('is_headline', "0");
            }else {
                $news ->where('is_headline', "1");
            }
        }

               
        // return response()->json($news->paginate(10));
        return view('news.index',  [
            'news' => $news->paginate(10)->withQueryString(),
            // 'categories' => Category::whereNull("parent_id"),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        try {
            Category::destroy($id);
            return Redirect::back()->with('status', 'Successfully to Delete Category');
        } catch (\Throwable $e) {
            return Redirect::back()->withErrors($e->getMessage());
        }
    }
}
