<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FrontEndSetting;
use Illuminate\Http\Request;

class FrontEndSettingsController extends Controller
{
    public function index()
    {
        $menu_settings = FrontEndSetting::first();
        return response()->json($menu_settings);
    }
}
