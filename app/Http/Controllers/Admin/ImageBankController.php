<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageBankRequest;
use App\Models\ImageBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageBankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $image_bank = ImageBank::all();
        return view("admin.image-bank.index", compact("image_bank"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.image-bank.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImageBankRequest $request)
    {
        try {
            $input = $request->validated();
            $data = [
                "title" => $input["title"],
                "created_by" => Auth::user()->uuid
            ];
            if ($request->hasFile('image_input')) {
                $file = $request->file('image_input');
                $image_input = time() . "." . $file->getClientOriginalExtension();
                // Storage::delete('public/image_input_image/' . $menu->image_input);
                $file->storeAs('public/image_bank/', $image_input);
                $data['slug'] = $image_input;
            }

            ImageBank::create($data);
            return redirect('image-bank')->with('status', 'Successfully add image');
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
        try {
            $image = ImageBank::find($id);
            $image->delete();
            return redirect()->back()->with('status', 'Successfully Delete Image');
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
