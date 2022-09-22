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
        return response()->json($menu_settings);
    }
}
