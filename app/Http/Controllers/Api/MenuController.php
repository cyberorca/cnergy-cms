<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Get Menu
     * @OA\Get (
     *     tags={"Menu"},
     *     path="/api/menu/?token={token}",
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
        $menus = Menu::whereNull('parent_id')->with(["childMenus", "roles"])->get();
        // return response()->json($menus);
        return response()->json($menus);
    }
}
