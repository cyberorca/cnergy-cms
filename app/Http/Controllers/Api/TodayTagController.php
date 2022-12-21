<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TodayTag;
use App\Http\Resources\TodayTagCollection;

class TodayTagController extends Controller
{
    public function index(Request $request)
    {
        $todayTag = TodayTag::orderBy('id');

        $limit = $request->get('limit', 20);
        if($limit > 20){
            $limit = 20;
        }
    
        // return response()->json($todayTag->get());
        return response()->json(new TodayTagCollection($todayTag->paginate($limit)->withQueryString()));
    }
}
