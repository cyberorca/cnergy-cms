<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\User;
use App\Http\Requests\TagsRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;



class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tags = Tag::latest();

        if ($request->get('inputTags')) {
            $tags->where('tags', 'like', '%' . $request->inputTags . '%');
        } 

        if ($request->get('inputSlug')) {
            $tags-> where('slug', 'like', '%' . $request->inputSlug . '%');
        }
        
        if ($request->get('status')) {
            $status = $request->status;
            if($status == 2) {
                $tags ->where('is_active', "0");
            }else {
                $tags ->where('is_active', "1");
            }
        }

        // return view('admin.tags.index',compact('tags'));
        return view('admin.tags.index',  [
            'tags' => $tags->paginate(10)->withQueryString(),
            // 'slug' => Tag::all()
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
        return view('admin.tags.editable', ['method' => end($method)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagsRequest $request)
    {
        
        $data = $request->input();
        $tags = new Tag([
            'tags' => ucwords($data['tag']),
            'slug' => Str::slug($data['tag']),
            'meta_description' => $data['description'],
            'meta_title' => $data['title'],
            'meta_keywords' => $data['keywords'],
            'created_at' => now(),
            // ganti uuid user login nanti
            'created_by' => Auth::user()->uuid,
            'updated_by' => Auth::user()->uuid,
        ]);
        try {
            $tags->save();
            return redirect()->route("tag-management.index")->with('status', 'Successfully Create Tag');
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show($tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit($tags)
    {
        $method = explode('/', URL::current());
        $tag = Tag::find($tags);
        return view('admin.tags.editable', ['method' => end($method)])->with('tag', $tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response 
     */
    public function update(TagsRequest $request, $tags)
    {
        $data = $request->input();
        
        try {
            $tag = Tag::find($tags);
            $tag->tags = ucwords($data['tag']);
            $tag->slug = Str::slug($data['tag']);
            $tag->is_active = $data["is_active"];
            $tag->meta_description = $data['description'];
            $tag->meta_title = $data["title"];
            $tag->meta_keywords = $data['keywords'];
            $tag->updated_at = now();
            $tag->updated_by = Auth::user()->uuid;
            $tag->save();
            return redirect()->route("tag-management.index")->with('status', 'Successfully Update Tag');
        } catch (\Throwable $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($tag)
    {
        try {
            Tag::destroy($tag);
            return Redirect::back()->with('status', 'Successfully Delete Tag');
        } catch (\Throwable $e) {
            return Redirect::back()->withErrors($e->getMessage());
        }
    }
}
