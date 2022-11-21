<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventoryManagement;
use App\Http\Resources\InventoryCollection;
use Symfony\Component\HttpFoundation\Response;

/**
 * Get Inventory Management
 * @OA\Get (
 *     tags={"Inventory Management"},
 *     path="/api/inventory/",
 *     security={{"Authentication_Token":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="success",
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="bad request",
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
class InventoryManagementController extends Controller
{
    public function index(Request $request)
    {
        // $inventoryManagement = InventoryManagement::latest();
        $inventoryManagement = InventoryManagement::orderBy('id');

        $type = $request->get('type');
        if($type){
            $inventoryManagement->where('type', '=', $type);
        }

        return response()->json(new InventoryCollection($inventoryManagement->get()));

    }

}
