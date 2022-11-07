<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventoryManagement;
use App\Http\Resources\InventoryCollection;
use Symfony\Component\HttpFoundation\Response;

class InventoryManagementController extends Controller
{
    public function index()
    {
        $inventoryManagement = InventoryManagement::latest();

        return response()->json(new InventoryCollection($inventoryManagement->get()));
        
    }

}
