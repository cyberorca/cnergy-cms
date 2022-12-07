<?php

namespace App\Http\Controllers\TodayTag;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TodayTag;
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
        $tag = TodayTag::latest();
        if ($request->get('inputTitle')) {
            $tag->where('title', 'like', '%' . $request->inputTitle . '%');
        } 

        if ($request->get('inputCategory')) {
            $tag-> where('category_id', 'like', '%' . $request->inputCategory . '%');
        }
        return view("today-tag.index",  [
            'today_tag' => $tag->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("today-tag.editable");
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
