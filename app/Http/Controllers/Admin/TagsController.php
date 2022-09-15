<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Http\Requests\TagsRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;


class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::latest()->paginate(5);
      
        return view('admin.tags.index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
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
            'tags' => $data['tag'],
            'slug' => $data['slug'],
            'created_at' => now(),
            // ganti uuid user login nanti
            'created_by' => '53ca775a-49f4-476e-8a30-cc1e6a5ac306',
        ]);
        try {
            $tags->save();
            return redirect("tags")->with('status', 'SUCCESS');
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
        $tag = Tag::find($tags);
        return view('admin.tags.update', compact('tag'));
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
        $data = $request->validated();
        
        try {
            $tag = Tag::find($tags);
            $tag->tags = $data["tag"];
            $tag->slug = $data["slug"];
            $tag->is_active = $data["is_active"];
            $tag->updated_at = now();
            $tag->updated_by = '53ca775a-49f4-476e-8a30-cc1e6a5ac306';
            $tag->save();
            return redirect('tags')->with('status', 'SUCCESS');
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
            return Redirect::back()->with('status', 'SUCCESS');
        } catch (\Throwable $e) {
            return Redirect::back()->withErrors($e->getMessage());
        }
    }
}
