<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TodayTag;
use App\Http\Resources\TodayTagCollection;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\TodayTagResource;

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

    public function show($id){
        $filterId = TodayTag::whereNull('deleted_at')
        ->where('id', $id)
        ->first();

        if ($filterId == null){
            return response()->json(['message'=>'Today Tag Not Found'], Response::HTTP_NOT_FOUND);
        }

        $cacheKey = "todayTagDetail-$id";
        if(!Cache::has($cacheKey)){
            CacheStorage::cache($cacheKey, 'today-tag');
            Cache::put($cacheKey, new TodayTagResource($filterId), now()->addDay());
        }

        return response()->json(Cache::get($cacheKey), Response::HTTP_OK);
    }
}
