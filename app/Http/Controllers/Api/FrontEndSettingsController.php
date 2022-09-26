<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FrontEndSetting;
use Illuminate\Http\Request;

class FrontEndSettingsController extends Controller
{
    public function index()
    {
        $menu_settings = FrontEndSetting::first()->makeHidden(['token', 'created_at', 'updated_at', 'deleted_at', 'id']);
        $data = [
            "title" => $menu_settings["title"],
            "address" => $menu_settings["address"],
            "sosmed" => json_encode([
                "facebook" => $menu_settings["facebook"],
                "fb_app_id" => $menu_settings["facebook_app_id"],
                "instagram" => $menu_settings["instagram"],
                "youtube" => $menu_settings["youtube"],
                "twitter" => $menu_settings["twitter"],
            ]),
            "color" => $menu_settings["color"],
            "site_description" => $menu_settings["site_description"],
            "twitter_username" => $menu_settings["twitter_username"],
        ];
        return response()->json($data);
    }
}
