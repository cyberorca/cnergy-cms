<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrontEndSettingsRequest;
use App\Models\FrontEndSetting;
use App\Models\MenuSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FrontEndSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu_settings = FrontEndSetting::first();
        return view('admin.menu.settings.index', compact('menu_settings'));
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
    public function update(FrontEndSettingsRequest $request, $id = 1)
    {
        try {
            $input = $request->validated();
            $data = [
                "site_title" => $input["site_title"],
                "site_description" => $input["site_description"],
                "address" => $input["address"],
                "facebook" => $input["facebook"],
                "facebook_app_id" => $input["facebook_app_id"],
                "instagram" => $input["instagram"],
                "youtube" => $input["youtube"],
                "twitter" => $input["twitter"],
                "twitter_username" => $input["twitter_username"],
                "accent_color" => $input["accent_color"]
            ];
            $menu = FrontEndSetting::first(['site_logo', 'favicon']);
            if ($request->hasFile('site_logo')) {
                $file = $request->file('site_logo');
                $site_logo = time() . "." . $file->getClientOriginalExtension();
                Storage::delete('public/site_logo_image/' . $menu->site_logo);
                $file->storeAs('public/site_logo_image', $site_logo);
                $data['site_logo'] = $site_logo;
            }
            if ($request->hasFile('favicon')) {
                $file = $request->file('favicon');
                $favicon = time() . "." . $file->getClientOriginalExtension();
                Storage::delete('public/site_logo_image/' . $menu->favicon);
                $file->storeAs('public/site_logo_image', $favicon);
                $data['favicon'] = $favicon;
            }
            FrontEndSetting::updateOrCreate([
                'id' => 1
            ], $data);

            return redirect()->back()->with('status', 'Successfully save menu settings');
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
        //
    }
}
