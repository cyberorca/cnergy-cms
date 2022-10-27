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
     *     path="/api/menu/",
     *     security={{"Authentication_Token":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="unauthorized",
     *       @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="The security token is invalid"),
     *          )
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
