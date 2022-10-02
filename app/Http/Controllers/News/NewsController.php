<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Http\Requests\NewsRequest;
use Illuminate\Support\Facades\DB;

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
        
        if ($request->get('published')) {
            $published = $request->get('published');
            if($published == 2) {
                $news ->where('is_published', "0");
            }else {
                $news ->where('is_published', "1");
            }
        }

        if ($request->get('inputTag')) {
            $news->whereHas('tags', function($query) use ($request){
                $query->where('tags', 'like', "%{$request->get('inputTag')}%");
            });
        }

        // return response()->json($news);
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
        $method = explode('/', URL::current());
        $categories = Category::all();
        $types = ['news', 'photonews', 'video'];
        return view('news.editable', ['method' => end($method),
            'categories' => $categories,
            'types' => $types
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
        try {
            $news = new News([
                'is_headline' => $request->has('isHeadline')==false ? '0' : '1',
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'content' => $data['content'],
                'synopsis' => $data['synopsis'],
                'type' => $data['type'],
                'published_at' => $data['save'] == 'publish' ? now() :null,
                'published_by' => $data['save'] == 'publish' ? auth()->id():null,
                'created_by' => auth()->id(),
                'category_id' => $data['category']
            ]);
            $news->save();
            return \redirect('news')->with('status', 'Successfully Add New News');
        }catch (\Throwable $e){
            return Redirect::back()->withErrors($e->getMessage());
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
        $news = News::where('id', $id)->first();
        $categories = Category::all();
        $types = ['news', 'photonews', 'video'];
        return view('news.editable', ['method' => end($method),
            'categories' => $categories,
            'types' => $types,
            'news' => $news
        ]);
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
        $newsById = News::find($id);
        try {
            $newsById->update([
                'is_headline' => $request->has('isHeadline')==false ? '0' : '1',
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'content' => $data['content'],
                'synopsis' => $data['synopsis'],
                'type' => $data['type'],
                'published_at' => $data['save'] == 'publish' ? now() :null,
                'published_by' => $data['save'] == 'publish' ? auth()->id():null,
                'updated_by' => auth()->id(),
                'category_id' => $data['category']
            ]);
            return \redirect('news')->with('status', 'Successfully Update News');
        }catch (\Throwable $e){
            return Redirect::back()->withErrors($e->getMessage());
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
        //
    }
}
