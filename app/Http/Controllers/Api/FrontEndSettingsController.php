<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FrontEndSetting;
use Illuminate\Http\Request;

class FrontEndSettingsController extends Controller
{
    /**
     * Get Front End Settings
     * @OA\Get (
     *     tags={"Front End Settings"},
     *     path="/api/fe-setting/?token={token}",
     *     @OA\Parameter(
     *         in="path",
     *         name="token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *     )
     * )
     */
    public function index()
    {
        $menu_settings = FrontEndSetting::first()->makeHidden(['token', 'deleted_at', 'id']);
        $data = [
            "id" => $menu_settings["id"],
            "title" => $menu_settings["site_title"],
            "address" => $menu_settings["address"],
            "sosmed" => json_encode([
                "facebook" => $menu_settings["facebook"],
                "ig" => $menu_settings["instagram"],
                "youtube" => $menu_settings["youtube"],
                "twitter" => $menu_settings["twitter"],
            ]),
            "site_logo" => $menu_settings["site_logo"],
            "favicon" => $menu_settings["favicon"],
            "color" => $menu_settings["accent_color"],
            "domain_id" => "",
            "site_description" => $menu_settings["site_description"],
            "fb_app_id" => $menu_settings["facebook_app_id"],
            "twitter_username" => $menu_settings["twitter_username"],
            "created_at" => date('Y-m-d H:i:s', strtotime($menu_settings['created_at'])),
            "updated_at" => date('Y-m-d H:i:s', strtotime($menu_settings['updated_at'])),

        ];
        return response()->json($data);
    }
}
