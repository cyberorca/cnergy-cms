<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FrontEndSetting;
use Illuminate\Http\Request;

class FrontEndSettingsController extends Controller
{
    public function index()
    {
        $menu_settings = FrontEndSetting::first()->makeHidden(['token', 'deleted_at', 'id']);
        $data = [
            "id" => $menu_settings["id"],
            "title" => $menu_settings["title"],
            "address" => $menu_settings["address"],
            "sosmed" => json_encode([
                "facebook" => $menu_settings["facebook"],
                "fb_app_id" => $menu_settings["facebook_app_id"],
                "instagram" => $menu_settings["instagram"],
                "youtube" => $menu_settings["youtube"],
                "twitter" => $menu_settings["twitter"],
            ]),
            "site_logo" => "",
            "favicon" => "",
            "color" => $menu_settings["color"],
            "domain_id" => "",
            "site_description" => $menu_settings["site_description"],
            "fb_app_id" => "",
            "twitter_username" => $menu_settings["twitter_username"],
            "created_at" => date('Y-m-d H:i:s', strtotime($menu_settings['created_at'])),
            "updated_at" => date('Y-m-d H:i:s', strtotime($menu_settings['updated_at'])),

        ];
        return response()->json($data);
    }
}
