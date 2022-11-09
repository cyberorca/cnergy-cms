<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventoryManagement;
use App\Http\Resources\InventoryCollection;
use Symfony\Component\HttpFoundation\Response;

class InventoryManagementController extends Controller
{
    public function index(Request $request)
    {
        $inventoryManagement = InventoryManagement::latest();

        $type = $request->get('type');
        if($type){
            $inventoryManagement->where('type', '=', $type);
        }

        return response()->json(new InventoryCollection($inventoryManagement->get()));
        
    }

}
